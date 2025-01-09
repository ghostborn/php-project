<?php
include('Conn/config.php');
include('Library/function.php');
// 判断是否登录
if (!checkLogin()) {
	msg(2, ' 请先登录', 'login.php');
}
$customer_id = $_GET['id'] ?? 0;
$query = 'select * from tb_customer where customer_id =' . $customer_id;
$res = $pdo->prepare($query);
$res->execute();
$row = $res->fetch(PDO::FETCH_ASSOC);
?>
<?php include('View/header.html') ?>
<div class="container-fluid">
    <!--顶部导航-->
	<?php include('View/nav.html') ?>
    <div class="row" style="margin-top:70px">
		<?php include('View/menu.html') ?>
        <div class="main-right  col-md-10 col-md-offset-2">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        填写客户信息
                    </div>
                    <div class="panel-body">
                        <form action="store_customer.php" id="add-customer" method="post" class="col-md-6"
                              style="padding-left: 10px">
                            <input type="hidden" name="customer_id" value="<?php echo $row['customer_id'] ?>">
                            <div class="form-group">
                                <label for="customer_user">客户姓名</label>
                                <input type="text" class="form-control" id="customer_user" name="customer_user"
                                       value="<?php echo $row['customer_user'] ?>">
                            </div>
                            <div class="form-group">
                                <label for="customer_tel">电话</label>
                                <input type="text" class="form-control" id="customer_tel"
                                       name="customer_tel" value="<?php echo $row['customer_tel'] ?>">
                            </div>
                            <div class="form-group">
                                <label for="customer_address">联系地址</label>
                                <textarea class="form-control" rows="3" id="customer_address"
                                          name="customer_address"><?php echo $row['customer_address'] ?></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">提交</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(function () {
        $('#add-customer').submit(function () {
            console.log('333')
            if (!checkField('#customer_user', '请输入客户姓名！')) {
                return false;
            }
            if (!checkPhone('#customer_tel', '请输入客户电话')) {
                return false;
            }
            if (!checkField('#customer_address', '请输客户联系地址')) {
                return false;
            }
            return true
        })
    })

    function checkField(id, message) {
        if ($(id).val() === '') {
            layer.tips(message, id, {time: 2000, tips: 2});
            $(id).focus();
            return false
        }
        return true
    }

    function checkPhone(id, message) {
        if (!checkField(id, message)) {
            return false;
        }
        const tel = $(id).val();
        if (!(/^(\d{3}-)(\d{8})$|^(\d{4}-)(\d{7})$|^(\d{4}-)(\d{8})$|^(\d{11})$/.test(tel))) {
            layer.tips('电话格式错误!', id, {time: 2000, tips: 2});
            $(id).focus();
            return false
        }
        return true;
    }


</script>

<?php include('View/footer.html') ?>
