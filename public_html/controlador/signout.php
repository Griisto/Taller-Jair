<?php
    session_start();
    session_unset();
    session_destroy();
    header("Location: https://".$_SERVER['HTTP_HOST']."/");
    $con = null;
    
?>