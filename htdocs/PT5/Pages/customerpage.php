<?php
    session_start();
    // We Reset here Also just incase
    session_unset();

    include '../connection.php';

    $QUERY = "SELECT * From customeraccount ORDER BY last_name ASC";
    $QUERYRESULT = mysqli_query($connection, $QUERY);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Accounts Information</title>

    <link rel="stylesheet" href="../CSS_files/mainDesign.css">
    <link rel="stylesheet" href="../CSS_files/customerTable.css">
</head>

<body>
    <div id = "Header">
        <a class="headerText" href="../MainPage.php"> Back to Home </a>
        &nbsp;&nbsp;&nbsp;
        <a href="InsertionPages/customerInsert.php"> Add Customer Account </a>
    </div>
   
    <h2 class="TitleText">Customer Accounts Information</h2>

    <table>
        <tr>
            <th>First Name</th>
            <th>Phone Number</th>
            <th>Address</th>
            <th>Email</th>
        </tr>

        <?php
            while ($Row = mysqli_fetch_assoc($QUERYRESULT)){
        ?>

        <tr>
            <td id="FirstNameColumn"> 
            <?php
            // Show the Name in the Table
                echo $Row['last_name'] . ", " . $Row['first_name']; 
            // If User Click Edit Button they will be redirect to Editing page with the productID
                echo '<form action="../customerEdit.php" method="POST"> 
                    <input type="hidden" name="CustomerID" value="' . $Row['CustomerID'] . '">
                    <input type="submit" value="Edit"> 
                  </form>';
            ?>
            </td> 
            <td id="PhoneColumn"> <?php echo $Row['Phone'];?></td>
            <td id="AddressColumn"> <?php echo $Row['Address'];?></td>
            <td id="EmailColumn"> <?php echo $Row['Email'];?></td>
        </tr>

        <?php
             }
        ?>
     </table>

</body>
</html>