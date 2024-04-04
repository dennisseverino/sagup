<?php
session_start();
include("../connection/connection.php");
include("../connection/function.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
 
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $age = $_POST['age'];
    $date_of_birth = $_POST['date_of_birth'];
    $block_number = $_POST['block_number'];
    $street = $_POST['street'];
    $country = $_POST['country'];
    $barangay = $_POST['barangay'];
    $city = $_POST['city'];
    $zip_code = $_POST['zip_code'];
    $contact_number = $_POST['contact_number'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role_name = $_POST['role_name']; // Retrieve the selected role name
    $role_description = $_POST['role_description']; // Retrieve the selected role description

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    if (!empty($firstname) && !empty($lastname) && !empty($date_of_birth) && !empty($age) && !empty($block_number) && !empty($street)
        && !empty($barangay) && !empty($city) && !empty($country) && !empty($zip_code) && !empty($email)
        && !empty($username) && !empty($password) 
    ) {
      
        // Check if the role name exists in the role_tb table
        $check_role_query = "SELECT * FROM role_tb WHERE role_name = '$role_name'";
        $role_result = mysqli_query($conn, $check_role_query);

        if (mysqli_num_rows($role_result) == 0) {
            // If the role name doesn't exist, insert it into the role_tb table along with the description
            $insert_role_query = "INSERT INTO role_tb (role_name, role_description) VALUES ('$role_name', '$role_description')";
            mysqli_query($conn, $insert_role_query);
        }

        // Retrieve the role_id corresponding to the selected role name
        $role_query = "SELECT role_id FROM role_tb WHERE role_name = '$role_name'";
        $role_result = mysqli_query($conn, $role_query);
        $role_row = mysqli_fetch_assoc($role_result);
        $role_id = $role_row['role_id'];

        // Insert user data into the user_tb table
        $user_id = random_num(20);
        $query = "INSERT INTO user_tb (user_id, firstname, lastname, age, date_of_birth, block_number, street, barangay, city, country, zip_code, contact_number, email, username, password, role_id) 
                  VALUES ('$user_id','$firstname','$lastname','$age','$date_of_birth','$block_number','$street','$barangay','$city','$country','$zip_code','$contact_number','$email','$username','$hashedPassword', '$role_id')";

        mysqli_query($conn, $query);

        header("Location: login.php");
        die;
    } else {
        echo "Please enter some valid information!";
    }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
     <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
   
    <link rel="stylesheet" href="css/signup.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" >
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="js/index.js"></script>
</head>

<body>
    <div class="parentWrapper">
        <div class="table-responsive">
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td>
                            <div class="rightWrapper">
                                <div class="loginForm">
                                    <form method="POST" enctype="multipart/form-data">
                                        <h1>Register an Account:</h1>

                                        <div class="mb-3">
                                            <label for="firstname" class="form-label">First name</label>
                                            <input id="firstname" type="text" name="firstname" class="form-control" placeholder="Enter your First Name" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="lastname" class="form-label">Last Name</label>
                                            <input id="lastname" type="text" name="lastname" class="form-control" placeholder="Enter your Last Name" required>
                                        </div>

                                        <div class="mb-3">
                                            <label for="age" class="form-label">Age</label>
                                            <input id="age" type="text" name="age" class="form-control" placeholder="Enter your Age" required>
                                        </div>

                                        <div class="mb-3">
                                            <label for="date_of_birth" class="form-label">Date of birth</label>
                                            <input id="date_of_birth" type="date" name="date_of_birth" class="form-control" placeholder="Enter your date_of_birth" required>
                                        </div>

                                        <div class="mb-3">
                                            <label for="block_number" class="form-label">Blk_#</label>
                                            <input id="block_number" type="text" name="block_number" class="form-control" placeholder="Block Number" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="street" class="form-label">Street</label>
                                            <input id="street" type="text" name="street" class="form-control" placeholder="Street" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="barangay" class="form-label">Barangay</label>
                                            <input id="barangay" type="text" name="barangay" class="form-control" placeholder="Barangay" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="city" class="form-label">City</label>
                                            <input id="city" type="text" name="city" class="form-control" placeholder="City" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="country" class="form-label">Country</label>
                                            <input id="country" type="text" name="country" class="form-control" placeholder="Country" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="zip_code" class="form-label">ZipCode</label>
                                            <input id="zip_code" type="text" name="zip_code" class="form-control" placeholder="Zip Code" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="contact_number" class="form-label">Contact Number</label>
                                            <input id="contact_number" type="text" name="contact_number" class="form-control" placeholder="Enter your Contact Number" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email Address</label>
                                            <input id="email" type="text" name="email" class="form-control" placeholder="Enter your Email Address" required>
                                        </div>

                                        <div class="mb-3">
                                            <label for="username" class="form-label">Username</label>
                                            <input id="username" type="text" name="username" class="form-control" placeholder="Enter your Username" required>
                                        </div>
                                        
                                        <div class="mb-3">
                                            <label for="password" class="form-label">Password</label>
                                            <input id="password" type="password" name="password" class="form-control" placeholder="Enter your password" required>
                                        </div>

                                        <div class="mb-3">
                                            <label for="role_name" class="form-label">Role</label>
                                            <select name="role_name" id="role_name" class="form_control" onchange="updateRoleDescription()" required>
                                                <option value="Member" selected>Member</option>
                                                <option value="Secretary">Secretary</option>
                                                <option value="Admin">Admin</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="role_description" class="form-label">Role Description</label>
                                            <input id="role_description" type="text" name="role_description" class="form-control" placeholder="Role Description" readonly required>
                                        </div>

                                        
                                                    
                                        <input type="submit" name="register" class="btn btn-primary" value="Register">
                                    </form>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>