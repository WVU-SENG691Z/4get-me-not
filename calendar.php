<html lang="en">

<head>
  <title>4get-me-not</title>

  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

  <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="css/responsive-calendar.css" rel="stylesheet" media="screen">
  <link href="css/smallmodal.css" rel="stylesheet" media="screen">
</head>

<body>
<?php
  require('header.php');
?>
<div class="container">
  <div class="row" style="margin-top: 60px">
    <div class="col-md-6">
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
    <div class="col-md-6" style="margin-top: -20px">
      <h2>Events</h2>
      <div id="eventlist"> </div>
    </div>
  </div> <!--
  <div class="row">
    <div class="col-md-4">
      <div class="col-md-6">
        <button id="addevent" class="btn btn-primary">Add Event</button>
      </div>
      <div class="col-md-6">
        <button id="addevent" class="btn btn-primary">Delete Event</button>
      </div>
    </div>
  </div>-->
</div>

<div id="addEventModal" class="modal fade bs-example-modal-sm">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title" id="myModalLabel">Add Event</h4>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-group">
            <label for="event-title" class="control-label">Title:</label>
            <input type="text" class="form-control" id="event-title">
          </div>
          <div class="form-group">
            <label for="event-start" class="control-label">Start Time:</label>
            <input type="datetime-local" class="form-control" id="event-start">
          </div>    
          <div class="form-group">
            <label for="event-end" class="control-label">End Time:</label>
            <input type="datetime-local" class="form-control" id="event-end">
          </div>
          <div class="form-group">
            <label for="event-location" class="control-label">Location:</label>
            <input type="text" class="form-control" id="event-location">
          </div>
          <div class="form-group">
            <label for="event-description" class="control-label">Description:</label>
            <textarea type="text" class="form-control" id="event-description"></textarea>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button id="saveEvent" type="button" class="btn btn-primary">Add Event</button>
      </div>
    </div>
  </div>
</div>

<div id="deleteEventModal" class="modal fade bs-example-modal-sm small">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title" id="myModalLabel">Delete Event</h4>
      </div>
      <div id="deleteEventBody" class="modal-body">
        <h6>Are you sure you want to delete this event?</h6>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button id="deleteEventConfirm" type="button" class="btn btn-danger">Delete Event</button>
      </div>
    </div>
  </div>
</div>

</body>

<script src="js/jquery-1.11.2.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<script src="js/responsive-calendar.min.js"></script>
<script src="js/signin.js"></script>

<script type="text/javascript">

function loadCalendar() 
{
    $.ajax(
    {
      type:'POST',
      url:'loadCalendar.php',
      data: { userid: 123 },
      success: function (response)
      {
        var data = JSON.parse(response);
        $('#calendar').responsiveCalendar('edit', data);
      }
    });
}

$(document).on("click", "#addEvent", function (event) 
{
    $("#addEventModal").modal();
});

$(document).on("click", "#saveEvent", function (event) 
{
    $.ajax(
    {
      type:'POST',
      url:'addEvent.php',
      data: { userid: 123,
              eventTitle: $("#event-title").val(), 
              eventStart: $("#event-start").val(),
              eventEnd: $("#event-end").val(),
              eventLocation: $("#event-location").val(),
              eventDescription: $("#event-description").val() },
      fail: function (response)
      {
        alert("Failed to create new event "+response);
      }
    })
    .done(function(response)
    {
      $("#addEventModal").modal('hide');
      loadCalendar();
    });
});

$(document).on("click", "#deleteEventCancel", function (event)
{
    $('.delete-active').removeClass("delete-active");
});

$(document).on("click", "#deleteEvent", function (event) 
{
    $("#deleteEvent").addClass("delete-active");
    $("#deleteEventModal").modal();
});

$(document).on("click", "#deleteEventConfirm", function (event)
{
    var jqElement =  $('.delete-active');
    var element = jqElement[0];
    jqElement.removeClass("delete-active");
    var eventToDelete = element.dataset.eventid;

    if(eventToDelete > 0)
    {
        $.ajax(
        {
          type:'POST',
          url:'deleteEvent.php',
          data: { userid: 123,
                  eventid: eventToDelete },
          fail: function (response)
          {
            alert("Failed to create new event "+response);
          }
        })
        .done(function(response)
        {
          jqElement.parent().parent().remove();
          $("#deleteEventModal").modal('hide');
          $('#calendar').responsiveCalendar('clearAll');
          loadCalendar();
        });
    }
    else
    {
        alert("INVALID EVENT ID");
    }
});

$(document).on("click", "#editEvent", function (event) 
{
    alert("EDIT!!!!");
});

$( document ).ready( function() {
  function addLeadingZero(num) {
    if (num < 10) {
      return "0" + num;
    } else {
      return "" + num;
    }
  }

  function getMonth()
  {
    var today = new Date();
    var month = today.getMonth() + 1; //0 based
    var year = today.getFullYear();

    if(month < 10)
      month = '0' + month;

    return year+'-'+month;
  }

  $('#calendar').responsiveCalendar({
    time: getMonth(),
    
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
