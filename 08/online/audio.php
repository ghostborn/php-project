<?php
include "conn/conn.php";//包含数据库连接文件
$t_sqlstr = "SELECT * FROM tb_audio ORDER BY downTime DESC LIMIT 0,7";//定义查询语句
$result = $pdo->prepare($t_sqlstr);//准备查询
$result->execute();//执行查询
$num = 1;//初始化变量
$t_rst = $result->fetch(PDO::FETCH_NUM);//将查询结果返回到数组中
?>
<table width="100%" border="0" cellpadding="0" cellspacing="0" style="margin-top:36px;">
    <tr>
        <td height="70" align="left" valign="bottom" style="font-size:22px;">歌曲下载排行榜</td>
    </tr>
</table>
<table width="100%" border="0" cellpadding="0" cellspacing="0" style="position:relative;margin-top: 6px;">
    <tr>
        <td height="220" align="center" colspan="3">
            <a href="operation.php?action=listen&id=<?php echo $t_rst[16]; ?>"
               target="_blank" onclick="return chk_listen()">
                <img width="100%" height="220" src="<?php echo "upfiles/audio/" . $t_rst[2]; ?>"/>
            </a>
            <div style="width:18%; height:10%; line-height:350%; background-color:#2bb673; color:#FFFFFF; font-size:14px; position:absolute; top:36.5%; left:0px;">
				<?php echo $num; ?>
            </div>
            <div style=" font-size:16px; font-weight:bolder; color:#FFFFFF; position:absolute; top:39%; left:22%;">
				<?php echo $t_rst[1]; ?>
            </div>
        </td>
    </tr>
	<?php
	while ($t_rst = $result->fetch(PDO::FETCH_NUM)) {//循环输出查询结果
		$num++;//变量自加1
		?>
        <tr height="42">
            <td width="36" align="center" valign="middle" class="f_td"><?php echo $num; ?></td>
            <td width="130" align="left" valign="middle" class="f_td" style="padding-left:18px"><a
                        href="operation.php?action=listen&id=<?php echo $t_rst[16]; ?>" target="_blank"
                        onclick="return chk_listen()"><?php echo $t_rst[1]; ?></a></td>
            <td width="25" align="center" valign="middle" class="f_td"><?php echo $t_rst[19]; ?></td>
        </tr>
		<?php
	}
	?>
</table>
