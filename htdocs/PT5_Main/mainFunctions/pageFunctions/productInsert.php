<?php
    session_start();
    include '../connection.php';

    if ($_SERVER['REQUEST_METHOD'] === "POST"){
        $ProductName = $connection -> real_escape_string($_POST['ProductName']);
        $ProductPrice = $_POST['ProductPrice'];
        $ProductDescription = $connection -> real_escape_string($_POST['ProductDesc']);
        $Quantity = $_POST['ProductQuant'];

        // Used in {Add Another} Button
        $_SESSION['ErrorAddAgain'] = "Good"; //-- Good State

        if ($ProductDescription == null or $ProductName == null or $ProductPrice == null){
            $_SESSION['ErrorAdd'] = 'Data Received is empty! Please try Again.';
            header("Location: ../../Pages/ProductInfoPage.php");
            exit;
        }

        $Query = null;

        if ($Quantity == 0 or $Quantity == null){
            $Query = "INSERT INTO products (Name, Price, Description) Values ('$ProductName', '$ProductPrice', '$ProductDescription')";
        }else{
            if (isset($_POST['DisplayProduct'])){
                $Query = "INSERT INTO products (Name, Price, Description, StockQuantity, Display) Values ('$ProductName', '$ProductPrice', '$ProductDescription', '$Quantity', 1)";
            }else{
                $Query = "INSERT INTO products (Name, Price, Description, StockQuantity, Display) Values ('$ProductName', '$ProductPrice', '$ProductDescription', '$Quantity', 0)";
            }
        }

        $InsertResult = mysqli_query($connection, $Query);

    
        if ($InsertResult){
            $_SESSION['SuccessAdd'] = "Product has been Successfully Added";
            header("Location: ../../Pages/ProductInfoPage.php");
            exit;
        }else{
           $_SESSION['ErrorAdd'] = 'Data Error: ' . mysqli_error($connection);
            header("Location: ../../Pages/ProductInfoPage.php");
            exit;
        }
    }
?>