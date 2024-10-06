<?php
    include '../connection.php';
    include '../config.php';

    // We are just returning the Query from the database
     function getDataTable($Callback, $Query_Conn){
        if (gettype($Callback) != "string"){
            return "Invalid Input";
        }

        if ($Callback == "GetProductInformation"){
            $QUERY = "SELECT * From products";
            $QueryResult = mysqli_query($Query_Conn, $QUERY);

            // Check if Result Variable is Valid/ Not Empty
            if (!$QueryResult){
                return "Error While Fetching Data";
            }
            return $QueryResult;
        }elseif($Callback == "GetCustomerInformation"){
            $QUERY = "SELECT * From customeraccount";
            $QueryResult = mysqli_query($Query_Conn, $QUERY);

            // Check if Result Variable is Valid/ Not Empty
            if (!$QueryResult){
                return "Error While Fetching Data";
            }
            return $QueryResult;
        }else{
            return "Cant find" . $Callback;
        }
    }