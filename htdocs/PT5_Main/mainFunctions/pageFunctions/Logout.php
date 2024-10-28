<?php
    session_start();
    session_unset();
    session_destroy();

    $_SESSION['CustomNotifyMsgHEADER'] = "Successfully Logged Out!";
    $_SESSION['CustomNotifyMsg'] = "Successfully logout from administration!";

    header("Location: ../../LoginPage.php");
    exit;
?>