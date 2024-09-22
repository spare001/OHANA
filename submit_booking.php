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
    // Retrieve and sanitize form data
    $prefix = htmlspecialchars($_POST['prefix']);
    $firstName = htmlspecialchars($_POST['first_name']);
    $middleName = htmlspecialchars($_POST['middle_name']);
    $lastName = htmlspecialchars($_POST['last_name']);
    $mobilePhone = htmlspecialchars($_POST['mobile_phone']);
    $emailAddress = htmlspecialchars($_POST['email_address']);
    $address1 = htmlspecialchars($_POST['address1']);
    $city = htmlspecialchars($_POST['city']);
    $postalCode = htmlspecialchars($_POST['postal_code']);
    $checkinDate = htmlspecialchars($_POST['checkin_date']);
    $checkoutDate = htmlspecialchars($_POST['checkout_date']);
    $timeSelection = htmlspecialchars($_POST['time_selection']);
    
    // Payment data
    $totalPrice = isset($_POST['total_price']) ? htmlspecialchars($_POST['total_price']) : 0;
    $downpaymentPrice = isset($_POST['downpayment_price']) ? htmlspecialchars($_POST['downpayment_price']) : 0;
    $multipleDaysTotalPrice = isset($_POST['multiple_days_total_price']) ? htmlspecialchars($_POST['multiple_days_total_price']) : 0;

    // Debug statements to check values
    echo "Check-in Date: " . htmlspecialchars($_POST['checkin_date']) . "<br>";
    echo "Check-out Date: " . htmlspecialchars($_POST['checkout_date']) . "<br>";
    echo "Time: " . htmlspecialchars($time_selection) . "<br>";
    echo "Total Payment: " . htmlspecialchars($totalPrice) . "<br>";
    echo "Downpayment: " . htmlspecialchars($downpaymentPrice) . "<br>";
    echo "Multiple Days Total Price: " . htmlspecialchars($multipleDaysTotalPrice) . "<br>";

    $numSmallRooms = htmlspecialchars($_POST['num_small_rooms']);
    $numBigRooms = htmlspecialchars($_POST['num_big_rooms']);

    // Handle file upload
    $paymentScreenshot = '';
    if (isset($_FILES['payment_screenshot']) && $_FILES['payment_screenshot']['error'] == UPLOAD_ERR_OK) {
        $uploadDir = 'uploads/';
        $uploadFile = $uploadDir . basename($_FILES['payment_screenshot']['name']);
        if (move_uploaded_file($_FILES['payment_screenshot']['tmp_name'], $uploadFile)) {
            $paymentScreenshot = basename($_FILES['payment_screenshot']['name']);
        } else {
            echo "<p>Error uploading file.</p>";
        }
    }

    // Prepare SQL query
    $query = "INSERT INTO bookings (prefix, first_name, middle_name, last_name, mobile_phone, email_address, address1, city, postal_code, checkin_date, checkout_date, num_small_rooms, num_big_rooms, payment_screenshot, time_selection, total_price, downpayment_price, multiple_days_total_price) 
              VALUES (:prefix, :first_name, :middle_name, :last_name, :mobile_phone, :email_address, :address1, :city, :postal_code, :checkin_date, :checkout_date, :num_small_rooms, :num_big_rooms, :payment_screenshot, :time_selection, :total_price, :downpayment_price, :multiple_days_total_price)";

    try {
        $stmt = $pdo->prepare($query);
        $stmt->execute([
            'prefix' => $prefix,
            'first_name' => $firstName,
            'middle_name' => $middleName,
            'last_name' => $lastName,
            'mobile_phone' => $mobilePhone,
            'email_address' => $emailAddress,
            'address1' => $address1,
            'city' => $city,
            'postal_code' => $postalCode,
            'checkin_date' => $checkinDate,
            'checkout_date' => $checkoutDate,
            'num_small_rooms' => $numSmallRooms,
            'num_big_rooms' => $numBigRooms,
            'payment_screenshot' => $paymentScreenshot,
            'time_selection' => $timeSelection,
            'total_price' => $totalPrice,
            'downpayment_price' => $downpaymentPrice,
            'multiple_days_total_price' => $multipleDaysTotalPrice
        ]);
        echo "<p>Booking confirmed. Total Payment: " . htmlspecialchars($totalPrice) . " Pesos</p>";
    } catch (PDOException $e) {
        echo "<p>Error: " . $e->getMessage() . "</p>";
    }

    // Redirect after successful submission
    header(header: "Location: booking.php");
    exit();
}
?>
