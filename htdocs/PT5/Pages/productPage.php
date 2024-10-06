<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="../mainDesign.css">

</head>

<?php
    include '../GetData.php';

    $QueryResult = getDataTable("GetProductInformation");

    while ($row = mysqli_fetch_array($QueryResult)){
?>

<body>
    <h2>Product Information</h2>
    <table>
        <tr>
            <th> First Name </th>
            <th> Last Name </th>
            <th> Phone Number</th>
            <th> Address </th>
        </tr>

        <tr>
            <td><?php echo($row["first_name"]) ?></td>
            <td><?php echo($row["last_name"]) ?></td>
            <td><?php echo($row["Phone"]) ?></td>
            <td><?php echo($row["Address"]) ?></td>
        </tr>

        // End Bracket loop
        <?php
            }
        ?>
    </table>
</body>
</html>