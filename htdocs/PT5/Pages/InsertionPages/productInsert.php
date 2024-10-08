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
                    <td> Product Name: <input type="text" id="ProductName" name="ProductName" placeholder="Enter product name"> </td>
                </tr>

                <tr>
                    <td> Price: <input type="number" id="Price" name="Price" placeholder="Enter product price" min="0" step=".01"> </td>
                </tr>
                <tr>
                    <td>Description:</td>
                </tr>
                <tr>
                    <td>
                    <textarea name="DescriptionText" id="DescriptionText" rows="5" cols="50", name="DescriptionText", placeholder="Description about the product..."></textarea>
                    </td>
                </tr>

                <tr>
                    <td id="SubmitButton"> <input type="Submit" value="Submit" name="Submit"> </td>
                </tr>

                <tr>
                    <td>
                        <?php
                            if (isset($_POST['Submit']) != ""){
                                $ProductName = $_POST['ProductName'];
                                $ProductPrice = $_POST['Price'];
                                $ProductDescription = $_POST['DescriptionText'];

                                if ($ProductDescription == null or $ProductName == null or $ProductPrice == null){
                                    echo'<br>Empty Fields';
                                    return;
                                }

                                $Query = "INSERT INTO products (Name, Price, Description) Values ('$ProductName', '$ProductPrice', '$ProductDescription')";

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