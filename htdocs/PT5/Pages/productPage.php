<?php
    session_start();
    // We Reset here Also just incase
    session_unset();

    include '../connection.php';

    $QUERY = "SELECT * From products";
    $QUERYRESULT = mysqli_query($connection, $QUERY);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products Information</title>

    <link rel="stylesheet" href="../CSS_files/mainDesign.css">
    <link rel="stylesheet" href="../CSS_files/productTable.css">
</head>

<body>
    <div id = "Header">
        <a class="headerText" href="../MainPage.php"> Back to Home </a>
        &nbsp;&nbsp;&nbsp;
        <a href="InsertionPages/productInsert.php"> Add Product </a>
    </div>
   
    <h2 class="TitleText">Product Information</h2>

    <table>
        <tr>
            <th> Product </th>
            <th> Price </th>
            <th> Description</th>
        </tr>

        <?php
            while ($Row = mysqli_fetch_assoc($QUERYRESULT)){
        ?>

        <tr>
            <td id="NameColumn"> 
            <?php
            // Show the Name in the Table
                echo $Row['Name']; 
            // If User Click Edit Button they will be redirect to Editing page with the productID
                echo '<form action="../productEdit.php" method="POST"> 
                    <input type="hidden" name="ProductID" value="' . $Row['productID'] . '">
                    <input type="submit" value="Edit"> 
                  </form>';
            ?>
            </td> 

            <td id = "PriceColumn"> <?php echo "$" . $Row['Price'];?> </td>
            <td id="DescriptionColumn"> <?php echo $Row['Description'];?> </td>
        </tr>

        <?php
            }
        ?>
     </table>

</body>
</html>