<?php
require "../../Security/all.php";
require "../../Redirect/all.php";
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>change</title>
    <link rel="stylesheet" href="CSS/content-2.css">
</head>
<body>
    <?php require "../../Layouts/header.php" ?>
    <?php
        function h($str){
            return htmlspecialchars($str,ENT_QUOTES,'UTF-8');
        }
        $prefecture=h($_GET["prefecture"]);
        $place=h($_GET["place"]);
        $contents=h($_GET["contents"]);
        $tag=h($_GET["tag"]);
        $img=h($_GET["img"]);
        $num=h($_GET["num"]);
    ?>
    <h2 class="subtitle">＊編集＊</h2>
    <form action="content-3.php" method="GET">   
        <p class="smalltitle">以下の内容で投稿します<br>宜しければ変更してください。</p>
        <div class="box">
            <p><img src="../../images/<?php echo $img ?>"></p>
            <h3>都道府県</h3>
            <p><?php echo $prefecture ?><p>
            <input type="hidden" name="prefecture" value="<?php echo $prefecture ?>">
            <h3>観光地名称</h3>
            <p><?php echo $place ?><p>
            <input type="hidden" name="place" value="<?php echo $place ?>">
            <h3>コメント</h3>
            <p><?php echo $contents ?><p>
            <input type="hidden" name="contents" value="<?php echo $contents ?>">
            <input type="hidden" name="num" value="<?php echo $num ?>">
        </div>
        <div class="flex_box">
            <input class="btn_s" type="button" value="内容を修正する" onclick="history.back(-1)">
            <button class="submit" type="submit" name="add">変更</button>
        </div>
        <input type="hidden" name="name" value="<?php echo $name;?>">
        <input type="hidden" name="password" value="<?php echo $password;?>">
        <input type="hidden" name="address" value="<?php echo $address;?>">
        <input type="hidden" name="id" value="<?php echo $id;?>">
        <input type="hidden" name="tel" value="<?php echo $tel;?>">
    </form>
    <?php require "../../Layouts/footer.php" ?>
    <script src="JS/content-2.js"></script>
</body>
</html>