<?php
session_start();

// If already logged in, redirect to index.php
if (isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

// // Database connection (same as in index.php)
// $host = "localhost";
// $dbname = "blog_db";
// $username = "root";
// $password = "";

// $error = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $input_username = trim($_POST['username']);
    $input_password = $_POST['password'];

    try {
        include("connection.php");
        // Assuming a 'users' table with columns: id, username, email, password (hashed)
        $stmt = $conn->prepare("SELECT id, username, password FROM users WHERE username = ? OR email = ?");
        $stmt->execute([$input_username, $input_username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && $input_password==$user['password']) {
            // Login successful
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['logged_in']= true;
            header("Location: index.php");
            // echo "login successful";
            exit();
        } else {
            $error = "Invalid username/email or password.";
        }
    } catch (PDOException $e) {
        $error = "Database error: " . $e->getMessage();
    }
}
?>