

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
<header class="navbar navbar-default navbar-static-top" id="top" role="banner"
        style="margin-bottom: -20px;">
  <div class="container">
    <div class="navbar-header">
      <button class="navbar-toggle collapsed" type="button" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="sr-only"> Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
    </div>
    <nav class="collapse navbar-collapse">
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
	 <li>
           <a href="#">About</a>
         </li>
      </ul> <!--
      <form class="navbar-form navbar-left" role="search">
        <div class="form-group">
          <input type="text" class="form-control" />
        </div> <button type="submit" class="btn btn-default">Search Tasks</button>
      </form> -->
      <ul class="nav navbar-nav navbar-right">
        <li>
          <div class="btn-toolbar">
            <button id="signin" style="background-color: #1E90FF; color: white" 
                    class="navbar-btn btn btn-default">Sign In</button>
            <button id="createaccount" style="background-color: #D3D3D3;" 
                    class="navbar-btn btn btn-default">Create Account</button>
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
    <div class="col-md-6">
      <h2>
        Features
      </h2>
    </div>
  </div>
  <div class="row">
    <div class="col-md-4">
      <h3>
       Task Reminders
      </h3>
      <p>
         We can remind you of a task and let you blah blah do stuff blah blah
       </p>
       <p>
        <a class="btn btn-primary" href="#">View details</a>
       </p>
    </div>
<!--  </div>
  <div class="row"> -->
    <div class="col-md-4">
      <h3>
       Event Notifications
      </h3>
      <p>
        Get notified of upcoming events! Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
      </p>
      <p>
        <a class="btn btn-primary" href="#">View details</a>
      </p>
    </div>
<!--  </div>
  <div class="row"> -->
    <div class="col-md-4">
      <h3>
        QR Code Scanning
      </h3>
      <p>
        Scan your QR code stickers to get information on your task or event. The stickers can be blah some other text with blah blah stuff all over the blah. 
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
<hr/>
<div class="container">
  <div class="row">
    <div class="col-md-6">
      <h2>
        More Content
      </h2>
    </div>
  </div>
   <div class="row">
    <div class="col-md-4">
      <h3>
       Stuff
      </h3>
      <p>
         We can remind you of a task and let you blah blah do stuff blah blah
      </p>
    </div>
     <div class="col-md-4">
      <h3>
       More Stuff
      </h3>
      <p>
         wefgjbgl;ksbgf stg wteg wethwtreh wthrethwer hhwerth etg
      </p>
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

<script>

  $(function(){
    $('#signin').click(function(){
        window.location='login.php';
    });
  });

</script>

</body>
</html>
