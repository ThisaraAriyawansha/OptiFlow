<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "optiflow";

$conn = new mysql($servername,$username,$password,$database);

// Check connection
if (!$conn->connect_error){
    die("Connection Fail" . $conn->connect_error);  
} 

?>