<?php
require "../../Security/all.php";

if (isset($_POST["csrf_token"]) && $_POST["csrf_token"] === $_SESSION['csrf_token']) {
    //
} else {
    header('Location: login-1.php');
}
require "../../Config/db.php";
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>login</title>
    <link rel="stylesheet" href="CSS/login-2.css">
    <?php

    function h($str){
        return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
    } 
    $member = h($_POST["user"]); 
    $raw_password = h($_POST["password"]); 
    
    if (!empty($member) && !empty($raw_password)) {
        if (!filter_var($member, FILTER_VALIDATE_EMAIL)) {
            print "<h2>＊ログイン＊</h2><h3>有効なメールアドレスを入力してください</h3>";
            exit;
        }
        $dbh = new PDO($dsn_s, $user, $password);
        $stmt = $dbh->prepare("SELECT * FROM user WHERE address=:user");
        $stmt->bindParam(':user', $member);
        $stmt->execute();
    
        if ($rows = $stmt->fetch()) {
            $hashed_password = $rows["password"];
            $hashed_input_password = password_hash($raw_password, PASSWORD_DEFAULT);

            if (password_verify($raw_password, $hashed_password)) {
                header('Location: ../Index/home.php');
                $_SESSION['user'] = $rows['id']; 
            } else {
                print "<h2>＊ログイン＊</h2><h3>パスワードが間違っています。<br>もう一度ログインしてください。</h3>";
            }
        } else {
            print "<h2>＊ログイン＊</h2><h3>ユーザーが存在しません<br>もう一度ログインしてください。</h3>";
        }
    } else {
        print "<h2>＊ログイン＊</h2><h3>メールアドレスとパスワードを入力してください。</h3>";
    }
?>
</head>
<body>
    <?php require "../../Layouts/header.php"; ?>
    <script src="JS/login-2.js"></script>
</body>
</html>