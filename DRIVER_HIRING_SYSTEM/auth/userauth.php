<?php 
    session_start();
    ob_start();
    if (!isset($_SESSION["userauth"]) ||  $_SESSION["userauth"] !== true) {
        header("Location: ./home.html");
        exit();
    }
    ob_end_flush();
?>