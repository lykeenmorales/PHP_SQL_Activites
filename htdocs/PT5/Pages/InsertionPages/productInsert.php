<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>

    <link rel="stylesheet" href="../../CSS_files/mainDesign.css">
    <link rel="stylesheet" href="../../CSS_files/ProductInsertEditDesign.css">

    <?php
        include '../../connection.php';

        $IsInput = null;
        $SuccessfullInsert = null;
    ?>
</head>


<body>
    <div id = "Header">
        <a class="headerText" href="../productPage.php"> Go Back </a>
        &nbsp;&nbsp;&nbsp;
    </div>

    <div id = "TitleText">
        <h1>Add New Product</h1>
    </div>

    <div id="CenterTable">
        <form method="post">
            <table>
                <tr>
                    <td><label for="Price">Product Name: </label><input type="text" id="ProductName" name="ProductName" placeholder="Enter Product name"></td>
                </tr>
                <tr>
                    <td><label for="Price">Price: </label><input type="number" id="Price" name="Price" placeholder="Enter Product price" min="0" step=".01"></td>
                </tr>
                <tr>
                    <td><label for="StockQuantity">Quantity: </label><input type="number" id="StockQuantity" name="StockQuantity" placeholder="Enter Product Stock Quantity" min="0" step="1"></td>
                </tr>
                <tr>
                    <td><label for="Price">Description:</label></td>
                </tr>
                <tr>
                    <td>
                     <textarea name="DescriptionText" id="DescriptionText" rows="5" cols="45", name="DescriptionText", placeholder="Description about the Product..."></textarea>
                    </td>
                </tr>

                <tr>
                    <td id="SubmitButton"> <input type="Submit" value="Submit" name="Submit"></td>
                </tr>

                <tr>
                    <td>
                        <?php
                            if (isset($_POST['Submit']) != ""){
                                $ProductName = $_POST['ProductName'];
                                $ProductPrice = $_POST['Price'];
                                $ProductDescription = $_POST['DescriptionText'];
                                $Quantity = $_POST['StockQuantity'];

                                if ($ProductDescription == null or $ProductName == null or $ProductPrice == null){
                                    echo'Empty Fields';
                                    return;
                                }

                                $Query = null;

                                if ($Quantity == 0 or $Quantity == null){
                                    $Query = "INSERT INTO products (Name, Price, Description) Values ('$ProductName', '$ProductPrice', '$ProductDescription')";
                                }else{
                                    $Query = "INSERT INTO products (Name, Price, Description, StockQuantity) Values ('$ProductName', '$ProductPrice', '$ProductDescription', '$Quantity')";
                                }

                                $InsertResult = mysqli_query($connection, $Query);

                                if ($InsertResult){
                                    echo"<br>Successfully Added new product";
                                }else{
                                    $IsInput = false;
                                    echo "<br>Error occurred while adding";
                                }
    
                                }
                        ?>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</body>
</html>