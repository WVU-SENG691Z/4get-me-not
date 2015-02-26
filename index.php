

<!DOCTYPE html>
<html lang="en">

<head>
  <title>4get-me-not</title>

  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

  <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>

<body>
<div class="container-fluid">
  <div class="row-fluid">
    <div class="col-md-12 column">
      <nav class="navbar navbar-default navbar-inverse" role="navigation">
        <div class="collapse navbar-collapse">
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
        </div>
      </nav>
      <div class="jumbotron">
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
  </div>
  <div class="row-fluid">
    <div class="col-md-4 column">
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
     <div class="col-md-4 column">
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
    <div class="col-md-4 column">
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
  </div>
</div>

<script src="js/jquery-1.11.2.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>

</body>
</html>
