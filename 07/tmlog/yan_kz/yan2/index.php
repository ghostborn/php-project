<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
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
            <td width="447" height="53" align="center">
                <span class="style1">数字图形验证码</span>
                <hr width="80%">
                验证码：
                <input type="text" name="txt_yan">
				<?php
				$num = intval(mt_rand(1000, 9999));
				for ($i = 0; $i < 4; $i++) {
					echo "<img src=images/checkcode/" . substr(strval($num), $i, 1) . ".gif>";
				}
				?>
                <input type="hidden" name="txt_hyan" id="txt_hyan" value="<?php echo $num; ?>">
                <br>
                <br>
                <input type="submit" name="Submit" value="验证" onClick="return check(form);">
                &nbsp;
                <input type="reset" name="Submit2" value="重置">

            </td>
        </tr>
    </table>
</form>
<?php
if (isset($_POST['txt_yan'])) {
	if ($_POST['txt_yan'] == $_POST['txt_hyan']) {
		echo "您输入的验证码通过，感谢您的加盟...";
	}
}
?>

</body>
</html>