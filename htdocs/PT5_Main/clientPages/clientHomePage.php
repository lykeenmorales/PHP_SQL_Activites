<?php
    session_start();
    include '../mainFunctions/connection.php';

    if (isset($_SESSION['Login_UserID'])){
        if (isset($_SESSION['Login_UserType'])){
            if ($_SESSION['Login_UserType'] == "Admin"){
                header("Location: ../homepage.php");
            }
        }
    }else{
        header("Location: ../LoginPage.php");
    }
?>