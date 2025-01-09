<?php
include('Conn/config.php');         // 引入配置文件
include('Library/function.php');    // 引入函数库
// 判断是否登录
if (!checkLogin()) {
	msg(2, ' 请先登录', 'login.php');
}
$keyword = $_GET['keyword'] ?? '';
//检查page参数
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$page = max($page, 1); //把page与1对比 取中间最大值
$pageSize = 5; //每页显示条数
$show = 6; //按钮数量
$offset = ($page - 1) * $pageSize;
/** 分页 **/
$query_all = "select count(*) from tb_shopping
                  where fahuo_id = '$keyword' or fahuo_user like '%$keyword%' ";
$result = $pdo->prepare($query_all);
$result->execute();
$total = $result->fetchColumn();
$pages = pages($total, $page, $pageSize, $show); // 调用分页方法
/** 筛选数据 **/
$query = "select * from tb_shopping
              where fahuo_id = '$keyword' or fahuo_user like '%$keyword%' order by id desc limit {$offset},{$pageSize} ";
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
                                    <a href="add_order.php">
                                        <button class="btn btn-primary add" type="button">
                                            <i class="glyphicon glyphicon-plus"></i>&nbsp;新增
                                        </button>
                                    </a>
                                </div>
                            </div>
                            <!--搜索开始-->
                            <form action="order.php" method="GET">
                                <div class="col-md-3">
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="keyword" name="keyword"
                                               value="<?php echo $keyword ?>" placeholder="请输入发货编号或发货人">
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
                            <!--路线存在情况-->
                            <table class="table table-bordered tb-hover" style="margin-bottom: 5px; ">
                                <thead>
                                <tr>
                                    <td>发货单号</td>
                                    <td>车牌号</td>
                                    <td>车主电话</td>
                                    <td>发货人</td>
                                    <td>发货人电话</td>
                                    <td>付款方法</td>
                                    <td>回执状态</td>
                                    <td class="text-center">操作</td>
                                </tr>
                                </thead>
                                <tbody>
								<?php while ($row = $res->fetch(PDO::FETCH_ASSOC)) { ?>
                                    <tr>
                                        <td><?php echo $row['fahuo_id'] ?></td>
                                        <td><?php echo $row['car_number'] ?></td>
                                        <td><?php echo $row['car_tel'] ?></td>
                                        <td><?php echo $row['fahuo_user'] ?></td>
                                        <td><?php echo $row['fahuo_tel'] ?></td>
                                        <td>
											<?php
											if ($row['fahuo_fk'] == 0) {
												echo "发货人付款";
											} else {
												echo "第三方付款";
											}
											?>
                                        </td>
                                        <td>
											<?php
											if ($row['fahuo_ys'] == 1) {
												echo "已确认";
											} else {
												echo "未确认";
											}
											?>
                                        </td>
                                        <td style="width:320px">
                                            <!--判断是否确认-->
											<?php if ($row['fahuo_ys'] == 1) { ?>
                                                <button class="btn btn-inverse" type="button">回执确认</button>
											<?php } else { ?>
                                                <a class="confirm-order" order_id="<?php echo $row['id'] ?>"
                                                   fahuo_id="<?php echo $row['fahuo_id'] ?>">
                                                    <button class="btn btn-warning " type="button">回执确认</button>
                                                </a>
											<?php } ?>
                                            <a class="show-order" order_id="<?php echo $row['id'] ?>">
                                                <button class="btn btn-success" type="button">查看明细</button>
                                            </a>
                                            <a href="edit_order.php?id=<?php echo $row['id'] ?>">
                                                <button class="btn btn-info " type="button">编辑</button>
                                            </a>
                                            <a href="delete_order.php?id=<?php echo $row['id'] ?>" class="del">
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
        // 确认发货单
        $('.confirm-order').on('click', function () {
            var order_id = $(this).attr('order_id');
            var fahuo_id = $(this).attr('fahuo_id');
            layer.confirm('确认发货单回执?', function () {
                $.post('confirm_order.php', {id: order_id, fahuo_id: fahuo_id}, function (res) {
                    if (res) {
                        layer.msg('更改成功');
                        window.location.href = "order.php";
                    } else {
                        layer.msg('更改失败');
                    }
                });
            });
            return false;
        });
        // 删除发货单
        $('.del').on('click', function () {
            var url = $(this).attr('href');
            layer.confirm('确认删除该发货单吗?', function () {
                window.location = url; // 页面跳转到删除页面
            });
            return false;
        });
        // 查看发货单明细
        $('.show-order').click(function () {
            var order_id = $(this).attr('order_id');
            layer.open({
                type: 2,
                title: '查看明细',
                shadeClose: true,
                shade: 0.5,
                area: ['960px', '90%'],
                content: 'order_detail.php?id=' + order_id //iframe的url
            });
        })
    })
</script>
<?php include('View/footer.html') ?>

