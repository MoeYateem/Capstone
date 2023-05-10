<?php

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");

$host = 'localhost';
$db = 'ap1';
$user = 'root';
$password = '';

// Establish a database connection
$conn = new PDO("mysql:host=$host;dbname=$db", $user, $password);

// Retrieve the email from the request
$email = $_GET['email']; // Assuming the email is provided as a query parameter

// Prepare the SQL query
$sql = "SELECT card_number, expiry_date, srn FROM credit_cards WHERE email = :email";

// Prepare the statement
$stmt = $conn->prepare($sql);
$stmt->bindParam(':email', $email);

// Execute the statement
$stmt->execute();

// Fetch the result
$result = $stmt->fetch(PDO::FETCH_ASSOC);

// Close the database connection
$conn = null;

// Send the result as JSON response
header('Content-Type: application/json');
echo json_encode($result);
?>
