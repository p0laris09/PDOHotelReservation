<?php
// Database configuration
$host = "localhost";
$username = "root";
$password = "";
$dbname = "hotel";

// Establish a connection to the database using PDO
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // Set PDO to throw exceptions on error
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
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

    try {
        // Prepare SQL statement to insert data into database
        $stmt = $pdo->prepare("INSERT INTO reservation (fn, ln, at, dt, email, phone, rp, rc, top, price, duration, discount, add_charge, total_cost) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    
        // Bind parameters to prepared statement
        $stmt->bindParam(1, $first_name);
        $stmt->bindParam(2, $last_name);
        $stmt->bindParam(3, $arrival);
        $stmt->bindParam(4, $departure);
        $stmt->bindParam(5, $email);
        $stmt->bindParam(6, $phone);
        $stmt->bindParam(7, $room_pref);
        $stmt->bindParam(8, $room_cap);
        $stmt->bindParam(9, $type_of_payment);
        $stmt->bindParam(10, $price);
        $stmt->bindParam(11, $duration);
        $stmt->bindParam(12, $discount);
        $stmt->bindParam(13, $additional_charge);
        $stmt->bindParam(14, $total_cost);
    
        // Execute the prepared statement
        $stmt->execute();
    
        // Redirect to a success page or do further processing
        header("Location: bill_info.php");
        exit();
    } catch (PDOException $e) {
        // Handle any errors that occur during the insert process
        die("Insert failed: " . $e->getMessage());
    }    
}
?>
