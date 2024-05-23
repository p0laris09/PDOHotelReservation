<?php
// Database connection settings
$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'hotel';

// Establish the PDO connection
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Check if reservation ID is provided
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    // Fetch reservation details from the database
    $sql = "SELECT * FROM reservation WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $reservation = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($reservation) {
        // Return reservation details as JSON
        header('Content-Type: application/json');
        echo json_encode($reservation);
    } else {
        // Reservation ID not found
        http_response_code(404);
        echo json_encode(array('error' => 'Reservation not found'));
    }
} else {
    // Reservation ID not provided
    http_response_code(400);
    echo json_encode(array('error' => 'Reservation ID not provided'));
}

// Close the PDO connection
$pdo = null;
?>
