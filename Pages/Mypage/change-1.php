<?php
require "../../Security/all.php";
require "../../Redirect/all.php";
require "../../Config/db.php";

$toke_byte = openssl_random_pseudo_bytes(30);
$csrf_token = bin2hex($toke_byte);
$_SESSION['csrf_token'] = $csrf_token;
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
    <title>change</title>
    <link rel="stylesheet" href="CSS/change-1.css">
</head>
<body>
    <?php require "../../Layouts/header.php" ?>
    <h2 class="subtitle">＊登録情報変更＊</h2>
    <form action="change-2.php" method="POST" onsubmit="return validateForm();">
        <input type="hidden" name="csrf_token" value="<?php echo $csrf_token;?>">
        <?php foreach($stmt as $loop):?>
            <h3>氏名</h3>
            <input type="text" id="name" name="name" value="<?php echo $loop['name']?>" size="30" style="height:25px;">
            <p id="nameError" class="error-message" style="color: red;"></p>
            <h3>メールアドレス (変更不可)</h3>
            <?php echo $loop['address']?><input type="hidden" name="address" value="<?php echo $loop['address']?>">
            <h3>会員ID (変更不可)</h3>
            <?php echo $loop['id']?><input type="hidden" name="id" value="<?php echo $loop['id']?>">
            <h3>パスワード</h3>
            <input type="password" id="password" name="password" value="" size="30" style="height:25px;">
            <p id="passwordError" class="error-message" style="color: red;"></p>
            <h3>確認用パスワード</h3>
            <input type="password" id="check_password" name="check_password" value="" size="30" style="height:25px;">
            <p id="check_passwordError" class="error-message" style="color: red;"></p>
            <!-- スイッチ -->
            <div class="ball_switch">
                <label class="switch">
                    <input type="checkbox" id="toggleSwitch" onclick="togglePasswordVisibility()">
                    <span class="slider round"></span>
                </label>
                <label for="toggleSwitch">パスワードを表示</label>
            </div>
            <h3>電話番号</h3>
            <input type="int" id="tel" name="tel" value="<?php echo $loop['tel']?>" size="30" style="height:25px;">
            <p id="telError" class="error-message" style="color: red;"></p>
            <div class="urls">
                <button class="btn_s" type="button" onclick="history.back(-1)">戻る</button>
                <input class="submit" type="submit" value="確認画面">
            </div>           
    </form>
    <?php endforeach;?>
    <script src="../../Validation/change.js"></script>
    <?php require "../../Layouts/footer.php" ?>
    <script src="JS/change-1.js"></script>
</body>
</html>