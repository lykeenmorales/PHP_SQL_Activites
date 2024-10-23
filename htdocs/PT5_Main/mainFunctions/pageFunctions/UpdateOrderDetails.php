<?php
    include '../connection.php';
    
    if ($_SERVER['REQUEST_METHOD'] === "POST"){
        $OrderID = $_POST['OrderID'];
        $OrderStatus = $_POST['OrderStatus'];

        if ($OrderStatus == null or $OrderID == null){
            echo "Error: OrderID or OrderStatus is null";
        }

        $UpdateQuery = "UPDATE orders SET OrderStatus = '$OrderStatus' WHERE OrderID = '$OrderID'";
        $UpdateResult = mysqli_query($connection, $UpdateQuery);

        if ($UpdateResult){
            echo "Order Details Updated";
        } else {
            echo "Error: " . $UpdateQuery . "<br>" . mysqli_error($connection);
        }
    }
?>