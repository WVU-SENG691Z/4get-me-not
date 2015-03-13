
<?php
    if(isset($_GET['day']))
    {
        $dbLink = pg_connect("host=127.0.0.1 dbname=dev1 user=postgres") 
                    or die("Unable to connect to database");

        $day = $_GET['day'];

        $query  = "SELECT * FROM events WHERE '".$day."' BETWEEN ";
        $query .= "date_trunc('day', event_time_start) and date_trunc('day', event_time_end);";

        $result = pg_query($dbLink, $query);

        echo "<h4>".$day."</h4>";
        if(pg_num_rows($result) == 0)
        {
            echo "none";
        }
        else
        {
            while($row = pg_fetch_object($result))
            {
                echo "<div class=\"span4 detail\">";
                echo "  <h5>Title:       ".$row->title."</h5>";
                echo "  <h5>Start Time:  ".$row->event_time_start."</h5>";
                echo "  <h5>End Time:    ".$row->event_time_end."</h5>";
                echo "  <h5>Location:    ".$row->location."</h5>";
                echo "  <h5>Description: ".$row->description."</h5>";
                echo "</div><br>";
            }
        }
    }
?>
