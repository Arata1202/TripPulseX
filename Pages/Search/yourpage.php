<?php
require "../../Security/all.php";
require "../../Redirect/all.php";
require "../../Config/db.php";

$num = $_GET['num']; 
$name = $_GET['name'];
$sessionid = $_SESSION['user'];

$pdo = new PDO($dsn,$user,$password,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET `utf8`"));
$regist = $pdo->prepare("SELECT * FROM japantravel WHERE name = '$name' order by created_at DESC limit 50");
$regist->execute();

$stmt = $pdo->prepare("SELECT * FROM japantravel WHERE name = '$name' order by created_at DESC limit 50");
$stmt->execute();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>mypage</title>
    <link rel="stylesheet" href="CSS/yourpage.css">
</head>
<body>
    <?php require "../../Layouts/header.php" ?>  
    <h2 class="subtitle">＊ユーザーページ＊</h2>
    <div class="top">
        <h2 style="color:deepskyblue;">ユーザー : <?php echo $_GET['name']; ?></h2>
        <div class="urls">
            <br><br><button class="button" onclick="location.href='search.php#n<?php echo $num ?>'">戻る</button>
            <!--
            <form action="yourfollow.php" method="POST">
                <input type="hidden" name="num" value="<?php echo $num; ?>">
                <input type="hidden" name="name" value="<?php echo $sessionid; ?>">
                <input type="hidden" name="follow" value="<?php echo $name; ?>">
                <button class="out" type="input">フォロー</button>
            </form>
            -->
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
            <form action="yourdetail.php" method="GET">
                <input type="hidden" name="num" value="<?php echo $num; ?>">
                <input type="hidden" name="name" value="<?php echo $loop['name']; ?>">
                <input type="hidden" name="id" value="<?php echo $loop['id']; ?>">
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
             <img src="../../images/<?php echo $loop['filename']?>" alt="" style="width:100%;">
             <div class="iine">
             <div class="many">&nbsp;いいね！ : <span id="like-count-<?php echo $loop['id']; ?>"><?php echo $loop['likes']?></span>件</div>
                    <div class="like_many">
                    <form action="like.php" method="GET" class="like-form">
                        <input type="hidden" name="post_id" value="<?php echo $loop['id']; ?>">
                        <button type="button" class="likeButton<?php if($loop['liked']) echo ' liked'; ?>" data-post-id="<?php echo $loop['id']; ?>">いいね！</button>
                    </form>
                    </div>
                 </div>
             <div class="message">&nbsp;<?php echo $loop['contents']?></div>
             <div class="contents">&nbsp;<?php echo $loop['created_at']?></div>
             <div class="urls">
                <form action="yourdetail.php" method="GET">
                    <input type="hidden" name="num" value="<?php echo $num; ?>">
                    <input type="hidden" name="name" value="<?php echo $loop['name']; ?>">
                    <input type="hidden" name="id" value="<?php echo $loop['id']; ?>">
                    <input class="submit" type="submit" name="submit" value="詳細">
                </form>
             </div>
             <hr>
		<?php endforeach;?>
    </section>
    <?php require "../../Layouts/footer.php" ?>
    <script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('.likeButton').click(function(){
                var button = $(this);
                var post_id = button.data('post-id');
                var liked = button.hasClass('liked');
                var likeCount = $('#like-count-' + post_id);
                button.toggleClass('liked');
                var likeState = button.hasClass('liked') ? 1 : 0;
                $.ajax({
                    type: 'POST',
                    url: 'like.php',
                    data: {post_id: post_id, like: likeState},
                    success: function(response){
                        var data = JSON.parse(response);
                        if(data.success) {
                            likeCount.text(data.likes);
                        }
                    },
                    error: function(){
                        button.toggleClass('liked', liked);
                    }
                });
            });
        });
    </script>
</body>
</html>