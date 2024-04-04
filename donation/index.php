<?php
session_start();
include_once("../connection/connection.php");
include_once("../connection/function.php"); 

// Get user data from session
$user_data = check_login($conn);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donations</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" >
    <link rel="stylesheet" href="css/test.css">
</head>
<body>
    <div class="container my-5">
        <h2>Donations of <?php echo $user_data['username']; ?></h2>
        <br>

        <table class="table">
            <thead>
                <tr>
                    <th>Donation ID</th>
                    <th>User ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Payment Amount</th>
                    <th>Payment Date</th>
                    <th>Card Number</th>
                    <th>Expiration Date</th>                     
                    <th>Security Code</th>
                    <th>Billing First Name</th>
                    <th>Billing Last Name</th>
                    <th>Billing Address</th>
                </tr>
            </thead>
            <tbody>
            <?php
            // Check if user is an admin
            if ($user_data['role_name'] === 'Admin' || ($user_data['role_name'] === 'Secretary')) {
                // Fetch all transactions
                $sql = "SELECT * FROM donation_tb INNER JOIN user_tb ON user_tb.user_id = donation_tb.user_id";
            } else {
                // Fetch only the user's transactions
                $sql = "SELECT * FROM donation_tb INNER JOIN user_tb ON user_tb.user_id = donation_tb.user_id WHERE donation_tb.user_id = {$user_data['user_id']}";
            }

            $result = $connection->query($sql);

            if(!$result){
                die("Invalid query: " . $connection->error);
            }



            while($row = $result->fetch_assoc()){
                echo "
                <tr>
                    <th>$row[donation_id]</th>
                    <th>$row[user_id]</th>
                    <th>$row[firstname]</th>
                    <th>$row[lastname]</th>
                    <th>$row[payment_amount]</th>
                    <th>$row[payment_date]</th>           
                    <th>$row[card_number]</th>
                    <th>$row[expiration_date]</th>
                    <th>$row[security_code]</th>
                    <th>$row[billing_firstname]</th>
                    <th>$row[billing_lastname]</th>
                    <th>$row[billing_address]</th>
                </tr>";
            }
            ?>
        </tbody>
        </table>
        <br>
        <a class="btn btn-primary" href="../admin/index.php" role="button">Back</a>
    </div>
</body>
</html>
