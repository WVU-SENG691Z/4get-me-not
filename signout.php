<?php

    session_start();

    if ( !isset( $_SESSION["origURL"] ) )
        $_SESSION["origURL"] = $_SERVER["HTTP_REFERER"];

    $_SESSION = array();

    if(isset($_COOKIE["publickey"]))
        setcookie("publickey", null, -1);

    header("Location: index.php");

    session_destroy();
?>
