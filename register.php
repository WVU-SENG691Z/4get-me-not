<?php

    session_start();
    $email = $firstname = $lastname = $password = $passwordconf = "";
    $success = false;

    $errors = array();

    if ($_SERVER["REQUEST_METHOD"] == "POST") 
    {
        if(empty($_POST["email"]))
            $errors[] = "Username is required";
        else 
            $email = test_input($_POST["email"]);
/*    
        if(empty($_POST["firstname"]))
            $errors[] = "First Name is required";
        else
            $firstname = test_input($_POST["firstname"]);

        if(empty($_POST["lastname"]))
            $errors[] = "Last Name is required";
        else
            $lastname = test_input($_POST["lastname"]);
*/
        if(empty($_POST["password"]))
            $errors[] = "Password is required";
        else
            $password = test_input($_POST["password"]);

        if(empty($_POST["passwordconf"]))
            $errors[] = "Password must be confirmed";
        else
            $passwordconf = test_input($_POST["passwordconf"]);

        if(strlen($password) < 6)
            $errors[] = "Minimum pasword length is 6 characters";

        if($password != $passwordconf)
            $errors[] = "Passwords must match in password and confirm fields";


        if(empty($errors)) //no errors, so we can continue to validation
        {
            $dbLink = pg_connect("host=127.0.0.1 dbname=dev1 user=postgres")
                          or die("Unable to connect to database");

            $query  = "SELECT * FROM users WHERE email LIKE '".$email."';";
            $result = pg_query($dbLink, $query);

            if(pg_num_rows($result) > 0)
                $errors[] = "Account already exists. Try again or Sign In";
            else
            {
                //generate salt
                $salt = utf8_decode(mcrypt_create_iv(5, MCRYPT_DEV_URANDOM));
                $passwdHash = md5(md5($password).md5($salt));
                $ip = ip2long($_SERVER['REMOTE_ADDR']);

                $query  = "INSERT INTO users (username, email, salt, passhash, reg_date, reg_ip) VALUES".
                          "('".$email."','".$email."', '".$salt."', '".$passwdHash."', 'now()', ".$ip.");";

                $result = pg_query($dbLink, $query);

                if($result)
                {
                    $success = true;
                }
                else
                    $errors[] = pg_last_error($dbLink);
            }
        }

        if($success == true)
        {
            echo '<div class="row">'.
             '<div class="alert alert-dismissible alert-success alert-sm" role="alert">'.
             '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'.
             '<span aria-hidden="true">&times;</span></button>'.
             '<span class="glyphicon" aria-hidden="true"></span>'.
             '<span class="sr-only"></span>Successfully created User account. Redirecting... '.
             '</div></div>';
            header("Refresh: 5; URL=calendar.php");
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
  <div id="signupbox" style="margin-top:60px" 
       class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
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
    <div class="panel panel-info">
      <div class="panel-heading">
        <div class="panel-title">Create Account</div>
        <div style="float:right; font-size: 85%; position: relative; top:-10px">
          <a id="signinlink" href="signin.php">Sign In</a></div>
      </div>  
      <div class="panel-body" >
        <form id="signupform" class="form-horizontal" role="form" method="post"
              action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
          <div id="signupalert" style="display:none" class="alert alert-danger">
            <p>Error:</p>
            <span></span>
          </div>
          <div class="form-group">
            <label for="email" class="col-md-3 control-label">Email</label>
            <div class="col-md-9">
              <input type="email" class="form-control" name="email" placeholder="Email Address" required>
            </div>
          </div>
<!--
          <div class="form-group">
            <label for="firstname" class="col-md-3 control-label">First Name</label>
            <div class="col-md-9">
             <input type="text" class="form-control" name="firstname" placeholder="First Name" required>
            </div>
          </div>
          <div class="form-group">
            <label for="lastname" class="col-md-3 control-label">Last Name</label>
            <div class="col-md-9">
              <input type="text" class="form-control" name="lastname" placeholder="Last Name" required>
            </div>
          </div>
-->
          <div class="form-group">
            <label for="password" class="col-md-3 control-label">Password</label>
            <div class="col-md-9">
              <input type="password" class="form-control" name="password" placeholder="Password" required>
            </div>
          </div>
          <div class="form-group">
            <label for="passwordicode" class="col-md-3 control-label">Confirm</label>
            <div class="col-md-9">
              <input type="password" class="form-control" name="passwordconf" placeholder="Password" required>
            </div>
          </div>
          <div class="form-group">
              <!-- Button -->                                        
            <div class="col-md-offset-3 col-md-9">
              <button id="btn-signup" type="submit" class="btn btn-info">Sign Up</button>
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
