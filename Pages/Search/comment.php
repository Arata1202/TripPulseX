<?php
require "../../Security/all.php";
require "../../Redirect/all.php";
require "../../Config/db.php";

function h($str){
    return htmlspecialchars($str,ENT_QUOTES,'UTF-8');
}
$id=h($_GET["id"]);
$name=h($_GET["name"]);
$filename=h($_GET["filename"]);
$csrf_token=h($_GET["csrf_token"]);
$name = $_SESSION['user'];

if (!empty($_GET["comment"])) {
    $comment = h($_GET["comment"]); 
    try {
        $dbh = new PDO($dsn, $user, $password);
        $stmt = $dbh->prepare("INSERT INTO comment(id, name, comment, created_at) VALUES (:id, :name, :comment, NOW())");
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':comment', $comment);
        $stmt->execute();
    } catch (PDOException $e) {
        echo "エラーが発生しました：" . $e->getMessage();
    }
}
$pdo = new PDO($dsn,$user,$password,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET `utf8`"));
$stmt = $pdo->prepare("SELECT * FROM comment WHERE id = '$id' && name = '$name' order by created_at DESC limit 50");
$stmt->execute();

$pdo = new PDO($dsn,$user,$password,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET `utf8`"));
$regist = $pdo->prepare("SELECT * FROM comment WHERE id = '$id' order by created_at DESC limit 50");
$regist->execute();
?>
<!DOCTYPE html>
<html lang="ja">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>comment</title>
    <link rel="stylesheet" href="CSS/comment.css">
</head>
<body>
    <?php require "../../Layouts/header.php" ?>
    <div class="box">
        <h2 class="subtitle">＊コメント＊</h2>
        <div class="urls">
        <form action="detail.php" method="POST">
            <input type="hidden" name="num" value="<?php echo $id ?>">
            <input class="btn-s" type="submit" value="戻る">
        </form>
        </div>  
        <img src="../../images/<?php echo $filename?>" alt="" style="width:100%;">
        <h3>コメントする</h3>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="GET" onsubmit="return validateForm();">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <input type="hidden" name="filename" value="<?php echo $filename; ?>">
            <input type="text" name="comment" id="comment" value="" size="30" style="height:25px;">
            <p id="commentError" class="error-message" style="color: red;"></p>
            <input class="submit" type="submit" value="投稿">
        </form>
        <h3>あなたのコメント</h3>
        <?php foreach ($stmt as $loop): ?>
            <?php $comment = $loop['comment']; ?>
            <table>
                <tr>
                    <td class="first"><?php echo $loop['name']; ?></td>
                    <td class="second">&nbsp;<?php echo $loop['created_at']; ?></td>
                    <td class="third">
                        <form action="comment-del.php" method="GET">
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <input type="hidden" name="name" value="<?php echo $name; ?>">
                            <input type="hidden" name="comment" value="<?php echo $comment; ?>">
                            <input type="hidden" name="filename" value="<?php echo $filename; ?>">
                            <input class="ok" type="submit" value="削除">
                        </form>
                    </td>
                </tr>
                <tr>
                    <td colspan="3"><?php echo $loop['comment']; ?></td>
                </tr>
                <hr>
            </table>
        <?php endforeach ?>  
        <hr>
        <?php
        if (!isset ($comment )){
            echo "<p>コメントはまだありません</p>";
            echo "<hr>";
        }
        ?>
        <h3>みんなのコメント</h3>       
        <?php foreach ($regist as $loop): ?>
            <?php $comment_s = $loop['comment']; ?>
            <table class="last">
                <tr>
                    <td class="first"><?php echo $loop['name']; ?></td>
                    <td class="second">&nbsp;<?php echo $loop['created_at']; ?></td>
                    <td class="third"></td>
                </tr>
                <tr>
                    <td colspan="3"><?php echo $loop['comment']; ?></td>
                </tr>
                <hr>
            </table>
        <?php endforeach ?>
        <hr>
        <?php
        if (!isset ($comment_s)){
            echo "<p>コメントはまだありません</p>";
            echo "<hr>";
        }
        ?>  
    </div>
    <?php require "../../Layouts/footer.php" ?>
    <script src="../../Validation/comment.js"></script>
    <script src="JS/comment.js"></script>
</body>
</html>