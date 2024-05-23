<?php
// Connect to the database using PDO
$host = "localhost";
$username = "root";
$password = "";
$dbname = "hotel";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Fetch reservations from the database
$sql = "SELECT * FROM reservations";
try {
    $stmt = $pdo->query($sql);
    if ($stmt->rowCount() > 0) {
        // Output data of each row
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>";
            echo "<td>" . $row["id"] . "</td>";
            echo "<td>" . $row["fn"] . " " . $row["ln"] . "</td>";
            echo "<td>" . $row["dp"] . "</td>";
            echo "<td>" . $row["at"] . "</td>";
            echo "<td>" . $row["dt"] . "</td>";
            echo "<td><a href='edit_reservation.php?id=" . $row["id"] . "'>Edit</a> | <a href='delete_reservation.php?id=" . $row["id"] . "'>Delete</a></td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='6'>No reservations found</td></tr>";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

// Close the PDO connection
$pdo = null;
?>
