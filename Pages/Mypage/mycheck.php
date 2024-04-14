<?php
require "../../Security/all.php";
require "../../Redirect/all.php";
require "../../Config/db.php";

$session_user = $_SESSION['user'];

$pdo = new PDO($dsn_s,$user,$password,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET `utf8`"));
$stmt = $pdo->prepare("SELECT * FROM user WHERE id = '$session_user'");
$stmt->execute();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>mypage</title>
    <link rel="stylesheet" href="CSS/mycheck.css">
</head>
<body>
    <?php require "../../Layouts/header.php" ?>
    <h2 class="subtitle">＊登録情報＊</h2>
    <?php foreach($stmt as $loop):?>
    <h3>氏名</h3>
    <p><?php echo $loop['name']?></p>
    <h3>メールアドレス</h3>
    <p><?php echo $loop['address']?></p>
    <h3>会員ID</h3>
    <p><?php echo $loop['id']?></p>
    <h3>パスワード</h3>
    <p>表示されません</p>
    <h3>電話番号</h3>
    <p><?php echo $loop['tel']?></p>
    <?php endforeach;?>
    <div class="urls">
        <button class="btn_s" type="button" onclick="history.back(-1)">戻る</button>
        <button class="submit" onclick="location.href='change-1.php'">登録情報を変更する</button>
    </div>
    <?php require "../../Layouts/footer.php" ?>
    <script src="JS/mycheck.js"></script>
</body>
</html>