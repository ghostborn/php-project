<?php if (isset($_POST['action']) && $_POST['action'] == "search") {//如果参数action的值为search
	?>
    <script language="javascript">
        top.opener.location = "main.php?action=member&types=<?php echo $_POST['types1']; ?>&key=<?php echo $_POST['keyword']; ?>";
        top.window.close();
    </script>
	<?php
	exit;//退出程序
}
?>
<?php
include "conn/conn.php";//包含数据库连接文件
include "inc/chec.php";//包含判断用户权限文件

?>
<table width="558" height="110" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
        <td width="567" height="26" align="center" valign="middle"><font style="font-size:13px; ">会 员 信 息 查
                询</font></td>
    </tr>
    <tr>
        <td>
            <table width="559" height="94" align="center" cellpadding="0" cellspacing="0">
                <tr>
                    <td height="92">
                        <table width="404" height="90" border="0" align="center" cellpadding="0" cellspacing="0">
                            <tr>
                                <td width="402" valign="top">
                                    <table width="400" border="0" align="center" cellpadding="0" cellspacing="0">

                                        <tr>
                                            <td height="15" colspan="2">&nbsp;</td>
                                        </tr>
                                        <form name="list" method="post"
                                              action="<?php isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : ""; ?>">
                                            <tr>
                                                <td width="150" height="40" align="right" valign="middle">查 询 方 式
                                                    ：
                                                </td>
                                                <td width="250" height="40" align="left" valign="middle"><select
                                                            name="types" onChange="javascript:list.submit()">
                                                        <option value="name" <?php if (isset($_POST['types']) && ($_POST['types'] == "name") or !isset($_POST['types'])) {
															echo "selected";
														} ?>>按用户名
                                                        </option>
                                                        <option value="grade" <?php if (isset($_POST['types']) && $_POST['types'] == "grade") {
															echo "selected";
														} ?>>按会员等级
                                                        </option>
                                                        <option value="counts" <?php if (isset($_POST['types']) && $_POST['types'] == "counts") {
															echo "selected";
														} ?>>按上传数量
                                                        </option>
                                                        <option value="sex" <?php if (isset($_POST['types']) && $_POST['types'] == "sex") echo "selected" ?>>
                                                            按性别
                                                        </option>
                                                    </select></td>
                                            </tr>
                                        </form>
                                        <form name="list1" method="post" action="v_found.php">
											<?php switch (isset($_POST['types']) ? $_POST['types'] : "") { //判断参数types的值
												case ""://如果参数值为空
													names();//执行names()函数
													break;//跳出switch语句
												case "name"://如果参数值为name
													names();//执行names()函数
													break;//跳出switch语句
												case "grade"://如果参数值为grade
													grade();//执行grade()函数
													break;//跳出switch语句
												case "counts"://如果参数值为counts
													counts();//执行counts()函数
													break;//跳出switch语句
												case "sex"://如果参数值为sex
													sex();//执行sex()函数
													break;//跳出switch语句
												default:
													names();//执行names()函数
													break;//跳出switch语句
											}
											?>
                                            <input name="types1" type="hidden"
                                                   value="<?php if (!isset($_POST['types'])) {
												       echo "name";
											       } else {
												       echo $_POST['types'];
											       } ?>">
                                            <input type="hidden" name="action" value="search">
                                            <tr>
                                                <td height="30" colspan="2" align="center" valign="middle">
                                                    <input name="Submit" type="submit" class="submit"
                                                           value="  查  询  ">
                                                    <input name="Submit2" type="button" class="submit"
                                                           value="  返  回  " onClick="javascript:top.window.close()">
                                                </td>
                                            </tr>
                                        </form>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</body>
</html>
<?php
function names()
{//定义names()函数
	?>
    <tr>
        <td height="40" align="right" valign="middle">
            用 户 名 ：
        </td>
        <td height="40"><input name="keyword" type="text" id="name"></td>
    </tr>
	<?php
}

function grade()
{//定义grade()函数
	?>
    <tr>
        <td height="40" align="right" valign="middle">会 员 等 级 ：</td>
        <td height="40">
            <input name="keyword" type="radio" value="普通会员" checked>
            普通会员
            <input type="radio" name="keyword" value="高级会员">
            高级会员
        </td>
    </tr>
	<?php
}

function counts()
{//定义counts()函数
	?>
    <tr>
        <td height="40" align="right" valign="middle">上 传 数 量 ：</td>
        <td height="40">
            <input name="keyword" type="text" id="name">以内
        </td>
    </tr>
	<?php
}

function sex()
{//定义sex()函数
	?>
    <tr>
        <td height="40" align="right" valign="middle">性 别 ：</td>
        <td height="40">
            <input type="radio" name="keyword" value="man">
            男
            <input name="keyword" type="radio" value="male" checked>
            女
        </td>
    </tr>
	<?php
}

?>
