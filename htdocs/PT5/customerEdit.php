<?php
    session_start();
    include 'connection.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['CustomerID'])) {
            $_SESSION['CustomerID'] = $_POST['CustomerID'];

            $Query = "SELECT * FROM customeraccount WHERE CustomerID = " . $_SESSION['CustomerID'];
            $QUERYRESULT = mysqli_query($connection, $Query);

            $Row = mysqli_fetch_assoc($QUERYRESULT);

            $_SESSION['FirstName'] = $Row['first_name'];
            $_SESSION['LastName'] = $Row['last_name'];
            $_SESSION['PhoneNumber'] = $Row['Phone'];
            $_SESSION['Address'] = $Row['Address'];
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
    <link rel="stylesheet" href="CSS_files/CustomerInsertEditDesign.css">

    <?php
        $Query = "SELECT * FROM customeraccount WHERE CustomerID = " . $_SESSION['CustomerID'];
        $QUERYRESULT = mysqli_query($connection, $Query);

        $Row = mysqli_fetch_assoc($QUERYRESULT);

        function ConvertNumber(){
            global $Row;

            $PhoneNumber = $Row['Phone'];
            $PhoneNumberStringEdit = null;

            if (str_replace('+63', '09', $PhoneNumber)){
                $PhoneNumberStringEdit = str_replace('+63', '0', $PhoneNumber);
            }

            $PhoneNumberStringEdit2 = str_replace(' ', '', $PhoneNumberStringEdit);
            
            return $PhoneNumberStringEdit2;
        }
    ?>
</head>

<body>
    <div id = "Header">
        <a class="headerText" href="Pages/customerpage.php"> Go Back </a>
        &nbsp;&nbsp;&nbsp;
    </div>

    <div id = "TitleText">
        <?php
            echo "<h1>Editing: " . $Row['first_name'] . " " . $Row['last_name'] . " Account " ."</h1>";
        ?>
    </div>

    <div id="CenterTable">
        <form id="MainForm" method="post" action="UpdateData.php" autocomplete="on">
            <table>
                <tr>
                    <td><label for="FirstNameColumn">First Name: </label><input type="text" id="FirstNameColumn" name="FirstNameColumn" placeholder="Enter first name" value="<?php echo htmlspecialchars($Row['first_name']);?>"></td>
                </tr>
                <tr>
                    <td><label for="LastNameColumn">Last Name: </label><input type="text" id="LastNameColumn" name="LastNameColumn" placeholder="Enter last name" value="<?php echo htmlspecialchars($Row['last_name']);?>"></td>
                </tr>
                <tr>
                    <td><label for="PhoneColumn">Phone: </label><input type="number" id="PhoneColumn" name="PhoneColumn" minlength="11" maxlength="50" placeholder="Enter Phone Number" min="1" value=<?php echo ConvertNumber();?>></td>
                </tr>
                <tr>
                    <td><label for="AddressColumn">Address: </label><input type="text" id="AddressColumn" name="AddressColumn" placeholder="Enter Address" maxlength="100" value="<?php echo htmlspecialchars($Row['Address']);?>"></td>
                </tr>
                <tr>
                    <td><label for="Email">Email:</label><input type="email" id="EmailColumn" name="Email" placeholder="Enter Email" value="<?php if ($Row['Email'] != null){echo htmlspecialchars($Row['Email']);} ;?>"><span class="Optional">*</span></td>
                </tr>

                <tr>
                    <td id="SubmitButton"><input id="MainSubmitButton" type="Submit" value="Update" name="UpdateCustomerAccount">   <input id="DeleteButton" type="Submit" value="Delete" name="DeleteCustomerAccount"></td>
                </tr>

                <tr>
                    <td>
                        <?php
                            if (isset($_SESSION['SuccessUpdateMessage'])){
                                if ($_SESSION['SuccessUpdateMessage'] != ""){
                                    if ($_SESSION['SuccessUpdateMessage'] == "Success"){
                                        echo '<br>Account Updated Successfully';
                                    }
                                    elseif ($_SESSION['SuccessUpdateMessage'] == "DeleteSuccess"){
                                        echo '<br>Account Deleted Successfully';
                                    }elseif ($_SESSION['SuccessUpdateMessage'] == "DeleteFailed"){
                                        echo '<br>Account Delete Failed. Please Try Again';
                                    }else{
                                        echo '<br>Account Update Failed {Empty Fields or Invalid Inputs}';
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
        const UpdateButton = document.getElementById("MainSubmitButton");
        const DeleteButton = document.getElementById("DeleteButton");
        const MainForm = document.getElementById("MainForm")

        const TypeOfUpdate = document.createElement("input");
        TypeOfUpdate.type = "hidden";
        TypeOfUpdate.name = "TypeOfUpdate"
        TypeOfUpdate.value = "CustomerUpdate"
        
        MainForm.appendChild(TypeOfUpdate);

        UpdateButton.addEventListener("click", UpdateAccount);
        DeleteButton.addEventListener("click", DeleteAccount);            

        function UpdateAccount(event){
            event.preventDefault();

            const FirstName = document.getElementById("FirstNameColumn").value;
            const LastName = document.getElementById("LastNameColumn").value;
            const Number = document.getElementById("PhoneColumn").value;
            const Address = document.getElementById("AddressColumn").value;
            const Email = document.getElementById("EmailColumn").value;

            const EmailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;

            if (Email != ""){
                if (!EmailPattern.test(Email)){
                    alert("Invalid Email");
                    return;
                }
            }

            if (FirstName === "" || LastName === "" || Address === ""){
                alert("Empty Fields");
                return;
            }
        
            if (Number === 0){
                alert("Phone Number cant be 0");
                return;
            }else if(Number.length < 11){
                alert("Phone Number must be 11 digits");
                return;
            }else if (Number.length > 11){
                alert("Phone Number must be less than 11 digits");
                return;
            }else if (Number.charAt(0) != 0 || Number.charAt(1) != 9){
                alert("Phone Number must start with 09");
                return;
            }

            document.querySelector("form").submit();
        }

        function DeleteAccount(event){
            event.preventDefault();

            if (confirm("Are you sure you want to delete this Account?")){
                const IsDelete = document.createElement("input")
                IsDelete.type = "hidden"
                IsDelete.name = "IsDelete"
                IsDelete.value = "Delete"

                MainForm.appendChild(IsDelete);

                document.querySelector("form").submit();
            }
        }
    </script>
</body>
</html>