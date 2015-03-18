<?php
    header('Content-type: application/json');

    if(isset($_POST['eventid']) && isset($_POST['userid']))
    {
        $responseArray = array();
        $dbLink = pg_connect("host=127.0.0.1 dbname=dev1 user=postgres") 
                    or die("Unable to connect to database");

        $userid = $_POST['userid'];
        $eventid = $_POST['eventid'];

        $result = pg_query_params($dbLink, 'DELETE FROM events WHERE userid=$1 and eventid=$2',
                                  array($userid, $eventid));
        if(!$result) 
        {
            $responseArray['status'] = 'error';
            $responseArray['data'] = '<div class="alert alert-danger alert-sm" role="alert">'.
                                     'Could not delete event!'.pg_last_error($dbLink).
                                     '</div>';
        }
        else
        {
            $responseArray['status'] = 'success';
            $responseArray['data'] = '<div class="alert alert-success alert-sm" role="alert">'.
                                     'Sucessfully deleted event!</div>';
        }

        echo json_encode($responseArray);
    }
?>
