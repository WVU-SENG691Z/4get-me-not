<html lang="en">

<head>
  <title>4get-me-not</title>

  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

  <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="css/responsive-calendar.css" rel="stylesheet" media="screen">
</head>

<body>
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
    </div>
    <nav class="collapse navbar-collapse">
      <ul class="nav navbar-nav">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Menu<strong class="caret"></strong></a>
          <ul class="dropdown-menu">
            <li>
            <li>
              <a href="#">Do something</a>
            </li>
          </ul>
         </li>
         <li>
           <a href="#">About</a>
         </li>
      </ul>
      <form class="navbar-form navbar-left" role="search">
        <div class="form-group">
          <input type="text" class="form-control" />
        </div> <button type="submit" class="btn btn-default">Search Tasks</button>
      </form>
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

<div class="container">
  <div class="row" style="margin-top: 60px">
    <div class="col-md-4">
      <div id="calendar" class="responsive-calendar">
        <div class="controls">
            <a class="pull-left" data-go="prev"><div class="btn btn-primary">Prev</div></a>
            <h4><span data-head-year></span> <span data-head-month></span></h4>
            <a class="pull-right" data-go="next"><div class="btn btn-primary">Next</div></a>
        </div><hr/>
        <div class="day-headers">
          <div class="day header">Mon</div>
          <div class="day header">Tue</div>
          <div class="day header">Wed</div>
          <div class="day header">Thu</div>
          <div class="day header">Fri</div>
          <div class="day header">Sat</div>
          <div class="day header">Sun</div>
        </div>
        <div class="days" data-group="days">
          <!-- the place where days will be generated -->
        </div>
      </div>
    </div>
    <div class="col-md-3 col-md-offset-1" style="margin-top: -20px">
      <h2>Events</h2>
      <div id="eventlist"> <div>
    </div>
  </div>
</div>

</body>

<script src="js/jquery-1.11.2.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<script src="js/responsive-calendar.min.js"></script>

<script type="text/javascript">

$( document ).ready( function() {
  function addLeadingZero(num) {
    if (num < 10) {
      return "0" + num;
    } else {
      return "" + num;
    }
  }

  function loadCalendar() 
  {
    $.ajax(
    {
      type:'POST',
      url:'loadCalendar.php',
      data: {userid: 123},
      success: function (response)
      {
        var data = JSON.parse(response);
        $('#calendar').responsiveCalendar('edit', data);
      }
    });
  }

  $('#calendar').responsiveCalendar({
    time: '2015-04',
    
    onDayClick: function(events) 
    { 
      key = $(this).data('year')+'-'+addLeadingZero( $(this).data('month') )+'-'+
            addLeadingZero( $(this).data('day') );

      $.ajax(
      {
        type:'GET',
        url:'loadDayCalendar.php',
        data: {day: key, userid: 123},
        success: function (response)
        {
          $("#eventlist").html(response);
        }
      });
    }
  });

  loadCalendar();
});

</script>
