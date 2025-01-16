<?php
//header ( "Content-type: text/html; charset=gb2312" ); //设置文件编码格式
include "conn/conn.php";//包含数据库连接文件
?>
<script>
    function found_chk() {
        if (document.getElementById("username").value == "") {
            alert("帐号不允许为空");
            document.getElementById("username").focus();
            return false;
        }
        if (document.getElementById("question").value == "") {
            alert("密码提示问题不允许为空");
            document.getElementById("question").focus();
            return false;
        }
        if (document.getElementById("answer").value == "") {
            alert("密码提示答案不允许为空");
            document.getElementById("answer").focus();
            return false;
        }
    }

    function chk_pwd() {
        if (document.getElementById("password").value == "") {
            alert("密码不允许为空");
            document.getElementById("password").focus();
            return false;
        }
        if (document.getElementById("password").value != document.getElementById("two_pwd").value) {
            alert("两次密码不一致");
            document.getElementById("password").focus();
            return false;
        }
    }
</script>
<style>
    .submit {
        border: 1px solid #000000;
    }
</style>
<?php
if (isset($_POST['action']) && $_POST['action'] == "chk") {//如果action参数值为chk
	if (($_POST['username'] != "") and ($_POST['question'] != "") and ($_POST['answer'] != "")) {//如果传递过来的值不为空
		$f_sql = "select * from tb_account where question = '" . $_POST['question'] . "' and answer = '" . $_POST['answer'] . "' and name='" . $_POST['username'] . "'";//定义查询语句
		$result = $pdo->prepare($f_sql);//准备查询
		$result->execute();//执行查询
		$f_rst = $result->fetch(PDO::FETCH_NUM);//将查询结果返回到数组
		if ($f_rst) {//如果数组为真
			?>
            <table width="400" border="0" cellspacing="0" cellpadding="0">
                <form name="form1" method="post" action="#">
                    <tr>
                        <td width="100" height="30" align="right" valign="middle" scope="col">用户名：</td>
                        <td width="294" height="30" align="left" valign="middle" scope="col">
                            <input name="username" id="username" type="text" size="25" readonly="readonly"
                                   value="<?php echo $f_rst[1]; ?>"
                                   onmouseover="this.style.backgroundColor='#deebef'"
                                   onmouseout="this.style.backgroundColor=''">
                            <input type="hidden" name="id" value="<?php echo $f_rst[0]; ?>">
                        </td>
                    </tr>
                    <tr>
                        <td height="30" align="right" valign="middle" scope="col">请输入密码：</td>
                        <td height="30" align="left" valign="middle" scope="col">
                            <input name="password" type="password" size="25" id="password"
                                   onmouseover="this.style.backgroundColor='#deebef'"
                                   onmouseout="this.style.backgroundColor=''">
                        </td>
                    </tr>
                    <tr>
                        <td width="100" height="30" align="right" valign="middle">确认密码：</td>
                        <td width="294" height="30" align="left" valign="middle">
                            <input name="two_pwd" id="two_pwd" type="password" size="25"
                                   onmouseover="this.style.backgroundColor='#deebef'"
                                   onmouseout="this.style.backgroundColor=''">
                        </td>
                    </tr>
                    <tr>
                        <td height="30">&nbsp;</td>
                        <td height="30">
                            <input type="hidden" name="action" value="mod">
                            <input type="submit" name="Submit" value="提交" class="submit" onClick="return chk_pwd();">&nbsp;
                            <input type="reset" name="Submit2" value="重置" class="submit">
                        </td>
                    </tr>
                </form>
            </table>
			<?php
		} else {
			echo "<script>alert('密码提示问题或答案不正确，请重新输入');history.back();</script>";//弹出对话框
			exit();//退出程序
		}
	}
} else {
	if (isset($_POST['action']) && $_POST['action'] == "mod") {//如果action参数值为mod
		if ($_POST['password'] == $_POST['two_pwd']) {//如果两个参数值相等
			$m_sql = "update tb_account set password = '" . $_POST['password'] . "' where id = " . $_POST['id'];//定义更新语句
			if ($pdo->exec($m_sql) == 1 || $pdo->exec($m_sql) == 0)//如果执行语句结果为真
			{
				echo "<script>alert('密码修改成功，请登录');top.window.close();</script>";
			}//弹出对话框
			exit();//退出程序

		} else {
			echo "<script>alert('密码修改失败，请稍后再试');top.window.close();</script>";//弹出对话框
			exit();//退出程序
		}
	} else {
		?>
        <table width="400" border="0" cellspacing="0" cellpadding="0">
            <form name="form1" method="post" action="#">
                <tr>
                    <td width="100" height="30" align="right" valign="middle" scope="col">用户名：</td>
                    <td width="294" height="30" align="left" valign="middle" scope="col">
                        <input name="username" id="username" type="text" size="25"
                               onmouseover="this.style.backgroundColor='#deebef'"
                               onmouseout="this.style.backgroundColor=''">
                    </td>
                </tr>
                <tr>
                    <td height="30" align="right" valign="middle" scope="col">密码提示问题：</td>
                    <td height="30" align="left" valign="middle" scope="col">
                        <input name="question" type="text" size="25" id="question"
                               onmouseover="this.style.backgroundColor='#deebef'"
                               onmouseout="this.style.backgroundColor=''">
                    </td>
                </tr>
                <tr>
                    <td width="100" height="30" align="right" valign="middle">密码提示答案：</td>
                    <td width="294" height="30" align="left" valign="middle">
                        <input name="answer" id="answer" type="text" size="25"
                               onmouseover="this.style.backgroundColor='#deebef'"
                               onmouseout="this.style.backgroundColor=''">
                    </td>
                </tr>
                <tr>
                    <td height="30">&nbsp;</td>
                    <td height="30">
                        <input type="hidden" name="action" value="chk">
                        <input type="submit" name="Submit" value="提交" class="submit" onClick="return found_chk();">&nbsp;
                        <input type="reset" name="Submit2" value="重置" class="submit">
                    </td>
                </tr>
            </form>
        </table>
		<?php
	}
}
?>
