<?php
    session_start();
    include '../connection.php';

    $query = "SELECT * FROM customeraccount WHERE Email = '".$_POST['EmailInput']."' AND password = '".$_POST['PasswordInput']."'";

    $result = $connection -> query($query);

    $resultArray = $result -> fetch_assoc();

    if (isset($resultArray)){
        if ($resultArray != "" or $resultArray != null){
            echo("CAN LOGIN");
        }else{
            $_SESSION['LoginError'] = "Invalid Email or Password";
            header('Location: ../../../PT5_Main/LoginPage.php');
            exit();
        }
    }else{
        $_SESSION['LoginError'] = "Invalid Email or Password";
        header('Location: ../../../PT5_Main/LoginPage.php');
        exit();
    }
?>