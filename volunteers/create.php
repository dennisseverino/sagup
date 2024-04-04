<?php
session_start();
include_once("../connection/connection.php");
include_once("../connection/function.php"); 

$user_data = check_login($conn);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve program name from the form
    $program_name = $_POST['program_name'];
    $program_description = $_POST['program_description'];
    
    // Check if the program name is empty
    if (empty($program_name) || empty($program_description)) {
        $errorMessage = "Program name and description are required";
    }
    else {
        // Retrieve user_id from the session (assuming you store it in the session upon user login)
        $user_id = $_SESSION['user_id'];
        
        // Insert program into the program_tb table along with the user_id
        $insert_program_query = "INSERT INTO program_tb (user_id, program_name, program_description) 
                                 VALUES ('$user_id', '$program_name', '$program_description')";
        
        // Execute the query
        if (mysqli_query($conn, $insert_program_query)) {
            $successMessage = "Program added successfully";
        } else {
            $errorMessage = "Error adding program: " . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Volunteer</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="css/index.css">
    <script>
        function updateProgramDescription() {
            var programSelect = document.getElementById("program_name");
            var programDescriptionInput = document.getElementById("program_description");

            // Get the selected value of the program_name dropdown
            var selectedProgram = programSelect.value;

            // Update the program_description field based on the selected program
            switch (selectedProgram) {
                case "herozero":
                    programDescriptionInput.value = "Helps Vendors";
                    break;
                case "foodwastemitigation":
                    programDescriptionInput.value = "Helps clean the environment.";
                    break;
                case "foodpantry":
                    programDescriptionInput.value = "Help provide food for those in need.";
                    break;
                default:
                    programDescriptionInput.value = "";
                    break;
            }
        }
    </script>
</head>
<body>
    <div class="container my-5">
        <h2>Create Volunteer</h2>

        <?php if (!empty($errorMessage)): ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong><?php echo $errorMessage; ?></strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <?php if (!empty($successMessage)): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong><?php echo $successMessage; ?></strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <form method="POST">
            <div class="row mb-3">
                <label for="program_name" class="form-label">Programs</label>
                <div class="col-sm-6">
                    <select name="program_name" id="program_name" class="form-control" onchange="updateProgramDescription()" required>
                        <option value="herozero">HeroZero</option>
                        <option value="foodwastemitigation">Food Waste Mitigation</option>
                        <option value="foodpantry">Food Pantry</option>
                    </select>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-sm-6">
                    <label for="program_description" class="form-label">Program Description</label>
                    <input id="program_description" type="text" name="program_description" class="form-control" placeholder="Role Description" readonly required>
                </div>
            </div>

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
</body>
</html>
