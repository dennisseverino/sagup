<?php
   include_once("../connection/connection.php");
   include_once("../connection/function.php"); 

    $id = "";
    $firstname = "";
    $lastname = "";
    $age = "";
    $block_number = "";
    $street = "";
    $barangay = "";
    $city = "";
    $country = "";
    $zipcode = "";
    $contact_number = "";
    $email = "";
    $programs = "";

    $errorMessage = "";
    $successMessage = "";

    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        // GET method: Show the data of the client
        if (!isset($_GET["id"]) || !is_numeric($_GET["id"])) {
            header("location: index.php");
            exit;
        }
    
        $id = $_GET["id"];
    
        // Prepare and bind the SQL statement
        $sql = "SELECT * FROM volunteers WHERE id=?";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows === 0) {
            header("location: index.php");
            exit;
        }
    
        $row = $result->fetch_assoc();
    
        $firstname = $row["firstname"];
        $lastname = $row["lastname"];
        $age = $row["age"];
        $block_number = $row['block_number'];
        $street = $row['street'];
        $barangay = $row['barangay'];
        $city = $row['city'];
        $country = $row['country'];
        $zipcode = $row['zipcode'];
        $contact_number = $row["contact_number"];
        $email = $row["email"];
        $programs = $row["programs"];
    } else {
        // POST method: Update the data of the client
        $id = $_POST["id"];
        $firstname = $_POST["firstname"];
        $lastname = $_POST["lastname"];
        $age = $_POST["age"];
        $block_number = $_POST['block_number'];
        $street = $_POST['street'];
        $barangay = $_POST['barangay'];
        $city = $_POST['city'];
        $country = $_POST['country'];
        $zipcode = $_POST['zipcode'];
        $contact_number = $_POST["contact_number"];
        $email = $_POST["email"];
        $programs = $_POST["programs"];

        do {
            if (empty($id) || empty($firstname) || empty($lastname) ||empty($age) || empty($contact_number) || empty($block_number) 
            || empty($street) || empty($barangay) || empty($city) || empty($country) || empty($zipcode) || empty($email) || empty($programs) ) {
            $errorMessage = "All the fields are required";
                break;
            }

            $sql = "UPDATE volunteers SET firstname = ?, lastname = ?, age = ?, street = ?, barangay = ?, city = ?, country = ?, zipcode = ?, contact_number = ?, email = ?, programs = ? WHERE id = ?";
            $stmt = $connection->prepare($sql);
            $stmt->bind_param("ssissssssssi", $firstname, $lastname, $age, $street, $barangay, $city, $country, $zipcode, $contact_number, $email, $programs, $id);
            
            // Execute the prepared statement
            $result = $stmt->execute();
            
            if (!$result) {
                $errorMessage = "Invalid query: " . $connection->error;
                break;
            }

            $successMessage = "Client updated correctly";

            header("location: index.php");
            exit;
        } while (true);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Shop</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="css/index.css">
</head>
<body>
<div class="container my-5">
    <h2>Update Volunteer</h2>

    <?php
    if (!empty($errorMessage)) {
        echo "
                <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                    <strong>$errorMessage</strong>
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>
                ";
    }
    ?>

    <form method="POST">
    <input type="hidden" name="id" value="<?php echo $id; ?>" >
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">First name</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="firstname" value="<?php echo $firstname; ?> " required>
            </div>
        </div>

        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Last Name</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="lastname" value="<?php echo $lastname; ?>" required>
            </div>
        </div>

        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Age</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="age" value="<?php echo $age; ?>" required>
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
            <label class="col-sm-3 col-form-label">Email</label>
            <div class="col-sm-6">
                <input type="email" class="form-control" name="email" value="<?php echo $email; ?>" required>
            </div>
        </div>

        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Contact Number</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="contact_number" value="<?php echo $contact_number; ?>" required>
            </div>
        </div>

        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Programs</label>
            <div class="col-sm-6">
                <input type="radio" id="herozero" name="programs" value="herozero" <?php if ($programs === 'herozero') echo 'checked'; ?>>
                <label for="herozero">Hero Zero</label><br>
                
                <input type="radio" id="foorpantry" name="programs" value="foorpantry" <?php if ($programs === 'foorpantry') echo 'checked'; ?>>
                <label for="foorpantry">Food Pantry</label><br>
                
                <input type="radio" id="foodmitigation" name="programs" value="foodmitigation" <?php if ($programs === 'foodmitigation') echo 'checked'; ?>>
                <label for="foodmitigation">Food Waste Mitigation</label><br>
            </div>
        </div>

        <?php
        if (!empty($successMessage)) {
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
                <a href="../admin/index.php" class="btn btn-outline-primary" role="button">Cancel</a>
            </div>
        </div>
    </form>
</div>
</body>
</html>
