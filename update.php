<?php
$updateMessage = ""; // Initialize the update message variable

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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $reservation_id = $_POST["id"];
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $arrival = $_POST["arrival"];
    $departure = $_POST["departure"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $room_pref = $_POST["room_pref"];
    $room_cap = $_POST["room_cap"];
    $type_of_payment = $_POST["top"];

    // Calculation
    $price = 0;
    if ($room_pref == 'Standard') {
        if ($room_cap == 'Single') {
            $price = 100;
        } elseif ($room_cap == 'Double') {
            $price = 200;
        } elseif ($room_cap == 'Family') {
            $price = 300;
        }
    } elseif ($room_pref == 'Deluxe') {
        if ($room_cap == 'Single') {
            $price = 300;
        } elseif ($room_cap == 'Double') {
            $price = 500;
        } elseif ($room_cap == 'Family') {
            $price = 700;
        }
    } elseif ($room_pref == 'Suite') {
        if ($room_cap == 'Single') {
            $price = 500;
        } elseif ($room_cap == 'Double') {
            $price = 800;
        } elseif ($room_cap == 'Family') {
            $price = 1000;
        }
    }

    $duration = (strtotime($departure) - strtotime($arrival)) / 86400 + 1; // Add 1 day to include the departure day

    // Total cost calculation
    $total_cost = $price * $duration;

    // Initialize discount and additional charge to 0
    $discount = 0;
    $additional_charge = 0;

    // Discount calculation
    if ($type_of_payment == 'Cash') {
        if ($duration >= 3 && $duration <= 5) {
            $discount = $total_cost * 0.10;
            $total_cost -= $discount;
        } elseif ($duration >= 6) {
            $discount = $total_cost * 0.15;
            $total_cost -= $discount;
        }
    }

    // Additional charges calculation
    if ($type_of_payment == 'Check') {
        $additional_charge = $total_cost * 0.05;
        $total_cost += $additional_charge;
    } elseif ($type_of_payment == 'Credit Card') {
        $additional_charge = $total_cost * 0.10;
        $total_cost += $additional_charge;
    }

    // Prepare an UPDATE statement
    $sql = "UPDATE reservation SET fn=:fn, ln=:ln, email=:email, phone=:phone, rp=:rp, rc=:rc, at=:at, dt=:dt, top=:top, price=:price, duration=:duration, discount=:discount, add_charge=:add_charge, total_cost=:total_cost WHERE id=:id";
    $stmt = $pdo->prepare($sql);

    // Bind parameters
    $stmt->bindParam(':id', $reservation_id);
    $stmt->bindParam(':fn', $first_name);
    $stmt->bindParam(':ln', $last_name);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':phone', $phone);
    $stmt->bindParam(':rp', $room_pref);
    $stmt->bindParam(':rc', $room_cap);
    $stmt->bindParam(':at', $arrival);
    $stmt->bindParam(':dt', $departure);
    $stmt->bindParam(':top', $type_of_payment);
    $stmt->bindParam(':price', $price);
    $stmt->bindParam(':duration', $duration);
    $stmt->bindParam(':discount', $discount);
    $stmt->bindParam(':add_charge', $additional_charge);
    $stmt->bindParam(':total_cost', $total_cost);

    try {
        // Execute the statement
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            $updateMessage = "Record updated successfully"; // Message to display on successful update
        } else {
            $updateMessage = "No records were updated"; // Message when no records were updated
        }
        // Redirect back to admin.php
        header("Location: admin.php");
        exit(); // Ensure that no other code is executed after the redirect
    } catch (PDOException $e) {
        $updateMessage = "Error updating record: " . $e->getMessage(); // Error message
    }
    $updateMessage = "Error updating record: " . $e->getMessage(); // Error message
    
}    

// Close the PDO connection
$pdo = null;
?>
