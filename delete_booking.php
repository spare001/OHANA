<?php
// Include database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ohana";

try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Check if ID is set in the URL
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        
        // Prepare and execute the delete statement
        $stmt = $pdo->prepare("DELETE FROM bookings WHERE id = :id");
        $stmt->execute(['id' => $id]);

        // Redirect back to reservations.php after deletion
        header("Location: reservations.php");
        exit();
    }
} catch (PDOException $e) {
    die('Connection failed: ' . $e->getMessage());
}
?>
