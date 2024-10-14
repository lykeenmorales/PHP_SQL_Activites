<?php
    session_start();
    include 'connection.php';
    include 'config.php';

    function CalculateTotalPrice(){
        $TotalPrice = 0;
        $ProductID = $_SESSION['ProductID'];
        $Quantity = $_SESSION['Quantity'];
        $Price = $_SESSION['ProductPrice'];

        $TotalPrice = $Price * $Quantity;

        return $TotalPrice;
    }

    if ($_SERVER["REQUEST_METHOD"] === "POST"){
        // print_r ($_SESSION);
        // print ("<br>");
        // print_r ($_POST);

        
    }
?>