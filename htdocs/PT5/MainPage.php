<?php
    session_start();
    // We Reset all Session Variables when going back to Home Page
    session_unset();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main Menu Page</title>

    <link rel="stylesheet" href="CSS_files/mainPage.css">
</head>
<body>
    <div class="CenterMenu">
        <h1>Stationary Supplies</h1>
        <input type="button" class="customerShowButton" value="View Customer Accounts", onclick="window.location.href = 'Pages/customerpage.php'">
        <input type="button" class="ProductShowButton" value="View Products Information" onclick="window.location.href = 'Pages/productPage.php'">
        <input type="button" class="OrderButton" value="View Customer Orders" onclick="window.location.href = 'Pages/order_Details_Page.php'">
    </div>
</body>
</html>