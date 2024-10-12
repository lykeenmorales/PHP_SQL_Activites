<?php
    session_start();
    // We Reset here Also just incase
    session_unset();

    include '../connection.php';

    $details_Query = "SELECT 
    o.OrderID, 
    ca.first_name, 
    ca.last_name, 
    p.Name, 
    p.Price,
    o.TotalPrice,
    o.OrderStatus, 
    od.Quant, 
    o.OrderDate

    FROM 
    customeraccount ca

    JOIN  orders o ON o.CustomerID = ca.CustomerID
    JOIN order_details od ON od.OrderID = o.OrderID
    JOIN products p ON od.ProductID = p.ProductID
    WHERE  o.CustomerID = ca.CustomerID
    ORDER BY o.OrderDate DESC
    ";

    $Details = mysqli_query($connection, $details_Query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Accounts Information</title>

    <link rel="stylesheet" href="../CSS_files/mainDesign.css">
    <link rel="stylesheet" href="../CSS_files/OrderDetails_Design.css">
</head>

<body>
    <div id = "Header">
        <a class="headerText" href="../MainPage.php"> Back to Home </a>
        &nbsp;&nbsp;&nbsp;
        <a href="MakeOrderPage.php"> Add Order </a>
    </div>
   
    <h2 class="TitleText">Order Details</h2>

    <table>
        <tr>
            <th>Order ID</th>
            <th>Customer Name</th>
            <th>Order Date</th>
            <th>Total Price</th>
            <th>Order Status</th>
            <th>Product Name</th>
            <th>Product Price</th>
            <th>Quantity</th>
        </tr>

        <?php
            while ($Row = mysqli_fetch_assoc($Details)){
        ?>
        
        <tr>
            <td id="OrderIDColumn"> <?php echo $Row['OrderID'];?></td>
            <td id="CustomerNameColumn"> <?php echo $Row['last_name'] . ", " . $Row['first_name'];?></td>
            <td id="OrderDateColumn"> <?php echo $Row['OrderDate'];?></td>
            <td id="TotalPriceColumn"> <?php echo $Row['TotalPrice'];?></td>
            <td id="OrderStatusColumn"> <?php echo $Row['OrderStatus'];?></td>
            <td id="ProductNameColumn"> <?php echo $Row['Name'];?></td>
            <td id="ProductPriceColumn"> <?php echo $Row['Price'];?></td>
            <td id="QuantityColumn"> <?php echo $Row['Quant'];?></td>
        </tr>

        <?php
             }
        ?>
     </table>

</body>
</html>

