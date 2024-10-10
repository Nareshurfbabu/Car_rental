<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "car_rental";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form data is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Fetch form data from $_POST array and trim whitespace
    $car_type = isset($_POST['car_type']) ? trim($_POST['car_type']) : '';
    $pickup_location = isset($_POST['pickup_location']) ? trim($_POST['pickup_location']) : '';
    $dropoff_location = isset($_POST['dropoff_location']) ? trim($_POST['dropoff_location']) : '';
    $pickup_date = isset($_POST['pickup_date']) ? trim($_POST['pickup_date']) : '';
    $pickup_time = isset($_POST['pickup_time']) ? trim($_POST['pickup_time']) : '';
    $dropoff_date = isset($_POST['dropoff_date']) ? trim($_POST['dropoff_date']) : '';
    $dropoff_time = isset($_POST['dropoff_time']) ? trim($_POST['dropoff_time']) : '';

    // Validate all required fields
    if (empty($car_type) || empty($pickup_location) || empty($dropoff_location) || 
        empty($pickup_date) || empty($pickup_time) || empty($dropoff_date) || empty($dropoff_time)) {
        die("All fields are required!");
    }

    // Prepare an SQL statement for execution
    $stmt = $conn->prepare("INSERT INTO reservations (car_type, pickup_location, dropoff_location, pickup_date, pickup_time, dropoff_date, dropoff_time) VALUES (?, ?, ?, ?, ?, ?, ?)");
    
    // Check if the statement was prepared successfully
    if ($stmt === false) {
        die("Error preparing statement: " . $conn->error);
    }

    // Bind parameters to the SQL query
    $stmt->bind_param("sssssss", $car_type, $pickup_location, $dropoff_location, $pickup_date, $pickup_time, $dropoff_date, $dropoff_time);

    // Execute the prepared statement
    if ($stmt->execute()) {
        // Redirect to another page after successful reservation
        header("Location: success.php");
        exit;  // Always exit after a redirect to stop further script execution
    } else {
        header("Location: 404.html");
    }

    // Close the statement and connection
    $stmt->close();
}
$conn->close();
?>
