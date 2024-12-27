<?php
include_once("conn/conn.php");
include_once("top.php");
?>

<link rel="stylesheet" type="text/css" href="css/index.css">
<div class="main" style="position:relative;">
    <img src="images/bg_14_1.jpg"/>
    <span class="a9 bccd-position">升级下载</span>
</div>
<div class="main-box">
    <div class="sjxz-image"><img src="images/bg_14_6.jpg"/></div>
    <div>
        <div class="text1">使用说明：</div>
        <div class="text2">
            请选择你所购买的编程词典类别：
            <select name="select_type" onchange="javascript:window.location=this.options[this.selectedIndex].value">
				<?php
				$sql = mysqli_query($conn, "select * from tb_type order by createtime desc");
				$info = mysqli_fetch_array($sql);
				if ($info == "") {
					echo "<option>暂无讨论区</option>";
				} else {
					echo "<option>-请选择-</option>";
					do {
						echo "<option value='sjxz.php?id=" . $info['id'] . "'>" . $info['typename'] . "</option>";
					} while ($info = mysqli_fetch_array($sql));
				}
				?>
            </select>
        </div>
		<?php
		if (isset($_GET['id'])) {
			?>
            <div class="text3">当前编程词典类别：
				<?php
				$sql1 = mysqli_query($conn, "select * from tb_type where id='" . $_GET['id'] . "'");
				$info1 = mysqli_fetch_array($sql1);
				echo unhtml($info1['typename']);
				?>
            </div>
            <table class="sjxz-table" cellpadding="0" cellspacing="1">
                <tr>
                    <td align="center" width="229" height="22" bgcolor="#FFFFFF">升级包名称</td>
                    <td align="center" width="97" bgcolor="#FFFFFF">版本</td>
                    <td align="center" width="122" bgcolor="#FFFFFF">更新时间</td>
                    <td align="center" width="67" bgcolor="#FFFFFF">立即下载</td>
                </tr>
				<?php
				$sql2 = mysqli_query($conn,
					"select * from tb_sjxz where typeid='" . $_GET['id'] . "' order by addtime desc");
				$info2 = mysqli_fetch_array($sql2);
				if ($info2 == false) {
					?>
                    <tr>
                        <td align="center" height="22" colspan="4" bgcolor="#FFFFFF">对不起，暂无该类编程词典升级包！</td>
                    </tr>
					<?php
				} else {
					$sql20 = mysqli_query($conn,
						"select * from tb_xlh where bccdid='" . $info2['typeid'] . "' and bbid='" . $info2['bbid'] . "'");
					$info20 = mysqli_fetch_array($sql20);
					do {
						?>
                        <tr>
                            <td height="22" bgcolor="#FFFFFF">&nbsp;<?php echo unhtml($info2['name']); ?></td>
                            <td align="center" height="22" bgcolor="#FFFFFF"><?php
								$sql3 = mysqli_query($conn, "select * from tb_bb where id='" . $info2['bbid'] . "'");
								$info3 = mysqli_fetch_array($sql3);
								echo unhtml($info3['bbname']);
								?></td>
                            <td align="center" height="22" bgcolor="#FFFFFF"><?php echo $info2['addtime']; ?></td>
                            <td align="center" height="22" bgcolor="#FFFFFF">
								<?php
								if (isset($_SESSION['unc'])) {
									?>
                                    <img src="images/bg_14_5.jpg" width="22" height="22" border="0"
                                         onclick="opendiv(<?php echo $info20['id']; ?>,<?php echo $info3['id']; ?>,<?php echo $_GET['id']; ?>,<?php echo $info2['id']; ?>)"/>
									<?php
								} else {
									?>
                                    <img src="images/bg_14_5.jpg" width="22" height="22" border="0"
                                         onclick="javascript:alert('请先登录本站，然后下载升级包！');"/>
									<?php
								}
								?>
                            </td>
                        </tr>
						<?php
					} while ($info2 = mysqli_fetch_array($sql2));
				}
				?>
            </table>
			<?php
		}
		?>
    </div>
</div>

<script>
    function opendiv(x, y, z, m) {
        User.style.display = '';
        form_xlh.xzid.value = x;
        form_xlh.bbid.value = y;
        form_xlh.pid.value = z;
        form_xlh.sid.value = m;
        form_xlh.xlh.focus();
    }

    function chkinputxlh(form) {
        if (form.xlh.value == "") {
            alert('请输入产品序列号！');
            form.xlh.focus();
            return (false);
        }
        if (form.sid.value == "") {
            alert('您的浏览器已经禁用了JavaScript，请启用！');
            return (false);
        }
        return (true);
    }
</script>

<div id="User" style="position:absolute; display:none; left: 520px; top: 300px;">
    <div class="sjxz-box">
        <form name="form_xlh" method="post" action="downloadsj.php" onsubmit="return chkinputxlh(this)">
            请输入产品序列号：
            <input type="text" name="xlh" size="40" class="inputcss"><br><br>
            <input type="hidden" name="xzid" value="">
            <input type="hidden" name="bbid" value="">
            <input type="hidden" name="pid" value="">
            <input type="hidden" name="sid" value="">
            <span>
	  <input type="submit" value="确定">&nbsp;&nbsp;
	  <input type="button" value="取消" onclick="User.style.display='none'">
	  </span>
        </form>
    </div>
</div>