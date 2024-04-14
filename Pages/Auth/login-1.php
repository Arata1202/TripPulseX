<?php
require "../../Security/all.php";

$toke_byte = openssl_random_pseudo_bytes(30);
$csrf_token = bin2hex($toke_byte);
$_SESSION['csrf_token'] = $csrf_token;
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>login</title>
    <link rel="stylesheet" href="CSS/login-1.css">
</head>
<body>
    <?php require "../../Layouts/auth-header.php" ?>

    <h2 class="subtitle">＊ログイン＊</h2>
    
    <!--入力フォーム-->
    <div class="box">
        <form action="login-2.php" method="post" onsubmit="return validateForm();">
            <input type="hidden" name="csrf_token" value="<?=$csrf_token?>">
            <div class="flex_box">
                <h3>メールアドレス</h3><p class="red">(*必須)</p>
            </div>
            <input type="text" id="email" name="user" size="30" placeholder="xyz123" style="height:25px;">
            <p id="emailError" class="error-message" style="color: red;"></p>
            <div class="flex_box">
                <h3>パスワード</h3><p class="red">(*必須)</p>
            </div>
            <input type="password" id="password" name="password" size="30" placeholder="Abc456" style="height:25px;">
            <p id="passwordError" class="error-message" style="color: red;"></p>
            <!-- スイッチ -->
            <div class="ball_switch">
                    <label class="switch">
                        <input type="checkbox" id="toggleSwitch" onclick="togglePasswordVisibility()">
                        <span class="slider round"></span>
                    </label>
                    <label for="toggleSwitch">パスワードを表示</label>
                </div>
            <br>
            <br><p><input class="submit" type="submit" value="ログイン"></p>
        </form>    
    </div>
    <div class="urls">
        <br><button onclick="location.href='submit-1.php'">新規会員登録はこちら</button>
    </div>

    <script src="JS/login-1.js"></script>
    <script src="../../Validation/login.js"></script>
</body>
</html>