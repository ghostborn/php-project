<?php
include_once('Conn/config.php');
include_once('Library/function.php');

//判断是否登录
if (!checkLogin()) {
	msg(2, '请先登录', 'login.php');
}
?>

<?php include_once('View/header.html') ?>

<div class="container-fluid">
    <!--顶部导航-->
	<?php include_once('View/nav.html') ?>
    <!--主区域开始-->
    <div class="row" style="margin-top:70px">
        <!--左侧菜单-->
	    <?php include('View/menu.html') ?>
        <!--右侧主区域开始-->
        <div class="main-right  col-md-10 col-md-offset-2">

        </div>


    </div>

    <!--主区域结束-->


</div>


<?php include_once('View/footer.html') ?>

