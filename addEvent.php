<?php

    header('Content-type: application/json');

    if(isset($_POST['eventTitle']) && isset($_POST['eventStart']) &&
       isset($_POST['eventEnd']) && isset($_POST['eventLocation']) &&
       isset($_POST['eventDescription']) && isset($_POST['userid']))
    {
        $responseArray = array();

        $dbLink = pg_connect("host=127.0.0.1 dbname=dev1 user=postgres") 
                    or die("Unable to connect to database");

        $userid = $_POST['userid'];
        $eventTitle = $_POST['eventTitle'];
        $eventStart = $_POST['eventStart'];
        $eventEnd = $_POST['eventEnd'];
        $eventLocation = $_POST['eventLocation'];
        $eventDescription = $_POST['eventDescription'];

        $result = 
            pg_query_params($dbLink, 'INSERT INTO events (userid, title, event_time_start, '.
                                     'event_time_end, location, description)'.
                                     'VALUES($1, $2, $3, $4, $5, $6)', 
                            array($userid, $eventTitle, $eventStart, $eventEnd, 
                                  $eventLocation, $eventDescription));

        if(!$result) 
        {
            $responseArray['status'] = 'error';
            $responseArray['data'] = '<div class="alert alert-danger alert-sm" role="alert">'.
                                     'Could not add your event.'.pg_last_error($dbLink).
                                     '</div>';
        }
        else
        {
            $responseArray['status'] = 'success';
            $responseArray['data'] = '<div class="alert alert-success alert-sm" role="alert">'.
                                     'Successfully added your new event!</div>';
        }

        echo json_encode($responseArray);
    }
?>
