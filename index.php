

<!DOCTYPE html>
<html lang="en">

<head>
  <title>4get-me-not</title>

  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

  <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .jumbotron {
      color: white;
      height: 500px;
      width: 100%;
      background-size: cover; 
      background-position: center; 
      background: url('img/calendar_1600.jpg') no-repeat;
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
<header class="navbar navbar-default navbar-inverse navbar-static-top" id="top" role="banner">
  <div class="container">
    <div class="navbar-header">
      <button class="navbar-toggle collapsed" type="button" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="sr-only"> Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
    <a class="navbar-brand" href="#">4get-me-not</a>
    </div>
    <nav class="collapse navbar-collapse navbar-inverse">
      <ul class="nav navbar-nav">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Menu<strong class="caret"></strong></a>
          <ul class="dropdown-menu">
            <li>
              <a href="#">Open Calendar</a>
            </li>
            <li>
              <a href="#">Do something else</a>
            </li>
          </ul>
         </li>
      </ul>
      <form class="navbar-form navbar-left" role="search">
        <div class="form-group">
          <input type="text" class="form-control" />
        </div> <button type="submit" class="btn btn-default">Search Tasks</button>
      </form>
      <ul class="nav navbar-nav navbar-right">
        <li>
          <a href="login.php">Sign In</a>
        </li>
      </ul>
    </nav>
  </div>
</header>

<div class="jumbotron vertical-center">
  <div class="container">
    <h1>
      4get-me-not
    </h1>
    <div>
      Your go to task/event organizer. Put me in your pocket.
    </div><br>
    <p>
      <a class="btn btn-primary btn-large" href="#">Learn more</a>
    </p>  
  </div>
</div>

<div class="container">
  <div class="row">
    <div class="col-md-4">
      <h2>
       Task Reminders
      </h2>
      <p>
         We can remind you of a task!!
       </p>
       <p>
        <a class="btn btn-primary" href="#">View details</a>
       </p>
    </div>
<!--  </div>
  <div class="row"> -->
    <div class="col-md-4">
      <h2>
       Event Notifications
      </h2>
      <p>
        Get notified of upcoming events!!!!
      </p>
      <p>
        <a class="btn btn-primary" href="#">View details</a>
      </p>
    </div>
<!--  </div>
  <div class="row"> -->
    <div class="col-md-4">
      <h2>
        QR Code Scanning
      </h2>
      <p>
        Scan your QR code stickers to get information on your task.
      </p>
      <p>
        <a class="btn btn-primary" href="#">View details</a>
      </p>
    </div>
<!--    <div class="col-md-3 column">
      <img src="img/qrcode.jpg" class="img-responsive" alt="QR image">
    </div> -->
  </div>
</div>

<script src="js/jquery-1.11.2.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>

</body>
</html>
