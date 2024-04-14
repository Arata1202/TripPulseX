<?php
require "../../Security/all.php";
require "../../Redirect/all.php";
require "../../Config/db.php";

function h($str){
    return htmlspecialchars($str,ENT_QUOTES,'UTF-8');
}
//変数定義
date_default_timezone_set('Asia/Tokyo');
$created_at=date("Y-m-d H:i:s");
$name = $_POST['users'];
$id=h($_POST["id"]);
$num=h($_POST["num"]);
$comment=h($_POST['comment']);
$filename=h($_POST["filename"]);
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>comment</title>
    <link rel="stylesheet" href="CSS/comment-add.css">
</head>
<body>
    <?php require "../../Layouts/footer.php" ?>
    <h2 class="subtitle">＊コメント＊</h2>
    <p>コメントを投稿しました。</p>
    <form action="yourcomment.php" method="GET">
        <input type="hidden" name="num" value="<?php echo $num ?>">
        <input type="hidden" name="name" value="<?php echo $loop['name'] ?>">
        <input type="hidden" name="id" value="<?php echo $id ?>">
        <input type="hidden" name="filename" value="<?php echo $filename ?>">
        <input class="submit" type="submit" value="コメントを見る">
    </form>
    <?php
    if (isset($_POST["comment"])) {
        $dbh = new PDO($dsn,$user,$password);
        $stmt = $dbh->prepare("INSERT INTO comment(id, name, comment, created_at) VALUES (:id,:name,:comment,:created_at)");
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':comment', $comment);
        $stmt->bindParam(':created_at', $created_at);
        $stmt->execute();
    } 
    ?>
    <?php require "../../Layouts/footer.php" ?>
</body>
</html>