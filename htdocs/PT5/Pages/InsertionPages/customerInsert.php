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
                    <td> First Name: <input type="text" id="FirstName" name="FirstName" placeholder="Enter First Name" maxlength="50"></td>
                </tr>
                <tr>
                    <td> Last Name: <input type="text" id="LastName" name="LastName" placeholder="Enter Last Name" maxlength="50"></td>
                </tr>
                <tr>
                    <td> Phone: <input type="number" id="Phone" name="Phone" placeholder="Enter Phone" min="0" maxlength="50"></td>
                </tr>
                <tr>
                    <td> Address: <input type="text" id="Address" name="Address" placeholder="Enter Address" maxlength="100"></td>
                </tr>

                <tr>
                    <td id="SubmitButton"> <input type="Submit" value="Submit" name="Submit"></td>
                </tr>
        
                <tr>
                    <td>
                        <?php
                            if (isset($_POST['Submit']) != ""){
                                $FirstName = $_POST['FirstName'];
                                $LastName = $_POST['LastName'];
                                $PhoneNumber = $_POST['Phone'];
                                $Address = $_POST['Address'];

                                if ($FirstName == null or $LastName == null or $PhoneNumber == null or $Address == null){
                                    echo'<br>Empty Fields';
                                    return;
                                }

                                $Query = "INSERT INTO customeraccount (first_name, last_name, Phone, Address) Values ('$FirstName', '$LastName', '$PhoneNumber', '$Address')";

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
</body>
</html>