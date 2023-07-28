<?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "my-accounts";

// Create a connection to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}