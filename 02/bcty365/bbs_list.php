<?php
include_once("top.php");
include_once("bbs_top.php");
?>
    <script language="javascript">
        function ShowTR(objImg, objTr) {
            if (objTr.style.display == "") {
                objTr.style.display = "none";
                objImg.src = "images/jia.gif";
                objImg.alt = "展开";
            } else {
                objTr.style.display = "";
                objImg.src = "images/jian.gif";
                objImg.alt = "折叠";
            }
        }
    </script>
    <div class="main-box">
        <div class="bbs-table">
            <div class="bbs-table-title">
				<?php
				$typeid = $_GET['id'];
				$sql = mysqli_query($conn, "select * from tb_type_small where id='" . $typeid . "'");
				$info = mysqli_fetch_array($sql);
				?>
                <span><?php echo unhtml($info['title']); ?>&nbsp;版块</span>
                <span class="publish">【&nbsp;<a href="
		            <?php
					if (isset($_SESSION["unc"])) {
						?>
			            bbs_pubbs.php?ids=<?php echo unhtml($info['title']); ?>&id=<?php echo $info['id']; ?>
		            <?php
					} else {
						echo "javascript:alert('请先登录本站，然后发表帖子！');window.location.href='index.php';";
					}
					?>" class="a8">发表帖子</a>&nbsp;】
                </span>
            </div>
            <table width="750" border="1" align="center" cellpadding="1" cellspacing="1" bordercolor="#FFFFFF"
                   bgcolor="#6EBEC7" id="tab_list">
				<?php
				$sql = mysqli_query($conn, "select count(*) as total from tb_bbs where typeid='" . $typeid . "'");
				$info = mysqli_fetch_array($sql);
				$total = $info['total'];
				if ($total == 0) {
					echo "<tr>";
					echo "<td  height=\"25\"  bgcolor=\"#FFFFFF\"><div align=\"center\">该讨论区无人发贴!</div></td>";
					echo "</tr>";
				} else {
					if (empty($_GET['page']) == true || is_numeric($_GET['page']) == false) {
						$page = 1;
					} else {
						$page = intval($_GET['page']);
					}
					$pagesize = 30;
					if ($total < $pagesize) {
						$pagecount = 1;
					} else {
						if ($total % $pagesize == 0) {
							$pagecount = intval($total / $pagesize);
						} else {
							$pagecount = intval($total / $pagesize) + 1;
						}
					}
					?>
                    <tr>
                        <td width="51" height="23" bgcolor="#F0F5FA">
                            <div align="center">状&nbsp;&nbsp;态</div>
                        </td>
                        <td width="41" bgcolor="#F0F5FA">
                            <div align="center">心&nbsp;&nbsp;情</div>
                        </td>
                        <td width="462" height="23" bgcolor="#F0F5FA">
                            <div align="center">主&nbsp;&nbsp;&nbsp;题</div>
                        </td>
                        <td width="79" bgcolor="#F0F5FA">
                            <div align="center">回复|人气</div>
                        </td>
                        <td width="122" bgcolor="#F0F5FA">
                            <div align="center">版&nbsp;&nbsp;主</div>
                        </td>
                        <td width="159" bgcolor="#F0F5FA">
                            <div align="center">发贴时间</div>
                        </td>
                    </tr>
					<?php
					$sql = mysqli_query($conn,
						"select * from tb_bbs where  typeid='" . $typeid . "' order by top desc,createtime desc,lastreplytime desc limit " . ($page - 1) * $pagesize . ",$pagesize");
					while ($info = mysqli_fetch_array($sql)) {
						?>
                        <tr>
                            <td height="23" bgcolor="#E9F3FF">
                                <div align="center">
									<?php
									if ($info['top'] == 1) {
										echo "<img src=\"images/lt_15_4.jpg\" width=\"30\" height=\"25\">";
									} else {
										if ($info['readtimes'] >= 5) {
											echo "<img src=\"images/lt_15_4.jpg\" width=\"30\" height=\"25\">";
										} else {
											echo " <img src=\"images/lt_15_4.jpg\" width=\"30\" height=\"25\">";
										}
									}
									?>
                                </div>
                            </td>
                            <td height="23" bgcolor="#E9F3FF">
                                <div align="center"><img src="<?php echo $info['head']; ?>"/></div>
                            </td>
                            <td height="23" bgcolor="#E9F3FF" class="a12">&nbsp;
                                <img src="images/jia.gif" border="0" alt="展开" id="img<?php echo $info['id']; ?>"
                                     onclick="ShowTR(img<?php echo $info['id']; ?>,tr<?php echo $info['id']; ?>)"/>
								<?php
								include_once("function.php");
								if ($info['top'] == 1) {
									echo "<a href=\"bbs_lookbbs.php?id=" . $info['id'] . "\" class=a1>" . unhtml($info['title']) . "";
								} else {
									echo "<a href=\"bbs_lookbbs.php?id=" . $info['id'] . "\" class=a1>" . unhtml($info['title']);
								}
								?>
                                <div align="left"></div>
                            </td>
                            <td height="23" bgcolor="#E9F3FF">
                                <div align="center">
									<?php
									$sql1 = mysqli_query($conn,
										"select count(*) as total from tb_reply where bbsid='" . $info['id'] . "'");
									$info1 = mysqli_fetch_array($sql1);
									echo $info1['total'];
									?>&nbsp;|&nbsp;<?php echo $info['readtimes']; ?></div>
                            </td>
                            <td height="23" bgcolor="#E9F3FF">
                                <div align="center">
									<?php
									$sql1 = mysqli_query($conn,
										"select usernc from tb_user where id='" . $info['userid'] . "'");
									$info1 = mysqli_fetch_array($sql1);
									echo $info1['usernc'];
									?>
                                </div>
                            </td>
                            <td height="23" bgcolor="#E9F3FF">
                                <div align="center"><?php echo $info['createtime']; ?></div>
                            </td>
                        </tr>
                        <tr id="tr<?php echo $info['id']; ?>" style="display:none">
                            <td height="23" bgcolor="#E9F3FF">&nbsp;</td>
                            <td height="23" colspan="5" bgcolor="#E9F3FF">
                                <table width="650" height="25" border="0" align="center" cellpadding="0"
                                       cellspacing="0">
									<?php
									$sqlr = mysqli_query($conn,
										"select * from tb_reply where  bbsid='" . $info['id'] . "' order by createtime asc");
									$infor = mysqli_fetch_array($sqlr);
									if ($infor == false) {
										?>
                                        <tr>
                                            <td width="750" height="25">
                                                <div align="center">该贴暂无回复!</div>
                                            </td>
                                        </tr>
										<?php
									} else {
										$m = 0;
										$k = 1;
										do {
											?>
                                            <tr>
                                                <td width="750" height="25"
                                                    bgcolor="#E9F3FF"><?php if ($m % 3 == 0) {
														$k++;
													} ?>
													<?php echo ($m + 1) . ".&nbsp;"; ?><a
                                                            href="bbs_lookbbs.php?id=<?php echo $info['id'] ?>&page=<?php echo($k - 1); ?>"
                                                            class="a4"><?php echo $infor['title']; ?></a>&nbsp;(<?php echo $infor['createtime']; ?>
                                                    )
                                                </td>
                                            </tr>
											<?php
											$m++;
										} while ($infor = mysqli_fetch_array($sqlr));
									}
									?>
                                </table>
                            </td>
                        </tr>
						<?php
					}
				}
				?>
            </table>
        </div>
		<?php
		if ($total != 0) {
			?>
            <div class="bbs-page">
                <div class="bbs-page-left">共有帖子<?php echo $total; ?>条&nbsp;每页显示<?php echo $pagesize; ?>条&nbsp;第<?php echo $page; ?>
                    页/共<?php echo $pagecount; ?>页
                </div>
                <div class="bbs-page-right">
                    <a href="<?php echo $_SERVER["PHP_SELF"] ?>?page=1&id=<?php echo $_GET["id"]; ?>"
                       class="a1">首页</a>&nbsp;<a href="<?php echo $_SERVER["PHP_SELF"] ?>?page=<?php
					if ($page > 1) {
						echo $page - 1;
					} else {
						echo 1;
					}
					?>&id=<?php echo $_GET["id"]; ?>" class="a1">上一页</a>&nbsp;<a
                            href="<?php echo $_SERVER["PHP_SELF"] ?>?page=<?php
							if ($page < $pagecount) {
								echo $page + 1;
							} else {
								echo $pagecount;
							}
							?>&id=<?php echo $_GET["id"]; ?>" class="a1">下一页</a>&nbsp;<a
                            href="<?php echo $_SERVER["PHP_SELF"] ?>?page=<?php echo $pagecount; ?>&id=<?php echo $_GET["id"]; ?>"
                            class="a1">尾页</a></div>
            </div>
			<?php
		}
		?>
    </div>
<?php
include_once("bottom.php");
?>