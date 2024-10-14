<?php
    session_start();
    include '../connection.php';
?>

<!doctype html>
<html lang="en">
<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />

    <!-- Bootstrap CSS v5.2.1 -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
        crossorigin="anonymous"
    />

    <!-- Custom CSS -->
        <link rel="stylesheet" href="../CSS_files/mainDesign.css">
        <link rel="stylesheet" href="../CSS_files/MakeOrderPage_Design.css">
</head>

<body>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid" id = "NavigationBar">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="customerpage.php">Go Back</a>
                </ul>
            </div>
        </div>
    </nav>

    <div id = "TitleText">
        <p class="h3">Making Order For: <?php echo $_SESSION['LastName'] . ", " . $_SESSION['FirstName'] ?></p>
    </div>

    <div id="CenterTable" class="container">
        <form action="../MakeOrder.php" method="post" id="MainForm" class="needs-validation" novalidate>
                <table>
                    <tr>
                        <td>
                            <div class="mb-1">
                                <label for="dropdownMenuButton" class="form-label">Choose Product:</label>
                                <div class="container mb-1">
                                    <div class="dropdown">
                                        <!-- Search Input -->
                                    <input id="searchInput" class="form-control form-control-sm custom-input-text-size mb-1" type="text" placeholder="chosen product" required> 
                                    <div class="invalid-feedback" name="productInputFeedback">
                                        Product field is invalid.
                                    </div>

                                        <button class="btn btn-Primary dropdown-toggle custom-select-size" data-bs-toggle="dropdown" data-bs-auto-close="inside" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                            Select an Item
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-scrollable" aria-labelledby="dropdownMenuButtonDark">
                                            <?php
                                                $ProductsArray = array();
                                                $Query = "SELECT * FROM products";
                                                $QUERYRESULT = mysqli_query($connection, $Query);

                                                while ($Row = mysqli_fetch_assoc($QUERYRESULT)){
                                                    if ($Row['StockQuantity'] > 0){
                                                        echo '<li><button class="dropdown-item btn-custom-hover" type="button" onclick="selectItem(\''.addslashes(htmlspecialchars($Row['Name'])).'\','.$Row['productID'].')">'.htmlspecialchars($Row['Name']).'</button></li>';
                                                        array_push($ProductsArray, $Row['Name']);
                                                    }
                                                }
                                            ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    
                    <tr>
                        <td>
                            <div class="mb-2 justify-content-center">
                                <label for="numberInput" class="form-label">Quantity: </label>
                                <input type="number" class="form-control custom-input" id="numberInput" placeholder="0" min="1" max="1000" required>
                                <div class="invalid-feedback" name="quantityFeedBack">
                                    Amount cant be 0 or negative.
                                </div>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <div class="d-flex justify-content-center">
                                <input type="hidden" name="ProductID" id="ProductID">
                                <button type="submit" id="SubmitButton" class="btn btn-primary btn-sm btn-light custom-input-Hover">Add Product</button>
                            </div>
                        </td>
                    </tr>
                </table>
        </form>
    </div>

    <!-- Success Notify Modal -->
    <div class="modal fade" id="SuccessfullModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmModalLabel">Confirm Action</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="Confirm">Continue</button>
                </div>
            </div>
        </div>
    </div>


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

    <!-- Custom JavaScript -->
    <script>
        const ProductInput = document.getElementById('searchInput');
        const MainForm = document.getElementById('MainForm')
        const submitButton = document.getElementById('SubmitButton');
        const productQuant = document.getElementById('numberInput')
        const dropdownMenu = document.querySelector('.dropdown-menu');
        const items = dropdownMenu.querySelectorAll('.dropdown-item');
        const forms = document.querySelectorAll('.needs-validation');
        const ProductID = document.getElementById('ProductID');
        
        function selectItem(item, ReceivedProductID){
            searchInput.value = item;

            // Check if the hidden input field exists
            if (ProductID) {
                ProductID.value = ReceivedProductID; // Set the value of the hidden input
                console.log('Hidden input value set to:', ProductID.value); // Output the value to the console
            } else {
                console.error("Hidden input field not found."); // Log error if not found
            }
        }

        //search functionality
        ProductInput.addEventListener('keyup', function(){
            const filter = ProductInput.value.toUpperCase();
            for (let i = 0; i < items.length; i++){
                let text = items[i].textContent || items[i].innerText;
                if (text.toUpperCase().indexOf(filter) > -1){
                    items[i].style.display = '';
                } else {
                    items[i].style.display = 'none';
                }
            }
        });

        // Validation Check
        submitButton.addEventListener("click", Submit);

        function Submit(event){
            event.preventDefault();

            // Loop over them and prevent submission

            var ValidProduct = null;
            var ValidQuantity = null;
            var Products = <?php echo json_encode($ProductsArray); ?>;
            const filter = ProductInput.value.toUpperCase();

            Products.forEach(element => {
            if (element.toUpperCase() == filter){
                ValidProduct = true;
            }
            });

            // Quantity Check
            if (productQuant.value == null || productQuant.value <= 0){
                ValidQuantity = false;

                event.preventDefault()
                event.stopPropagation()
                
                productQuant.classList.add('is-invalid'); 
                productQuant.classList.remove('is-valid'); 
            }else{
                ValidQuantity = true;

                productQuant.classList.add('is-valid'); 
                productQuant.classList.remove('is-invalid');
            }
            // Product Check
            if (ProductInput.value == null || ProductInput.value == ""){
                event.preventDefault()
                event.stopPropagation()

                ProductInput.classList.add('is-invalid'); 
                ProductInput.classList.remove('is-valid'); 

                document.getElementsByName("productInputFeedback")[0].textContent = "Product field is empty!";
                return;
            }else if (ValidProduct == null || ValidProduct == false){
                event.preventDefault()
                event.stopPropagation()

                ProductInput.classList.add('is-invalid'); 
                ProductInput.classList.remove('is-valid'); 

                document.getElementsByName("productInputFeedback")[0].textContent = "Product is not in the list!";
                return;
            }else{
                ProductInput.classList.add('is-valid'); 
                ProductInput.classList.remove('is-invalid');
            }

            if (ValidProduct == true && ValidQuantity == true){
                document.getElementsByName("productInputFeedback")[0].textContent = "";
                document.getElementsByName("quantityFeedBack")[0].textContent = "";

                document.getElementsByClassName('modal-body')[0].textContent = "Order has been successfully placed for customer: <?php echo $_SESSION['FirstName'] . ", " . $_SESSION['LastName'] ?>";
                const SuccessfullModal = new bootstrap.Modal(document.getElementById('SuccessfullModal'));
                SuccessfullModal.show();

                document.getElementById('Confirm').addEventListener('click', function(){
                    SuccessfullModal.hide();
                    document.getElementById('MainForm').submit();
                });
            }
        } 
    </script>
</body>
</html>
