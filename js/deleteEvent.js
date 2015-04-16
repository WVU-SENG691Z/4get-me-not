$(document).on("click", ".deleteEventCancel", function (event)
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
          data: { eventid: eventToDelete },
          fail: function (response)
          {
            alert("Failed to create new event "+response);
          }
        })
        .done(function(response)
        {
          $("#successNotification").html(response.data);
          alertTimeout(5000); //close after 5 seconds, add time to read
          jqElement.parent().parent().remove();
          $("#deleteEventModal").modal('hide');
          if($('#calendar').length)
          {
            $('#calendar').responsiveCalendar('clearAll');
            loadCalendar();
          }
        });
    }
    else
    {
        alert("INVALID EVENT ID");
    }
});
