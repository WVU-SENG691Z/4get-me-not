<?php
    session_start();

    //check if there was a referring page that was access without being signed in, 
    //if so, go to that one after successful sign in 
    if(isset($_GET['location']))
        $_SESSION["origURL"] = $_GET['location'];
    else
    {
        //otherwise go to the page where you clicked sign in
        if ( !isset( $_SESSION["origURL"] ) )
            $_SESSION["origURL"] = $_SERVER["HTTP_REFERER"];
    }

    $username = $password = "";
    $success = false;
    $errors = array();

    if ($_SERVER["REQUEST_METHOD"] == "POST") 
    {
        if(empty($_POST["username"])) 
            $errors[] = "Username is required";
        else 
            $username = test_input($_POST["username"]);

        if(empty($_POST["password"]))
            $errors = "Password is required";
        else
            $password = test_input($_POST["password"]);

        if(empty($errors)) //no errors, so we can continue to validation
        {
            $dbLink = pg_connect("host=127.0.0.1 dbname=dev1 user=postgres")
                          or die("Unable to connect to database");

            $query  = "SELECT id, email, salt, passhash FROM users WHERE email LIKE '".$username."';";
            $result = pg_query($dbLink, $query);

            if(pg_num_rows($result) == 1) //found a username match
            {
                $row = pg_fetch_object($result);

                //validate password
                $salt = $row->salt;
                $passwdHash = $row->passhash;

                if(md5(md5($password).md5($salt)) != $passwdHash)
                    $errors[] = "Invalid Credentials, Try Again";
                else
                {
                    $success = true;
                    $_SESSION["USER_ID"] = $row->id;
                    $_SESSION["AGENT_STRING"] = $_SERVER["HTTP_USER_AGENT"];

                    //generate public key
                    date_default_timezone_set('America/Chicago');
                    $publickey = md5($username.date('U'));

                    //generate private key
                    $privatekey = md5($salt.$_SERVER["HTTP_USER_AGENT"]);

                    //check autologin table for number of autologins for current user
                    $userid = $row->id;
                    $query  = "SELECT count(id) FROM autologin WHERE user_id=".$userid;
    
                    $result = pg_query($dbLink, $query);

                    if(pg_num_rows($result) > 3)
                    {
                        //too many autologins, delete oldest
                        $query  = "DELETE FROM autologin WHERE id = (SELECT id FROM autologin ".
                                  "WHERE user_id=".$userid." ORDER BY last_used_on ASC LIMIT 1";
                        $result = pg_query($dbLink, $query);

                        $query  = "INSERT INTO autologin (user_id, public_key, private_key, ".
                                  "created_on) VALUES (".$userid.", '".$publickey."', ".
                                  "'".$privatekey."', 'now()')";
                        $result = pg_query($dbLink, $query);

                        setcookie("publickey", $userid.$publickey);
                    }
                    
                }
            }
            else
                $errors[] = "Invalid Credentials, Try Again";
        }

        if($success == true)
        {
            header("Location: ".$_SESSION["origURL"]);
        }
    }

    function test_input($data) 
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>4get-me-not</title>

  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"/>
  <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet"/>
</head>

<body>
<div class="container">
  <div id="loginbox" style="margin-top:60px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2"> 
  <?php
    foreach ($errors as &$value)
    {
         echo '<div class="row">'.
             '<div class="alert alert-dismissible alert-danger alert-sm" role="alert">'.
             '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'.
             '<span aria-hidden="true">&times;</span></button>'.
             '<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>'.
             '<span class="sr-only">Error:</span> '.$value.'</div></div>';
    } 
  ?>
    <div class="panel panel-info" >
      <div class="panel-heading">
        <div class="panel-title">Sign in to 4get-me-not</div>
        <div style="float:right; font-size: 80%; position: relative; top:-10px"><a href="#">Forgot password?</a></div>
      </div>
      <div style="padding-top:30px" class="panel-body" >
        <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
        <form id="loginform" class="form-horizontal" role="form" method="post" 
              action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
          <div style="margin-bottom: 25px" class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
            <input id="login-username" type="email" class="form-control" name="username" value="<?php echo $username;?>" 
                   placeholder="email" required>
          </div>
          <div style="margin-bottom: 25px" class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
            <input id="login-password" type="password" class="form-control" name="password" placeholder="password" required>
          </div>
<!--
          <div class="input-group">
            <div class="checkbox">
              <label>
                <input id="login-remember" type="checkbox" name="remember" value="1"> Remember me
              </label>
            </div>
          </div>
-->
          <div style="margin-top:10px" class="form-group">
            <!-- Button -->
            <div class="col-sm-12 controls">
              <button type="submit" class="btn btn-success">Login</button>
<!--              <a id="btn-login" href="#" class="btn btn-success">Login</a> -->
            </div>
          </div>
          <div class="form-group">
            <div class="col-md-12 control">
              <div style="border-top: 1px solid#888; padding-top:15px; font-size:85%" >
                Don't have an account? 
                <a href="register.php">Create Account</a>
              </div>
            </div>
          </div>    
        </form>     
      </div>                     
    </div>  
  </div>
</div>
<br><br><br>

<footer>
  <div class="container">
  <hr/>
    <div class="row" style="margin-top: -20px; margin-bottom: -20px;">
      <div class="pull-right" style="margin-right: 20px">
        <h5>
          &copy; 2015 The Iterators
        </h5>
      </div>
    </div>
  </div>
</footer>

<script src="js/jquery-1.11.2.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<script src="js/deleteEvent.js"></script>

</body>
</html>
