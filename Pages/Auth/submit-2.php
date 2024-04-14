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
    <link rel="stylesheet" href="CSS/submit-2.css">
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
    $pass=h($_POST["password"]);
    $check_password=h($_POST["check_password"]);
    $csrf_token = h($_POST["csrf_token"]);

    if (!empty($_POST["name"])){
        if (mb_strlen($name) <= 20){
            //
        } else {
            print "<h2>＊新規会員登録＊</h2><h3>氏名は20字以内で入力してください</h3>";
            exit;
        }
    } else {
        //
    }
    if (!empty($address)) {
        //
    } else {
        print "<h2>＊新規会員登録＊</h2><h3>メールアドレスを入力してください</h3>";
        exit;
    }
    if (strpos($address, '@')) {
        //
    } else{
        print "<h2>＊新規会員登録＊</h2><h3>@を忘れずに入力してください</h3>";
        exit;
    }
    if (!empty(explode('@', $address)[1])) {
        //
    } else { 
        print "<h2>＊新規会員登録＊</h2><h3>@の後ろにドメイン名を入力してください</h3>";
        exit;
    }
    if (filter_var($address, FILTER_VALIDATE_EMAIL)) {
            //
        } else {
            print "<h2>＊新規会員登録＊</h2><h3>このメールアドレスは有効ではありません</h3>";
            exit;
    }
    if (empty($id)) {
        print "<h2>＊新規会員登録＊</h2><h3>会員IDを入力してください</h3>";
        exit;
    }
    if (mb_strlen($id) <= 12){
        //
    } else {
        print "<h2>＊新規会員登録＊</h2><h3>会員IDは12字以内で入力してください</h3>";
        exit;
    }
    if (!ctype_alnum($id)) {
        print "<h2>＊新規会員登録＊</h2><h3>会員IDはアルファベットか数字で入力してください</h3>";
        exit;
    } 
    if (empty($pass)) {
        print "<h2>＊新規会員登録＊</h2><h3>パスワードを入力してください</h3>";
        exit;
    }
    if (strlen($pass) < 8) {
        print "<h2>＊新規会員登録＊</h2><h3>パスワードは8字以上である必要があります</h3>";
        exit;
    }
    if (strlen($pass) > 30) {
        print "<h2>＊新規会員登録＊</h2><h3>パスワードは30字以下である必要があります</h3>";
        exit;
    }
    if (!preg_match('/[a-z]/', $pass)) {
        print "<h2>＊新規会員登録＊</h2><h3>パスワードは小文字を含んでいる必要があります</h3>";
        exit;
    }
    if (!preg_match('/[A-Z]/', $pass)) {
        print "<h2>＊新規会員登録＊</h2><h3>パスワードは大文字を含んでいる必要があります。</h3>";
        exit;
    }
    if (!preg_match('/\d/', $pass)) {
        print "<h2>＊新規会員登録＊</h2><h3>パスワードは数字を含んでいる必要があります。</h3>";
        exit;
    }
    if (empty($check_password)) {
        print "<h2>＊新規会員登録＊</h2><h3>確認用パスワードを入力してください</h3>";
        exit;
    }
    if ($pass !== $check_password) {
        print "<h2>＊新規会員登録＊</h2><h3>確認用パスワードが一致しません</h3>";
        exit;
    }

    $pdo = new PDO($dsn_s,$user,$password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET `utf8`"));
    $stmtEmail = $pdo->prepare("SELECT COUNT(*) FROM user WHERE address = :email");
    $stmtEmail->bindParam(':email', $address, PDO::PARAM_STR);
    $stmtEmail->execute();
    $countEmail = $stmtEmail->fetchColumn();
    $stmtId = $pdo->prepare("SELECT COUNT(*) FROM user WHERE id = :id");
    $stmtId->bindParam(':id', $id, PDO::PARAM_STR);
    $stmtId->execute();
    $countId = $stmtId->fetchColumn();

    if ($countEmail > 0 && $countId > 0) {
        print "<h2>＊新規会員登録＊</h2><h3>このメールアドレスは既に登録されています</h3>";
        exit;
    } elseif ($countEmail > 0) {
        print "<h2>＊新規会員登録＊</h2><h3>このメールアドレスは既に登録されています</h3>";
        exit;
    } elseif ($countId > 0) {
        print "<h2>＊新規会員登録＊</h2><h3>この会員IDは既に登録されています</h3>";
        exit;
    }    
    ?>
    <div class="box">
        <form action="submit-3.php" method="post">   
            <h2 class="subtitle">＊新規会員登録＊</h2>
            <p class="smalltitle">内容をご確認の上、<br>宜しければ登録してください。</p>
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
                <button class="urls" onclick="window.history.back();">内容を修正する</button>
                <button class="submit" type="submit" name="add">登録する</button>
            </div>
                <input type="hidden" name="csrf_token" value="<?=$csrf_token?>">
                <input type="hidden" name="name" value="<?php echo $name;?>">
                <input type="hidden" name="address" value="<?php echo $address;?>">
                <input type="hidden" name="password" value="<?php echo $pass;?>">
                <input type="hidden" name="id" value="<?php echo $id;?>">
                <input type="hidden" name="tel" value="<?php echo $tel;?>">
        </form>   
    </div> 
    <script src="JS/submit-2.js"></script>
</body>
</html>