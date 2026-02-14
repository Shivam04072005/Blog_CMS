<?php
include_once("connection.php");

header("Content-Type: application/json");

try {

    $query = $conn->prepare("
        SELECT id, title, author, category, date_created, content 
        FROM posts 
        ORDER BY date_created DESC
    ");

    $query->execute();
    $posts = $query->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($posts);

} catch (PDOException $e) {

    echo json_encode([
        "status" => "error",
        "message" => "Failed to fetch posts"
    ]);

}
?>
