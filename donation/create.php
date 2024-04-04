<?php
session_start();
include_once("../connection/connection.php");
include_once("../connection/function.php"); 
$user_data = check_login($conn);

$errorMessage = "";
$successMessage = "";

// Initialize variables
$billing_firstname = "";
$billing_lastname = "";
$billing_address = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $payment_amount = $_POST["payment_amount"];
    $payment_date = $_POST["payment_date"];
    $card_number = $_POST["card_number"];
    $expiration_date = $_POST["expiration_date"];
    $security_code = $_POST["security_code"];
    $billing_firstname = $_POST["billing_firstname"];
    $billing_lastname = $_POST["billing_lastname"];
    $billing_address = $_POST["billing_address"];

    do {
        if (empty($payment_amount) || empty($payment_date) || empty($card_number) || empty($expiration_date) || empty($security_code)
            || empty($billing_firstname) || empty($billing_lastname) || empty($billing_address)) {
            $errorMessage = "All fields are required";
            break;
        }

        // Use prepared statement to prevent SQL injection
        $sql = "INSERT INTO donation_tb (user_id, payment_amount, payment_date, card_number, expiration_date, security_code, billing_firstname, billing_lastname, billing_address) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("sssssssss", $user_data['user_id'], $payment_amount, $payment_date, $card_number, $expiration_date, $security_code,
            $billing_firstname, $billing_lastname, $billing_address);
        $stmt->execute();

        if ($stmt->affected_rows === -1) {
            $errorMessage = "Error inserting record: " . $stmt->error;
            break;
        }

        $successMessage = "Donation added successfully";

        header("location: ../landingPage/index.php");
        exit;

    } while (false);
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
                <label class="col-sm-3 col-form-label">Select Payment</label>
                <div class="col-sm-6">
                    <input type="radio" id="payment_amount_2500" name="payment_amount" value="2500">
                    <label for="payment_amount_2500">2,500</label>
                    <input type="radio" id="payment_amount_5000" name="payment_amount" value="5000">
                    <label for="payment_amount_5000">5,000</label>
                    <input type="radio" id="payment_amount_10000" name="payment_amount" value="10000">
                    <label for="payment_amount_10000">10,000</label>
                    <input type="radio" id="payment_amount_others" name="payment_amount" value="others">
                    <label for="payment_amount_others">Others</label>
                    <input type="text" id="custom_amount" name="custom_payment_amount" placeholder="Enter amount" disabled>
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Payment Date</label>
                <div class="col-sm-6">
                    <input type="date" class="form-control" name="payment_date" value="<?php echo $payment_date; ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Card Number</label>
                <div class="col-sm-6">
                    <input type="number" class="form-control" name="card_number" value="<?php echo $card_number; ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Expiration Date</label>
                <div class="col-sm-6">
                    <input type="date" class="form-control" name="expiration_date" value="<?php echo $expiration_date; ?>">
                </div>
            </div>


            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Security Code</label>
                <div class="col-sm-6">
                    <input type="number" class="form-control" name="security_code" value="<?php echo $security_code; ?>">
                </div>
            </div>
    

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Billing First Name</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="billing_firstname" value="<?php echo $billing_firstname; ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Billing Last Name</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="billing_lastname" value="<?php echo $billing_lastname; ?>">
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
    const othersRadio = document.getElementById('payment_date_others');
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