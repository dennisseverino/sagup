<?php
session_start();
include("../connection/connection.php");
include("../connection/function.php");



if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // Something was posted
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (!empty($username) && !empty($password) && !is_numeric($username)) {
        // Read from database
        $query = "SELECT * FROM user_tb WHERE username = ? LIMIT 1";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows > 0) {
            $user_data = $result->fetch_assoc();
            if (password_verify($password, $user_data['password'])) {
                // Password matches
                $_SESSION['user_id'] = $user_data['user_id'];
                header("Location: ../admin/index.php");
                exit;
            }
        }
        echo "Wrong username or password!";
    } else {
        echo "Wrong username or password!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/loginn.css">
</head>
<body>
<div class="container">
    <div id="box">
        <form method="POST" action="">
            <div class="welcome">SAGUP NEGROS</div>
            <div class="title">LOGIN</div>
            <input id="text" type="text" name="username" placeholder="Enter Username"><br><br>
            <input id="text" type="password" name="password" placeholder="Enter Password"><br><br>
            <input id="button" type="submit" name="Login">
            <br> <br> <br>
            <a href="signup.php" class="signup">Signup an account</a>
        </form>
    </div>
</div>
</body>
</html>
