<?php
    //import config file
    include 'config.php';


    $connection = mysqli_connect("127.0.0.1", "mariadb", "mariadb", "mariadb");

    if (!$connection){
        die("Connection Failed" . mysqli_connect_error());
    }else{
        if ($DEBUG_PRINTING){
            echo "Connection Successful";
        }
    }
?>