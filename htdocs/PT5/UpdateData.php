<?php
session_start();
include 'connection.php';
include 'config.php';

function ConvertToPhoneNumber($PhoneNumber){
    $ReceivedPhoneNumber = (string)$PhoneNumber;

    if (substr($ReceivedPhoneNumber, 0,1) == '0'){
        $ReceivedPhoneNumber = substr($ReceivedPhoneNumber, 1);
    }

    $PhoneNumberStringEdit1 = '+63' . $ReceivedPhoneNumber;    
    $FinalizePhoneNumber = preg_replace('/(\+63)(\d{3})(\d{3})(\d{4})/', '$1 $2 $3 $4', $PhoneNumberStringEdit1);

    return $FinalizePhoneNumber;
}

// For Product Update
if (isset($_POST['UpdateProduct'])){
    if (isset($_POST['UpdateProduct']) != ""){
        $ProductName = $_POST['ProductName'];
        $ProductPrice = $_POST['Price'];
        $ProductDescription = $_POST['DescriptionText'];
    
        if ($ProductDescription == null or $ProductName == null or $ProductPrice == null){
            $_SESSION['SuccessUpdateMessage'] = "Failed";
            header("Location: productEdit.php");
            exit;
        }
    
        $Query = "UPDATE products SET Name = '$ProductName', Price = '$ProductPrice', Description = '$ProductDescription' WHERE productID = " . $_SESSION['ProductId'];
    
        $InsertResult = mysqli_query($connection, $Query);
    
        if ($InsertResult){
            if ($RETURN_TO_DATA_PAGE == true){
                header("Location: Pages/productPage.php");
                exit;
            }else{
                $_SESSION['SuccessUpdateMessage'] = "Success";
                header("Location: productEdit.php");
                exit;
            }
        }else{
            $_SESSION['SuccessUpdateMessage'] = "Failed";
            header("Location: productEdit.php");
            exit;
        }
    }
    return;
}

// For Customer Account Update

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $FirstName = $_POST['FirstNameColumn'];
    $LastName = $_POST['LastNameColumn'];
    $Phone = ConvertToPhoneNumber($_POST['PhoneColumn']);
    $Address = $_POST['AddressColumn'];
    
    if ($FirstName == null or $LastName == null or $Phone == null or $Address == null){
        $_SESSION['SuccessUpdateMessage'] = "Failed";
        header("Location: customerEdit.php");
        exit;
    }

    $Query = "UPDATE customeraccount SET first_name = '$FirstName', last_name = '$LastName', Phone = '$Phone', Address = '$Address' WHERE CustomerID = " . $_SESSION['CustomerID'];

    $InsertResult = mysqli_query($connection, $Query);

    if ($InsertResult){
        if ($RETURN_TO_DATA_PAGE == true){
            header("Location: Pages/customerpage.php");
            exit;
        }else{
            $_SESSION['SuccessUpdateMessage'] = "Success";
            header("Location: customerEdit.php");
            exit;
        }
    }else{
        $_SESSION['SuccessUpdateMessage'] = "Failed";
        header("Location: customerEdit.php");
        exit;
    }
}

?>