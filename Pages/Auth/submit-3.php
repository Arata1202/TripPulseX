<?php
require "../../Security/all.php";

if (isset($_POST["csrf_token"]) && $_POST["csrf_token"] === $_SESSION['csrf_token']) {
    //
} else {
    header('Location: submit-1.php');
}
require "../../Config/db.php";
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>submit</title>
    <link rel="stylesheet" href="CSS/submit-3.css">
</head>
<body>
    <?php require "../../Layouts/header.php";

    function h($str){
        return htmlspecialchars($str,ENT_QUOTES,'UTF-8');
    }
    $id = h($_POST["id"]);
    $name = h($_POST["name"]);
    $pass_before = h($_POST["password"]);
    $address = h($_POST["address"]);
    $tel = h($_POST["tel"]);
    $pass = password_hash($pass_before, PASSWORD_DEFAULT);

    $pdo = new PDO($dsn_s,$user,$password,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET `utf8`"));
    $regist = $pdo->prepare("INSERT INTO user(id, name, password, address, tel) VALUES (:id,:name,:password,:address,:tel)");
    $regist->bindParam(":id", $id);
    $regist->bindParam(":name", $name);
    $regist->bindParam(":password", $pass);
    $regist->bindParam(":address", $address);
    $regist->bindParam(":tel", $tel);
    $regist->execute();
    ?>
    <h2 class="subtitle">＊新規会員登録＊</h2>
    <p class="smalltitle">新規会員登録完了。<br>ログインページより、ログインしてください。</p>
    <div class="urls">
        <br><button onclick="location.href='login-1.php'">ログインページ</button>
    </div>
    <script src="JS/submit-3.js"></script>
</body>
</html>