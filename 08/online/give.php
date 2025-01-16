<?php
session_start();//启动Session
include "conn/conn.php";//包含数据库连接文件
?>
    <script src="js/register.js"></script>
    <table width="558" height="110" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
            <td width="567" height="46" valign="bottom">
                <div align="center">
                    <font style="color:#000000; font-size:24px; padding-top:20px; ">点 歌 记 录 详 单</font>
                </div>
            </td>
        </tr>
        <tr>
            <td>
                <table border="0" width="559" height="94" align="center" cellpadding="0" cellspacing="0">
                    <form name="list" method="post" action="?action=give&id=<?php echo $_GET['id']; ?>">
                        <tr>
                            <td height="15" colspan="2">&nbsp;</td>
                        </tr>
                        <tr valign="top">
                            <td width="100" height="30">
                                <div align="right">接收人：</div>
                            </td>
                            <td width="325" height="30">
                                <input name="toname" type="text" id="toname" size="30" class="usual">
                            </td>
                        </tr>
                        <tr>
                            <td height="30" valign="top">
                                <div align="right">祝福语：</div>
                            </td>
                            <td height="80" valign="top">
                                <textarea name="remark" cols="40" rows="5" id="remark"></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td height="40" colspan="2">
                                <div align="center">
                                    <input name="id" type="hidden"
                                           value="<?php echo $_GET['id'] ?? "" ?>">
                                    <input name="Submit" type="button" value="  点  歌  " onClick="return register()">
                                    <input name="Submit2" type="button" value="  返  回  "
                                           onClick="javascript:top.window.close()">
                                </div>
                            </td>
                        </tr>
                    </form>
                </table>
            </td>
        </tr>
    </table>

<?php
if (isset($_POST['toname']) && $_POST['toname'] <> "") {//如果toname参数值不为空
	$sql = "select * from tb_account where name='" . $_POST['toname'] . "'";//定义查询语句
	$result = $pdo->prepare($sql);//准备查询
	$result->execute();//执行查询
	if (!$rst = $result->fetch(PDO::FETCH_NUM)) {//如果查询结果不为真
		echo "<script>alert('该会员不存在，请重新输入！');</script>";//弹出提示信息
		exit();//退出程序
	}
	$id = $_POST['id'];//为变量赋值
	$toname = $_POST['toname'];//为变量赋值
	$from = $_SESSION['name'];//为变量赋值
	$remark = $_POST['remark'];//为变量赋值


	$sql = "insert into tb_register (name,fromName,toName,remark,issueDate) values(" . $id . ",'" . $from . "','" . $toname . "','" . $remark . "','" . date("Y-m-d H:i:s") . "')";//定义插入语句
	$rst = $pdo->exec($sql);//执行语句

	?>
    <script language="javascript">
		<?php
		if(!($rst == false)){
		?>
        alert("点歌信息保存成功");//弹出对话框
		<?php
		}else{
		?>
        alert("点歌失败");//弹出对话框
		<?php
		}
		?>
        top.opener.location.reload();//刷新父窗口
        top.window.close();//关闭当前页面
    </script>
	<?php
}
?>