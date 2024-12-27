<?php
include_once("conn/conn.php");
include_once("top.php");
?>
    <link rel="stylesheet" type="text/css" href="css/index.css">
    <div class="main" style="position:relative;">
        <img src="images/bg_14_1.jpg"/>
        <span class="a9 bccd-position">编程词典</span></div>
    <div class="main-box">
		<?php
		$sql = mysqli_query($conn, "SELECT COUNT(*) AS total1 FROM tb_bccd ");
		$info = mysqli_fetch_array($sql);
		$total1 = $info['total1'];
		if (empty($_GET['page']) == true || is_numeric($_GET['page']) == false) {
			$page1 = 1;
		} else {
			$page1 = intval($_GET['page']);
		}
		if ($total1 == 0) {
			echo "<div align=center>暂无新书</div>";
		} else {
			$pagesize1 = 8;
			if ($total1 < $pagesize1) {
				$pagecount1 = 1;
			} else {
				if ($total1 % $pagesize1 == 0) {
					$pagecount1 = intval($total1 / $pagesize1);
				} else {
					$pagecount1 = intval($total1 / $pagesize1) + 1;
				}
			}
			$sql = mysqli_query($conn,
				"select * from tb_bccd order by bccdname desc, addtime desc  limit " . ($page1 - 1) * $pagesize1 . ",$pagesize1");
			$info = mysqli_fetch_array($sql);
			$i = 1;
			do {
				?>
                <div class="bccd-box">
                    <div class="bccd-image2">
                        <a href="<?php echo $info["imageaddress"]; ?>">
                            <img src=" <?php echo $info["imageaddress"]; ?>" width="135" height="150" border="0">
                        </a>
                    </div>
                    <div class="bccd-info2">
                        <img src="images/bg_14_2.jpg" width="236" height="24">
                        <span class="a10 bccd-name">名&nbsp;&nbsp;称：
                        <?php
                        echo unhtml($info["bccdname"]);
                        ?>
                        </span>
                        <ul>
                            <li>所属版本：
								<?php
								$sqlt = mysqli_query($conn,
									"select id,bbname from tb_bb where id='" . $info["bbid"] . "'");
								$infot = mysqli_fetch_array($sqlt);
								echo unhtml($infot["bbname"]);
								?></li>
                            <li>价&nbsp;&nbsp;格：
								<?php
								echo number_format($info["price"], 2) . "&nbsp;元";
								?>
                            </li>
                            <li>版&nbsp;&nbsp;权：
								<?php
								echo unhtml($info["owner"]);
								?>
                            </li>
                        </ul>
                        <a href="bccdinfo.php?id=<?php echo $info['id']; ?>">
                            <img src="images/bg_14_3.jpg" border="0" width="69" height="20"/>
                        </a>&nbsp;
                        <a href="shopping_cart_first.php?id=<?php echo $info['id']; ?>">
                            <img src="images/bg_14_4.jpg" width="69" height="20" border="0"/>
                        </a>&nbsp;
                        <a href="shopping_cart.php">
                            <img src="images/bg_14_16.jpg" border="0" width="80" height="22"/>
                        </a>
                    </div>
                </div>
				<?php
				$i++;
			} while ($info = mysqli_fetch_array($sql));
		}
		?>
        <div class="bccd-page">
            <div class="bccd-page-left">
                共有编程词典<?php echo $total1; ?>个&nbsp;每页显示<?php echo $pagesize1; ?>
                个&nbsp;第<?php echo $page1; ?>
                页/共<?php echo $pagecount1; ?>页
            </div>
            <div class="bccd-page-right">
                <a href="<?php echo $_SERVER["PHP_SELF"] ?>?page=1" class="a1">首页</a>&nbsp;
                <a href="<?php echo $_SERVER["PHP_SELF"] ?>?page=<?php
				if ($page1 > 1) {
					echo $page1 - 1;
				} else {
					echo 1;
				}
				?>" class="a1">
                    上一页
                </a>&nbsp;
                <a href="<?php echo $_SERVER["PHP_SELF"] ?>?page=<?php
				if ($page1 < $pagecount1) {
					echo $page1 + 1;
				} else {
					echo $pagecount1;
				}
				?>" class="a1">
                    下一页
                </a>&nbsp;
                <a href="<?php echo $_SERVER["PHP_SELF"] ?>?page=<?php echo $pagecount1; ?>" class="a1">尾页</a>
            </div>
        </div>
    </div>
<?php
include_once("bottom.php");
?>