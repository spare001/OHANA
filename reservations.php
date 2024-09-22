<?php
// Include database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ohana";

try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Connection failed: ' . $e->getMessage());
}

// Fetch upcoming reservations
$upcomingReservations = [];
$currentDate = date('Y-m-d');
$stmt = $pdo->prepare("SELECT * FROM bookings WHERE checkin_date >= :currentDate");
$stmt->execute(['currentDate' => $currentDate]);
$upcomingReservations = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Fetch past reservations
$pastReservations = [];
$stmt = $pdo->prepare("SELECT * FROM bookings WHERE checkout_date < :currentDate");
$stmt->execute(['currentDate' => $currentDate]);
$pastReservations = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OHANA Private Resort</title>
    <link rel="icon" href="img/logo-png.png" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <script src="mode.js"></script>  
        
    <script>
        (function() {
            const savedMode = localStorage.getItem('mode');
            if (savedMode) {
                document.documentElement.classList.add(savedMode);
            } else {
                document.documentElement.classList.add('light-mode'); // Default to light mode
            }
        })();
    </script>
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/locales-all.min.js"></script>
<style>
    /* General Styles */
body { 
    background-color: #f8f9fa; 
    font-size: 0.85em; /* Adjust the base font size */
}

h2, h4 {
    font-size: 1.2em; /* Adjust heading sizes as needed */
    color: black !important;
}

.card { 
    margin-bottom: 20px; 
}

/* Sidebar Styles */
.sidebar {
    position: fixed; /* Fix the sidebar */
    top: 0; /* Align to the top */
    left: 0; /* Align to the left */
    min-height: 100vh; /* Full height */
    background: linear-gradient(180deg, rgba(253,211,27,1) 0%, rgba(237,70,7,1) 100%);
    color: white;
    width: 250px; /* Fixed width for larger screens */
    padding-top: 50px !important;
}

.sidebar a {
    color: black;
    padding: 10px 20px;
}

.sidebar a:hover {
    color: black;
    font-weight: 500;
}

.sidebar .nav-link.active {
    color: black;
    font-weight: 500;
}

/* Main Content Styles */
.container {
    margin-left: 250px; /* Create space for the sidebar */
    padding: 50px;
    max-width: calc(100% - 250px); /* Adjust max-width */
    height: 100vh; /* Full height */
    overflow-y: auto; /* Allow vertical scrolling */
}

/* Table and Form Styles */
table {
    font-size: 0.85em; /* Make table text smaller */
}

.form-control, .form-select {
    border: 1px solid orange !important; /* Default border color */
    border-radius: 15px; /* Rounded corners */
    padding: 10px; /* Padding inside the text field */
}

.form-control:focus {
    border-color: orange !important; /* Border color on focus */
    box-shadow: 0 0 0 1px orangered !important; /* Light shadow effect */
    outline: none; /* Remove default outline */
}

/* Calendar Styles */
#calendar {
    width: 50%; /* Reduced width */
    max-width: 100%; /* Ensure it doesn’t exceed the container */
    margin: 0 auto; /* Center the calendar */
    height: 70vh; /* Adjusted height to make it smaller */
}

/* Font Awesome Calendar Styles */
.fc-daygrid-day-number {
    text-decoration: none !important;
}

.fc-col-header-cell, .fc-col-header-cell a {
    text-decoration: none !important; /* Remove underlines */
    border: none !important; /* Remove any borders around the day names */
    padding: 20px 0 !important;
    color: black;
}

.fc-daygrid-day {
    border: 1px solid #ddd; /* Light gray border */
}

.fc-daygrid-day:hover {
    background-color: wheat; /* Highlight border on hover */
}

.fc-toolbar button {
    background-color: transparent !important;
    border-color: transparent !important;
    color: black !important;
    text-transform: uppercase; /* Capitalize button text */
}

.fc-toolbar h2 {
    text-transform: uppercase; /* Capitalize title */
}

.fc .fc-daygrid {
    border: transparent !important;
    border-radius: 5px; /* Optional rounded corners */
}

/* Dark Mode Styles */
body.dark-mode label {
    color: black; /* Text color in dark mode */
}

body.dark-mode .fc-daygrid-day-number {
    color: white; /* Day number color */
}

body.dark-mode p {
    color: black; /* Paragraph color */
}

body.dark-mode .form-control, .form-select {
    border: 1px solid orange !important; /* Default border color */
    border-radius: 15px; /* Rounded corners */
    padding: 10px; /* Padding inside the text field */
}

body.dark-mode .form-control:focus {
    border-color: orange !important; /* Border color on focus */
    box-shadow: 0 0 0 1px orangered !important; /* Light shadow effect */
}

/* Media Queries */
@media (max-width: 768px) {
    .sidebar {
        position: static; /* Reset for mobile view */
        width: 100%; /* Full width on smaller screens */
    }
    .container {
        margin-left: 0; /* Reset margin for mobile */
        max-width: 100%; /* Full width */
    }
}

</style>
<body>
<div class="d-flex">
<div class="sidebar flex-shrink-0" id="sidebar">
    <img src="img/logo-png.png" alt="OHANA Logo" class="img-fluid mx-auto d-block" style="max-width: 50%; margin-bottom: 20px;">
    <ul class="nav flex-column">
        <li class="nav-item"><a class="nav-link" href="admin.php">Dashboard</a></li>
        <li class="nav-item"><a class="nav-link" href="add_reservation.php">Add New Reservation</a></li>
        <li class="nav-item"><a class="nav-link active" href="reservations.php">Reservations</a></li>
        <li class="nav-item"><a class="nav-link" href="edit_booking.php">Edit Booking</a></li>
        <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
    </ul>
</div>

    <div class="container">
        <h2 class="text-center mb-4">Reservations</h2>

        <!-- Upcoming Reservations Table -->
        <h4>Upcoming Reservations</h4>
        <div class="table-responsive mb-4">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Full Name</th>
                        <th>Mobile Phone</th>
                        <th>Email Address</th>
                        <th>City</th>
                        <th>Check-In</th>
                        <th>Check-Out</th>
                        <th>Condo Type</th>
                        <th>Dorm Type</th>
                        <th>Time Selection</th>
                        <th>Total Price</th>
                        <th>Downpayment Price</th>
                        <th>Created Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($upcomingReservations as $reservation): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($reservation['prefix'] . ' ' . $reservation['first_name'] . ' ' . $reservation['middle_name'] . ' ' . $reservation['last_name']); ?></td>
                            <td><?php echo htmlspecialchars($reservation['mobile_phone']); ?></td>
                            <td><?php echo htmlspecialchars($reservation['email_address']); ?></td>
                            <td><?php echo htmlspecialchars($reservation['city']); ?></td>
                            <td><?php echo htmlspecialchars(date('F d, Y', strtotime($reservation['checkin_date']))); ?></td>
                            <td><?php echo htmlspecialchars(date('F d, Y', strtotime($reservation['checkout_date']))); ?></td>
                            <td><?php echo htmlspecialchars($reservation['num_small_rooms']); ?></td>
                            <td><?php echo htmlspecialchars($reservation['num_big_rooms']); ?></td>
                            <td><?php echo htmlspecialchars($reservation['time_selection']); ?></td>
                            <td>₱<?php echo number_format($reservation['total_price'], 2); ?></td>
                            <td>₱<?php echo number_format($reservation['downpayment_price'], 2); ?></td>
                            <td><?php echo htmlspecialchars(date('F d, Y', strtotime($reservation['created_at']))); ?></td>
                            <td>
                                <a href="edit_booking.php?id=<?php echo $reservation['id']; ?>" class="btn btn-primary btn-sm">Edit</a>
                                <button class="btn btn-danger btn-sm" onclick="deleteReservation(<?php echo $reservation['id']; ?>)">Delete</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- Past Reservations Table -->
        <h4>Past Reservations</h4>
        <div class="table-responsive mb-4">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Full Name</th>
                        <th>Mobile Phone</th>
                        <th>Email Address</th>
                        <th>City</th>
                        <th>Check-In</th>
                        <th>Check-Out</th>
                        <th>Condo Type</th>
                        <th>Dorm Type</th>
                        <th>Time Selection</th>
                        <th>Total Price</th>
                        <th>Downpayment Price</th>
                        <th>Created Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($pastReservations as $reservation): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($reservation['prefix'] . ' ' . $reservation['first_name'] . ' ' . $reservation['middle_name'] . ' ' . $reservation['last_name']); ?></td>
                            <td><?php echo htmlspecialchars($reservation['mobile_phone']); ?></td>
                            <td><?php echo htmlspecialchars($reservation['email_address']); ?></td>
                            <td><?php echo htmlspecialchars($reservation['city']); ?></td>
                            <td><?php echo htmlspecialchars(date('F d, Y', strtotime($reservation['checkin_date']))); ?></td>
                            <td><?php echo htmlspecialchars(date('F d, Y', strtotime($reservation['checkout_date']))); ?></td>
                            <td><?php echo htmlspecialchars($reservation['num_small_rooms']); ?></td>
                            <td><?php echo htmlspecialchars($reservation['num_big_rooms']); ?></td>
                            <td><?php echo htmlspecialchars($reservation['time_selection']); ?></td>
                            <td>₱<?php echo number_format($reservation['total_price'], 2); ?></td>
                            <td>₱<?php echo number_format($reservation['downpayment_price'], 2); ?></td>
                            <td><?php echo htmlspecialchars(date('F d, Y', strtotime($reservation['created_at']))); ?></td>
                            <td>
                                <a href="edit_booking.php?id=<?php echo $reservation['id']; ?>" class="btn btn-primary btn-sm">Edit</a>
                                <button class="btn btn-danger btn-sm" onclick="deleteReservation(<?php echo $reservation['id']; ?>)">Delete</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
// Your existing JavaScript
(function() {
    const savedMode = localStorage.getItem('mode');
    if (savedMode) {
        document.documentElement.classList.add(savedMode);
    } else {
        document.documentElement.classList.add('light-mode'); // Default to light mode
    }
})();

function deleteReservation(id) {
    if (confirm("Are you sure you want to delete this reservation?")) {
        window.location.href = "delete_booking.php?id=" + id;
    }
}
</script>

</body>
</html>
