<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>简单的数字验证码</title>
    <style>
        .style1 {
            color: #FF9900;
            font-family: "方正小标宋简体";
            font-size: 24px;
            font-weight: bold;
        }
    </style>
</head>
<script>
    function check(form) {
        if (form.txt_yan.value == "") {
            alert("请输入验证码");
            form.txt_yan.focus();
            return false;
        }
        if (form.txt_yan.value != form.txt_hyan.value) {
            alert("对不起，您输入的验证码不正确!");
            form.txt_yan.focus();
            return false;
        }
    }
</script>
<body>
<form name="form" method="post" action="">
    <table width="447" border="1" align="center" cellpadding="1" cellspacing="1" bordercolor="#009A31"
           bgcolor="#99FF33">
        <tr>
            <td idth="447" height="53" align="center">
                <span class="style1">
                    简单的数字验证码
                </span>
                <hr width="80%">
                <span class="style1"> </span> 验证码：
                <input type="text" name="txt_yan">
				<?php
				$num = intval(mt_rand(1000, 9999));
				echo "<font color=red size=4><strong>" . $num . "</strong></font>";       //自动生成一组4位的随机数
				?>
                <input type="hidden" name="txt_hyan" id="txt_hyan" value="<?php echo $num; ?>">
                <br>
                <br>
                <input type="submit" name="Submit" value="验证" onclick="return check(form)">
                <input type="reset" name="Submit2" value="重置"></td>
            </td>
        </tr>
    </table>
</form>
<?php
if (isset($_POST['Submit'])) {
	echo "您输入的验证码验证通过~";
}
?>

</body>
</html>