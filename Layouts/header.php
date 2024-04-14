<header>

    <div class="mobile_hamberger">
        <div class="mobile_btn">
            <i></i>
            <i></i>
            <i></i>
        </div>
        <div class="mobile_block">
            <div class="mobile_list">
                <ul>
                    <li style="color:#007bff;"><h5>＊<?php echo $_SESSION['user'] ?>様</h5></li>
                    <br>
                    <li><h5><a href="../Mypage/mypage.php">＊マイページ</a></h5></li>
                    <li><h5><a href="../Ranking/ranking.php">＊ランキング</a></h5></li>
                    <li><h5><a href="../Contact/contact-1.php">＊お問い合わせ</a></h5></li>
                </ul>
            </div>
        </div>
    </div>


    <div class="hamburger-left">
        <div class="block-left">
            <div class="list-left">
                <ul>
                    <li style="color:#007bff;"><h5>ログインユーザー</h5></li>
                    
                    <li><h5><?php echo $_SESSION['user'] ?></h5></li>
                </ul>
            </div>
        </div>
    </div>

    <div class="hamburger">
        <div class="block">
            <div class="list">
                <ul>
                    <li style="color:#007bff;"><h5>Menu</h5></li>
                    <br>
                    <li><h5><a href="../Index/home.php">ホーム</a></h5></li>
                    <li><h5><a href="../Add/add.php">投稿</a></h5></li>
                    <li><h5><a href="../Search/search.php">検索</a></h5></li>
                    <li><h5><a href="../Mypage/mypage.php">マイページ</a></h5></li>
                    <li><h5><a href="../Ranking/ranking.php">ランキング</a></h5></li>
                    <li><h5><a href="../Contact/contact-1.php">お問い合わせ</a></h5></li>
                </ul>
            </div>
        </div>
    </div>

    <!--タイトル-->
    <h1 class="title"><a href="../../Pages/Index/home.php">&nbsp;Trip Pulse X</a></h1>
</header> 

<script>
    const mobile_btn = document.querySelector('.mobile_btn');
     const mobile_block = document.querySelector('.mobile_block');
     mobile_btn.addEventListener('click', () => {
         mobile_btn.classList.toggle('active');
         mobile_block.classList.toggle('active');
     });
</script>



<style>
   /* 基本スタイル */
body {
    margin: 0;
    font-family: 'Arial', sans-serif;
    background-color:white !important;
}

.hamburger .btn{
    display:none;
}

.btn{
    position:fixed;
    top: 0;
    right: 0;
    width: 45px;
    height: 45px;
    z-index: 9;
    margin-top:5px;
}
.btn i{
    position: absolute;
    left: 5px;
    width: 40px;
    height: 2px;
    background-color: white;
    transition: .5s;
}
.btn i:nth-of-type(1){
    top: 16px;
}
.btn i:nth-of-type(2){
    top: 26px;
}
.btn i:nth-of-type(3){
    top: 36px;
}
.btn.active i:nth-of-type(1){
    transform: translateY(10px) rotate(45deg);
}
.btn.active i:nth-of-type(2){
    opacity: 0;
}
.btn.active i:nth-of-type(3){
    transform: translateY(-10px) rotate(-45deg);
}
.block{
    position: fixed;
    bottom: 0;
    top: 0;
    left:67%;
    background-color: white;
    color: black;
    opacity: 0;
    pointer-events: none;
}
.block{
    opacity: 1;
    pointer-events: auto;
    box-shadow: 15px 15px 15px 15px rgba(0, 0, 0, 0.5);
    width:100%;
    height:100%;
    transition: none;
}
.list{
    position: absolute;
    top: 60px;
    left: 20px;
    font-size: 30px;
    height:100%;
    width: 22%;
}
.list-left{
    position: absolute;
    top: 60px;
    left: 20px;
    font-size: 30px;
    height:100%;
    width: 80%;
}
.list-left ul {
    list-style: none;
    padding: 0px;
    margin-left:10%;
}
.list ul{
    list-style: none;
    padding: 0px;
    margin-left:20%;
}
.list-left ul li {
    text-align:center;
}
.list li{
    padding: 0px 0px 0px 5px;
    line-height: 10px;
    text-align:center;
} 
.list ul{
    list-style:none;
}
h5{
    margin-bottom:0px;
    font-size:23px;
}
.list ul h5 a{
    color:black;
    text-decoration:none;
}

/* ナビゲーションメニュー */
.menu {
    position: fixed;
    top: 0;
    right: 0;
    width: 250px;
    height: 100%;
    background-color: #fff;
    box-shadow: -4px 0 6px rgba(0,0,0,0.1);
}


.menu ul {
    list-style: none;
    padding: 20px;
    margin: 80px 0 0 0; 
}

.menu li h5 {
    margin: 20px 0;
    font-size: 18px;
}

.menu li h5 a {
    color: #333;
    text-decoration: none;
}

.menu li h5 a:hover {
    color: deepskyblue;
}

/* タイトルスタイル */
.title {
    font-size: 24px;
    text-align: center;
    padding: 15px 0;
    margin: 0;
    background-color: #007bff;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.title a {
    text-decoration: none;
    color: white;
    transition: color 0.2s;
}

.title a:hover {
    color: deepskyblue;
}

.hamburger-left .block-left {
    position: fixed;
    bottom: 0;
    top: 0;
    left: 0;
    background-color: white;
    color: black;
    box-shadow: 15px 0 15px -15px rgba(0, 0, 0, 0.5);
    width: 32.9%;
    height:100%;
    transition: transform 0.3s ease-in-out;
}

.hamburger-left .list-left {
    position: absolute;
    top: 60px;
    left: 20px;
    font-size: 30px;
}

@media screen and (max-width: 767px){
    .hamburger, .hamburger-left {
        display: none;
    }

    /* モバイルビューではモバイル用のハンバーガーメニューを表示 */
    .mobile_hamberger {
        display: block;
    }
    .mobile_btn {
    position: fixed;
    top: 0;
    right: 0;
    width: 45px;
    height: 45px;
    z-index: 9;
    margin-top:5px;
}

.mobile_btn i {
    position: absolute;
    left: 5px;
    width: 40px;
    height: 2px;
    background-color: white;
    transition: .5s;
}

.mobile_btn i:nth-of-type(1) {
    top: 16px;
}

.mobile_btn i:nth-of-type(2) {
    top: 26px;
}

.mobile_btn i:nth-of-type(3) {
    top: 36px;
}

.mobile_btn.active i:nth-of-type(1) {
    transform: translateY(10px) rotate(45deg);
}

.mobile_btn.active i:nth-of-type(2) {
    opacity: 0;
}

.mobile_btn.active i:nth-of-type(3) {
    transform: translateY(-10px) rotate(-45deg);
}

.mobile_block {
    position: fixed;
    top: 0;
    left: 100%;
    width: 100%;
    height: 100%;
    background-color: white;
    color: black;
    transition: transform 0.5s ease;
    box-shadow: 15px 15px 15px 15px rgba(0, 0, 0, 0.5);
}

.mobile_block.active {
    transform: translateX(-85%);
}

.mobile_list {
    position: absolute;
    top: 60px;
    left: 20px;
    font-size: 30px;
}

.mobile_list ul {
    list-style: none;
    padding: 0px;
}

.mobile_list li {
    padding: 0px 0px 0px 30px;
    line-height: 10px;
}

.mobile_list ul h5 {
    margin-bottom: 0px;
}

.mobile_list ul h5 a {
    color: black;
    text-decoration: none;
}

}

</style>