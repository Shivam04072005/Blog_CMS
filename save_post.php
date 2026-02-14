<?php
session_start();
include_once("connection.php");

// Check login
if (!isset($_SESSION['user_id'])) {
    header("Location: loginpage.php");
    exit();
}

// Get values
$title = isset($_POST['title']) ? $_POST['title'] : '';
$category = isset($_POST['category']) ? $_POST['category'] : '';
$content = isset($_POST['content']) ? $_POST['content'] : '';

$author = $_SESSION['username'];

date_default_timezone_set("Asia/Kolkata");
$date_created = date("Y-m-d H:i:s");

// 🔥 Generate 11-character unique ID
function generatePostId($length = 11) {
    return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
}

$post_id = generatePostId();

try {

    $sql = "INSERT INTO posts (id, title, author, category, content, date_created) 
            VALUES (:id, :title, :author, :category, :content, :date_created)";

    $stmt = $conn->prepare($sql);

    $stmt->bindParam(':id', $post_id);
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':author', $author);
    $stmt->bindParam(':category', $category);
    $stmt->bindParam(':content', $content);
    $stmt->bindParam(':date_created', $date_created);

    $stmt->execute();

    header("Location: index.php");
    exit();

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
