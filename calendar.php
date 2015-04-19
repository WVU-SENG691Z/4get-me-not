<?php
  require('authentication.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>4get-me-not</title>

  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"/>

  <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet"/>
  <link href="css/responsive-calendar.css" rel="stylesheet" media="screen"/>
  <link href="css/bootstrap.datetimepicker.css" rel="stylesheet" media="screen"/>
  <link href="css/smallmodal.css" rel="stylesheet" media="screen"/>

  <style>
    .alert-sm
    {
        padding-top: 6px;
        padding-bottom: 6px;
    }
  </style>

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
          <div class="day header">Sun</div>
          <div class="day header">Mon</div>
          <div class="day header">Tue</div>
          <div class="day header">Wed</div>
          <div class="day header">Thu</div>
          <div class="day header">Fri</div>
          <div class="day header">Sat</div>
        </div>
        <div class="days" data-group="days">
          <!-- the place where days will be generated -->
        </div>
      </div>
    </div>
    <div class="col-md-6" style="margin-top: -20px">
      <h2>Events (<?php  
    session_start();

    if(isset($_SESSION['USER_ID']))
    {
        $userid = $_SESSION['USER_ID'];

        $dbLink = pg_connect("host=127.0.0.1 dbname=dev1 user=postgres")
                    or die("Unable to connect to database");

        $query  = "SELECT COUNT(userid) FROM events WHERE userid=".$userid;

        $result = pg_query($dbLink, $query);

        if(pg_num_rows($result) > 0)
        {
            $row = pg_fetch_object($result);
            echo $row->count;
        }
        else
            echo 0;
    }?>)</h2>
      <div id="eventlist"> </div>
    </div>
  </div>
</div>

<div id="addEventModal" class="modal fade bs-example-modal-sm">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close addEventCancel" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title" id="myModalLabel">Add Event</h4>
      </div>
      <div class="modal-body">
        <form id="addEventForm">
          <div class="form-group has-feedback">
            <label for="event-title" class="control-label">Title:</label>
            <input type="text" class="form-control" name="event-title" id="event-title" required>
            <span class="glyphicon form-control-feedback" id="event-title1"></span>
          </div>
          <div class="form-group has-feedback">
            <label for="event-start" class="control-label">Start Time:</label>
            <div class="input-group date" id="datetimepickerEventStart">
              <input type="text" class="form-control" id="event-start" name="event-start"
                     placeholder="MM/DD/YYYY HH:MM A" required/>
              <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
            </div>
          </div>    
          <div class="form-group has-feedback">
            <label for="event-end" class="control-label">End Time:</label>
            <div class="input-group date" id="datetimepickerEventEnd">
              <input type="text" class="form-control" id="event-end" name="event-end"
                     placeholder="MM/DD/YYYY HH:MM A" required/>
              <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
            </div>
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
        <button type="button" class="btn btn-default addEventCancel" 
                data-dismiss="modal">Close</button>
        <button id="saveNewEvent" type="button" class="btn btn-primary">Add Event</button>
      </div>
    </div>
  </div>
</div>

<?php
    require('dialogs/deleteEventModal.php');
?>

</body>

<script src="js/jquery-1.11.2.min.js"></script>
<script src="js/moment.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<script src="js/responsive-calendar.min.js"></script>
<script src="js/bootstrap.datetimepicker.min.js"></script>
<script src="js/jquery.validate.min.js"></script>
<script src="js/deleteEvent.js"></script>

<script type="text/javascript">

$(function () 
{
    $('#datetimepickerEventStart').datetimepicker({format: 'MM/DD/YYYY hh:mm a'});
    $('#datetimepickerEventEnd').datetimepicker({format: 'MM/DD/YYYY hh:mm a'});

    //make sure we dont have a ending date before a start date
    $('#datetimepickerEventStart').on("dp.change",function (e) 
    {
        $('#datetimepickerEventEnd').data("DateTimePicker").minDate(e.date);
    });

    //make sure we dont have a starting date after an end date
    $('#datetimepickerEventEnd').on("dp.change",function (e) 
    {
        $('#datetimepickerEventStart').data("DateTimePicker").maxDate(e.date);
    });

});


function loadCalendar() 
{
    $.ajax(
    {
      type:'POST',
      url:'loadCalendar.php',
      success: function (response)
      {
        var data = JSON.parse(response);
        $('#calendar').responsiveCalendar('edit', data);
      }
    });
}

function alertTimeout(timeout)
{
    setTimeout(function()
    {
        $("#successNotification").children('.alert:first-child').remove();
    }, timeout);
}

function clearForm()
{
    $('.help-block').remove();
    $('#saveNewEvent').prop('disabled', 'disabled'); // disable button
    $('.form-group').removeClass('has-success').removeClass('has-error');
    $('.form-control-feedback').removeClass('glyphicon-ok').removeClass('glyphicon-remove');
    $("#addEventForm")[0].reset(); //clear form data
}

$(document).on("click", "#addEventButton", function (event) 
{
    //set the default day in the picker to the selected day from the calendar
    clearForm();
    var selectedDay = moment($("#selectedDay").text());
    $('#datetimepickerEventStart').data("DateTimePicker").date(selectedDay);
    $("#addEventModal").modal();
});

$(document).on("click", ".addEventCancel", function (event) 
{
    clearForm(); //clear form data
});


$(document).on("click", "#saveNewEvent", function (event) 
{
    $.ajax(
    {
      type:'POST',
      url:'addEvent.php',
      data: { eventTitle: $("#event-title").val(), 
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
      $("#successNotification").html(response.data);
      alertTimeout(3000); //close after 3 seconds
      $("#addEventModal").modal('hide');
      clearForm();
      loadCalendar();
    });

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
    startFromSunday: true,
    
    onDayClick: function(events) 
    { 
      key = $(this).data('year')+'-'+addLeadingZero( $(this).data('month') )+'-'+
            addLeadingZero( $(this).data('day') );

      $.ajax(
      {
        type:'POST',
        url:'loadDayCalendar.php',
        data: {day: key},
        success: function (response)
        {
          $("#eventlist").html(response);
        }
      });
    }
  });

  loadCalendar();

});

$("#addEventForm").validate(
{
    rules: 
    {
        'event-title': 
        {
            minlength: 3,
            maxlength: 64,
            required: true
        },
        'event-start':
        {
            required: true
        },
        'event-end':
        {
            required: true
        }
    },
    highlight: function(element) 
    {
        var id_attr = "#" + $( element ).attr("id") + "1";
        $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
        $(id_attr).removeClass('glyphicon-ok').addClass('glyphicon-remove');         
    },
    unhighlight: function(element) 
    {
        var id_attr = "#" + $( element ).attr("id") + "1";
        $(element).closest('.form-group').removeClass('has-error').addClass('has-success');
        $(id_attr).removeClass('glyphicon-remove').addClass('glyphicon-ok');         
    },
    errorElement: 'div',
        errorClass: 'help-block',
        errorPlacement: function(error, element) 
        {
            if(element.next().is('.input-group-addon'))
                 error.insertAfter(element.parent());
            else
                error.insertAfter(element);
        }
});

$('#addEventForm input').on('keyup blur', function () 
{ 
    if ($('#addEventForm').valid()) 
        $('#saveNewEvent').prop('disabled', false);        // enables button
    else 
        $('#saveNewEvent').prop('disabled', 'disabled');   // disables button
});
</script>
