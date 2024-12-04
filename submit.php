<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

// Database connection

$host = "localhost";
$username = "root";  // Default MySQL username for local server
$password = "";      // Default MySQL password (leave empty if not set)
$database = "registration_db";  // Make sure this database exists

// Create connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data and sanitize
    $first_name = htmlspecialchars($_POST['first_name']);
    $last_name = htmlspecialchars($_POST['last_name']);
    $email = htmlspecialchars($_POST['email']);
    $phone = htmlspecialchars($_POST['phone']);
    $dob = htmlspecialchars($_POST['dob']);
    $gender = htmlspecialchars($_POST['gender']);

    // Check if any field is empty
    if (empty($first_name) || empty($last_name) || empty($email) || empty($phone) || empty($dob) || empty($gender)) {
        echo "All fields are required!";
        exit();
    }

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO users (first_name, last_name, email, phone, dob, gender) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $first_name, $last_name, $email, $phone, $dob, $gender);

    // Execute query and check success
    if ($stmt->execute()) {
        echo "Registration Successful!";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close statement
    $stmt->close();
}

// Close connection
$conn->close();
?>
