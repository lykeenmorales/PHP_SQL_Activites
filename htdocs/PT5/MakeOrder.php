<?php
    session_start();
    include 'connection.php';
    include 'config.php';

    if ($_SERVER["REQUEST_METHOD"] === "POST"){
        if ($_POST['ProductID'] == null || $_POST['TimeZone'] == null || $_SESSION['CustomerID'] == null){
            $_SESSION['Error'] = "No Product ID";
            header("Location: Pages/MakeOrderPage.php");
            exit;
        }

        $UserTimezone = $_POST['TimeZone'];
        $CustomerID = $_SESSION['CustomerID'];

        date_default_timezone_set($UserTimezone);

        $currentDateTime = new DateTime();
        $formattedDateTime = $currentDateTime->format('Y-m-d H:i:s');

        // We Got the Product Info First
        $Query = "SELECT * FROM products WHERE productID = " . $_POST['ProductID'];  

        $ProductsResult = mysqli_query($connection, $Query);

        while ($row = mysqli_fetch_assoc($ProductsResult)){
            $_SESSION['ProductName'] = $row['Name'];
            $_SESSION['ProductPrice'] = $row['Price'];
            $_SESSION['ProductDescription'] = $row['Description'];
            $_SESSION['ProductStockQuantity'] = $row['StockQuantity'];
        }

        function CalculateTotalPrice(){
            global $connection;

            $TotalPrice = 0;
            $ProductID = $_POST['ProductID'];
            $Quantity = $_POST['AmountOfProduct'];
            $Price = $_SESSION['ProductPrice'];

            $TotalPrice = $Price * $Quantity;

            // We Check if the Quantity is more than the Stock Quantity
            if ($_SESSION['ProductStockQuantity'] < $Quantity){
                $_SESSION['Error'] = "Not Enough Stock";
                return false;
            }

            $_SESSION['ProductStockQuantity'] -= $Quantity;

            // We Update the Stock Quantity
            mysqli_query($connection, "UPDATE products SET StockQuantity = StockQuantity - " . $Quantity . " WHERE ProductID = " . $ProductID);

            return $TotalPrice;
        }

        $TotalPrice = CalculateTotalPrice();

        if ($TotalPrice == false){
            header("Location: Pages/MakeOrderPage.php");
            exit;
        }

        // We Insert the Order
        $OrderQuery = mysqli_query($connection, "INSERT INTO orders (CustomerID, OrderDate, TotalPrice, OrderStatus) VALUES ('$CustomerID', '$formattedDateTime', '$TotalPrice', 'Processing')");
        // We Insert Data in order_details
        $OrderDetailsQuery = mysqli_query($connection, "INSERT INTO order_details (OrderID, ProductID, Quant) VALUES ((SELECT MAX(OrderID) FROM orders), " . $_POST['ProductID'] . ", " . $_POST['AmountOfProduct'] . ")");

        if (!$OrderQuery){
            $_SESSION['Error'] = "Order Failed: SQL ERROR";
            header("Location: Pages/MakeOrderPage.php");
            exit;
        }
    
        if (!$OrderDetailsQuery){
            $_SESSION['Error'] = "Order Failed: SQL ERROR";
            header("Location: Pages/MakeOrderPage.php");
            exit;
        }

        $_SESSION['Success'] = "Order Made";
        header("Location: Pages/MakeOrderPage.php");
    }
?>