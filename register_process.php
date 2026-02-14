<?php 
session_start();
include_once("connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $fname    = trim($_POST['fname']);
    $username = trim($_POST['username']);
    $email    = trim($_POST['email']);
    $passw    = $_POST['password'];
    $cpassw   = $_POST['confirm_password'];

    date_default_timezone_set("Asia/Kolkata");
    $date_created = date("Y-m-d H:i:s");

    // Check password match
    if ($passw != $cpassw) {
        die("Passwords do not match!");
    }

    $hashed_password =$passw;

    // Generate 11-character ID
    function generateUserId($length = 11) {
        return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
    }

    $user_id = generateUserId();

    try {

        $sql = "INSERT INTO users (id, full_name, username, email, password, date_created) 
                VALUES (?, ?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($sql);

        $stmt->execute(array(
            $user_id,
            $fname,
            $username,
            $email,
            $hashed_password,
            $date_created
        ));

        header("Location: index.php");
        exit();

    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
