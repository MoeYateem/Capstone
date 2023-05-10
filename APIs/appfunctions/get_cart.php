<?php
// get_instrument_data.php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");

$conn = new mysqli("localhost","root","","ap1");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$email = isset($_GET['email']) ? $_GET['email'] : '';

if (!empty($email)) {
    // Modify the query to include the `picture` column
    $query = "SELECT i.Name AS name, c.email, i.Price AS price, i.pic AS pic
              FROM cart c
              JOIN instruments i ON c.item_name = i.Name
              WHERE c.email = ?";

    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    $data = [];
    while ($row = $result->fetch_assoc()) {
        // Include the picture in the data array
        $data[] = $row;
    }

    echo json_encode($data);
} else {
    echo json_encode(['error' => 'Invalid or missing email']);
}
?>
