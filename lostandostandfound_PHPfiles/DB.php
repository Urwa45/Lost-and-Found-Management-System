<?php
$host = "localhost";
$user = "root";         // Default MySQL username in XAMPP
$password = "";         // Leave empty, no password for root in XAMPP
$dbname = "lost_and_found";  // Your database name

$conn = new mysqli($host, $user, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Optional: show message on success
// echo "Connected successfully";
?>
