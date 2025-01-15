<?php
include "conn/conn.php";//包含数据库连接文件
$v_sqlstr = "SELECT * FROM tb_video ORDER BY downTime DESC LIMIT 0,7";//定义查询语句
$result = $pdo->prepare($v_sqlstr);//准备查询
$result->execute();//执行查询
$vnum = 1;//为变量赋值
$v_rst = $result->fetch(PDO::FETCH_NUM);//将查询结果返回到数组中
?>
<table width="100%" border="0" cellpadding="0" cellspacing="0" style="margin-top:0px;">
    <tr>
        <td align="left" height="70" style="font-size:22px;" valign="bottom">电影榜</td>
    </tr>
</table>
<table width="100%" border="0" cellpadding="0" cellspacing="0" style="position:relative; margin-top: 2px;">
    <tr>
        <td height="220" colspan="3" align="center">
            <a href="operation.php?action=see&id=<?php echo $v_rst[16]; ?>" target="_blank" onclick="return chk_see()">
                <img width="100%" height="220" src="<?php echo "upfiles/video/" . $v_rst[2]; ?>"/>
            </a>
            <div style="width:18%; height:10%; line-height:350%; background-color:#2bb673; color:#FFFFFF; font-size:14px; position:absolute; top:36%; left:0px;">
				<?php echo $vnum; ?>
            </div>
            <div style="font-size:16px; font-weight:bolder; color:#FFFFFF; position:absolute; top:39%; left:22%;">
				<?php echo $v_rst[1]; ?>
            </div>
        </td>
    </tr>
	<?php
	while ($v_rst = $result->fetch(PDO::FETCH_NUM)) {//循环输出查询结果
		$vnum++;//变量自加1
		?>
        <tr height="43">
            <td width="36" align="center" valign="middle" class="f_td"><?php echo $vnum; ?></td>
            <td width="130" align="left" valign="middle" class="f_td" style="padding-left:18px">
                <a href="operation.php?action=see&id=<?php echo $v_rst[16]; ?>" target="_blank"
                   onclick="return chk_see()"><?php echo $v_rst[1]; ?>
            </td>
            <td width="25" align="center" valign="middle" class="f_td"><?php echo $v_rst[19]; ?></td>
        </tr>
		<?php
	}
	?>
</table>