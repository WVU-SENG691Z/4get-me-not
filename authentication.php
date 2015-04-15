
<?php
    session_start();

    if(isset( $_SESSION["USER_ID"]))
    {
        if(isset($_SESSION["AGENT_STRING"]))
        {
            if($_SESSION["AGENT_STRING"] != $_SERVER["HTTP_USER_AGENT"])
            {
                //agent string mismatch, possible hijack attempt
                header("Location: signout.php");
            }
        }
    }
    else
    {
        // no user id set in session, force sign in and remember page that was being accessed
        header("Location: signin.php?location=".urlencode($_SERVER['REQUEST_URI']));
        //header($_SERVER["SERVER_PROTOCOL"]."403 Forbidden");
        //echo '<h1>403 Forbidden</h1>';
        exit;
    }
?>
