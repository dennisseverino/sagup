<?php
   include_once("../connection/connection.php");
   include_once("../connection/function.php");


    $id="";
    $payment_type="";
    $payment_currency="";
    $firstname="";
    $lastname="";
    $age="";
    $email="";
    $contact_number="";
    $card_number="";
    $securitycode="";
    $billing_fname="";
    $billing_lname="";
    $billing_address="";

    $errorMessage ="";
    $successMessage = "";

    if($_SERVER['REQUEST_METHOD'] == 'GET'){
        //GET method: Show the data of the client

        if(!isset($_GET["id"]) ) {
            header("location: index.php");
            exit;
        }

        $id = $_GET["id"];

        // read the row of the selected client from database table
        $sql = "SELECT * FROM donations WHERE id=$id";
        $result = $connection->query($sql);
        $row = $result->fetch_assoc();

        if(!$row){
            header("location: index.php");
            exit;
        }
      
        $payment_type = $row["payment_type"];
        $payment_currency = $row["payment_currency"];
        $firstname = $row["firstname"];
        $lastname = $row["lastname"];
        $age = $row["age"];
        $email = $row["email"];
        $contact_number = $row["contact_number"];
        $card_number = $row["card_number"];
        $expdate = $row["expdate"];
        $securitycode = $row["securitycode"];
        $billing_fname = $row["billing_fname"];
        $billing_lname = $row["billing_lname"];
        $billing_address = $row["billing_address"];

        

    }else{
        //POST method: Update the data of the client
        $id = $_POST["id"];
        $payment_type = $_POST["payment_type"];
        $payment_currency = $_POST["payment_currency"];
        $firstname = $_POST["firstname"];
        $lastname = $_POST["lastname"];
        $age = $_POST["age"];
        $email = $_POST["email"];
        $contact_number = $_POST["contact_number"];
        $card_number = $_POST["card_number"];
        $expdate = $_POST["expdate"];
        $securitycode = $_POST["securitycode"];
        $billing_fname = $_POST["billing_fname"];
        $billing_lname = $_POST["billing_lname"];
        $billing_address = $_POST["billing_address"];

        do{
            if(empty($id) || empty($payment_type) || empty($payment_currency) || empty($firstname) || empty($lastname) || empty($age) 
            || empty($email) || empty($contact_number) || empty($card_number) || empty($expdate) || empty($securitycode) 
            || empty($billing_fname) || empty($billing_lname) || empty($billing_address)){
                $errorMessage = "All the fields are requred";
                break;
            }

            $sql = "UPDATE donations " .  
                    "SET payment_type = '$payment_type', payment_currency = '$payment_currency', firstname = '$firstname' , lastname = '$lastname'
                    , age = '$age' ,  email = '$email' ,  contact_number = '$contact_number' ,  card_number = '$card_number' ,
                    expdate = '$expdate',  securitycode = '$securitycode' ,  billing_fname = '$billing_fname' ,  billing_lname = '$billing_lname' 
                    ,  billing_address = '$billing_address'  " .
                    "WHERE id = $id";

                    $result = $connection->query($sql);

                    if (!$result){
                        $errorMessage = "Invalid query: " . $connection->error;
                        break;
                    }

                    $successMessage = "Client updated correctly";

                    header("location: index.php");
                    exit;
        }while(true);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Shop</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" >
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="css/test.css">
</head>
<body>
    <div class="container my-5">
        <h2>Create Donation</h2>

        <?php
            if(!empty($errorMessage)){
                echo "
                <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                    <strong>$errorMessage</strong>
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>
                ";
            }
        ?>

        <form method="POST">

        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Select Payment Type</label>
            <div class="col-sm-6">
                <input type="radio" id="payment_type_one_time" name="payment_type" value="One Time">
                <label for="payment_type_one_time">One Time</label>
                                    
                <input type="radio" id="payment_type_monthly" name="payment_type" value="Monthly">
                <label for="payment_type_monthly">Monthly</label><br>
                            
            </div>
        </div> 

        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Select Payment</label>
            <div class="col-sm-6">
                <input type="radio" id="payment_currency_2500" name="payment_currency" value="2500">
                <label for="payment_currency_2500">2,500</label>
                                                        
                <input type="radio" id="payment_currency_5000" name="payment_currency" value="5000">
                <label for="payment_currency_5000">5,000</label>
                                                        
                <input type="radio" id="payment_currency_10000" name="payment_currency" value="10000">
                <label for="payment_currency_10000">10,000</label>

                <input type="radio" id="payment_currency_others" name="payment_currency" value="others">
                <label for="payment_currency_others">Others</label>
                <input type="text" id="custom_amount" name="payment_currency" placeholder="Enter amount" disabled>
            </div>
        </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">First name</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="firstname" value="<?php echo $firstname; ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">lastname</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="lastname" value="<?php echo $lastname; ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Age</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="age" value="<?php echo $age; ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Email</label>
                <div class="col-sm-6">
                    <input type="email" class="form-control" name="email" value="<?php echo $email; ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">contact Number</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="contact_number" value="<?php echo $contact_number; ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Card Number</label>
                <div class="col-sm-6">
                    <input type="number" class="form-control" name="card_number" value="<?php echo $card_number; ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Date</label>
                <div class="col-sm-6">
                    <input type="date" class="form-control" name="expdate" value="<?php echo $expdate; ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Security Code</label>
                <div class="col-sm-6">
                    <input type="number" class="form-control" name="securitycode" value="<?php echo $securitycode; ?>">
                </div>
            </div>
    

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Billing First Name</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="billing_fname" value="<?php echo $billing_fname; ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Billing Last Name</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="billing_lname" value="<?php echo $billing_lname; ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Billing Address</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="billing_address" value="<?php echo $billing_address; ?>">
                </div>
            </div>
            

            <?php
            if(!empty($successMessage)){
                echo "
                <div class='row mb-3'>
                    <div class='alert alert-success alert-dismissible fade show' role='alert'>
                        <strong>$successMessage</strong>
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>
                </div>
                ";
            }
            ?>

            <div class="row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                <div class="col-sm-3 d-grid">
                    <a href="../landingPage/index.php" class="btn btn-outline-primary" role="button">Cancel</a>
                </div>
            </div>


        </form>
    </div>
    <script>
document.addEventListener("DOMContentLoaded", function() {
    const othersRadio = document.getElementById('payment_currency_others');
    const customAmountInput = document.getElementById('custom_amount');

    // Add event listener to the "Others" radio button
    othersRadio.addEventListener('change', function() {
        // If "Others" radio is selected, enable the custom amount input
        if (this.checked) {
            customAmountInput.disabled = false;
            customAmountInput.focus(); // Optional: Automatically focus on the custom amount input
        } else {
            // If another option is selected, disable the custom amount input
            customAmountInput.disabled = true;
            customAmountInput.value = ''; // Clear the input value
        }
    });
});
</script>
</body>
</html>