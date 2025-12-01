<?php
$host = "localhost";
$dbname = "blog_db";
$username = "root";
$password = "";

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $query = $conn->prepare("SELECT * FROM posts ORDER BY id DESC");
    $query->execute();

    $posts = $query->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($posts);
}
catch(PDOException $e) {
    echo json_encode([]);
}
?>
