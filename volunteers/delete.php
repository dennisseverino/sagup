<?php

error_reporting(0);
session_start();

if(isset($_GET["program_id"])){
    $program_id = $_GET["program_id"];

    include_once("../connection/connection.php");
      
   

    $sql = "DELETE FROM program_tb WHERE program_id = $program_id";
    $result = mysqli_query($connection, $sql); 

    if($result){
        $_SESSION['message']='OKAY NA DELETE NA';
        header("location: ../volunteers/index.php");
        exit; 
    }
}
?>