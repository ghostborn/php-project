<?php
include('Conn/config.php');
include('Library/function.php');

//判断是否登录
if (!checkLogin()) {
	msg(2, '请先登录', 'login.php');
}

$customer_user = $_GET['customer_user'] ?? "";
//检查page参数
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$page = max($page, 1);   //把page与1对比 取中间最大值
$pageSize = 5; //每页显示条数
$show = 6; //按钮数量
$offset = ($page - 1) * $pageSize;

/** 分页 **/
$query_all = "select count(*) from tb_customer where customer_user like '%$customer_user%'";
$result = $pdo->prepare($query_all);
$result->execute();
$total = $result->fetchColumn();
$pages = pages($total, $page, $pageSize, $show); // 调用分页方法

/** 筛选数据 **/
$query = "select * from tb_customer where customer_user like '%$customer_user%' order by customer_id desc limit {$offset},{$pageSize}";
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
                                    <a href="add_customer.php">
                                        <button class="btn btn-primary add" type="button">
                                            <i class="glyphicon glyphicon-plus"></i>&nbsp;新增
                                        </button>
                                    </a>
                                </div>
                            </div>
                            <!--搜索开始-->
                            <form action="customer.php" method="GET">
                                <div class="col-md-3">
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="customer_user" name="customer_user"
                                               value="<?php echo $customer_user ?>" placeholder="请输入姓名">
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
							echo "您查找的用户不存在!";
						} else {
							?>
                            <table class="table table-bordered tb-hover" style="margin-bottom: 5px; ">
                                <thead>
                                <tr>
                                    <td>客户姓名</td>
                                    <td>电话</td>
                                    <td>联系地址</td>
                                    <td class="text-center">操作</td>
                                </tr>
                                </thead>
                                <tbody>
								<?php while ($row = $res->fetch(PDO::FETCH_ASSOC)) { ?>
                                    <tr>
                                        <td><?php echo $row['customer_user'] ?></td>
                                        <td><?php echo $row['customer_tel'] ?></td>
                                        <td><?php echo $row['customer_address'] ?></td>
                                        <td class="col-md-3">
                                            <a href="add_customer.php?id=<?php echo $row['customer_id'] ?>">
                                                <button class="btn btn-info" type="button">
                                                    <i class="glyphicon glyphicon-edit"></i> 编辑
                                                </button>
                                            </a>
                                            <a href="delete_customer.php?id=<?php echo $row['customer_id'] ?>"
                                               class="del">
                                                <button class="btn btn-danger" type="button">
                                                    <i class="glyphicon glyphicon-trash"></i>&nbsp;删除
                                                </button>
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
    $(function(){
        $('.del').on('click',function(){
            const url = $(this).attr('href');
            layer.confirm('确认删除该用户信息吗?',function () {
                window.location = url;
            })
            return false;
        })
    })

</script>

<?php include('View/footer.html') ?>



