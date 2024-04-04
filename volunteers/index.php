<?php
session_start(); 
include_once("../connection/connection.php");
include_once("../connection/function.php"); 
$user_data = check_login($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donations</title>
 <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" >
    <link rel="stylesheet" href="css/index.css">



</head>
<body>
    <div i class="container my-5">
        <h2>Programs</h2>
        <?php
            if(isset($_SESSION['message'])){
                echo '<div class="message">' . $_SESSION['message'] . '</div>';
            }

            unset($_SESSION['message']);
        ?>
        <br>

        <table class="table">
            <thead>
                <tr>
                    <th>Program ID</th>
                    <th>UserID</th>
                    <th>Firstname</th>
                    <th>Lastname</th>
                    <th>Program Name</th>
                    <th>Program Description</th>
                    <?php if($user_data['role_name'] === 'Admin' || ($user_data['role_name'] === 'Secretary')) 
                    echo '<th>Actions</th>'
                    ?>                             
                </tr>
            </thead>
            <tbody>          
            <?php
// Check if user is an admin
if ($user_data['role_name'] === 'Admin' || ($user_data['role_name'] === 'Secretary')) {
    // Fetch all transactions
    $sql = "SELECT * FROM program_tb INNER JOIN user_tb ON user_tb.user_id = program_tb.user_id";
} else {
    // Fetch only the user's transactions
    $sql = "SELECT * FROM program_tb INNER JOIN user_tb ON user_tb.user_id = program_tb.user_id WHERE program_tb.user_id = {$user_data['user_id']}";
}

$result = $connection->query($sql);

if(!$result){
    die("Invalid query: " . $connection->error);
}

while($row = $result->fetch_assoc()){
    echo "
    <tr>
        <th>{$row['program_id']}</th>
        <th>{$row['user_id']}</th>
        <th>{$row['firstname']}</th>
        <th>{$row['lastname']}</th>
        <th>{$row['program_name']}</th>
        <th>{$row['program_description']}</th>
        <td>";
        
    // Check if user is an admin or secretary
    if ($user_data['role_name'] === 'Admin' || $user_data['role_name'] === 'Secretary') {
        // Render edit and delete buttons
        echo "
            <a class='btn btn-primary btn-sm' href='edit.php?program_id={$row['program_id']}'>Edit</a>
            <a onClick=\"javascript:return confirm('SURE KA HA?');\" class='btn btn-danger btn-sm' href='../volunteers/delete.php?program_id={$row['program_id']}'>Delete</a>";
    }
    
    echo "
        </td>
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







