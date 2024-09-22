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

// Check if ID is set in the URL
if (!isset($_GET['id'])) {
    header('Location: admin.php'); // Redirect to index if no ID is provided
    exit;
}

// Fetch the booking details
$stmt = $pdo->prepare("SELECT * FROM bookings WHERE id = :id");
$stmt->bindParam(':id', $_GET['id'], PDO::PARAM_INT);
$stmt->execute();
$booking = $stmt->fetch(PDO::FETCH_ASSOC);

// Check if booking exists
if (!$booking) {
    echo "Booking not found.";
    exit;
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $prefix = $_POST['prefix'];
    $firstName = $_POST['first_name'];
    $middleName = $_POST['middle_name']; // Added middle name
    $lastName = $_POST['last_name'];
    $mobilePhone = $_POST['mobile_phone'];
    $emailAddress = $_POST['email_address'];
    $checkinDate = $_POST['checkin_date'];
    $checkoutDate = $_POST['checkout_date'];
    $totalPrice = $_POST['total_price'];
    $timeSelection = htmlspecialchars($_POST['time_selection']); // Added time selection

    // Update the booking in the database
    $stmt = $pdo->prepare("UPDATE bookings SET prefix = :prefix, first_name = :first_name, middle_name = :middle_name, last_name = :last_name, mobile_phone = :mobile_phone, email_address = :email_address, checkin_date = :checkin_date, checkout_date = :checkout_date, total_price = :total_price, time_selection = :time_selection WHERE id = :id");
    
    $stmt->bindParam(':prefix', $prefix);
    $stmt->bindParam(':first_name', $firstName);
    $stmt->bindParam(':middle_name', $middleName); // Bind middle name
    $stmt->bindParam(':last_name', $lastName);
    $stmt->bindParam(':mobile_phone', $mobilePhone);
    $stmt->bindParam(':email_address', $emailAddress);
    $stmt->bindParam(':checkin_date', $checkinDate);
    $stmt->bindParam(':checkout_date', $checkoutDate);
    $stmt->bindParam(':total_price', $totalPrice);
    $stmt->bindParam(':time_selection', $timeSelection); // Bind time selection
    $stmt->bindParam(':id', $_GET['id'], PDO::PARAM_INT);

    if ($stmt->execute()) {
        header('Location: reservations.php'); // Redirect to the bookings list
        exit;
    } else {
        echo "Error updating booking.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <title>Edit Booking</title>
</head>
<body>
    <div class="container mt-5">
        <h2>Edit Booking</h2>
        <form method="POST">
            <div class="form-group">
                <label for="prefix">Prefix</label>
                <select class="form-control" name="prefix" id="prefix" required>
                    <option value="<?= htmlspecialchars($booking['prefix']); ?>"><?= htmlspecialchars($booking['prefix']); ?></option>
                    <option value="Dr.">Dr.</option>
                    <option value="Mr.">Mr.</option>
                    <option value="Mrs.">Mrs.</option>
                </select>
            </div>
            <div class="form-group">
                <label for="first_name">First Name</label>
                <input type="text" class="form-control" name="first_name" id="first_name" value="<?= htmlspecialchars($booking['first_name']); ?>" required>
            </div>
            <div class="form-group">
                <label for="middle_name">Middle Name</label>
                <input type="text" class="form-control" name="middle_name" id="middle_name" value="<?= htmlspecialchars($booking['middle_name']); ?>">
            </div>
            <div class="form-group">
                <label for="last_name">Last Name</label>
                <input type="text" class="form-control" name="last_name" id="last_name" value="<?= htmlspecialchars($booking['last_name']); ?>" required>
            </div>
            <div class="form-group">
                <label for="mobile_phone">Mobile Phone</label>
                <input type="text" class="form-control" name="mobile_phone" id="mobile_phone" value="<?= htmlspecialchars($booking['mobile_phone']); ?>" required>
            </div>
            <div class="form-group">
                <label for="email_address">Email Address</label>
                <input type="email" class="form-control" name="email_address" id="email_address" value="<?= htmlspecialchars($booking['email_address']); ?>" required>
            </div>
            <div class="form-group">
                <label for="checkin_date">Check-in Date</label>
                <input type="date" class="form-control" name="checkin_date" id="checkin_date" value="<?= htmlspecialchars($booking['checkin_date']); ?>" required>
            </div>
            <div class="form-group">
                <label for="checkout_date">Check-out Date</label>
                <input type="date" class="form-control" name="checkout_date" id="checkout_date" value="<?= htmlspecialchars($booking['checkout_date']); ?>" required>
            </div>
            <div class="form-group">
                <label for="total_price">Total Price</label>
                <input type="number" class="form-control" name="total_price" id="total_price" value="<?= htmlspecialchars($booking['total_price']); ?>" required>
            </div>
            <div class="form-group">
                <label for="time_selection">Time Selection</label>
                <input type="text" class="form-control" name="time_selection" id="time_selection" value="<?= htmlspecialchars($booking['time_selection']); ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Update Booking</button>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
