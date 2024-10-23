<?php
    session_start();
    include '../connection.php';

    $details_Query = "SELECT 
    o.OrderID, 
    ca.first_name, 
    ca.last_name,
    ca.Address, 
    ca.CustomerID,
    p.Name, 
    p.Price,
    o.TotalPrice,
    o.OrderStatus, 
    od.Quant, 
    o.OrderDate

    FROM 
    customeraccount ca

    JOIN  orders o ON o.CustomerID = ca.CustomerID
    JOIN order_details od ON od.OrderID = o.OrderID
    JOIN products p ON od.ProductID = p.ProductID
    WHERE  o.CustomerID = ca.CustomerID
    ORDER BY o.OrderDate DESC
    ";

    $Details = mysqli_query($connection, $details_Query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Accounts Information</title>

        <!-- Bootstrap CSS v5.2.1 -->
    <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
    rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
    crossorigin="anonymous"
    />

    <!-- Custom CSS -->
    <link rel="stylesheet" href="../CSS_files/mainDesign.css">
    <link rel="stylesheet" href="../CSS_files/OrderDetails_Design.css">

    <style>
        .custom-search-size{
            width: 350px;
            height: 30px;
        }
        .search-input-pos{
            position: absolute;
            top: 200px;
            right: 960px;
            
            justify-content: center; 
            align-items: center;
        }
        .customer-submit-pos{
            position: absolute;
            bottom: 100px;
        }

        .custom-select-sizeform{
            width: 125px;
            height: 30px;

            font-size: 12px;
            text-align: center;
            display: flex;
            justify-content: center; 
            align-items: center;
        }
        
    </style>
</head>

<body>
    <div id = "Header">
        <a class="headerText" href="../MainPage.php"> Back to Home </a>
        &nbsp;&nbsp;&nbsp;
    </div>
   
    <h2 class="TitleText">Order Details</h2>

    <form action="../UpdateOrderDetails.php" method="post" id="MainForm">
        
    <input class="form-control custom-search-size search-input-pos custom-search-size" id="myInput" type="text" placeholder="Search..">

    <table>
        <tr>
            <th> Customer Name </th>
            <th> Product </th>
            <th> Product Price </th>
            <th> Quantity </th>
            <th> Date of Order </th>
            <th> Total Amount </th>
            <th> Order Status </th>
            <th> Delivery Address </th>
        </tr>
        
            <?php
                while ($Row = mysqli_fetch_assoc($Details)){
            ?>
            
            <tbody id="myTable">
                <tr id="Info">
                    <input type="hidden" name="OrderID" value='<?php echo $Row['OrderID']; ?>'>
                    <td id="CustomerNameColumn"> <?php echo $Row['last_name'] . ", " . $Row['first_name'];?></td>
                    <td id="ProductNameColumn"> <?php echo $Row['Name'];?></td>
                    <td id="ProductPriceColumn"> <?php echo '$' . $Row['Price'];?></td>
                    <td id="QuantityColumn"> <?php echo $Row['Quant'];?></td>
                    <td id="OrderDateColumn"> <?php echo $Row['OrderDate'];?></td>
                    <td id="TotalPriceColumn"> <?php echo '$' . $Row['TotalPrice'];?></td>
                    <td id="OrderStatusColumn">
                        <select class="form-select SelectStatus custom-select-sizeform" name="OrderStatus" data-order-id='<?php echo $Row['OrderID']; ?>'>
                            <option value="Pending" <?php if($Row['OrderStatus'] == 'Pending') echo 'selected'; ?>>Pending</option>
                            <option value="Processing" <?php if($Row['OrderStatus'] == 'Processing') echo 'selected'; ?>>Processing</option>
                            <option value="Shipped" <?php if($Row['OrderStatus'] == 'Shipped') echo 'selected'; ?>>Shipped</option>
                            <option value="Delivered" <?php if($Row['OrderStatus'] == 'Delivered') echo 'selected'; ?>>Delivered</option>
                            <option value="Cancelled" <?php if($Row['OrderStatus'] == 'Cancelled') echo 'selected'; ?>>Cancelled</option>
                        </select>
                    </td>
                    <td id="AddressColumn"> <?php echo $Row['Address'];?></td>
                </tr>
            </tbody>

            <?php
                ;}
            ?>
        </table>
    </form>

    <!-- Bootstrap JavaScript Libraries -->
    <script
        src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"
    ></script>
    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
        crossorigin="anonymous"
    ></script>

    <script>
        const SubmitButton = document.getElementById('SubmitButton');
        const orderStatusSelect = document.getElementsByName('OrderStatus');
        const SelectStatus = document.querySelectorAll('.SelectStatus')
        
        const ErrorSession = '<?php 
            if(isset($_SESSION['Error'])){
                echo $_SESSION['Error'];
                unset($_SESSION['Error']);
            }
        ?>'

        const SuccessSession = '<?php
            if (isset($_SESSION['Success'])){
                echo $_SESSION['Success'];
                unset($_SESSION['Success']);
            }
        ?>'

        if (ErrorSession != null && ErrorSession != 0){
            alert("Error: " + ErrorSession);
        }

        if (SuccessSession != null && SuccessSession != 0){
            alert("Success: " + SuccessSession);
        }

        document.getElementById('myInput').addEventListener('keyup', function() {
            var input = document.getElementById('myInput');
            var filter = input.value.toLowerCase();
            var table = document.querySelector('table');
            var tr = table.getElementsByTagName('tr');

            for (var i = 1; i < tr.length; i++) {
                var td = tr[i].getElementsByTagName('td');
                var found = false;
                for (var j = 0; j < td.length; j++) {
                    if (td[j]) {
                        if (td[j].innerHTML.toLowerCase().indexOf(filter) > -1) {
                            found = true;
                            break;
                        }
                    }
                }
                if (found) {
                    tr[i].style.display = '';
                } else {
                    tr[i].style.display = 'none';
                }
            }
        });

        document.getElementsByName('OrderStatus')[0].addEventListener('change', function() {
            this.blur(); // Remove focus from the select element
        });

        SelectStatus.forEach(element => {
            element.addEventListener('change', function() {
                const selectedStatus = this.value; // Get the selected value
                const orderId = this.getAttribute('data-order-id'); // Get the Order ID from data attribute

                // Make AJAX request to update the order status
                fetch('../UpdateOrderDetails.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: `OrderID=${orderId}&OrderStatus=${selectedStatus}`
                })
                .then(response => {
                    if (response.ok) {
                        return response.text();
                    }
                    throw new Error('Network response was not ok.');
                })
                .then(data => {
                    console.log(data); // If Success this will print
                    this.blur();
                })
                .catch(error => {
                    console.error('There was a problem with the fetch operation:', error);
                });
            });
        });
    </script>
</body>
</html>

