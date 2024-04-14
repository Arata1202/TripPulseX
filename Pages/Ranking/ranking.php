<?php
require "../../Security/all.php";
require "../../Redirect/all.php";
require "../../Config/db.php";

$dbh=new PDO($dsn,$user,$password);
$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
$sql='SELECT * FROM japantravel order by likes DESC limit 10';
$rec = $dbh->prepare($sql);
$rec->execute();
$rec_list = $rec->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>ranking</title>
    <link rel="stylesheet" href="CSS/ranking.css">
</head>
<body>
    <?php require "../../Layouts/header.php" ?>
    <h2 class="subtitle">＊ランキング＊<br><br></h2>
    <section class="box">    
        <?php foreach($rec_list as $loop):
        $pic_num =  $loop['id'];
        ?>
            <h2><?php $number = $number + 1; echo $number; ?>位</h2>
            <h3>( いいね : <?php echo $loop['likes']?>件 )</h3>
        <table>
            <tr>
                <td width="42%"><img src="../../images/<?php echo $loop['filename']?>" alt="" width="100%"></td>
                <td width="40%"><?php echo $loop['name']?><br><?php echo $loop['prefecture']?><br><?php echo $loop['place']?><br><?php echo $loop['created_at']?></td>
            <form action="detail.php" method="GET">
                <input type="hidden" name="num" value="<?php echo $loop['id']; ?>">
                <td width="18%"><input class="submit" type="submit" name="submit" value="詳細"></td>
            </form>
        </tr>
        </table>
        <hr>
        <?php endforeach;?>
    </section>
    <section class="pcbox">
		<p><?php foreach($rec_list as $loop):?></p>
            <h2><?php $suuji = $suuji + 1; echo $suuji; ?>位</h2>
            <h3>( いいね : <?php echo $loop['likes']?>件 )</h3>
            <div class="spot">
                <p class="name" id="n<?php echo $loop['id']; ?>">
                 &nbsp;
                    <form class="follow" action="yourpage.php" method="GET">
                        <input type="hidden" name="num" value="<?php echo $loop['id']; ?>">
                        <input type="hidden" name="name" value="<?php echo $loop['name']; ?>">
                        <button class="btn_tr" type="submit"><?php echo $loop['name']; ?></button>
                    </form>      
                </p>
                 <div class="prefecture">
                     <p><?php echo $loop['prefecture']?></p>
                     <p>&nbsp;<?php echo $loop['place']?>&nbsp;</p>
                 </div>
             </div>
             <img src="../../images/<?php echo $loop['filename']?>" loading="lazy" alt="" style="width:100%;">
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
                 <form action="detail.php" method="GET">
                    <input type="hidden" name="num" value="<?php echo $loop['id']; ?>">
                    <td width="18%"><input class="btn_t" type="submit" name="submit" value="詳細"></td>
                </form>
             </div>
             <hr>
		<?php endforeach;?>
    </section>
    <?php require "../../Layouts/footer.php" ?>
    <script src="JS/ranking.js"></script>
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