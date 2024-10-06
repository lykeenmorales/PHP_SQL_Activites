<?php
    include 'connection.php';
    include 'config.php';

    // We are just returning the Query from the database
     function getDataTable($Callback){

        global $connection;

        if (gettype($Callback) != "string"){
            return "Invalid Input";
        }

        if ($Callback == "GetProductInformation"){
            $QUERY = "SELECT * From 'products'";
            $QUERYRESULT = mysqli_query($connection, $QUERY);

            // Check if Result Variable is Valid/ Not Empty
            if (!$QUERYRESULT){
                return "Error While Fetching Data";
            }
            return $QUERYRESULT;
        }elseif($Callback == "GetCustomerInformation"){
            $QUERY = "SELECT * From customeraccount";
            $QUERYRESULT = mysqli_query($connection, $QUERY);

            // Check if Result Variable is Valid/ Not Empty
            if (!$QUERYRESULT){
                return "Error While Fetching Data";
            }
            return $QUERYRESULT;
        }else{
            return "Cant find" . $Callback;
        }
    }
?>