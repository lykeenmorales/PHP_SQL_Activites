<?php
    session_start();
    include '../connection.php';

    function ConvertToPhoneNumber($PhoneNumber){
        $ReceivedPhoneNumber = (string)$PhoneNumber;
    
        if (substr($ReceivedPhoneNumber, 0,1) == '0'){
            $ReceivedPhoneNumber = substr($ReceivedPhoneNumber, 1);
        }
    
        $PhoneNumberStringEdit1 = '+63' . $ReceivedPhoneNumber;    
        $FinalizePhoneNumber = preg_replace('/(\+63)(\d{3})(\d{3})(\d{4})/', '$1 $2 $3 $4', $PhoneNumberStringEdit1);
    
        return $FinalizePhoneNumber;
    }

    if ($_SERVER['REQUEST_METHOD'] === "POST"){
        $FirstName = $connection -> real_escape_string($_POST['FirstNameInput']);
        $LastName = $connection -> real_escape_string($_POST['LastNameInput']);
        $PhoneNumber = ConvertToPhoneNumber($_POST['PhoneNumber']);
        $Address = $connection -> real_escape_string($_POST['Location']);
        $Email = $connection -> real_escape_string($_POST['Email']);
        $userPass = $connection -> real_escape_string($_POST['userPassword']);

        // Used in {Add Another} Button
        $_SESSION['ErrorAddAgain'] = "Good"; //-- Good State

        if ($FirstName == null or $LastName == null or $PhoneNumber == null or $Address == null or $userPass == null){
            $_SESSION['ErrorAdd'] = 'Data Received is empty! Please try Again.';
            header("Location: ../../LoginPage.php");
            return;
        }

        $Query = null;

        if ($Email == null){
            $Query = "INSERT INTO customeraccount (first_name, last_name, Phone, Address, Password) Values ('$FirstName', '$LastName', '$PhoneNumber', '$Address', '$userPass')";
        }else{
            $Query = "INSERT INTO customeraccount (first_name, last_name, Phone, Address, Email, Password) Values ('$FirstName', '$LastName', '$PhoneNumber', '$Address', '$Email', '$userPass')";
        }

      
        $InsertResult = mysqli_query($connection, $Query);

        if ($InsertResult){
            header("Location: ../../LoginPage.php");
            exit;
        }else{
            header("Location: ../../LoginPage.php");
            exit;
        }
    }
?>