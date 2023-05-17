<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");

$host = 'localhost';
$db = 'ap1';
$user = 'root';
$password = '';

try {
    // Establish a database connection
    $conn = new PDO("mysql:host=$host;dbname=$db", $user, $password);

    // Retrieve the email, card_number, expiry_date and srn from the POST request
    $email = $_POST['email'];
    $card_number = $_POST['card_number'];
    $expiry_date = $_POST['expiry_date'];
    $srn = $_POST['srn'];

    // Prepare the SQL query
    $sql = "INSERT INTO credit_cards (email, card_number, expiry_date, srn) VALUES (:email, :card_number, :expiry_date, :srn)";

    // Prepare the statement
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':card_number', $card_number);
    $stmt->bindParam(':expiry_date', $expiry_date);
    $stmt->bindParam(':srn', $srn);

    // Execute the statement
    $stmt->execute();

    // Close the database connection
    $conn = null;

    // Send a success message as JSON response
    echo json_encode(['message' => 'Credit card added successfully']);
} catch (PDOException $e) {
    // Handle database connection errors
    echo 'Error: ' . $e->getMessage();
}
