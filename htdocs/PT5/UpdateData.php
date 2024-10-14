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

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST['TypeOfUpdate'])){
        if ($_POST['TypeOfUpdate'] == "CustomerUpdate"){
            // Checking if IsDelete is set
            if (isset($_POST['IsDelete'])){
                if ($_POST['IsDelete'] != null and $_POST['IsDelete'] == "Delete"){
                    $Query = "DELETE FROM customeraccount WHERE CustomerID = " . $_SESSION['CustomerID'];
            
                    $DeleteQuery = mysqli_query($connection, $Query);
            
                    if ($DeleteQuery){
                        $_SESSION['SuccessUpdateMessage'] = "DeleteSuccess";
                        header("Location: Pages/customerpage.php");
                        exit;
                    }else{
                        $_SESSION['SuccessUpdateMessage'] = "DeleteFailed";
                        header("Location: customerEdit.php");
                        exit;
                    }
                }
            }
            
            // If not Delete we proceed to Update
            $FirstName = $_POST['FirstNameColumn'];
            $LastName = $_POST['LastNameColumn'];
            $Phone = ConvertToPhoneNumber($_POST['PhoneColumn']);
            $Address = $_POST['AddressColumn'];
            $Email = $_POST['Email'];
        
        
            if ($FirstName == null or $LastName == null or $Phone == null or $Address == null){
                $_SESSION['SuccessUpdateMessage'] = "Failed";
                header("Location: customerEdit.php");
                exit;
            }
        
            $Query = null;
        
            if ($Email != ""){
                $Query = "UPDATE customeraccount SET first_name = '$FirstName', last_name = '$LastName', Phone = '$Phone', Address = '$Address', Email = '$Email' WHERE CustomerID = " . $_SESSION['CustomerID'];
            }else{
                $Query = "UPDATE customeraccount SET first_name = '$FirstName', last_name = '$LastName', Phone = '$Phone', Address = '$Address', Email = null WHERE CustomerID = " . $_SESSION['CustomerID'];
            }
        
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
    
        if ($_POST['TypeOfUpdate'] == "ProductUpdate"){
            // Checking if IsDelete is set
            if (isset($_POST['IsDelete'])){
                if ($_POST['IsDelete'] != null and $_POST['IsDelete'] == "Delete"){
                    $Query = "DELETE FROM products WHERE productID = " . $_SESSION['ProductId'];
        
                    $DeleteQuery = mysqli_query($connection, $Query);
        
                    if ($DeleteQuery){
                        $_SESSION['SuccessUpdateMessage'] = "DeleteSuccess";
                        header("Location: Pages/productPage.php");
                        exit;
                    }else{
                        $_SESSION['SuccessUpdateMessage'] = "DeleteFailed";
                        header("Location: productEdit.php");
                        exit;
                    }
                }
            }
    
            // If not Delete we proceed to Update
            $ProductName = $_POST['ProductName'];
            $ProductPrice = $_POST['Price'];
            $ProductDescription = $_POST['DescriptionText'];
            $ProductQuantity = $_POST['StockQuantity'];
        
            if ($ProductDescription == null or $ProductName == null or $ProductPrice == null){
                $_SESSION['SuccessUpdateMessage'] = "Failed";
                header("Location: productEdit.php");
                exit;
            }
        
            $Query = null;
    
            if ($ProductQuantity != null or $ProductQuantity != 0){
                $Query = "UPDATE products SET Name = '$ProductName', Price = '$ProductPrice', Description = '$ProductDescription', StockQuantity = '$ProductQuantity' WHERE productID = " . $_SESSION['ProductId'];
            }else{
                $Query = "UPDATE products SET Name = '$ProductName', Price = '$ProductPrice', Description = '$ProductDescription' WHERE productID = " . $_SESSION['ProductId'];
            }
        
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
    }
}

?>