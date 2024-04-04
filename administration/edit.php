<?php
include_once("../connection/connection.php");
include_once("../connection/function.php");

$user_id = $_GET["user_id"];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve all form data including the updated role_name
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $age = $_POST['age'];
    $date_of_birth = $_POST['date_of_birth'];
    $block_number = $_POST['block_number'];
    $street = $_POST['street'];
    $barangay = $_POST['barangay'];
    $city = $_POST['city'];
    $country = $_POST['country'];
    $zipcode = $_POST['zipcode'];
    $contact_number = $_POST['contact_number'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role_name = $_POST['role_name']; // Changed from 'role_name' to 'roles'
    $role_description = $_POST['role_description']; // You can adjust this if needed

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Prepare the update statement
    $sql = "UPDATE user_tb SET firstname=?, lastname=?, age=?, date_of_birth=?, block_number=?, street=?, barangay=?, 
            city=?, country=?, zip_code=?, contact_number=?, email=?, username=?, password=?, role_id=? WHERE user_id=?";

    // Prepare statement
    $stmt = $connection->prepare($sql);
    if (!$stmt) {
        $errorMessage = "Error in preparing statement: " . $connection->error;
    } else {
        // Retrieve the role_id corresponding to the selected role name
        $role_query = "SELECT role_id FROM role_tb WHERE role_name = ?";
        $role_stmt = $connection->prepare($role_query);
        $role_stmt->bind_param("s", $role_name);
        $role_stmt->execute();
        $role_result = $role_stmt->get_result();

        if ($role_result->num_rows > 0) {
            $role_row = $role_result->fetch_assoc();
            $role_id = $role_row['role_id'];

            // Bind parameters
            $stmt->bind_param("ssisssssssssssii", $firstname, $lastname, $age, $date_of_birth, $block_number, $street, $barangay, 
                $city, $country, $zipcode, $contact_number, $email, $username, $hashedPassword, $role_id, $user_id);

            // Execute statement
            if ($stmt->execute()) {
                $successMessage = "Client updated successfully";
            } else {
                $errorMessage = "Error in executing statement: " . $stmt->error;
            }
        } else {
            $errorMessage = "Role not found";
        }

        // Close statement
        $stmt->close();
        $role_stmt->close();
    }
}

// Fetch user details for pre-filling the form
$sql = "SELECT * FROM user_tb WHERE user_id=?";
$stmt = $connection->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $firstname = $row['firstname'];
    $lastname = $row['lastname'];
    $age = $row['age'];
    $date_of_birth = $row['date_of_birth'];
    $block_number = $row['block_number'];
    $street = $row['street'];
    $barangay = $row['barangay'];
    $city = $row['city'];
    $country = $row['country'];
    $zipcode = $row['zip_code'];
    $contact_number = $row['contact_number'];
    $email = $row['email'];
    $username = $row['username'];
    // Password should not be prefilled for security reasons
} else {
    $errorMessage = "User not found";
}
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Account</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="css/edit.css">
    <script src="js/index.php"></script>
</head>
<body>
    <div class="container my-5">
        <h2>Update Account</h2>

        <?php if (!empty($errorMessage)) : ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong><?php echo $errorMessage; ?></strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <?php if (!empty($successMessage)) : ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong><?php echo $successMessage; ?></strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <form method="POST">
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">First Name</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="firstname" value="<?php echo $firstname; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Last Name</label>
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
                <label class="col-sm-3 col-form-label">Date of Birth</label>
                <div class="col-sm-6">
                    <input type="date" class="form-control" name="date_of_birth" value="<?php echo $date_of_birth; ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Block Number</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="block_number" value="<?php echo $block_number; ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Street</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="street" value="<?php echo $street; ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Barangay</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="barangay" value="<?php echo $barangay; ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">City</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="city" value="<?php echo $city; ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Country</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="country" value="<?php echo $country; ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Zip Code</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="zipcode" value="<?php echo $zipcode; ?>">
                </div>
            </div>


            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Contact Number</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="contact_number" value="<?php echo $contact_number; ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Email</label>
                <div class="col-sm-6">
                    <input type="email" class="form-control" name="email" value="<?php echo $email; ?>">
                </div>
            </div>

            

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Username</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="username" value="<?php echo $username; ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Password</label>
                <div class="col-sm-6">
                    <input type="password" class="form-control" name="password" value="<?php echo $password; ?>">
                </div>
            </div>

            <div class="mb-3">
                <label for="role_name" class="form-label">Role</label>
                <select name="role_name" id="role_name" class="form_control" required>
                    <option value="Member" <?php if($role_name == 'Member') echo 'selected'; ?>>Member</option>
                    <option value="Secretary" <?php if($role_name == 'Secretary') echo 'selected'; ?>>Secretary</option>
                    <option value="Admin" <?php if($role_name == 'Admin') echo 'selected'; ?>>Admin</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="role_description" class="form-label">Role Description</label>
                <input id="role_description" type="text" name="role_description" class="form-control" placeholder="Role Description" value="<?php echo isset($role_description) ? $role_description : ''; ?>" readonly required>
            </div>

            <?php if (!empty($successMessage)) : ?>
                <div class="row mb-3">
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong><?php echo $successMessage; ?></strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            <?php endif; ?>

            <div class="row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                <div class="col-sm-3 d-grid">
                    <a href="../administration/index.php" class="btn btn-outline-primary" role="button">Cancel</a>
                </div>
            </div>
        </form>
    </div>
    <script>
        function updateRoleDescription() {
    var roleSelect = document.getElementById("role_name");
    var roleDescriptionInput = document.getElementById("role_description");

    // Get the selected value of the role_name dropdown
    var selectedRole = roleSelect.value;

    // Update the role_description field based on the selected role
    if (selectedRole === "Member") {
        roleDescriptionInput.value = "Main Workforce of the organization";
    } else if (selectedRole === "Secretary") {
        roleDescriptionInput.value = "Responsible for administrative tasks";
    } else if (selectedRole === "Admin") {
        roleDescriptionInput.value = "Oversees the website";
    }
}

    </script>
</body>
</html>
