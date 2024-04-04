<?php
error_reporting(0);
session_start();

if(isset($_GET["user_id"])){
    $user_id = $_GET["user_id"];

    include_once("../connection/connection.php");
    

    $sql = "DELETE FROM user_tb WHERE user_id = $user_id";
    $result = mysqli_query($connection, $sql); 

    if($result){
        $_SESSION['message']='NA DELETE NA ANG ACCOUNT';
        header("location: ../administration/index.php");
        exit; // Move this inside the if block
    }
}
?>

