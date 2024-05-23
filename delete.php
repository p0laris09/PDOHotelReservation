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

// Check if reservation ID is provided in the URL
if (isset($_GET['id'])) {
    $reservation_id = $_GET['id'];

    // Prepare the DELETE statement
    $sql = "DELETE FROM reservation WHERE id = :id";
    $stmt = $pdo->prepare($sql);

    try {
        // Bind the parameter and execute the statement
        $stmt->bindParam(':id', $reservation_id);
        $stmt->execute();

        // Redirect back to admin.php after deletion
        header("Location: admin.php");
        exit(); // Ensure that no other code is executed after the redirect
    } catch (PDOException $e) {
        echo "Error deleting record: " . $e->getMessage();
    }
} else {
    // If reservation ID is not provided, redirect to admin.php
    header("Location: admin.php");
    exit();
}

// Close the PDO connection
$pdo = null;
?>
