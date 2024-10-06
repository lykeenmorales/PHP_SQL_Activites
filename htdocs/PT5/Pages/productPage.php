<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="../mainDesign.css">

</head>

<body>
    <h2>Product Information</h2>
    <table>
        <tr>
            <th> First Name </th>
            <th> Last Name </th>
            <th> Phone Number</th>
            <th> Address </th>
        </tr>
        <?php
            include '../GetData.php';

            $QueryResult = getDataTable("GetProductInformation");

            while ($row = mysqli_fetch_array($QueryResult)){
        ?>
        <tr>
            <td><?php echo($row); ?></td>
       
        </tr>

        <?php
            }
        ?>
    </table>
</body>
</html>