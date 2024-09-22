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

// Fetch reserved bookings
$query = "SELECT checkin_date, checkout_date, time_selection FROM bookings";
$stmt = $pdo->prepare($query);
$stmt->execute();
$reserved = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Return data in JSON format
echo json_encode($reserved);
?>
