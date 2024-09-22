<?php
// Database connection
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

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $checkinDate = htmlspecialchars($_POST['checkin_date']);
    $checkoutDate = htmlspecialchars($_POST['checkout_date']);
    $time = htmlspecialchars($_POST['time']);

    // Prepare SQL query
    $query = "INSERT INTO bookings (checkin_date, checkout_date, time) VALUES (:checkin_date, :checkout_date, :time)";
    
    try {
        $stmt = $pdo->prepare($query);
        $stmt->execute([
            'checkin_date' => $checkinDate,
            'checkout_date' => $checkoutDate,
            'time' => $time
        ]);
        header("Location: booking.php"); // Redirect to booking.php after success
        exit();
    } catch (PDOException $e) {
        echo "<p>Error: " . $e->getMessage() . "</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OHANA Private Resort</title>
    <link rel="icon" href="img/logo-png.png" type="image/x-icon">
    <link rel="stylesheet" href="style2.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <script src="mode.js"></script>  
    <style>
        body { background-color: #f8f9fa; }
        .container { margin-top: 50px; }
        .table { background-color: white; border-radius: 10px; }
        .table th, .table td { text-align: center; }
        .btn-custom { background: linear-gradient(90deg, rgba(253,211,27,1) 0%, rgba(237,70,7,1) 100%); color: white; }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="text-center">Add Reservation</h1>
        <form method="POST" action="">
            <div class="mb-3">
                <label for="checkin_date" class="form-label">Check-In Date</label>
                <input type="date" class="form-control" id="checkin_date" name="checkin_date" required>
            </div>
            <div class="mb-3">
                <label for="checkout_date" class="form-label">Check-Out Date</label>
                <input type="date" class="form-control" id="checkout_date" name="checkout_date" required>
            </div>
            <div class="mb-3">
                <label for="time" class="form-label">Time</label>
                <select class="form-select" id="time" name="time" required>
                    <option value="" disabled selected>Select Option</option>
                    <option value="Day Swim">Day Swim</option>
                    <option value="Night Swim">Night Swim</option>
                    <option value="22 hours">22 Hours</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Add Reservation</button>
        </form>
    </div>
</body>
</html>
