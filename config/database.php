<?php
    ob_start();
    session_start();
    // $timezone = date_default_timezone_set("Africa/Kenya");
    //  The variables to the database\

    $host = "localhost";
    $user = "root";
    $password = "";
    $db = "social";

    //  Connection to the database
    $connection = mysqli_connect($host,$user,$password,$db);

    //  Confirming the error
    if(!$connection) {
        die("QUERY FAILED".mysqli_error($connection));
    } 

?>