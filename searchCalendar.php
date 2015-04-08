
<!DOCTYPE html>
<html lang="en">

<head>
  <title>4get-me-not</title>

  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"/>
  <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet"/>
</head>

<body>
<?php
  require('header.php');
?>
<div class="container">
  <div class="row" style="margin-top: 60px">
    <?php
    if(isset($_GET['searchkey']))
    {
        $dbLink = pg_connect("host=127.0.0.1 dbname=dev1 user=postgres") 
                    or die("Unable to connect to database");

        $searchkey = $_GET['searchkey'];

        $query  = "SELECT * FROM (SELECT *, to_tsvector(title) || to_tsvector(location) || 
                                            to_tsvector(description) AS document 
                   FROM events)event_search WHERE 
                   event_search.document @@ to_tsquery('".$searchkey."')";

        $result = pg_query($dbLink, $query);

        //Insert edit/delete notifications
        echo '<h4 id="searchResults">Search Results for: '.$searchkey.'</h4>
              <div class="col-md-9 col-xs-9">
                 <div id="successNotification"></div>
              </div><br><div class="row">';

        if(pg_num_rows($result) > 0)
        {
            echo '<div class="col-md-7 col-xs-12">
                    <div class="panel-group" id="accordion" role="tablist" 
                       aria-multiselectable="true">';
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
    
            echo '</div>';
        }
        else //no results
        {
            echo "No Results";
        }

        echo '</div>';
    }
    else
    {
        header("HTTP/1.0 400 Bad Request", true, 400);
        exit('400: Bad Request');
    }
    ?>
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

<?php
    require('dialogs/deleteEventModal.php');
?>

<script src="js/jquery-1.11.2.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<script src="js/signin.js"></script>
<script src="js/deleteEvent.js"></script>

<script type="text/javascript">
function alertTimeout(timeout)
{
    setTimeout(function()
    {
        $("#successNotification").children('.alert:first-child').remove();
    }, timeout);
}
</script>

</body>
</html>
