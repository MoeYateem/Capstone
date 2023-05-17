<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");

// Database connection parameters
$host = 'localhost';
$db = 'ap1';
$user = 'root';
$password = '';

try {
    // Establish a database connection
    $conn = new PDO("mysql:host=$host;dbname=$db", $user, $password);
    
    // Retrieve the email, postal_code, and address from the POST request
    $email = $_POST['email'];
    $postal_code = $_POST['postal_code'];
    $address = $_POST['address'];
    
    // Prepare the SQL query
    $sql = "INSERT INTO addresses (email, postal_code, address) VALUES (:email, :postal_code, :address)";
    
    // Prepare the statement
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':postal_code', $postal_code);
    $stmt->bindParam(':address', $address);
    
    // Execute the statement
    $stmt->execute();
    
    // Close the database connection
    $conn = null;
    
    // Send a success message as JSON response
    echo json_encode(['message' => 'Address added successfully']);
} catch (PDOException $e) {
    // Handle database connection errors
    echo 'Error: ' . $e->getMessage();
}
