<?php
include 'DB.php';

// Set new passwords
$adminUsername = "admin";
$adminPassword = "123asd";

$urwaUsername = "UrwaManzoor";
$urwaPassword = "asd123"; 

// Hash passwords
$hashedAdmin = password_hash($adminPassword, PASSWORD_DEFAULT);
$hashedUrwa = password_hash($urwaPassword, PASSWORD_DEFAULT);

// Update admin password
$stmt1 = $conn->prepare("UPDATE users SET password = ? WHERE username = ?");
$stmt1->bind_param("ss", $hashedAdmin, $adminUsername);
$stmt1->execute();
echo "✅ Admin password updated.<br>";
$stmt1->close();

// Update UrwaManzoor password
$stmt2 = $conn->prepare("UPDATE users SET password = ? WHERE username = ?");
$stmt2->bind_param("ss", $hashedUrwa, $urwaUsername);
$stmt2->execute();
echo "✅ UrwaManzoor password updated.<br>";
$stmt2->close();

$conn->close();
?>
