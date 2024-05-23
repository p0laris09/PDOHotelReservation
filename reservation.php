<?php  
$localhost = "localhost";
$username = "root";
$password = "";
$dbname = "hotel";

$conn = mysqli_connect($localhost, $username, $password, $dbname);
if (!$conn) {
    echo "<script>alert('Can't Connect to the Database!');</script>";
 die ('Fail to connect to MySQL: ' . mysqli_connect_error());
}
?>

<!doctype html>
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
        .buttons-container {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        button {
            display: block;
            margin-top: 15px;
            padding: 15px;
            border: 0;
            background-color: #cb5f51;
            font-weight: bold;
            color: #fff;
            cursor: pointer;
            width: 100%;
        }

        button:hover {
            background-color: #c15b4d;
        }

        select {
            width: auto;
            max-width: 100%;
        }
    </style>
    </head>

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
                                <span class="d-block text-primary">Hotel</span>
                                <span class="d-block text-dark">Reservation Form</span>
                            </h1>
                        </div>
                    </div>
                </div>
            </header>
            <body>
                
                <form class="hotel-reservation-form" method="post" action="reserve.php">
                    <div class="fields">
                        <div class="wrapper">
                            <div>
                                <label for="first_name">First Name</label>
                                <div class="field">
                                    <i class="fas fa-user"></i>
                                    <input id="first_name" type="text" name="first_name" placeholder="First Name">
                                </div>
                            </div>
                            <div class="gap"></div>
                            <div>
                                <label for="last_name">Last Name</label>
                                <div class="field">
                                    <i class="fas fa-user"></i>
                                    <input id="last_name" type="text" name="last_name" placeholder="Last Name">
                                </div>
                            </div>
                        </div>

                        <div class="wrapper">
                            <div>
                                <label for="arrival">Arrival</label>
                                    <div class="field">
                                        <input id="arrival" type="date" name="arrival">
                                    </div>
                            </div>
                            <div class="gap"></div>
                                <div>
                                    <label for="departure">Departure</label>
                                        <div class="field">
                                            <input id="departure" type="date" name="departure">
                                        </div>
                                </div>
                            </div>

                        <div class="wrapper">
                            <div>
                                <label for="email">Email</label>
                                <div class="field">
                                    <i class="fas fa-user"></i>
                                    <input id="email" type="text" name="email" placeholder="Your Email">
                                </div>
                            </div>
                            <div class="gap"></div>
                            <div>
                                <label for="phone">Contact Number</label>
                                <div class="field">
                                    <i class="fas fa-user"></i>
                                    <input id="phone" type="tel" name="phone" placeholder="09">
                                </div>
                            </div>
                        </div>

                        <div class = "wrapper">
                            <div>
                                    <label for="room_pref">Room Preference</label>
                                    <div class="field">
                                        <select id="room_pref" name="room_pref">
                                            <option disabled selected value="">--</option>
                                            <option value="Standard">Standard</option>
                                            <option value="Deluxe">Deluxe</option>
                                            <option value="Suite">Suite</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="gap"></div>
                                <div>
                                    <label for="room_cap">Room Capacity</label>
                                    <div class="field">
                                        <select id="room_cap" name="room_cap">
                                            <option disabled selected value="">--</option>
                                            <option value="Single">Single</option>
                                            <option value="Double">Double</option>
                                            <option value="Family">Family</option>
                                        </select>
                                    </div>
                                </div>
                        </div>
                    

                        <div class = "wrapper">
                            <div>
                                <label for="top">Type of Payment</label>
                                <div class="field">
                                <select id="top" name="top">
                                    <option disabled selected value="">--</option>
                                    <option value="Cash">Cash</option>
                                    <option value="Check">Check</option>
                                    <option value="Credit Card">Credit Card</option>
                                </select>
                            </div>
                            </div>
                            
                            
                        </div>
                        


                        
                        <div id="error-message" style="color: red;"></div>
                        <div class="gap"></div>
                        <div class="gap"></div>
                            <input type="submit" value="Reserve"></input>
                            <button type="reset">Clear</button>
                        </div>
                    </div>
                    </div>
                </form>

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

    </body>

    
</html>

<script>
document.addEventListener('DOMContentLoaded', function () {
    function validateInputs() {
        const arrival = document.getElementById('arrival').value;
        const departure = document.getElementById('departure').value;
        const firstName = document.getElementById('first_name').value;
        const lastName = document.getElementById('last_name').value;
        const email = document.getElementById('email').value;
        const phone = document.getElementById('phone').value;
        const roomPrefs = document.getElementById('room_pref').value;
        const roomCap = document.getElementById('room_cap').value;
        const typeOfPayment = document.getElementById('top').value;

        let missingFields = [];
        const errorMessage = document.getElementById('error-message');

        if (!arrival) {
            missingFields.push("Arrival");
        }
        if (!departure) {
            missingFields.push("Departure");
        }
        if (!firstName) {
            missingFields.push("First Name");
        }
        if (!lastName) {
            missingFields.push("Last Name");
        }
        if (!email) {
            missingFields.push("Email");
        }
        if (!phone) {
            missingFields.push("Phone");
        }
        if (!roomPrefs) {
            missingFields.push("Room Preference");
        }
        if (!roomCap) {
            missingFields.push("Room Capacity");
        }
        if (!typeOfPayment) {
            missingFields.push("Type of Payment");
        }

        if (missingFields.length > 0) {
            errorMessage.textContent = "Please fill in the following required fields: " + missingFields.join(", ");
            return false;
        }

        return true;
    }

    document.querySelector('input[type="submit"]').addEventListener('click', function (event) {
        if (!validateInputs()) {
            event.preventDefault();
        }
    });
});
</script>
</html>








