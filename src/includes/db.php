<?php
// This file handles the connection to the MySQL database.

$host = 'localhost';  
$username = 'root';   
$password = '';       
$dbname = 'pizzahaven'; 

// Create connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
