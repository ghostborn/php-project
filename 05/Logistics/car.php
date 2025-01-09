<?php
include('Conn/config.php');         // 引入配置文件
include('Library/function.php');    // 引入函数库
// 判断是否登录
if (!checkLogin()) {
	msg(2, ' 请先登录', 'login.php');
}
$keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';
//检查page参数
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$page = max($page, 1); //把page与1对比 取中间最大值
$pageSize = 5; //每页显示条数
$show = 6; //按钮数量
$offset = ($page - 1) * $pageSize;
/** 分页 **/
$query_all = "select count(*) from tb_car
              where car_number = '$keyword' or username like '%$keyword%' ";
$result = $pdo->prepare($query_all);
$result->execute();
$total = $result->fetchColumn();
$pages = pages($total, $page, $pageSize, $show); // 调用分页方法
/** 筛选数据 **/
$query = "select * from tb_car
          where car_number = '$keyword' or username like '%$keyword%' order by id desc limit {$offset},{$pageSize} ";
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
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="input-button">
                                    <a href="add_car.php">
                                        <button class="btn btn-primary add" type="button">
                                            <i class="glyphicon glyphicon-plus"></i>&nbsp;新增
                                        </button>
                                    </a>
                                </div>
                            </div>
                            <!--搜索开始-->
                            <form action="car.php" method="GET">
                                <div class="col-md-3">
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="keyword" name="keyword"
                                               value="<?php echo $keyword ?>" placeholder="请输入车牌号或车主名称">
                                        <span class="input-group-btn">
                                            <button class="btn btn-info"><i
                                                        class="glyphicon glyphicon-search"></i></button>
                                        </span>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="panel-body">
						<?php
						if (empty($total)) {
							echo "您查找的数据不存在!";
						} else {
							?>
                            <table class="table table-bordered tb-hover" style="margin-bottom: 5px; ">
                                <thead>
                                <tr>
                                    <td width="80px">车主姓名</td>
                                    <td>车主身份证号</td>
                                    <td width="90px">车牌号</td>
                                    <td>车主电话</td>
                                    <td>地址</td>
                                    <td>车辆路线</td>
                                    <td>车辆描述</td>
                                    <td class="text-center">操作</td>
                                </tr>
                                </thead>
                                <tbody>
								<?php while ($row = $res->fetch(PDO::FETCH_ASSOC)) { ?>
                                    <tr>
                                        <td><?php echo $row['username'] ?></td>
                                        <td><?php echo $row['user_number'] ?></td>
                                        <td><?php echo $row['car_number'] ?></td>
                                        <td><?php echo $row['tel'] ?></td>
                                        <td><?php echo $row['address'] ?></td>
                                        <td><?php echo $row['car_road'] ?></td>
                                        <td><?php echo $row['car_content'] ?></td>
                                        <td style="width:130px">
                                            <a href="add_car.php?id=<?php echo $row['id'] ?>">
                                                <button class="btn btn-info " type="button">编辑</button>
                                            </a>
                                            <a href="delete_car.php?id=<?php echo $row['id'] ?>" class="del">
                                                <button class="btn btn-danger " type="button">删除</button>
                                            </a>
                                        </td>
                                    </tr>
								<?php } ?>
                                </tbody>
                            </table>
						<?php } ?>
                    </div>
                    <!--分页-->
                    <div class="text-right" style="padding-right: 10px">
						<?php echo $pages ?>
                    </div>
                </div>
            </div>
        </div>
        <!--右侧主区域结束-->
    </div>
    <!--主区域结束-->
</div>

<script>
    $(function () {
        // 删除发货单
        $('.del').on('click', function () {
            var url = $(this).attr('href');
            layer.confirm('确认删除该车源吗?', function () {
                window.location = url; // 页面跳转到删除页面
            });
            return false;
        });
    })
</script>
<?php include('View\footer.html') ?>

