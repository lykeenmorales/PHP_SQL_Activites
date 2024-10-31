<?php
    session_start();
    // We get the Email First
    $RememberedEmailInput = null;
    if (isset($_SESSION['RememberedEmail'])){
        if ($_SESSION['RememberedEmail'] != null || $_SESSION['RememberedEmail'] != ""){
            $RememberedEmailInput = $_SESSION['RememberedEmail'];
        }
    }
    session_unset();


    $_SESSION['RememberedEmail'] = $RememberedEmailInput;
    $_SESSION['CustomNotifyMsgHEADER'] = "Successfully Logged Out!";
    $_SESSION['CustomNotifyMsg'] = "Successfully logout from administration!";

    header("Location: ../../LoginPage.php");
    exit;
?>