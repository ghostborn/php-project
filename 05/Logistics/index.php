<?php
include_once('Conn/config.php');
include_once('Library/function.php');

//判断是否登录
if (!checkLogin()) {
    msg(2, '请先登录', 'login.php');
}
// 获取查询条件
$start = $_GET['start'] ?? "";
$end = $_GET['end'] ?? "";

// 分页设置
$page = isset($_GET['page']) ? intval($_GET['page']) : 1; //检查page参数
$pageSize = 5; //每页显示条数
$show = 6;//按钮显示数量
$offset = ($page - 1) * $pageSize;  //设置起点

// 获取分页数据
$query_all = "select count(*) from tb_car where car_road like '%$start%' and car_road like '%$end%' ";
$result = $pdo->prepare($query_all);
$result->execute();
$total = $result->fetchColumn();

/** 筛选数据 **/
$query = "SELECT tb_car.*,tb_car_log.car_log FROM tb_car LEFT JOIN tb_car_log ON tb_car_log.car_number = tb_car.car_number";
$query .= "where car_road like '%$start%' and car_road like '%$end%' order by id desc limit {$offset},{$pageSize}";
$res = $pdo->prepare($query);
$res->execute();

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
            <div class="col-md-12">
                <div class="panel panel-default ">
                    <div class="panel-heading text-center">
                        <form class="form-inline" action="index.php" method="get">
                            <div class="form-group">
                                <label for="start">路线：</label>
                                <input type="text" class="form-control" id="start" name="start"
                                       value=<?php echo $start ?>>
                            </div>
                            <div class="form-group">
                                <label for="end">至</label>
                                <input type="text" class="form-control" id="end" name="end" value=<?php echo $end ?>>
                            </div>
                            <button class="btn btn-info"><i class="glyphicon glyphicon-search"></i></button>
                        </form>
                    </div>
                    <div class="panel-body">
                        <!--路线不存在情况-->
                        <?php
                        if (empty($))
                        ?>
                    </div>


                </div>
            </div>

        </div>


    </div>

    <!--主区域结束-->


</div>


<?php include_once('View/footer.html') ?>

