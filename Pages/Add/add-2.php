<?php
require "../../Security/all.php";
require "../../Redirect/all.php";

require "../../Config/db.php";

if (!empty($_FILES)) {
    $filename = $_FILES['upload_image']['name'];
    $uploaded_path = '../../images/' . $filename;
    $result = move_uploaded_file($_FILES['upload_image']['tmp_name'], $uploaded_path);

    if ($result) {
        list($width, $height) = getimagesize($uploaded_path);
        $maxSize = 1; 
        $targetWidth = $width;
        $targetHeight = $height;

        while (filesize($uploaded_path) > $maxSize * 1024) {
            $targetWidth *= 0.6;
            $targetHeight *= 0.6;
            $image = imagecreatetruecolor($targetWidth, $targetHeight);

            switch (strtolower(pathinfo($filename, PATHINFO_EXTENSION))) {
                case 'jpg':
                case 'jpeg':
                    $srcImage = imagecreatefromjpeg($uploaded_path);
                    break;
                case 'png':
                    $srcImage = imagecreatefrompng($uploaded_path);
                    break;
                default:
                    echo "サポートされていないファイル形式です。";
                    exit;
            }

            imagecopyresampled($image, $srcImage, 0, 0, 0, 0, $targetWidth, $targetHeight, $width, $height);
            $webp_path = '../../images/' . pathinfo($filename, PATHINFO_FILENAME) . '.webp';
            imagewebp($image, $webp_path, 1); 
            imagedestroy($image); 
            imagedestroy($srcImage); 
            unlink($uploaded_path);
            $filename = pathinfo($filename, PATHINFO_FILENAME) . '.webp';
            $uploaded_path = $webp_path;
            break; 
        }
    } else {
        echo 'アップロード失敗！エラーコード：' . $_FILES['upload_image']['error'];
    }
} else {
    echo '画像を選択してください';
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>add</title>
    <link rel="stylesheet" href="CSS/add-2.css">
</head>
<body>
    <?php require "../../Layouts/header.php" ?>
    <h2 class="subtitle">＊新規投稿＊</h2>
    <section class="box">
         <p>投稿ありがとうございます。</p><br>
         <button class="submit" onclick="location.href='../Index/home.php'">ホームに戻る</button>
    </section>
    <?php
    function h($str){
        return htmlspecialchars($str,ENT_QUOTES,'UTF-8');
    }
    date_default_timezone_set('Asia/Tokyo');
    $created_at = date("Y-m-d H:i:s");
    $id = null;
    $name = h($_POST["name"]);
    $contents = h($_POST["contents"]);
    $place = h($_POST["place"]);
    $prefecture = h($_POST["prefecture"]);
    
    $pdo = new PDO($dsn,$user,$password,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET `utf8`"));
    $regist = $pdo->prepare("INSERT INTO japantravel(id, name, contents, created_at, place, prefecture, filename) VALUES (:id,:name,:contents,:created_at,:place,:prefecture,:filename)");
    $regist->bindParam(":id", $id);
    $regist->bindParam(":name", $name);
    $regist->bindParam(":contents", $contents);
    $regist->bindParam(":place", $place);
    $regist->bindParam(":prefecture", $prefecture);
    $regist->bindParam(":created_at", $created_at);
    $regist->bindParam(":filename", $filename);
    $regist->execute();
    
    require "../../Layouts/footer.php"; ?>
    <script src="JS/add-2.js"></script>
</body>
</html>