
<?php

    $dbLink = pg_connect("host=127.0.0.1 dbname=dev1 user=postgres")
                or die("Unable to connect to database");

    $query  = "SELECT date_trunc('day', event_time)::DATE as day, COUNT(event_time) FROM ";
    $query .= "events GROUP BY date_trunc('day', event_time);";

    $result = pg_query($dbLink, $query);

    $dayInformation = '{';

    while($row = pg_fetch_object($result))
        $dayInformation .= '"'.$row->day.'": {"number": '.(int)$row->count.'},';

    $dayInformation = substr($dayInformation, 0, -1);
    $dayInformation .= '}';

    echo $dayInformation;
?>
