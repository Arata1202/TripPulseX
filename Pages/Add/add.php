<?php
require "../../Security/all.php";
require "../../Redirect/all.php";
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>add</title>
    <link rel="stylesheet" href="CSS/add.css">
</head>
<body>
    <div class="loader" style="display:none;">
        <div class="loader-inner ball-pulse">
        <div></div>
        <div></div>
        <div></div>
        </div>
    </div>
    <style>
        .loader {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(255, 255, 255, 0.7);
    z-index: 1000;
    display: flex;
    justify-content: center;
    align-items: center;
}

.ball-pulse > div {
    background-color: #333;
    width: 25px; /* ボールのサイズを大きくする */
    height: 25px; /* ボールのサイズを大きくする */
    border-radius: 100%;
    margin: 2px;
    -webkit-animation: ball-pulse 1.2s infinite ease-in-out;
    animation: ball-pulse 1.2s infinite ease-in-out;
}
        @-webkit-keyframes ball-pulse {
    0%, 100% { 
        -webkit-transform: scale(0.75);
        transform: scale(0.75);
    }
    50% { 
        -webkit-transform: scale(1);
        transform: scale(1);
    }
}

@keyframes ball-pulse {
    0%, 100% { 
        transform: scale(0.75);
    }
    50% { 
        transform: scale(1);
    }
}
    </style>
    <?php require "../../Layouts/header.php" ?>
    <h2 class="subtitle">＊新規投稿＊</h2>
    <div class="box">
        <form action="add-2.php" method="post" enctype="multipart/form-data" onsubmit="return validateForm();">
             <input type="hidden" name="name" value="<?php echo $_SESSION['user'] ?>" ><br>
             <h3>都道府県</h3>
             <input type="text" id="prefecture" name="prefecture" value="" placeholder="例 : 神奈川県" size="30" style="height:25px;"><br>
             <p id="prefectureError" class="error-message" style="color: red;"></p>
             <h3>観光地名称</h3>
             <input type="text" id="spot" name="place" value="" placeholder="例 : 箱根温泉" size="30" style="height:25px;"><br>
             <p id="spotError" class="error-message" style="color: red;"></p>
             <h3>コメント</h3>
             <textarea name="contents" id="contents" value="" placeholder="例 : 箱根温泉へ行きました。" rows="5" cols="30"></textarea><br>
             <p id="contentsError" class="error-message" style="color: red;"></p>
             <br>
             <input type="file" id="upload_image" name="upload_image" size="30" style="height:25px;">
             <p id="upload_imageError" class="error-message" style="color: red;"></p>
             <br>
             <button class="submit" type="submit">投稿</button>
        </form>
     </div>              
     <?php require "../../Layouts/footer.php" ?>
     <script src="../../Validation/add.js"></script>
     <script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
     <script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
     <script type="text/javascript">
    $(document).ready(function(){
        $('form').on('submit', function(event) {
            if (validateForm()) {
                $('.loader').show();
                event.preventDefault();
            }
        });
        $(window).on('load', function() {
            $('.loader').hide();
        });
    });
</script>
    <script src="JS/add.js"></script>
</body>
</html>