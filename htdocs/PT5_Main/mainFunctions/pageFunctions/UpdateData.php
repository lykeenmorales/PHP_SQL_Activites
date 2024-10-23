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

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        if (isset($_POST['TypeOfUpdate'])){
            if ($_POST['TypeOfUpdate'] == "CustomerUpdate"){
                // Used in {Add Another} Button
                $_SESSION['ErrorAddAgain'] = "Good"; //-- Good State
                $_SESSION['RemoveAddAnother'] = "true"; //-- Set to true to remove

                // Checking if IsDelete is set
                if (isset($_POST['IsDelete'])){
                    if ($_POST['IsDelete'] != null and $_POST['IsDelete'] == "Delete"){
                        $Query = "DELETE FROM customeraccount WHERE CustomerID = " . $_SESSION['CustomerID'];
                
                        $DeleteQuery = mysqli_query($connection, $Query);
                        
                        if ($DeleteQuery){
                            $_SESSION['SuccessAdd'] = "Account has been Deleted Successfully!";
                            header("Location: ../../Pages/CustomerPage.php");
                            exit;
                        }else{
                            $_SESSION['ErrorAdd'] = 'Data Error while trying to Delete: ' . mysqli_error($connection);
                            header("Location: ../../Pages/CustomerPage.php");
                            exit;
                        }
                    }
                }
                
                // If not Delete we proceed to Update
                $FirstName = $_POST['FirstName'];
                $LastName = $_POST['LastName'];
                $Phone = ConvertToPhoneNumber($_POST['PhoneNumber']);
                $Address = $connection -> real_escape_string($_POST['Address']);
                $Email = $_POST['Email'];
            
                if ($FirstName == null or $LastName == null or $Phone == null or $Address == null){
                    $_SESSION['ErrorAdd'] = 'Data Received is empty {Error while receiving Data}! Please try Again.';
                    header("Location: ../../Pages/CustomerPage.php");
                    return;
                }
        
            
                $Query = null;
            
                if ($Email != ""){
                    $Query = "UPDATE customeraccount SET first_name = '$FirstName', last_name = '$LastName', Phone = '$Phone', Address = '$Address', Email = '$Email' WHERE CustomerID = " . $_SESSION['CustomerID'];
                }else{
                    $Query = "UPDATE customeraccount SET first_name = '$FirstName', last_name = '$LastName', Phone = '$Phone', Address = '$Address', Email = null WHERE CustomerID = " . $_SESSION['CustomerID'];
                }
            
                $UpdateResult = mysqli_query($connection, $Query);

                if ($UpdateResult){
                    $_SESSION['SuccessAdd'] = $FirstName . " " . $LastName . " Account has been Updated.";
                    header("Location: ../../Pages/CustomerPage.php");
                    exit;
                }else{
                    $_SESSION['ErrorAdd'] = 'Data Error: ' . mysqli_error($connection);
                    header("Location: ../../Pages/CustomerPage.php");
                    exit;
                }
            }
        
            if ($_POST['TypeOfUpdate'] == "ProductUpdate"){
                // Used in {Add Another} Button
                $_SESSION['ErrorAddAgain'] = "Good"; //-- Good State
                $_SESSION['RemoveAddAnother'] = "true"; //-- Set to true to remove
                
                $DisplayProduct = null;

                if (isset($_POST['DisplayProduct'])){
                    $DisplayProduct = 1;
                }else{
                    $DisplayProduct = 0;
                }

                // Checking if IsDelete is set
                if (isset($_POST['IsDelete'])){
                    if ($_POST['IsDelete'] != null and $_POST['IsDelete'] == "Delete"){
                        $Query = "UPDATE products SET Display = 0 WHERE productID = " . $_SESSION['ProductId'];
            
                        $DeleteQuery = mysqli_query($connection, $Query);
            
                        if ($DeleteQuery){
                            $_SESSION['SuccessAdd'] = 'Automatically Set to Visible False Only! (Wont appear unless "Display all" is Unchecked)';
                            header("Location: ../../Pages/ProductInfoPage.php");
                            exit;
                        }else{
                            $_SESSION['ErrorAdd'] = 'Data Error while trying to Delete: ' . mysqli_error($connection);
                            header("Location: ../../Pages/ProductInfoPage.php");
                            exit;
                        }
                    }
                }
        
                $ProductName = $connection -> real_escape_string($_POST['ProductName']);
                $ProductPrice = $_POST['ProductPrice'];
                $ProductDescription = $connection -> real_escape_string($_POST['ProductDesc']);
                $ProductQuantity = $_POST['ProductQuant'];
            
                if ($ProductDescription == null or $ProductName == null or $ProductPrice == null){
                    $_SESSION['ErrorProductAdd'] = 'Data Received is empty {Error while receiving Data}! Please try Again.';
                    header("Location: ../../Pages/ProductInfoPage.php");
                    exit;
                }
            
                $Query = null;
        
                if ($ProductQuantity != null or $ProductQuantity != 0){
                    $Query = "UPDATE products SET Name = '$ProductName', Price = '$ProductPrice', Description = '$ProductDescription', StockQuantity = '$ProductQuantity', Display = '$DisplayProduct' WHERE productID = " . $_SESSION['ProductId'];
                }else{
                    $Query = "UPDATE products SET Name = '$ProductName', Price = '$ProductPrice', Description = '$ProductDescription', Display = '$DisplayProduct' WHERE productID = " . $_SESSION['ProductId'];
                }
            
                $UpdateResult = mysqli_query($connection, $Query);

                if ($UpdateResult){
                    $_SESSION['SuccessAdd'] = $ProductName . " Information has been Updated.";
                    header("Location: ../../Pages/ProductInfoPage.php");
                    exit;
                }else{
                    $_SESSION['ErrorAdd'] = 'Data Error: ' . mysqli_error($connection);
                    header("Location: ../../Pages/ProductInfoPage.php");
                    exit;
                }
                
            }
        }
    }

?>