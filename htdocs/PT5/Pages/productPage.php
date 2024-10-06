<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="../mainDesign.css">

</head>

<?php
    include '../connection.php';

    $QUERY = "SELECT * From products";
    $QUERYRESULT = mysqli_query($connection, $QUERY);
?>

<body>
    <h2>Product Information</h2>
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
           <?php echo $Row['Name'] ; ?>
           <?php echo $Row['Price'] ; ?>
           <?php echo $Row['Description'] ; ?>
        </tr>

        <?php
            }
        ?>
    </table>
</body>
</html>