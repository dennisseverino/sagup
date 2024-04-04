<?php
session_start(); 
include_once("../connection/connection.php");
include_once("../connection/function.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Shop</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" >
    <link rel="stylesheet" href="css/index.css">

</head>
<body>
    <div i class="container my-5">
        <h2>User</h2>
        
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
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Age</th>
                    <th>Date of Birth</th>
                    <th>Block Number</th>
                    <th>Street</th>
                    <th>Barangay</th>
                    <th>City</th>
                    <th>Country</th>
                    <th>Zip Code</th>
                    <th>Contact Number</th>
                    <th>Email</th>
                    <th>Roles</th>
                    <th>role_description</th>
                    <th>Username</th>
                    <th>Password</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>

            <?php
            // You don't need to redefine connection here as it's already defined in connection.php

            $sql = "SELECT * FROM user_tb INNER JOIN role_tb ON user_tb.role_id = role_tb.role_id ";

            $result = mysqli_query($conn, $sql); // Use the connection from connection.php

            if(!$result){
                die("Invalid query: " . mysqli_error($conn));
            }

            while($row = mysqli_fetch_assoc($result)){
                echo "
                <tr>
                    <th>$row[user_id]</th>
                    <th>$row[firstname]</th>
                    <th>$row[lastname]</th>
                    <th>$row[age]</th>
                    <th>$row[date_of_birth]</th>
                    <th>$row[block_number]</th>
                    <th>$row[street]</th>
                    <th>$row[barangay]</th>
                    <th>$row[city]</th>
                    <th>$row[country]</th>
                    <th>$row[zip_code]</th>
                    <th>$row[contact_number] </th>
                    <th>$row[email] </th>
                    <th>$row[role_name] </th>
                    <th>$row[role_description] </th>
                    <th>$row[username] </th>
                    <th>$row[password] </th>
                    <td>
                        <a class='btn btn-primary btn-sm'href='edit.php?user_id=$row[user_id]'>Edit</a>
                        <a onClick=\"javascript:return confirm('100% SURE?');\"class='btn btn-danger btn-sm'href='../administration/delete.php?user_id=$row[user_id]'>Delete</a>
                    </td>
                </tr>
                ";
            }
            ?>
                
        </tbody>
        </table>
        <a class="btn btn-primary" href="../admin/index.php">Back</a>
    </div>
</body>
</html>