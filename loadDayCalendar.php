
<?php
    if(isset($_GET['day']))
    {
        $dbLink = pg_connect("host=127.0.0.1 dbname=dev1 user=postgres") 
                    or die("Unable to connect to database");

        $day = $_GET['day'];

/*        $query  = "SELECT handles.title, handles, events.event_time_start, events.location, 
                   events.event_time_end, eventid FROM handles, events WHERE 
                   handles.handle_id=events.handle_id AND '".$day."' BETWEEN 
                   date_trunc('day', event_time_start) and date_trunc('day', event_time_end);";
*/
        $query  = "SELECT * FROM events WHERE '".$day."' BETWEEN ";
        $query .= "date_trunc('day', event_time_start) and date_trunc('day', event_time_end);";

        $result = pg_query($dbLink, $query);

        //Insert day, add button, and placeholder for add/edit/delete notifications
        echo '<h4 id="selectedDay">'.$day.'</h4>'.
             '<div class="row">'.
             '  <div class="col-md-2 col-xs-2">'.
             '    <button id="addEventButton" class="btn btn-success">Add</button>'.
             '  </div>'.
             '  <div class="col-md-9 col-xs-9">'.
             '    <div id="successNotification"></div>'.
             '  </div>'.
             '</div><br>';

        if(pg_num_rows($result) > 0)
        {
            echo "<div class=\"panel-group\" id=\"accordion\" role=\"tablist\" 
                       aria-multiselectable=\"true\">";
            $i = 0;
            //add each event for a particular day
            while($row = pg_fetch_object($result))
            {
                echo "<div class=\"panel panel-default\">";
                echo "  <button id=\"deleteEvent\" data-eventid=\"".$row->eventid."\" 
                                class=\"pull-right btn btn-danger\">";
                echo "    Delete</button>";
                echo "  <button id=\"editEvent\" data-eventid=\"".$row->eventid."\" 
                                class=\"pull-right btn btn-info\">";
                echo "    Edit</button>";
                echo "  <div class=\"panel-heading\" role=\"tab\" id=\"heading".$i."\">";
                echo "    <h4 class=\"panel-title\">";
                echo "      <a class=\"collapsed\" data-toggle=\"collapse\"";
                echo "         data-parent=\"#accordion\" ";
                echo "         href=\"#collapse".$i."\" aria-expanded=\"false\" ";
                echo "         aria-controls=\"collapse".$i."\">";
                echo $row->title;
                echo "      </a></h4>";
                echo "  </div>";
                echo "  <div id=\"collapse".$i."\" class=\"panel-collapse collapse\"";
                echo "       role=\"tabpanel\" aria-labelledby=\"heading".$i."\">";
                echo "    <div class=\"panel-body\">";
                echo "      <h6>Start Time:  ".$row->event_time_start."</h6>";
                echo "      <h6>End Time:    ".$row->event_time_end."</h6>";
                echo "      <h6>Location:    ".$row->location."</h6>";
                echo "      <h6>Description: ".$row->description."</h6>";
                echo "    </div>";
                echo "  </div>";
                echo "</div>";

                $i++;
            }
            echo "</div>";
        }
    }
?>
