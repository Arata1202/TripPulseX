<?php
require "../../Security/all.php";
require "../../Redirect/all.php";
require "../../Config/db.php";

function h($str){
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}
$name = $_SESSION['user'];
$id = isset($_GET["id"]) ? h($_GET["id"]) : "";
$filename = isset($_GET["filename"]) ? h($_GET["filename"]) : "";
$comment = isset($_GET['comment']) ? h($_GET['comment']) : "";

if (!empty($comment)) {
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
try {
    $pdo = new PDO($dsn, $user, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET `utf8`"));
    $stmt = $pdo->prepare("SELECT * FROM comment WHERE id = :id AND name = :name ORDER BY created_at DESC LIMIT 50");
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':name', $name);
    $stmt->execute();
    $user_comments = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $stmt = $pdo->prepare("SELECT * FROM comment WHERE id = :id ORDER BY created_at DESC LIMIT 50");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $all_comments = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "エラーが発生しました：" . $e->getMessage();
}
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
            <button class="btn-s" onclick="location.href='home.php#n<?php echo $id ?>'">戻る</button>
        </div>
        <img src="../../images/<?php echo $filename; ?>" alt="" style="width:100%;">
        <h3>コメントする</h3>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="GET" onsubmit="return validateForm();">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <input type="hidden" name="filename" value="<?php echo $filename; ?>">
            <input type="text" id="comment" name="comment" value="" size="30" style="height:25px;">
            <p id="commentError" class="error-message" style="color: red;"></p>
            <input class="submit" type="submit" value="投稿">
        </form>
        <h3>あなたのコメント</h3>
        <?php foreach ($user_comments as $comment): ?>
            <table>
                <tr>
                    <td class="first"><?php echo $comment['name']; ?></td>
                    <td class="second">&nbsp;<?php echo $comment['created_at']; ?></td>
                    <td class="third">
                        <form action="comment-del.php" method="GET">
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <input type="hidden" name="name" value="<?php echo $name; ?>">
                            <input type="hidden" name="comment" value="<?php echo $comment['comment']; ?>">
                            <input type="hidden" name="filename" value="<?php echo $filename; ?>">
                            <input class="ok" type="submit" value="削除">
                        </form>
                    </td>
                </tr>
                <tr>
                    <td colspan="3"><?php echo $comment['comment']; ?></td>
                </tr>
                <hr>
            </table>
        <?php endforeach ?>  
        <hr>
        <?php if (empty($user_comments)): ?>
            <p>コメントはまだありません</p>
            <hr>
        <?php endif ?>
        <h3>みんなのコメント</h3>       
        <?php foreach ($all_comments as $comment): ?>
            <table>
                <tr>
                    <td class="first"><?php echo $comment['name']; ?></td>
                    <td class="second">&nbsp;<?php echo $comment['created_at']; ?></td>
                    <td class="third"></td>
                </tr>
                <tr>
                    <td colspan="3"><?php echo $comment['comment']; ?></td>
                </tr>
                <hr>
            </table>
        <?php endforeach ?>
        <hr>
        <?php if (empty($all_comments)): ?>
            <p>コメントはまだありません</p>
            <hr>
        <?php endif ?>    
    </div>
    <?php require "../../Layouts/footer.php" ?>
    <script src="../../Validation/comment.js"></script>
    <script src="JS/comment.js"></script>
</body>
</html>
