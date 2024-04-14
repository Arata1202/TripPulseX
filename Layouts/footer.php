<!-- <link rel="stylesheet" href="CSS/footer.css"> -->

<!--ボトムメニュー-->
<footer class="mobile">
    <ul class="under_menu">
        <li><a href="../Index/home.php">ホーム</a></li>
        <li><a href="../Add/add.php">投稿</a></li>
        <li><a href="../Search/search.php">検索</a></li>
    </ul>
</footer>

<style>
/* ボトムメニュー */
.under_menu{
    display:flex;
    position:fixed;
    left:0;
    bottom:0;
    padding-left:0;
    width:100%;
    background-color: #007bff;
    margin-bottom:0;
    height:45px;
    list-style:none;
    padding-bottom: env(safe-area-inset-bottom);
}
.under_menu li{
    table-layout:fixed;
    width:100%;
    padding:5px;
    text-align:center;
    color:white;
    font-size:20px;
}
.under_menu li a{
    color:white;
    text-decoration:none;
    font-weight:bold;
} */

@media screen and (min-width: 767px){
    .under_menu {
        display:none !important;
    }
}
</style>