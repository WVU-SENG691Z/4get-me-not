<header class="navbar navbar-default navbar-fixed-top" id="top" role="banner"
        style="margin-bottom: -20px;">
  <div class="container">
    <div class="navbar-header">
      <button class="navbar-toggle collapsed" type="button" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="sr-only"> Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="index.php">4get-me-not</a>
    </div>
    <nav class="collapse navbar-collapse">
<?php
    if(isset($_SESSION['USER_ID']))
    {
        echo '<ul class="nav navbar-nav">
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Menu<strong class="caret"></strong></a>
                <ul class="dropdown-menu">
                  <li>
                    <a href="calendar.php">Calendar</a>
                  </li>
                  <li>
                    <a href="handles.php">QR</a>
                  </li>
                </ul>
              </li>
            </ul>
            <form class="navbar-form navbar-left" role="search" action="searchCalendar.php" method="GET">
              <div class="input-group">
                <input type="text" name="searchkey" class="form-control" 
                       placeholder="Search Tasks/Events"/>
                <span class="input-group-btn">
                  <button type="submit" class="btn btn-default" type="button">Go!</button>
                </span>
              </div>
            </form>';
    }
?>
      <ul class="nav navbar-nav navbar-right">
        <li>
          <div class="btn-toolbar">
<?php

    if(isset($_SESSION['USER_ID']))
    {
        $dbLink = pg_connect("host=127.0.0.1 dbname=dev1 user=postgres")
                    or die("Unable to connect to database");

        $userid = $_SESSION['USER_ID'];
        $query  = "SELECT username FROM users WHERE id=".$userid;
    
        $result = pg_query($dbLink, $query);

        if(pg_num_rows($result) > 0)
        {
            $row = pg_fetch_object($result);

            echo '    <a href="signout.php" class="navbar-btn btn btn-default">Sign Out</a>'.
                 '    <p class="navbar-text">Hi, '.$row->username.'</p>';
        }
        else //may be a problem, no information found for user id
        {
            //sign out user
            header("Location: signout.php");
        }
    }
    else
    {
        echo '    <a href="signin.php" '.
                         'class="navbar-btn btn btn-primary">Sign In</a>'.
             '    <a href="register.php" style="background-color: #D3D3D3;"'.
                         'class="navbar-btn btn btn-default">Create Account</a>';
    }
?>
          </div>
        </li>
      </ul>
    </nav>
  </div>
</header>



