<?php
    session_start();
    include 'connection.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['ProductID'])) {
            $_SESSION['ProductId'] = $_POST['ProductID'];

            $Query = "SELECT * FROM products WHERE productID = " . $_SESSION['ProductId'];
            $QUERYRESULT = mysqli_query($connection, $Query);

            $Row = mysqli_fetch_assoc($QUERYRESULT);

            $_SESSION['ProductPrice'] = $Row['Price'];
            $_SESSION['ProductName'] = $Row['Name'];
            $_SESSION['ProductDescription'] = $Row['Description'];
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>

    <link rel="stylesheet" href="CSS_files/mainDesign.css">
    <link rel="stylesheet" href="CSS_files/ProductInsertEditDesign.css">

    <?php
        $Query = "SELECT * FROM products WHERE productID = " . $_SESSION['ProductId'];
        $QUERYRESULT = mysqli_query($connection, $Query);

        $Row = mysqli_fetch_assoc($QUERYRESULT);
    ?>
</head>

<body>
    <div id = "Header">
        <a class="headerText" href="Pages/productPage.php"> Go Back </a>
        &nbsp;&nbsp;&nbsp;
    </div>

    <div id = "TitleText">
        <?php
            echo "<h1>Edit Product: " . $_SESSION['ProductName'] . "</h1>";
        ?>
    </div>

    <div id="CenterTable">
        <form id="MainForm" method="post" action="UpdateData.php">
            <table>
                <tr>
                    <td>
                        <label for="ProductName">Product Name: </label>
                        <input type="text" id="ProductName" name="ProductName" placeholder="Enter product name" value="<?php echo htmlspecialchars($Row['Name']); ?>">
                    </td>
                </tr>

                <tr>
                    <td>
                        <label for="Price">Price: </label>
                        <input type="number" id="Price" name="Price" placeholder="Enter product price" min="0" step=".01" value="<?php echo htmlspecialchars($Row['Price']); ?>">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="StockQuantity">Quantity: </label>
                        <input type="number" id="StockQuantity" name="StockQuantity" placeholder="Enter Product Stock Quantity" min="0" step="1" value="<?php if ($Row['StockQuantity'] != null or $Row['StockQuantity'] != 0){echo htmlspecialchars($Row['StockQuantity']);}else{echo '0';}?>">
                    </td>
                </tr>
                <tr>
                    <td><label for="DescriptionText">Description: </label></td>
                </tr>
                <tr>
                    <td>
                    <textarea name="DescriptionText" id="DescriptionText" rows="5" cols="50", name="DescriptionText", placeholder="Description about the product..."><?php echo htmlspecialchars($Row['Description']);?></textarea>
                    </td>
                </tr>

                <tr>
                    <td id="SubmitButton"> <input id="MainSubmitButton" type="Submit" value="Update" name="UpdateProduct">   <input id="DeleteButton" type="Submit" value="Delete" name="DeleteCustomerAccount"></td>
                </tr>

                <tr>
                    <td>
                        <?php
                            if (isset($_SESSION['SuccessUpdateMessage'])){
                                if ($_SESSION['SuccessUpdateMessage'] != ""){
                                    if ($_SESSION['SuccessUpdateMessage'] == "Success"){
                                        echo '<br>Product Updated Successfully';
                                    }
                                    else{
                                        echo '<br>Product Update Failed {Empty Fields or Invalid Inputs}';
                                    }
                                }
                            }
                        ?>
                    </td>
                </tr>
            </table>
        </form>
    </div>

    <script>
        const SubmitButton = document.getElementById("MainSubmitButton");
        const DeleteButton = document.getElementById("DeleteButton");
        const MainForm = document.getElementById("MainForm");
        
        const TypeOfUpdate = document.createElement("input");
        TypeOfUpdate.type = "hidden";
        TypeOfUpdate.name = "TypeOfUpdate"
        TypeOfUpdate.value = "ProductUpdate"
        
        MainForm.appendChild(TypeOfUpdate);


        SubmitButton.addEventListener('click', UpdateData);
        DeleteButton.addEventListener('click', DeleteData);

        function UpdateData(event){
            event.preventDefault();

            document.querySelector("form").submit();
        }

        function DeleteData(event){
            event.preventDefault();

            if (confirm("Are you sure you want to delete this product?")){
                const IsDelete = document.createElement("input");
                IsDelete.type = "hidden";
                IsDelete.name = "IsDelete"
                IsDelete.value = "Delete"

                MainForm.appendChild(IsDelete);

                document.querySelector("form").submit();
            }                
        }
    </script>
</body>
</html>