<?php
include('Conn/config.php');         // 引入配置文件
include('Library/function.php');    // 引入函数库
// 判断是否登录
if (!checkLogin()) {
	msg(2, ' 请先登录', 'login.php');
}
$id = $_GET['id'] ?? 0;
$query = "select tb_shopping.*,tb_car_log.car_log from tb_shopping left join tb_car_log on tb_car_log.fahuo_id = tb_shopping.fahuo_id where id = " . $id; // 根据id查找车辆信息
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
                        填写发货单
                    </div>
                    <div class="panel-body">
                        <form id="add-form" action="store_order.php" method="post">
                            <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
                            <table class="table table-bordered tb-hover" style="margin-bottom: 5px; ">
                                <tbody>
                                <tr>
                                    <td>发货单号：</td>
                                    <td>
                                        <input type="text" id="fahuo_id" class="form-control" name="fahuo_id" readonly
                                               value="<?php echo $row["fahuo_id"]; ?>">
                                    </td>
                                    <td>车牌号码：</td>
                                    <td><input type="text" id="car_number" class="form-control" name="car_number"
                                               value="<?php echo $row['car_number'] ?>"></td>
                                    <td>车主电话：</td>
                                    <td><input type="text" id="tel" class="form-control" name="tel"
                                               value="<?php echo $row['car_tel'] ?>"></td>
                                </tr>
                                <tr>
                                    <td>发货人：</td>
                                    <td><input type="text" id="fahuo_user" class="form-control" name="fahuo_user"
                                               value="<?php echo $row['fahuo_user'] ?>"></td>
                                    <td>发货人电话：</td>
                                    <td><input type="text" id="fahuo_tel" class="form-control" name="fahuo_tel"
                                               value="<?php echo $row['fahuo_tel'] ?>"></td>
                                    <td>付款方式<?php echo $row['fahuo_fk'] ?>：</td>
                                    <td>
                                        <select id="form-control" class="form-control" name="fahuo_fk">
                                            <option value="0" <?php if ($row['fahuo_fk'] == 0) echo "selected" ?> >
                                                发货人付款
                                            </option>
                                            <option value="1" <?php if ($row['fahuo_fk'] == 1) echo "selected" ?> >
                                                第三方付款
                                            </option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>货物描述：</td>
                                    <td colspan='5'>
                                        <textarea id="fahuo_content" class="form-control" rows="3"
                                                  name="fahuo_content"><?php echo $row['fahuo_content'] ?></textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td>发货地址：</td>
                                    <td colspan='5'>
                                        <textarea id="fahuo_address" class="form-control" rows="2"
                                                  name="fahuo_address"><?php echo $row['fahuo_address'] ?></textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td>收货人：</td>
                                    <td><input type="text" id="shouhuo_user" class="form-control" name="shouhuo_user"
                                               value="<?php echo $row['shouhuo_user'] ?>"></td>
                                    <td>收货人电话：</td>
                                    <td><input type="text" id="shouhuo_tel" class="form-control" name="shouhuo_tel"
                                               value="<?php echo $row['shouhuo_tel'] ?>"></td>
                                </tr>
                                <tr>
                                    <td>收货地址：</td>
                                    <td colspan='5'><textarea id="shouhuo_address" class="form-control" rows="2"
                                                              name="shouhuo_address"><?php echo $row['shouhuo_address'] ?></textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td>说明：</td>
                                    <td colspan='5'><textarea id="car_log" class="form-control" rows="3"
                                                              name="car_log"><?php echo $row['car_log'] ?></textarea>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            <button type="submit" class="btn btn-primary" style="margin-left: 20px">提交</button>
                        </form>
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
        $('#add-form').submit(function () {
            if (!checkPhone('#tel', '请输入车主电话')) {
                return false;
            }
            if (!checkField('#fahuo_user', '请输入发货人!')) {
                return false;
            }
            if (!checkPhone('#fahuo_tel', '请输入发货人电话')) {
                return false;
            }
            if (!checkField('#fahuo_content', '请输入货物信息!')) {
                return false;
            }
            if (!checkField('#fahuo_address', '请发货地址!')) {
                return false;
            }
            if (!checkField('#shouhuo_user', '请输入收货人!')) {
                return false;
            }
            if (!checkPhone('#shouhuo_tel', '请输收货人电话')) {
                return false;
            }
            if (!checkField('#shouhuo_address', '请输入收货地址!')) {
                return false;
            }
            if (!checkField('#car_log', '请输入车辆使用信息!')) {
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
        const tel = $(id).val();
        if (!(/^(\d{3}-)(\d{8})$|^(\d{4}-)(\d{7})$|^(\d{4}-)(\d{8})$|^(\d{11})$/.test(tel))) {
            layer.tips('电话格式错误!', id, {time: 2000, tips: 2});
            $(id).focus();
            return false;
        }
        return true;
    }

</script>

<?php include('View\footer.html') ?>


