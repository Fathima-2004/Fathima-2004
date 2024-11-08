<?php 
    session_start();
    ob_start();
    if (!isset($_SESSION["adminauth"]) ||  $_SESSION["adminauth"] !== true) {
        header("Location: ./home.html");
        exit();
    }
    ob_end_flush();
?>