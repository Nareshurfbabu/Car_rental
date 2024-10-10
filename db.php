<?php
$servername = "localhost";  // Aapka database server
$username = "root";         // Aapka MySQL username
$password = "";             // Aapka MySQL password (agar koi hai to)
$dbname = "car_rental";     // Database ka naam

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

echo "Connected successfully"; // Isko test karne ke liye rakhen, jab connection sahi ho jaye to hata sakte hain
?>
