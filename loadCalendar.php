
<?php
    session_start();

    if(isset($_SESSION['USER_ID']))
    {
        $userid = $_SESSION['USER_ID'];

        $dbLink = pg_connect("host=127.0.0.1 dbname=dev1 user=postgres")
                    or die("Unable to connect to database");

        $query  = "SELECT dates, COUNT(dates) FROM (SELECT generate_series(date_trunc('day', ";
        $query .= "event_time_start), date_trunc('day', event_time_end), '1 day')::date AS dates ";
        $query .= "FROM events WHERE userid=".$userid.")t GROUP BY dates;";

        $result = pg_query($dbLink, $query);

        $dayInformation = '{';

        if(pg_num_rows($result) > 0)
        {
            while($row = pg_fetch_object($result))
                $dayInformation .= '"'.$row->dates.'": {"number": '.(int)$row->count.'},';

            $dayInformation = substr($dayInformation, 0, -1);
        }
            
        $dayInformation .= '}';
        echo $dayInformation;
    }
?>
