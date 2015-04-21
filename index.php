<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>4get-me-not</title>

  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"/>

  <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet"/>
  <style>
    .jumbotron {
      background-color: ;
      height: 600px;
      background: url('img/calendar_1600.jpg') center top no-repeat;
      background-size: cover;
    }
  </style>

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>

<body>
<?php
  require('header.php');
?>
<div class="jumbotron" style="margin-bottom: 0px;">
  <div class="container" style="color: black; transform: translateY(30%); ">
    <h1 style="">4get-me-not</h1>
    <div>Your go to task/event organizer. Put me in your pocket.</div><br>
    <p><a class="btn btn-primary btn-large" href="#">Learn more</a></p> 
  </div>
</div>

<div style="height: 220px;">
<div class="container">
  <div class="row" style="margin-top: 60px;">
    <center>
      <h3>Get notifications for your upcoming events</h3>
      <a class="btn btn-primary btn-large" style="margin-top: 20px;" 
         href="#">See how we keep you in the know</a>
    </center>
  </div>
  <hr/>
</div>
</div>
<div class="container">
  <div class="row" style="margin-top: 30px">
    <div class="col-md-3">
      <img src="img/qrcode.jpg" class="img-responsive" alt="QR image">
    </div>
    <div class="col-md-4">
      <h3>QR Code Scanning</h3>
      <p> Generate and scan your own QR Codes for your tasks</p>
    </div>
  </div>
</div>

<div style="background: url('img/reminder.jpg') center top no-repeat; 
            background-size: cover; height: 450px;">
<div class="container">
  <div class="row" style="margin-top: 30px">
    <div class="col-md-4">
      <h3>Task Reminders</h3>
      <p>We can remind you of an upcoming task so you aren't overwhelmed with your busy schedule</p>
    </div>
  </div>
</div>
</div>
<div style="height: 700px; background-color: #286090;">
<div class="container">
  <div class="row">
    <div class="col-md-6" style="margin-top: 60px; color: white;">
      <h1>Sign in to get started</h1>
      <p>Start integrating your tasks into your life!</p>
       <a class="btn btn-default" href="signin.php">Sign in</a>
    </div>
    <div class="col-md-offset-2 col-md-4">
        <img src="img/4get-me-not_phone.png" style="height: 650px;" class="img-responsive" >
    </div>
  </div>
</div>
</div>

<div style="background-color: #EDEDED; height: 300px;">
<div class="container">
  <div class="row" style="margin-top: 60px;">
    <div class="col-md-4">
      <h3>Email Notifications</h3>
      <p>Notifications for upcoming events and tasks on your schedule</p>
    </div>
     <div class="col-md-4">
      <h3>Phone Alerts</h3>
      <p>For stuff</p>
    </div>
    <div class="col-md-4">
      <h3>Text Reminders</h3>
      <p>Yep, we have that too</p>
    </div>
  </div>
</div>
</div>

<div style="background-color: #F9F9F9; height: 250px;">
  <div class="container">
    <center>
      <div class="row" style="margin-top: 60px;">
        <h3>Start saving time and start being on time.</h3>
      </div>
      <div class="row" style="margin-top: 20px;">
        <a href="register.php" class="btn btn-info btn-lg">Create Your Account</a>
      </div>
    </center>
  </div>
</div>


<footer>
  <div class="container">
  <hr/>
    <div class="row" style="margin-top: -20px; margin-bottom: -20px;">
      <a class="pull-left" style="margin-left: 20px">About</a>
      <a class="pull-left" style="margin-left: 20px">Careers</a>
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

</body>
</html>
