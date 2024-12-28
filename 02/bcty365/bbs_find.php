<?php
include_once("top.php");
include_once("bbs_top.php");
?>
    <script>
        function chkinput(form) {
            if (form.find_name.value == "") {
                alert('请输入查找关键字!');
                form.find_name.select();
                return (false);
            }
        }
    </script>
    <div class="main-box">
        <table class="bbs-find-form">
            <tr>
                <td bgcolor="#F7F7F7">
                    <table width="750" height="25" bgcolor="#6EBEC7">
                        <tr>
                            <td align="center"><strong>查找帖子</strong></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td height="25" bgcolor="#F7F7F7">
                    <form name="form_findbbs" method="post" action="bbs_find.php" onSubmit="return chkinput(this)">
                        请输入关键字：<input type="text" name="find_name" size="35" maxlength="100" class="inputcss">
                        <select name="find_method" class="inputcss">
                            <option value="user">用户</option>
                            <option value="title">主题</option>
                            <option value="content">内容</option>
                        </select>
                        <input type="submit" name="submit" id="submit" value="查找" class="buttoncss">
                    </form>
                </td>
            </tr>
        </table>
		<?php
		if (isset($_POST["submit"]) || isset($_GET['page'])) {
			?>
            <table class="bbs-find-form">
				<?php
				if (!isset($_GET['findname'])) {
					$findname = $_POST['find_name'];
				} else {
					$findname = $_GET['findname'];
				}
				if (!isset($_GET['findmethod'])) {
					$findmethod = $_POST['find_method'];
				} else {
					$findmethod = $_GET['findmethod'];
				}
				if ($findmethod == "user") {
					$sql = mysqli_query($conn, "select id from tb_user where usernc='" . $findname . "'");
					$info = mysqli_fetch_array($sql);
					$sql2 = mysqli_query($conn,
						"select count(*) as total from tb_bbs where userid='" . $info['id'] . "'");
				} elseif ($findmethod == "title") {
					$sql2 = mysqli_query($conn,
						"select count(*) as total from tb_bbs where title like '%" . $findname . "%'");
				} elseif ($findmethod == "content") {
					$sql2 = mysqli_query($conn,
						"select count(*) as total from tb_bbs where content like '%" . $findname . "%'");
				}
				//$sql2=mysql_query("select count(*) as total from tb_bbs where typeid='".$typeid."'",$conn);
				$info2 = mysqli_fetch_array($sql2);
				$total = $info2['total'];
				if ($total == 0) {
					echo "<tr>";
					echo "<td height=\"20\" colspan=\"3\" bgcolor=\"#FFFFFF\"><div align=\"center\"> 对不起，没有查找到您要找的帖子！</div></td>";
					echo "</tr>";
				} else {
					if (empty($_GET['page']) == true || is_numeric($_GET['page']) == false) {
						$page = 1;
					} else {
						$page = intval($_GET['page']);
					}
					$pagesize = 5;
					if ($total < $pagesize) {
						$pagecount = 1;
					} else {
						if ($total % $pagesize == 0) {
							$pagecount = intval($total / $pagesize);
						} else {
							$pagecount = intval($total / $pagesize) + 1;
						}
					}
					if ($findmethod == "user") {
						$sql = mysqli_query($conn, "select id from tb_user where usernc='" . $findname . "'");
						$info = mysqli_fetch_array($sql);
						$sql2 = mysqli_query($conn,
							"select * from tb_bbs where  userid='" . $info['id'] . "' order by createtime desc  limit " . ($page - 1) * $pagesize . ",$pagesize");
					} elseif ($findmethod == "title") {
						$sql2 = mysqli_query($conn,
							"select * from tb_bbs where title like '%" . $findname . "%' order by createtime desc  limit " . ($page - 1) * $pagesize . ",$pagesize");
					} elseif ($findmethod == "content") {
						$sql2 = mysqli_query($conn,
							"select * from tb_bbs where  content like '%" . $findname . "%' order by createtime desc  limit " . ($page - 1) * $pagesize . ",$pagesize");
					}
					//$sql2=mysql_query("select * from tb_bbs where  typeid='".$typeid."' order by createtime desc  limit ".($page-1)*$pagesize.",$pagesize",$conn);
					?>
                    <tr>
                        <td colspan="5" bgcolor="#F7F7F7">
                            <table width="750" height="25" bgcolor="#6EBEC7">
                                <tr>
                                    <td align="left" style="padding-left:30px;">
										<?php
										if ($findmethod == "user") {
											echo "按用户进行查找";
										} elseif ($findmethod == "title") {
											echo "按主题进行查找";
										} elseif ($findmethod == "content") {
											echo "按内容进行查找";
										}
										?>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td width="308" height="25" align="center" bgcolor="#F7F7F7">主&nbsp;&nbsp;题</td>
                        <td width="78" align="center" bgcolor="#F7F7F7">版主</td>
                        <td width="58" align="center" bgcolor="#F7F7F7">回复次数</td>
                        <td width="117" align="center" bgcolor="#F7F7F7">创建时间</td>
                        <td width="117" align="center" bgcolor="#F7F7F7">最后回复时间</td>
                    </tr>
					<?php
					while ($info2 = mysqli_fetch_array($sql2)) {
						$sql3 = mysqli_query($conn, "select * from tb_user where id='" . $info2['userid'] . "'");
						$info3 = mysqli_fetch_array($sql3);
						?>
                        <tr>
                            <td height="23" align="right" bgcolor="#F7F7F7">
                                <div align="left">&nbsp;&nbsp;
                                    <a href="bbs_lookbbs.php?id=<?php echo $info2['id']; ?>" class="a1">
										<?php include_once("function.php");
										echo unhtml($info2['title']); ?>
                                    </a>
                                </div>
                            </td>
                            <td height="23" bgcolor="#F7F7F7">
                                <div align="center"><?php echo $info3['usernc']; ?></div>
                            </td>
                            <td height="23" bgcolor="#F7F7F7">
                                <div align="center">
									<?php
									$sql4 = mysqli_query($conn,
										"select count(*) as totalreply from tb_reply where bbsid='" . $info2['id'] . "'");
									$info4 = mysqli_fetch_array($sql4);
									echo $info4['totalreply'];
									?>
                                </div>
                            </td>
                            <td height="23" bgcolor="#F7F7F7">
                                <div align="center"><?php echo $info2['createtime']; ?></div>
                            </td>
                            <td height="23" bgcolor="#F7F7F7">
                                <div align="center"><?php echo $info2['lastreplytime']; ?></div>
                            </td>
                        </tr>
						<?php
					}
				}
				?>
            </table>
			<?php
			if ($total != 0) {
				?>
                <div class="bbs-page">
                    <div class="bbs-page-left">共查找到帖子<?php echo $total; ?>条&nbsp;每页显示<?php echo $pagesize; ?>
                        条&nbsp;第<?php echo $page; ?>页/共<?php echo $pagecount; ?>页
                    </div>
                    <div class="bbs-page-right">
                        <a href="<?php echo $_SERVER["PHP_SELF"] ?>?page=1&findname=<?php echo $findname; ?>&findmethod=<?php echo $findmethod; ?>"
                           class="a1">首页</a>&nbsp;<a href="<?php echo $_SERVER["PHP_SELF"] ?>?page=<?php
						if ($page > 1) {
							echo $page - 1;
						} else {
							echo 1;
						}
						?>&findname=<?php echo $findname; ?>&findmethod=<?php echo $findmethod; ?>"
                                                       class="a1">上一页</a>&nbsp;<a
                                href="<?php echo $_SERVER["PHP_SELF"] ?>?page=<?php
								if ($page < $pagecount) {
									echo $page + 1;
								} else {
									echo $pagecount;
								}
								?>&findname=<?php echo $findname; ?>&findmethod=<?php echo $findmethod; ?>" class="a1">下一页</a>&nbsp;<a
                                href="<?php echo $_SERVER["PHP_SELF"] ?>?page=<?php echo $pagecount; ?>&findname=<?php echo $findname; ?>&findmethod=<?php echo $findmethod; ?>"
                                class="a1">尾页</a></div>
                </div>
				<?php
			}
		}
		?>
    </div>
<?php
include_once("bottom.php");
?>