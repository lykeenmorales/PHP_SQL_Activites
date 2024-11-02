<?php
    session_start();
    include '../connection.php';

    if (isset($_POST['NewPassword'])){
        $NewPassword = $connection -> real_escape_string(trim($_POST['NewPassword']));
        $EmailUsed = null;

        if (isset($_POST['EmailInput'])){
            $EmailUsed = $connection -> real_escape_string(trim($_POST['EmailInput']));
        }else{
            $EmailUsed = $_SESSION["Email"];
        }

        $Query = "UPDATE customeraccount SET Password = '$NewPassword' WHERE Email = '$EmailUsed'";

        $UpdateResult = $connection -> query($Query);

        if ($UpdateResult){
            $_SESSION['CustomNotifyMsg'] = "Password has been Successfully Changed! Please login.";
            $_SESSION['CustomNotifyMsgHEADER'] = "Password Changed!";
            header('Location: ../../LoginPage.php');
            exit();
        }else{
            $_SESSION['CustomNotifyMsg'] = "Something went wrong while trying to change your password! Please try again.";
            $_SESSION['CustomNotifyMsgHEADER'] = "Error!";
            header('Location: ../../LoginPage.php');
            exit();
        }
    }
?>