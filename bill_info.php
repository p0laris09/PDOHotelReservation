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

// Fetch data from the database
try {
    $stmt = $pdo->query("SELECT * FROM reservation ORDER BY id DESC LIMIT 1"); // Assuming id is the primary key
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    // Handle any errors that occur during the query
    die("Query failed: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Basta Kape - Reservation</title>
    <!-- CSS FILES -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;300;400;700;900&display=swap" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="css/slick.css"/>
    <link href="css/style.css" rel="stylesheet">
    <style>
        table {
            width: 50%;
            margin-left: auto;
            margin-right: auto;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        .buttons-container {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }
        .centered-button {
            margin: 0 10px;
        }
        button {
            background-color: #333;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 5px;
        }
        button:hover {
            background-color: #555;
        }
    </style>
</head>
<body>

<section class="preloader">
    <div class="spinner">
        <span class="sk-inner-circle"></span>
    </div>
</section>

<main>
<nav class="navbar navbar-expand-lg">
    <div class="container">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <a class="navbar-brand" href="index.html">
            <strong><span>Basta</span> Kape</strong>
        </a>

        <div class="d-lg-none">
            <a href="sign-in.html" class="bi-person custom-icon me-3"></a>

            <a href="product-detail.html" class="bi-bag custom-icon"></a>
        </div>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Home</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="profile.php">Company's Profile</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link active" href="reservation.php">Reservation</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="contacts.php">Contact</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

    <header class="site-header section-padding d-flex justify-content-center align-items-center">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 col-12">
                    <h1>
                        <span class="d-block text-primary">Bill</span>
                        <span class="d-block text-dark">Information</span>
                    </h1>
                </div>
            </div>
        </div>
    </header>

    <table>
            <tr><th>Field</th><th>Value</th></tr>
            <tr><td>First Name:</td><td><?= htmlspecialchars($row['fn']) ?></td></tr>
            <tr><td>Last Name:</td><td><?= htmlspecialchars($row['ln']) ?></td></tr>
            <tr><td>Email:</td><td><?= htmlspecialchars($row['email']) ?></td></tr>
            <tr><td>Phone:</td><td><?= htmlspecialchars($row['phone']) ?></td></tr>
            <tr><td>Room Preference:</td><td><?= htmlspecialchars($row['rp']) ?></td></tr>
            <tr><td>Room Capacity:</td><td><?= htmlspecialchars($row['rc']) ?></td></tr>
            <tr><td>Type of Payment:</td><td><?= htmlspecialchars($row['top']) ?></td></tr>
            <tr><td>Arrival Date:</td><td><?= htmlspecialchars($row['at']) ?></td></tr>
            <tr><td>Departure Date:</td><td><?= htmlspecialchars($row['dt']) ?></td></tr>
            <tr><td>Duration:</td><td><?= htmlspecialchars($row['duration']) ?> days</td></tr>
            <tr><td>Price per Day:</td><td>₱<?= htmlspecialchars($row['price']) ?></td></tr>

            <?php
            if (isset($row['discount']) && $row['discount'] > 0) {
                echo "<tr><td>Discount:</td><td>₱" . htmlspecialchars($row['discount']) . "</td></tr>";
            }
    
            if (isset($row['add_charge']) && $row['add_charge'] > 0) {
                echo "<tr><td>Additional Charge:</td><td>₱" . htmlspecialchars($row['addl_charge']) . "</td></tr>";
            }
            ?>
            <tr><td>Total Cost:</td><td>₱<?= htmlspecialchars($row['total_cost']) ?></td></tr>
        </table>

    <div class="buttons-container">
        <button onclick="goHome()" class="centered-button">Home</button>
        <button onclick="goBack()" class="centered-button">Back</button>
    </div>

    <br>
</main>

<footer class="site-footer">
            <div class="container">
                <div class="row">

                    <div class="col-lg-3 col-10 me-auto mb-4">
                        <h4 class="text-white mb-3"><a href="index.php">Basta</a> Kape</h4>
                        <p class="copyright-text text-muted mt-lg-5 mb-4 mb-lg-0">Copyright © 2024 <strong>Basta Kape</strong></p>
                        <br>
                        <p class="copyright-text">Designed by <a href="https://www.tooplate.com/" target="_blank">Basta Kape Team</a></p>
                    </div>

                    <div class="col-lg-5 col-8">
                        <h5 class="text-white mb-3">Sitemap</h5>

                        <ul class="footer-menu d-flex flex-wrap">
                            <li class="footer-menu-item"><a href="about.html" class="footer-menu-link">About</a></li>

                            <li class="footer-menu-item"><a href="#" class="footer-menu-link">Contact</a></li>

                            <li class="footer-menu-item"><a href="#" class="footer-menu-link">Reservation</a></li>
                        </ul>
                    </div>

                    <div class="col-lg-3 col-4">
                        <h5 class="text-white mb-3">Social</h5>

                        <ul class="social-icon">

                            <li><a href="#" class="social-icon-link bi-youtube"></a></li>

                            <li><a href="#" class="social-icon-link bi-whatsapp"></a></li>

                            <li><a href="#" class="social-icon-link bi-instagram"></a></li>

                            <li><a href="#" class="social-icon-link bi-skype"></a></li>
                        </ul>
                    </div>

                </div>
            </div>
            </footer>

<!-- JAVASCRIPT FILES -->
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/Headroom.js"></script>
<script src="js/jQuery.headroom.js"></script>
<script src="js/slick.min.js"></script>
<script src="js/custom.js"></script>

<script>
    function goHome() {
        window.location.href = "index.php";
    }

    function goBack() {
        window.history.back();
    }
</script>
</body>
</html>




