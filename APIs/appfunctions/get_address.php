<?php

// Database connection parameters
$host = 'localhost';
$db = 'ap1';
$user = 'root';
$password = '';

try {
    // Establish a database connection
    $conn = new PDO("mysql:host=$host;dbname=$db", $user, $password);
    
    // Retrieve the email from the request
    $email = $_GET['email']; // Assuming the email is provided as a query parameter
    
    // Prepare the SQL query
    $sql = "SELECT postal_code, address FROM addresses WHERE email = :email";
    
    // Prepare the statement
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':email', $email);
    
    // Execute the statement
    $stmt->execute();
    
    // Fetch the result
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Close the database connection
    $conn = null;
    
    // Send the result as JSON response
    header('Content-Type: application/json');
    echo json_encode($result);
} catch (PDOException $e) {
    // Handle database connection errors
    echo 'Error: ' . $e->getMessage();
}
