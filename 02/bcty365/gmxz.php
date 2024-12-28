<?php
include_once("conn/conn.php");
include_once("top.php");
?>
    <link rel="stylesheet" type="text/css" href="css/index.css">
    <div class="main" style="position:relative;">
        <img src="images/bg_14_1.jpg"/>
        <span class="a9 bccd-position">购买须知</span>
    </div>
    <div class="main-box">
		<?php
		$sqlb = mysqli_query($conn, "select * from tb_bccd order by addtime desc");
		$infob = mysqli_fetch_array($sqlb);
		if ($infob == false) {
			echo "<div class='gmxz-noresult'>对不起，暂无编程词典信息！</div>";
		} else {
			do {
				?>
                <div class="gmxz-table-title">
                    <img src="images/menubar_left[1].gif"/>
                    <span><?php echo unhtml($infob['bccdname']); ?></span>
                </div>
                <table class="gmxz-table" cellspacing="1">
					<?php
					$sqlq = mysqli_query($conn, "select * from tb_bbqb where bccdid='" . $infob['id'] . "'");
					$infoq = mysqli_fetch_array($sqlq);
					if ($infoq == false) {
						echo "<div align=center>对不起，该编程词典暂无版本信息！</div>";
					} else {
						?>
                        <tr>
                            <td width="98" height="22" bgcolor="#CCCCCC">
                                <div align="center">软件版本</div>
                            </td>
                            <td width="197" height="22" bgcolor="#CCCCCC">
                                <div align="center">功能</div>
                            </td>
                            <td width="261" height="22" bgcolor="#CCCCCC">
                                <div align="center">享受服务</div>
                            </td>
                            <td width="119" height="22" bgcolor="#CCCCCC">
                                <div align="center">价格(元)</div>
                            </td>
                        </tr>
						<?php
						do {
							?>
                            <tr>
                                <td height="22" bgcolor="#FFFFFF">&nbsp;
									<?php
									$sql0 = mysqli_query($conn,
										"select * from tb_bb where id='" . $infoq['bbid'] . "'");
									$info0 = mysqli_fetch_array($sql0);
									echo unhtml($info0['bbname']);
									?>
                                </td>
                                <td height="22" bgcolor="#FFFFFF">&nbsp;<?php echo unhtml($infoq['gn']); ?></td>
                                <td height="22" bgcolor="#FFFFFF">&nbsp;<?php echo unhtml($infoq['fw']); ?></td>
                                <td height="22" bgcolor="#FFFFFF">
                                    <div align="center"><?php echo $infoq['price']; ?></div>
                                </td>
                            </tr>
							<?php
						} while ($infoq = mysqli_fetch_array($sqlq));
					}
					?>
                </table>
				<?php
			} while ($infob = mysqli_fetch_array($sqlb));
		}
		?>
    </div>
<?php
include_once("bottom.php");
?>