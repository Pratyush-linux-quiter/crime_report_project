<?php
$servername = "localhost";
$username = "root"; // Default XAMPP username
$password = ""; // Default password is empty
$database = "crime report"; // Ensure this matches your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>