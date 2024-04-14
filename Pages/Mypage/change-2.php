<?php
require "../../Security/all.php";
require "../../Redirect/all.php";

if (isset($_POST["csrf_token"]) && $_POST["csrf_token"] === $_SESSION['csrf_token']) {
    //
} else {
    header('Location: login-1.php');
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>change</title>
    <link rel="stylesheet" href="CSS/change-2.css">
</head>
<body>
    <?php require "../../Layouts/header.php";
    function h($str){
        return htmlspecialchars($str,ENT_QUOTES,'UTF-8');
    }
    $name=h($_POST["name"]);
    $id=h($_POST["id"]);
    $address=h($_POST["address"]);
    $tel=h($_POST["tel"]);
    $password=h($_POST["password"]);
    $csrf_token=h($_POST["csrf_token"]);
    ?>
    <h2 class="subtitle">＊登録情報変更＊</h2>
    <form action="change-3.php" method="post">   
    <input type="hidden" name="csrf_token" value="<?=$csrf_token?>">
        <p>内容をご確認の上、<br>宜しければ登録してください。</p>
        <div class="box">
            <h3>氏名</h3>
            <p><?php echo $name ?><p>
            <h3>メールアドレス</h3>
            <p><?php echo $address ?><p>
            <h3>会員ID</h3>
            <p><?php echo $id ?><p>
            <h3>パスワード</h3>
            <p>表示されません<p>
            <h3>電話番号</h3>
           <p><?php echo $tel ?><p>
        </div>
        <div class="flex_box">
            <input class="btn_s" type="button" value="内容を修正する" onclick="history.back(-1)">
            <button class="submit" type="submit" name="add">登録する</button>
        </div>
        <input type="hidden" name="name" value="<?php echo $name;?>">
        <input type="hidden" name="password" value="<?php echo $password;?>">
        <input type="hidden" name="address" value="<?php echo $address;?>">
        <input type="hidden" name="id" value="<?php echo $id;?>">
        <input type="hidden" name="tel" value="<?php echo $tel;?>">
    </form>
    <?php require "../../Layouts/footer.php" ?>
    <script src="JS/change-2.js"></script>
</body>
</html>