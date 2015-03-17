<?php

    if(isset($_POST['eventid']) && isset($_POST['userid']))
    {
        $dbLink = pg_connect("host=127.0.0.1 dbname=dev1 user=postgres") 
                    or die("Unable to connect to database");

        $userid = $_POST['userid'];
        $eventid = $_POST['eventid'];

        $result = pg_query_params($dbLink, 'DELETE FROM events WHERE userid=$1 and eventid=$2',
                                  array($userid, $eventid));
        if(!$result) 
        {
            echo "An error occurred.".pg_last_error($dbLink);
            exit;
        }
    }
?>
