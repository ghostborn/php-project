<?php
include('Conn/config.php');         // 引入配置文件
include('Library/function.php');    // 引入函数库
// 判断是否登录
if (!checkLogin()) {
	msg(2, ' 请先登录', 'login.php');
}
$id = isset($_GET['id']) ? $_GET['id'] : 0;  // 获取车辆信息id
/** 筛选数据 **/
$query = "select * from tb_car where id = " . $id; // 根据id查找车辆信息
$res = $pdo->prepare($query);  // 预处理操作
$res->execute();               // 执行SQL语句
$row = $res->fetch(PDO::FETCH_ASSOC); // 以关联方式获取数据
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
                        填写车源
                    </div>
                    <form id="add-form" action="store_car.php" method="post">
                        <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
                        <div class="panel-body">
                            <table class="table table-bordered tb-hover" style="margin-bottom: 5px; ">
                                <tbody>
                                <tr>
                                    <td>车主姓名：</td>
                                    <td>
                                        <input type="text" id="username" class="form-control" name="username"
                                               value="<?php echo $row['username'] ?>">
                                    </td>
                                    <td>车牌号码：</td>
                                    <td><input type="text" id="car_number" class="form-control" name="car_number"
                                               value="<?php echo $row['car_number'] ?>"></td>
                                    <td>身份证号：</td>
                                    <td><input type="text" id="user_number" class="form-control" name="user_number"
                                               value="<?php echo $row['user_number'] ?>"></td>
                                </tr>
                                <tr>
                                    <td>车主电话：</td>
                                    <td><input type="text" id="tel" class="form-control" name="tel"
                                               value="<?php echo $row['tel'] ?>"></td>
                                    <td>车主地址：</td>
                                    <td><input type="text" id="address" class="form-control" name="address"
                                               value="<?php echo $row['address'] ?>"></td>
                                </tr>
                                <tr>
                                    <td>运输路线：</td>
                                    <td colspan='5'>
                                        <textarea id="car_road" class="form-control" rows="2"
                                                  name="car_road"><?php echo $row['car_road'] ?></textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td>车辆描述：</td>
                                    <td colspan='5'>
                                        <textarea id="car_content" class="form-control" rows="3"
                                                  name="car_content"><?php echo $row['car_content'] ?></textarea>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            <button type="submit" class="btn btn-primary" style="margin-left: 20px">提交</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!--右侧主区域结束-->
    </div>
    <!--主区域结束-->
</div>

<script>
    $(function () {
        $('#add-form').submit(function () {
            if (!checkField('#username', '请输入车主!')) {
                return false;
            }
            if (!checkField('#car_number', '请输入车牌号码!')) {
                return false;
            }
            if (!checkField('#user_number', '请输入身份证号码!')) {
                return false;
            }
            if (!checkPhone('#tel', '请输入车主电话')) {
                return false;
            }
            if (!checkField('#address', '请输入车主地址!')) {
                return false;
            }
            if (!checkField('#car_road', '请输入输入路线!')) {
                return false;
            }
            if (!checkField('#car_content', '请输入车辆描述!')) {
                return false;
            }
            return true;
        })
    });

    function checkField(id, message) {
        if ($(id).val() == '') {
            layer.tips(message, id, {time: 2000, tips: 2});
            $(id).focus();
            return false;
        }
        return true;
    }

    function checkPhone(id, message) {
        if (!checkField(id, message)) {
            return false;
        }
        var tel = $(id).val();
        if (!(/^(\d{3}-)(\d{8})$|^(\d{4}-)(\d{7})$|^(\d{4}-)(\d{8})$|^(\d{11})$/.test(tel))) {
            layer.tips('电话格式错误!', id, {time: 2000, tips: 2});
            $(id).focus();
            return false;
        }
        return true;
    }

</script>

<?php include('View/footer.html') ?>


