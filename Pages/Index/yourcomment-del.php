<?php
require "../../Security/all.php";
require "../../Redirect/all.php";
require "../../Config/db.php";

 function h($str){
     return htmlspecialchars($str,ENT_QUOTES,'UTF-8');
 }
 $id = h($_GET["id"]);
 $name = $_SESSION['user'];
 $comment = h($_GET['comment']);
 $filename = h($_GET['filename']);
 $csrf_token=h($_GET["csrf_token"]);

$pdo = new PDO($dsn,$user,$password,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET `utf8`"));
$regist = $pdo->prepare("DELETE FROM comment WHERE id = '$id' && name = '$name' && comment = '$comment'");
$regist->execute();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>comment</title>
    <link rel="stylesheet" href="CSS/comment-del.css">
</head>
<body>
    <?php require "../../Layouts/header.php" ?>
    <h2 class="subtitle">＊コメント＊</h2>
    <p>コメントを削除します。</p>
    <form action="yourcomment.php" method="GET">
        <input class="btn_s" type="button" value="戻る" onclick="history.back(-1)">
        <input type="hidden" name="id" value="<?php echo $id ?>">
        <input type="hidden" name="name" value="<?php echo $name ?>">
        <input type="hidden" name="filename" value="<?php echo $filename ?>">
        <input class="submit" type="submit" value="削除">
    </form>
    <?php require "../../Layouts/footer.php" ?>
    <script src="JS/comment-del.js"></script>
</body>
</html>