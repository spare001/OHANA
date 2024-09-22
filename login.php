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

// Start the session
session_start();

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check if the user exists
    $stmt = $pdo->prepare("SELECT password FROM users WHERE username = :username");
    $stmt->execute(['username' => $username]);
    $hashedPassword = $stmt->fetchColumn();

    if ($hashedPassword && password_verify($password, $hashedPassword)) {
        // Successful login
        $_SESSION['loggedin'] = true; // Set session variable
        $_SESSION['username'] = $username; // Store username in session
        header("Location: admin.php"); // Redirect to admin page
        exit();
    } else {
        $error = "Invalid username or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh; /* Full viewport height */
            margin: 0; /* Remove default margin */
        }
        .login-container {
            max-width: 400px; /* Adjust width as needed */
            width: 100%; /* Full width up to max-width */
        }
        .input-group-text {
            cursor: pointer;
        }
    </style>
</head>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh; /* Full viewport height */
            margin: 0; /* Remove default margin */
        }
        .login-container {
            max-width: 400px; /* Adjust width as needed */
            width: 100%; /* Full width up to max-width */
        }
        .input-group-text {
            cursor: pointer;
        }
        .btn-orange {
            background-color: orange; /* Set background color */
            border-color: orange; /* Set border color */
            color: black; /* Set text color */
        }
        .btn-orange:hover {
            background-color: darkorange; /* Darker shade on hover */
            border-color: darkorange; /* Darker shade on hover */
        }
    </style>
</head>
<body>
<div class="login-container mt-5">
    <h2 class="text-center">Login</h2>
    <?php if (isset($error)): ?>
        <div class="alert alert-danger mt-5" role="alert">
            <?php echo $error; ?>
        </div>
    <?php endif; ?>
    <form method="POST" action="">
        <div class="mb-2">
            <label for="username" class="form-label">Username</label>
        </div>
        <input type="text" class="form-control mb-3" id="username" name="username" required>

        <div class="mb-2">
            <label for="password" class="form-label">Password</label>
        </div>
        <div class="input-group">
            <input type="password" class="form-control" id="password" name="password" required>
            <span class="input-group-text" id="togglePassword">
                <i class="fas fa-eye" id="eyeIcon"></i>
            </span>
        </div>
        
        <button type="submit" class="btn btn-orange w-100 mt-5">Login</button> <!-- Changed class to btn-orange -->
    </form>
</div>

<script>
    const togglePassword = document.getElementById('togglePassword');
    const passwordInput = document.getElementById('password');
    const eyeIcon = document.getElementById('eyeIcon');

    togglePassword.addEventListener('mousedown', function () {
        passwordInput.setAttribute('type', 'text');
        eyeIcon.classList.add('fa-eye-slash');
    });

    togglePassword.addEventListener('mouseup', function () {
        passwordInput.setAttribute('type', 'password');
        eyeIcon.classList.remove('fa-eye-slash');
    });

    // For mobile devices
    togglePassword.addEventListener('touchstart', function () {
        passwordInput.setAttribute('type', 'text');
        eyeIcon.classList.add('fa-eye-slash');
    });

    togglePassword.addEventListener('touchend', function () {
        passwordInput.setAttribute('type', 'password');
        eyeIcon.classList.remove('fa-eye-slash');
    });
</script>
</body>
</html>
