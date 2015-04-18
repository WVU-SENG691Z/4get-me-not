<?php
    session_start();
    header('Content-type: application/json');

   if(true)
    {
        $responseArray = array();

        $dbLink = pg_connect("host=127.0.0.1 dbname=dev1 user=postgres") 
                    or die("Unable to connect to database");

        $userid = $_SESSION['USER_ID'];
		$handle_id = $_REQUEST['handle_id'];
        $eventStart = $_REQUEST['TimeAdjustment'];
		$eventEnd = $eventStart; 
		
        $result = 
            pg_query_params($dbLink, 'INSERT INTO events (userid, handle_id, event_time_start, event_time_end) VALUES($1, $2, NOW() - INTERVAL \''.  $eventStart .' minutes\', NOW() - INTERVAL \''.  $eventStart .' minutes\')', 
                            array($userid, $handle_id));

        if(!$result) 
        {
            $responseArray['status'] = 'error';
            $responseArray['data'] = '<div class="alert alert-danger alert-sm" role="alert">'.
                                     'Coult not add your event.'.pg_last_error($dbLink).
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