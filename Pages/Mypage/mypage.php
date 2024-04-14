<?php
require "../../Security/all.php";
require "../../Redirect/all.php";
require "../../Config/db.php";

$sessionid = $_SESSION['user'];

$pdo = new PDO($dsn,$user,$password,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET `utf8`"));
$regist = $pdo->prepare("SELECT * FROM japantravel WHERE name = '$sessionid' order by created_at DESC limit 50");
$regist->execute();

$stmt = $pdo->prepare("SELECT * FROM japantravel WHERE name = '$sessionid' order by created_at DESC limit 50");
$stmt->execute();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>mypage</title>
    <link rel="stylesheet" href="CSS/mypage.css">
</head>
<body>
    <?php require "../../Layouts/header.php" ?>
    <h2 class="subtitle">＊マイページ＊</h2>
    <div class="top">
        <h2 style="color:deepskyblue;">ログイン中 : <?php echo $_SESSION['user'] ?></h2>
        <div class="urls">
            <br><br><button onclick="location.href='mycheck.php'">登録情報</button>
            <button class="out" onclick="location.href='logout.php'">ログアウト</button>
        </div>
    </div>
    <section class="box">
        <br><h3>投稿一覧</h3>
        <?php foreach($regist as $loop):
        $pic_num =  $loop['id'];
        ?>
        <table>
            <tr>
                <td width="40%"><img src="../../images/<?php echo $loop['filename']?>" alt="" width="100%"></td>
                <td width="45%"><?php echo $loop['prefecture']?><br><?php echo $loop['place']?><br>いいね : <?php echo $loop['likes']?>件<br><?php echo $loop['created_at']?></td>
            <form action="detail.php" method="GET">
                <input type="hidden" name="num" value="<?php echo $loop['id']; ?>">
                <td width="20%"><input class="submit" type="submit" name="submit" value="詳細"></td>
            </form>
        </tr>
        </table>
        <hr>
        <?php endforeach;?>
    </section> 
    <section class="pcbox">       
        <h3>投稿一覧</h3>
		<?php foreach($stmt as $loop):?>
            <div class="spot">
                 <p class="name"><b>&nbsp;<?php echo $loop['name']?></b></p>
                 <div class="prefecture">
                     <p><?php echo $loop['prefecture']?></p>
                     <p>&nbsp;<?php echo $loop['place']?>&nbsp;</p>
                 </div>
             </div>
             <img src="../../images/<?php echo $loop['filename']?>" loading="lazy" alt="" style="width:100%;">
             <div class="iine">
                 <div class="many">&nbsp;いいね！ : <?php echo $loop['likes']?>件</div>
             </div>
             <div class="message">&nbsp;<?php echo $loop['contents']?></div>
             <div class="contents">&nbsp;<?php echo $loop['created_at']?></div>
             <div class="urls">
                <form action="detail.php" method="GET">
                    <input type="hidden" name="num" value="<?php echo $loop['id']; ?>">
                    <input class="submit" type="submit" name="submit" value="詳細">
                </form>
             </div>
             <hr>
		<?php endforeach;?>
    </section>
    <?php require "../../Layouts/footer.php" ?>
    <script src="JS/mypage.js"></script>
</body>
</html>