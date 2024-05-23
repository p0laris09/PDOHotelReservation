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

// Fetch reservations from the database
$sql = "SELECT * FROM reservation";
try {
    $stmt = $pdo->query($sql);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Basta Kape - Admin</title>
    <!-- CSS FILES -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;300;400;700;900&display=swap" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="css/slick.css"/>
    <link href="css/style.css" rel="stylesheet">
    <style>
    .container {
    max-width: 1500px;
    margin: 0 auto;
    padding: 20px;
    }
    table {
        width: 90%;
        margin-left: auto;
        margin-right: auto;
        border-collapse: collapse;
    }
    th, td {
        padding: 8px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }
    
    .modal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
    }
    .modal-content {
        background-color: #fefefe;
        margin: 15% auto; /* 15% from the top and centered */
        padding: 20px;
        border: 1px solid #888;
        width: 80%; /* Could be more or less, depending on screen size */
    }
    /* Close button */
    .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }
    .close:hover,
    .close:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }
    
    .buttons-container\ {
        display: flex;
        justify-content: center;
        margin-top: 20px;
    }

    button[type="reset"],
    button[type="submit"],
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

    button:hover[type="reset"],
    button:hover[type="submit"],
    button {
        background-color: #c15b4d;
    }
    </style>
</head>
<body>

<!-- ========== Start Preloader ========== -->
<section class="preloader">
    <div class="spinner">
        <span class="sk-inner-circle"></span>
    </div>
</section>
<!-- ========== End Preloader ========== -->

<main>
<header class="site-header section-padding d-flex justify-content-center align-items-center">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 col-12">
                    <h1>
                        <span class="d-block text-primary">Basta Kape</span>
                        <span class="d-block text-dark">Admin Panel</span>
                    </h1>
                </div>
            </div>
        </div>
    </header>
</main>

    <div class="container">
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Guest Name</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Room Type</th>
                        <th>Room Capacity</th>
                        <th>Arrival Date</th>
                        <th>Departure Date</th>
                        <th>Type of Payment</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    if ($stmt->rowCount() > 0) {
                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            echo "<tr>";
                            echo "<td>" . $row["id"] . "</td>";
                            echo "<td>" . $row["fn"] . " " . $row["ln"] . "</td>";
                            echo "<td>" . $row["phone"] . "</td>";
                            echo "<td>" . $row["email"] . "</td>";
                            echo "<td>" . $row["rp"] . "</td>";
                            echo "<td>" . $row["rc"] . "</td>";
                            echo "<td>" . $row["at"] . "</td>";
                            echo "<td>" . $row["dt"] . "</td>";
                            echo "<td>" . $row["top"] . "</td>";
                            echo "<td>";
                            echo "<button onclick='openViewModal(" . $row["id"] . ")'>View</button> ";
                            echo "<button onclick='openEditModal(" . $row["id"] . ")'>Edit</button> ";
                            echo "<button onclick='openDeleteModal(" . $row["id"] . ")'>Delete</button>";
                            echo "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='10'>No reservations found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>


    
    

    <!-- View Modal -->
    <div id="viewModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeViewModal()">&times;</span>
            <p>View modal content goes here...</p>
        </div>
    </div>

    <!-- Edit Modal -->
    <div id="editModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeEditModal()">&times;</span>
            <p>Edit modal content goes here...</p>
        </div>
    </div>

    <!-- Delete Modal -->
    <div id="deleteModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeDeleteModal()">&times;</span>
            <p>Delete modal content goes here...</p>
        </div>
    </div>

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


            <div id="editModalForm" class="modal" style="display: none;">
                <div class="modal-content">
                <span class="close" onclick="closeEditModal()">&times;</span> <!-- Close button -->
                    <form class="hotel-reservation-form" method="post" action="update.php">
                    <input type="hidden" id="id" name="id" value="">
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

                            <div class="wrapper">
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

                            <div class="wrapper">
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
                            <button type="submit" onclick="updateReservation()">Update</button>
                            <button type="reset">Clear</button>
                        </div>
                    </form>
                </div>
            </div>

    <script>
        // Get the modals
        var viewModal = document.getElementById('viewModal');
        var editModal = document.getElementById('editModal');
        var deleteModal = document.getElementById('deleteModal');

        // Function to open the view modal
        function openViewModal(id) {
            viewModal.style.display = "block";
            // Fetch reservation details using AJAX
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    var reservation = JSON.parse(xhr.responseText);
                    populateViewModal(reservation);
                }
            };
            xhr.open("GET", "get_reservation_details.php?id=" + id, true);
            xhr.send();
        }

        // Function to populate the view modal with reservation details
        function populateViewModal(reservation) {
            var modalContent = document.querySelector("#viewModal .modal-content");
            modalContent.innerHTML = `
                <span class="close" onclick="closeViewModal()">&times;</span>
                <table>
                    <tr><th>Field</th><th>Value</th></tr>
                    <tr><td>First Name:</td><td>${reservation.fn}</td></tr>
                    <tr><td>Last Name:</td><td>${reservation.ln}</td></tr>
                    <tr><td>Email:</td><td>${reservation.email}</td></tr>
                    <tr><td>Phone:</td><td>${reservation.phone}</td></tr>
                    <tr><td>Room Preference:</td><td>${reservation.rp}</td></tr>
                    <tr><td>Room Capacity:</td><td>${reservation.rc}</td></tr>
                    <tr><td>Type of Payment:</td><td>${reservation.top}</td></tr>
                    <tr><td>Arrival Date:</td><td>${reservation.at}</td></tr>
                    <tr><td>Departure Date:</td><td>${reservation.dt}</td></tr>
                    <tr><td>Duration:</td><td>${reservation.duration} days</td></tr>
                    <tr><td>Price per Day:</td><td>₱${reservation.price}</td></tr>
                    ${reservation.discount ? `<tr><td>Discount:</td><td>₱${reservation.discount}</td></tr>` : ''}
                    ${reservation.add_charge ? `<tr><td>Additional Charge:</td><td>₱${reservation.add_charge}</td></tr>` : ''}
                    <tr><td>Total Cost:</td><td>₱${reservation.total_cost}</td></tr>
                </table>
            `;
        }


        // Function to open the edit modal and populate form fields with database values
        function openEditModal(id) {
            // Show the modal
            document.getElementById('editModalForm').style.display = 'block';

            // Fetch reservation details from the database using AJAX
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        // Parse the response JSON
                        var reservation = JSON.parse(xhr.responseText);

                        // Log the received reservation data
                        console.log('Received reservation data:', reservation);

                        // Populate form fields with reservation details
                        document.getElementById('id').value = reservation.id;
                        document.getElementById('first_name').value = reservation.fn;
                        document.getElementById('last_name').value = reservation.ln;
                        document.getElementById('arrival').value = formatDate(reservation.at);
                        document.getElementById('departure').value = formatDate(reservation.dt);
                        document.getElementById('email').value = reservation.email;
                        document.getElementById('phone').value = reservation.phone;
                        document.getElementById('room_pref').value = reservation.rp;
                        document.getElementById('room_cap').value = reservation.rc;
                        document.getElementById('top').value = reservation.top;
                        
                    } else {
                        // Handle HTTP error
                        console.error('Failed to fetch reservation details. HTTP Status:', xhr.status);
                    }
                }
            };
            xhr.open('GET', 'get_reservation_details.php?id=' + id, true); // Change 'reservationId' to 'id'
            xhr.send();
        }

        // Function to format date to yyyy/mm/dd
        function formatDate(dateString) {
            var date = new Date(dateString);
            var year = date.getFullYear();
            var month = ('0' + (date.getMonth() + 1)).slice(-2);
            var day = ('0' + date.getDate()).slice(-2);
            return year + '-' + month + '-' + day;
        }




        function updateReservation() {
        // Get form data
        var id = document.getElementById('id').value;
        var firstName = document.getElementById('first_name').value;
        var lastName = document.getElementById('last_name').value;
        var arrival = document.getElementById('arrival').value;
        var departure = document.getElementById('departure').value;
        var email = document.getElementById('email').value;
        var phone = document.getElementById('phone').value;
        var roomPref = document.getElementById('room_pref').value;
        var roomCap = document.getElementById('room_cap').value;
        var top = document.getElementById('top').value;

        // Construct the data to be sent to the server
        var data = new FormData();
        data.append('id', id);
        data.append('first_name', firstName);
        data.append('last_name', lastName);
        data.append('arrival', arrival);
        data.append('departure', departure);
        data.append('email', email);
        data.append('phone', phone);
        data.append('room_pref', roomPref);
        data.append('room_cap', roomCap);
        data.append('top', top);

        // Send the updated data to the server using AJAX
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    // Handle success
                    console.log('Reservation updated successfully.');
                    // Optionally, you can close the edit modal here
                    closeEditModal();
                } else {
                    // Handle error
                    console.error('Failed to update reservation. HTTP Status:', xhr.status);
                }
            }
        };
        xhr.open('POST', 'update.php', true); 
        xhr.send(data);
    }



        function clearForm() {
            document.getElementById('editForm').reset();
        }

        // Function to open the delete modal
        function openDeleteModal(id) {
            deleteModal.style.display = "block";
            // Display confirmation message with two buttons
            var modalContent = document.querySelector("#deleteModal .modal-content");
            modalContent.innerHTML = `
                <p style="text-align: center;">Are you sure you want to delete this reservation?</p>
                <div class="buttons-container" style="display: flex; justify-content: center;">
                    <button onclick="deleteReservation(${id})">Yes</button>
                    <button onclick="closeDeleteModal()">No</button>
                </div>
            `;
        }

        // Function to delete the reservation
        function deleteReservation(id) {
            // Send the reservation ID to delete.php using window.location.href
            window.location.href = `delete.php?id=${id}`;
        }




        // Function to close the view modal
        function closeViewModal() {
            viewModal.style.display = "none";
        }

        // Function to close the edit modal
        function closeEditModal() {
            var editModal = document.getElementById('editModal');
            var editModalForm = document.getElementById('editModalForm');
            editModal.style.display = "none";
            editModalForm.style.display = "none";
        }


        // Function to close the delete modal
        function closeDeleteModal() {
            deleteModal.style.display = "none";
        }

        // Close the modal when clicking outside of it
        window.onclick = function(event) {
            if (event.target == viewModal) {
                closeViewModal();
            }
            if (event.target == editModal) {
                closeEditModal();
            }
            if (event.target == deleteModal) {
                closeDeleteModal();
            }
        }
    </script>



    <!-- JAVASCRIPT FILES -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/Headroom.js"></script>
    <script src="js/jQuery.headroom.js"></script>
    <script src="js/slick.min.js"></script>
    <script src="js/custom.js"></script>

</body>
</html>

<?php
// Close the PDO connection
$pdo = null;
?>