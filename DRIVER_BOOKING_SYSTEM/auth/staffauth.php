<?php 
    session_start();
    ob_start();
    if (!isset($_SESSION["staffauth"]) ||  $_SESSION["staffauth"] !== true) {
        header("Location: ./home.html");
        exit();
    }
    ob_end_flush();
?>