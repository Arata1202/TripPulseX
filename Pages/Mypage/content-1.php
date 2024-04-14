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
    <title>change</title>
    <link rel="stylesheet" href="CSS/content-1.css">
</head>
<body>
    <?php require "../../Layouts/header.php" ?>
    <h2 class="subtitle">＊編集＊</h2>
    <?php
    $num = $_SESSION['num'];
    
    if (isset($_SESSION["num"])) {
        $pdo = new PDO($dsn,$user,$password,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET `utf8`"));
        $stmt = $pdo->prepare("SELECT * FROM japantravel WHERE id = '$num'");
        $stmt->execute();
    } else {    
        echo "error";
    }
    ?>
    <div class="box">
        <form action="content-2.php" method="GET" onsubmit="return validateForm();">
            <!--投稿番号-->
            <input type="hidden" name="num" value="<?php echo $num ?>">
            <?php foreach($stmt as $loop):?>
            <p><img src="../../images/<?php echo $loop['filename'];?>"></p>
            <h3>都道府県</h3>
            <p><input type="text" id="prefecture" name="prefecture" value="<?php echo $loop['prefecture']?>" size="30" style="height:25px;"></p>
            <p id="prefectureError" class="error-message" style="color: red;"></p>
            <h3>観光地名称</h3>
            <p id="spotError" class="error-message" style="color: red;"></p>
            <p><input type="text" id="spot" name="place" value="<?php echo $loop['place']?>" size="30" style="height:25px;"></p>
            <h3>コメント</h3>
            <p><textarea name="contents" id="contents" rows="5" cols="30"><?php echo $loop['contents']?></textarea></p>
            <p id="contentsError" class="error-message" style="color: red;"></p>
            <input type="hidden" name="img" value="<?php echo $loop['filename']?>">
            <div class="urls">
                <input class="btn_s" type="button" value="戻る" onclick="history.back(-1)">
                <button class="submit" type="submit">編集</button>
            </div>
            <?php endforeach;?>
        </form>
    </div>
    <?php require "../../Layouts/footer.php" ?>
    <script src="../../Validation/contents.js"></script>
    <script src="JS/content-1.js"></script>
</body>
</html>