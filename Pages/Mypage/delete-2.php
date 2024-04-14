<?php
require "../../Security/all.php";
require "../../Redirect/all.php";
require "../../Config/db.php";
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>delete</title>
    <link rel="stylesheet" href="CSS/delete-2.css">
</head>
<body>
    <?php require "../../Layouts/header.php";

        function h($str){
            return htmlspecialchars($str,ENT_QUOTES,'UTF-8');
        }
        $num = h($_GET["delete"]);

        $pdo = new PDO($dsn,$user,$password,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET `utf8`"));
        $regist = $pdo->prepare("DELETE FROM japantravel WHERE id = '$num'");
        $regist->execute();
    ?>
    <h2 class="subtitle">＊投稿の削除＊</h2>
    <p>投稿の削除が完了しました。</p>
    <div class="urls">
        <br><br><button onclick="location.href='mypage.php'">マイページへ戻る</button>
    </div>
    <?php require "../../Layouts/footer.php" ?>
    <script src="JS/delete-2.js"></script>
</body>
</html>