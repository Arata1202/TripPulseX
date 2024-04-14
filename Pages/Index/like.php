<?php
require "../../Security/all.php";
require "../../Redirect/all.php";
require "../../Config/db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_name = $_SESSION['user']; 
    $post_id = $_POST['post_id'];
    $like = filter_var($_POST['like'], FILTER_VALIDATE_BOOLEAN); 
    $dbh = new PDO($dsn, $user, $password);
    if ($like) {
        $stmt = $dbh->prepare("INSERT INTO good_list (user_name, post_id) VALUES (?, ?) ON DUPLICATE KEY UPDATE user_name = user_name");
    } else {
        $stmt = $dbh->prepare("DELETE FROM good_list WHERE user_name = ? AND post_id = ?");
    }
    $stmt->execute([$user_name, $post_id]);
    $stmt = $dbh->prepare("UPDATE japantravel SET likes = (SELECT COUNT(*) FROM good_list WHERE post_id = ?) WHERE id = ?");
    $stmt->execute([$post_id, $post_id]);
    $stmt = $dbh->prepare("SELECT COUNT(*) FROM good_list WHERE post_id = ?");
    $stmt->execute([$post_id]);
    $likes = $stmt->fetchColumn();
    echo json_encode(['success' => true, 'likes' => $likes]);
    exit();
}