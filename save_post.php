<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "blog_db";  // Your database name

// Create DB connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form POST values
$title = $_POST['title'];
$author = $_POST['author'];
$category = $_POST['category'];
$content = $_POST['content'];

// Auto-generate date string
date_default_timezone_set("Asia/Kolkata");

$date_created = date("Y-m-d H:i:s");
// Now this gives the correct Indian date/time


// SQL Query matching your table
$sql = "INSERT INTO posts (title, author, category, content, date_created) 
        VALUES (?, ?, ?, ?, ?)";

// Prepare statement
$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}

// Bind parameters (5 strings)
$stmt->bind_param("sssss", $title, $author, $category, $content, $date_created);

// Execute
if ($stmt->execute()) {
    echo "<script>alert('Post saved successfully!'); window.location.href='index.php';</script>";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();

?>
