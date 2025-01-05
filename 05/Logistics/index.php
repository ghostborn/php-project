<?php
    include('Conn\config.php');         // 引入配置文件
    include('Library\function.php');    // 引入函数库
    // 判断是否登录
    if(!checkLogin()){
        msg(2,' 请先登录','login.php');
    }
    // 获取查询条件
    $start = isset($_GET['start']) ? $_GET['start'] : "";
    $end   = isset($_GET['end']) ? $_GET['end'] : "";
    /** 分页设置 **/
    $page = isset($_GET['page']) ? intval($_GET['page']) : 1; //检查page参数
    $pageSize = 5; //每页显示条数
    $show = 6; //按钮显示数量
    $offset = ($page - 1) * $pageSize; // 设置起点
    // 获取分页数据
    $query_all = "select count(*) from tb_car where car_road like '%$start%' and car_road like '%$end%' ";
    $result = $pdo->prepare($query_all);
    $result->execute();
    $total = $result->fetchColumn();
    $pages = pages($total,$page,$pageSize,$show); // 调用分页方法
    /** 筛选数据 **/
    $query = "select tb_car.*,tb_car_log.car_log from tb_car left join tb_car_log on tb_car_log.car_number = tb_car.car_number ";
    $query .= "where car_road like '%$start%' and car_road like '%$end%' order by id desc limit {$offset},{$pageSize} ";
    $res = $pdo->prepare($query);
    $res->execute();
?>

<?php include('View/header.html') ?>
<div class="container-fluid">
    <!--顶部导航-->
    <?php include('View/nav.html') ?>
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
                                <input type="text" class="form-control" id="start" name="start" value=<?php echo $start ?> >
                            </div>
                            <div class="form-group">
                                <label for="end">至</label>
                                <input type="text" class="form-control" id="end" name="end" value=<?php echo $end ?> >
                            </div>
                            <button class="btn btn-info"><i class="glyphicon glyphicon-search"></i></button>
                        </form>
                    </div>
                    <div class="panel-body">
                        <!--路线不存在情况-->
                        <?php
                            if(empty($total)){
                                echo "您查找的路线不存在!";
                            }else{
                        ?>
                            <!--路线存在情况-->
                            <table class="table table-bordered tb-hover" style="margin-bottom: 5px; ">
                                <thead>
                                <tr>
                                    <td>车牌号码</td>
                                    <td>路线</td>
                                    <td>车辆描述</td>
                                    <td>使用日志</td>
                                    <td class="text-center">是否使用</td>
                                </tr>
                                </thead>
                                <tbody>
                                <?php while($row = $res->fetch(PDO::FETCH_ASSOC)){ ?>
                                    <tr>
                                        <td><?php echo $row['car_number'] ?></td>
                                        <td><?php echo $row['car_road'] ?></td>
                                        <td><?php echo $row['car_content'] ?></td>
                                        <td>
                                            <?php echo $row['car_log'] ?>
                                        </td>
                                        <td class=" text-center">
                                            <?php if($row['car_log']){ ?>
                                                <button class="btn btn-inverse" type="button">预订该车</button>
                                            <?php }else{ ?>
                                                <a href="add_order.php?car_id=<?php echo $row['id'] ?>">
                                                    <button class="btn btn-warning " type="button">预订该车</button>
                                                </a>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                <?php } ?>
                                </tbody>
                            </table>
                        <?php } ?>
                    </div>
                    <!--分页-->
                    <div class="text-right" style="padding-right: 10px">
                        <?php echo $pages?>
                    </div>
                </div>
            </div>
        </div>
        <!--右侧主区域结束-->
    </div>
    <!--主区域结束-->
</div>
<?php include('View\footer.html') ?>

