<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title></title>
    <style>
        body {
            background: url("images/logon_bg.png");
        }
    </style>
</head>
<script>
    function chkinput(form) {
        if (form.name.value === '') {
            alert("请输入用户名！");
            form.name.select();
            return false;
        }
        if (form.pwd.value === '') {
            alert("请输入用户密码！");
            form.pwd.select();
            return false;
        }
        return true;
    }

</script>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>

<form name="form1" method="post" action="chkadmin.php" onSubmit="return chkinput(this)">
    <table width="545" border="0" align="center" cellpadding="0" cellspacing="0" id="__01">
        <tr>
            <td height="114" background="images/logon_top.png">&nbsp;</td>
        </tr>
        <tr>
            <td height="222" align="center" valign="middle" background="images/logon_middle.png">
                <table width="83%" height="160" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                        <td width="39%" height="30" align="right">管理员名称：</td>
                        <td width="61%" align="left"><input name="name" type="text" id="name"></td>
                    </tr>
                    <tr>
                        <td height="50" align="right">管理员密码：</td>
                        <td align="left"><input name="pwd" type="password" id="pwd"></td>
                    </tr>
                    <tr align="center" valign="top">
                        <td height="80" colspan="2">
                            <input name="imageField" type="image" src="images/btn1.gif" class="input1">
                            &nbsp;
                            <input name="imageField2" type="image" src="images/btn2.gif"
                                   onClick="form.reset();return false;" class="input1">
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</form>

</body>

</html>