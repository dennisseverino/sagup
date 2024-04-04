<?php

$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "sagup";

if(!$conn = mysqli_connect($db_host,$db_user,$db_pass,$db_name))
{
    die("failed to connect");
}

$connection = new mysqli($db_host, $db_user, $db_pass, $db_name);