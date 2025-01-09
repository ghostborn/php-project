<?php
include('Conn/config.php');         // 引入配置文件
include('Library/function.php');    // 引入函数库
// 判断是否登录
if (!checkLogin()) {
	msg(2, ' 请先登录', 'login.php');
}
$id = isset($_GET['id']) ? $_GET['id'] : 0;
$query = "select tb_shopping.*,tb_car_log.car_log from tb_shopping left join tb_car_log on tb_car_log.fahuo_id = tb_shopping.fahuo_id where id = " . $id; // 根据id查找车辆信息
$res = $pdo->prepare($query);  // 预处理操作
$res->execute();               // 执行SQL语句
$row = $res->fetch(PDO::FETCH_ASSOC); // 以关联方式获取数据
?>
<?php include('View/header.html') ?>
<div class="container-fluid">
    <table class="table table-bordered tb-hover" style="margin-top: 5px; ">
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
            <td><input type="text" id="tel" class="form-control" name="tel" value="<?php echo $row['car_tel'] ?>"></td>
        </tr>
        <tr>
            <td>发货人：</td>
            <td><input type="text" id="fahuo_user" class="form-control" name="fahuo_user"
                       value="<?php echo $row['fahuo_user'] ?>"></td>
            <td>发货人电话：</td>
            <td><input type="text" id="fahuo_tel" class="form-control" name="fahuo_tel"
                       value="<?php echo $row['fahuo_tel'] ?>"></td>
            <td>付款方式：</td>
            <td>
                <select id="form-control" class="form-control" name="fahuo_fk">
                    <option value="0" <?php if ($row['fahuo_fk'] == 0) echo "selected" ?> >发货人付款</option>
                    <option value="1" <?php if ($row['fahuo_fk'] == 1) echo "selected" ?> >第三方付款</option>
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
                                      name="shouhuo_address"><?php echo $row['shouhuo_address'] ?></textarea></td>
        </tr>
        <tr>
            <td>说明：</td>
            <td colspan='5'><textarea id="car_log" class="form-control" rows="3"
                                      name="car_log"><?php echo $row['car_log'] ?></textarea></td>
        </tr>
        </tbody>
    </table>
</div>
<div class="text-center" onclick="printpage()">
    <button class="btn btn-primary">打印订单</button>
</div>
<script type="text/javascript" onclick="printpage()">
    function printpage() {
        window.print()
    }
</script>


