<?php

if(isset($_GET["id"])){
    $id = $_GET["id"];

    include_once("../connection/connection.php");
       
    

    $sql = "DELETE FROM volunteers WHERE id = $id";
    $connection->query($sql);
}

header("location: ../donation/index.php");
exit;