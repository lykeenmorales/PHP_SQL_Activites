<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Customer</title>

    <link rel="stylesheet" href="../../CSS_files/mainDesign.css">
    <link rel="stylesheet" href="../../CSS_files/CustomerInsertEditDesign.css">

    <?php
        include '../../connection.php';

        $IsInput = null;
        $SuccessfullInsert = null;

        function ConvertToPhoneNumber($PhoneNumber){
            $ReceivedPhoneNumber = (string)$PhoneNumber;
        
            if (substr($ReceivedPhoneNumber, 0,1) == '0'){
                $ReceivedPhoneNumber = substr($ReceivedPhoneNumber, 1);
            }
        
            $PhoneNumberStringEdit1 = '+63' . $ReceivedPhoneNumber;    
            $FinalizePhoneNumber = preg_replace('/(\+63)(\d{3})(\d{3})(\d{4})/', '$1 $2 $3 $4', $PhoneNumberStringEdit1);
        
            return $FinalizePhoneNumber;
        }
    ?>
</head>


<body>
    <div id = "Header">
        <a class="headerText" href="../customerpage.php"> Go Back </a>
        &nbsp;&nbsp;&nbsp;
    </div>

    <div id = "TitleText">
        <h1>Add Customer Information</h1>
    </div>

    <div id="CenterTable">
        <form method="post">
            <table>
                <tr>
                    <td><label for="FirstName">First Name: </label><input type="text" id="FirstName" name="FirstName" placeholder="Enter First Name" maxlength="50"></td>
                </tr>
                <tr>
                    <td><label for="LastName">Last Name: </label><input type="text" id="LastName" name="LastName" placeholder="Enter Last Name" maxlength="50"></td>
                </tr>
                <tr>
                    <td><label for="Phone">Phone: </label><input type="number" id="Phone" name="Phone" placeholder="Enter Phone" min="0" maxlength="50"></td>
                </tr>
                <tr>
                    <td><label for="Address">Address: </label><input type="text" id="Address" name="Address" placeholder="Enter Address" maxlength="100"></td>
                </tr>
                <tr>
                    <td><label for="Email">Email:</label><input type="email" id="Email" name="Email" placeholder="Enter Email"><span class="Optional">*</span></td>
                </tr>

                <tr>
                    <td id="SubmitButton"> <input type="Submit" value="Submit" name="Submit"></td>
                </tr>
        
                <tr>
                    <td>
                        <?php
                            if ($_SERVER["REQUEST_METHOD"] === "POST") {
                                $FirstName = $_POST['FirstName'];
                                $LastName = $_POST['LastName'];
                                $PhoneNumber = ConvertToPhoneNumber($_POST['Phone']);
                                $Address = $_POST['Address'];
                                $Email = $_POST['Email'];

                                if ($FirstName == null or $LastName == null or $PhoneNumber == null or $Address == null){
                                    echo'<br>Empty Fields';
                                    return;
                                }

                                $Query = null;

                                if ($Email == null){
                                    $Query = "INSERT INTO customeraccount (first_name, last_name, Phone, Address) Values ('$FirstName', '$LastName', '$PhoneNumber', '$Address')";
                                }else{
                                    $Query = "INSERT INTO customeraccount (first_name, last_name, Phone, Address, Email) Values ('$FirstName', '$LastName', '$PhoneNumber', '$Address', '$Email')";
                                }

                                $InsertResult = mysqli_query($connection, $Query);

                                if ($InsertResult){
                                    echo"<br>Successfully Added new Customer Account";
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

    <script>
        document.getElementById("SubmitButton").addEventListener("click", function(event){    
            event.preventDefault(); 

            const FirstName = document.getElementById("FirstName").value;
            const LastName = document.getElementById("LastName").value;
            const Number = document.getElementById("Phone").value;
            const Address = document.getElementById("Address").value;
            const Email = document.getElementById("Email").value;
            
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
        })
    </script>
</body>
</html>