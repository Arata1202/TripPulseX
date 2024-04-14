<?php
require "../../Security/all.php";
require "../../Redirect/all.php";

$toke_byte = openssl_random_pseudo_bytes(30);
$csrf_token = bin2hex($toke_byte);
$_SESSION['csrf_token'] = $csrf_token;
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>contact</title>
    <link rel="stylesheet" href="CSS/contact-1.css">
</head>
<body>
    <?php require "../../Layouts/header.php" ?>
    <h2 class="subtitle">＊お問い合わせ＊</h2>
    <div class="box">
        <form action="contact-2.php" method="post" onsubmit="return validateForm();">
            <input type="hidden" name="csrf_token" value="<?=$csrf_token?>">
            <div class="box_first">    
                <div class="require">
                    <h3>氏名</h3><p class="red">(*必須)</p>
                </div>
                <input type="text" name="name" id="name" value="" size="30" placeholder="東洋　太郎" style="height:25px;">
                <p id="nameError" class="error-message" style="color: red;"></p>
            </div>
            <div class="box_first"> 
                <div class="require">
                    <h3>メールアドレス</h3><p class="red">(*必須)</p>
                </div>
                <input type="text" name="email" value="" id="email" size="30" placeholder="example@example.jp" size="50" style="height:25px;">
                <p id="emailError" class="error-message" style="color: red;"></p>
                <div class="require">
                    <h3>題名</h3><p class="red">(*必須)</p>
                </div>
                <input type="text" name="title" id="title" value="" size="30" placeholder="題名を記入" style="height:25px;">
                <p id="titleError" class="error-message" style="color: red;"></p>
                <div class="require">
                    <h3>お問い合わせ内容</h3><p class="red">(*必須)</p>
                </div>
                <textarea name="contact_body" id="contact_body" value="" rows="7"  cols="30" placeholder="具体的な内容を記入"></textarea>
                <p id="contact_bodyError" class="error-message" style="color: red;"></p>
            </div>
            <p><input class="submit" type="submit" name="submit" value="確認画面へ"></p>
        </form>
    </div>     
    <?php require "../../Layouts/footer.php" ?>
    <script src="../../Validation/contact.js"></script>
    <script src="JS/contact-1.js"></script>
</body>
</html>