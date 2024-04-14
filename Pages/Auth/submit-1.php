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
    <title>submit</title>
    <link rel="stylesheet" href="CSS/submit-1.css">
</head>
<body>
    <?php require "../../Layouts/header.php" ?>

    <h2 class="subtitle">＊新規会員登録＊</h2>
    <div class="box">
        <form action="submit-2.php" method="post" onsubmit="return validateForm();">
        <input type="hidden" name="csrf_token" value="<?=$csrf_token?>">
            <div class="flex_box">    
                <div class="require">
                    <h3>氏名</h3><p class="black">(*任意)</p>
                </div>
                <input type="text" id="name" name="name" value="" size="30" placeholder="東洋　太郎" style="height:25px;">
                <p id="nameError" class="error-message" style="color: red;"></p>
                <div class="require">
                    <h3>メールアドレス</h3><p class="red">(*必須)</p>
                </div>
                <input type="text" id="email" name="address" value="" size="30" placeholder="example@example.jp" size="30" style="height:25px;">
                <p id="emailError" class="error-message" style="color: red;"></p>
                <div class="require">
                    <h3>会員ID</h3><p class="red">(*必須)</p>
                </div>
                <input type="text" id="id" name="id" value="" size="30" placeholder="example1234" size="30" style="height:25px;">
                <p id="idError" class="error-message" style="color: red;"></p>
                <div class="require">
                    <h3>パスワード</h3><p class="red">(*必須)</p>
                </div>
                <input type="password" id="password" name="password" value="" size="30" placeholder="Example1234" size="50" style="height:25px;">
                <p id="passwordError" class="error-message" style="color: red;"></p>
                <div class="require">
                    <h3>確認用パスワード</h3><p class="red">(*必須)</p>
                </div>
                <input type="password" id="check_password" name="check_password" value="" size="30" placeholder="Example1234" size="50" style="height:25px;">
                <p id="check_passwordError" class="error-message" style="color: red;"></p>
                <!-- スイッチ -->
                <div class="ball_switch">
                    <label class="switch">
                        <input type="checkbox" id="toggleSwitch" onclick="togglePasswordVisibility()">
                        <span class="slider round"></span>
                    </label>
                    <label for="toggleSwitch">パスワードを表示</label>
                </div>
                <div class="require">
                    <h3>電話番号</h3><p class="black">(*任意)</p>
                </div>
                <input type="tel" id="tel" name="tel" value="" size="30" placeholder="0120999888" size="30" style="height:25px;">
                <p id="telError" class="error-message" style="color: red;"></p>
                <br>
                <p><input class="submit" type="submit" name="submit" value="確認画面へ"></p>
            </div>
        </form>
        <div class="urls">
            <br><button onclick="location.href='login-1.php'">既にアカウントをお持ちの方はこちら</button>
        </div>
    </div>      
    <script src="JS/submit-1.js"></script>
    <script src="../../Validation/submit.js"></script>
</body>
</html>