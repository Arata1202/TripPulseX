<?php
require "../../Security/all.php";
require "../../Redirect/all.php";
require "../../Config/db.php";

$num = $_POST['num'];
$user_name = $_POST['user_name'];
$follow_name = $_POST['follow_name'];

try {
    $pdo = new PDO($dsn, $user, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET `utf8`"));

    $query = "SELECT COUNT(*) FROM follow WHERE user_name = :user_name AND follow_name = :follow_name";
    $stmt = $pdo->prepare($query);
    $stmt->execute(array(':user_name' => $user_name, ':follow_name' => $follow_name));
    $count = $stmt->fetchColumn();

    if ($count == 0) {
        $query = "INSERT INTO follow (user_name, follow_name) VALUES (:user_name, :follow_name)";
        $stmt = $pdo->prepare($query);
        $stmt->execute(array(':user_name' => $user_name, ':follow_name' => $follow_name));
        $isFollowing = true; // フォロー操作後、ユーザーはフォロー状態にある
    } else {
        $query = "DELETE FROM follow WHERE user_name = :user_name AND follow_name = :follow_name";
        $stmt = $pdo->prepare($query);
        $stmt->execute(array(':user_name' => $user_name, ':follow_name' => $follow_name));
        $isFollowing = false; // アンフォロー操作後、ユーザーは非フォロー状態にある
    }
    
    echo json_encode(['success' => true, 'isFollowing' => $isFollowing]);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
?>
