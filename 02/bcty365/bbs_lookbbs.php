<?php
include_once("top.php");
include_once("bbs_top.php");
//根据$_GET传递的数据获取tb_bbs中的数据
$sqlb = mysqli_query($conn, "select * from tb_bbs where id='" . $_GET["id"] . "'");
$infob = mysqli_fetch_array($sqlb);
//根据$_GET传递的数据获取tb_user中的数据
$sql4 = mysqli_query($conn, "select * from tb_user where id='" . $infob["userid"] . "' ");
$info4 = mysqli_fetch_array($sql4);
?>
<script>
    function show_reply() {
        if (reply_bbs1.style.display == "") {
            reply_bbs1.style.display = "none";
            //button_show_bbs.value="回复帖子";
        } else if (reply_bbs1.style.display == "none") {
            reply_bbs1.style.display = "";
            //button_show_bbs.value="关闭窗口";
        }
    }
</script>

<div class="main-box">
    <div class="bbs-table">
        <div class="bbs-table-title">
            <span><?php echo unhtml($infob["title"]); ?></span>
        </div>
        <table class="lookbbs-table" cellspacing="1" bgcolor="#6EBEC7">
            <tr>
                <td width="210" bgcolor="#FFFFFF">
                    <div class="lookbbs-table-left">
                        <ul>
                            <li>
                                <div align="center"><img src="<?php echo $info4['photo']; ?>"/></div>
                            </li>
                            <li>
                                <div align="center">发贴人：<?php echo $info4['usernc']; ?></div>
                            </li>
                            <li>
                                <div align="center"><img src="images/lt_15_6.jpg" width="42" height="16"
                                                         alt="<?php echo $info4['email']; ?>"/><img
                                            src="images/lt_15_7.jpg" width="48" height="16"
                                            alt="<?php echo $info4['qq']; ?>"/><img src="images/lt_15_8.jpg"
                                                                                    width="53" height="16"
                                                                                    alt="<?php echo $info4['ip']; ?>"/>
                                </div>
                            </li>
                            <li>用户级别：
								<?php
								//根据用户信息表tb_user中字段usertype的值判断该用户的类型
								//如果值为1则是管理员，值为2则是后台管理员，值为0则是普通会员
								if ($info4["usertype"] == "1") {
									echo "管理员";
								} else {
									echo "普通会员";
								}
								?>
                            </li>
                            <li>发贴总数：<?php echo $info4["pubtimes"]; ?></li>
                            <li>注册时间：<?php echo $info4["regtime"]; ?></li>
                        </ul>
                    </div>
                </td>
                <td bgcolor="#FFFFFF" class="lookbbs-table-publish">
                    <div><img src="images/lt_15_11.jpg" width="25" height="25">
                        <span><?php echo $infob["createtime"]; ?></span></div>
                    <div>
						<?php
						//判断tb_bbs表中的字段photo是否为空，为空则执行下面的内容
						if ($infob['photo'] != "") {
							$photos = substr($infob['photo'], 2, 70);//获取图片在服务器中的存储路径
							echo(stripslashes($infob["content"]));       //输出帖子的内容
							echo "<img src=\"$photos\">";//根据获取的图片路径，输出服务器中的图片
						} else {//如果tb_bbs表中的图片字段photo为空，则执行下面的内容
							echo(stripslashes($infob["content"]));//只输出帖子的内容
						}
						?>
                    </div>
                    <div>
                        <img src="images/lt_15_9.jpg" width="72" height="23" id="button_show_bbs"
                             style="cursor:hand" onClick="<?php
						if (!isset($_SESSION["unc"])) {
							echo "javascript:alert('请先登录本站，然后回复帖子！');window.location.href='index.php';";
						} else {
							?>
                                show_reply()
							<?php
						}
						?>"/>
                        <img src="images/lt_15_5.jpg" width="72" height="23" style="cursor:hand" onclick="<?php
						//如果$_SESSION["unc"]的值为空，则不可以进行顶帖子的操作
						if (!isset($_SESSION["unc"])) {
							echo "javascript:alert('请先登录本站,然后进行此操作！');window.location.href='index.php';";
						} else {
							//否则将判断当前用户的类型，如果是管理员则可以顶帖
							$sqlu = mysqli_query($conn,
								"select  usertype from tb_user where usernc='" . $_SESSION["unc"] . "'");
							$infou = mysqli_fetch_array($sqlu);
							if ($infou["usertype"] == 1) {//如果用户的类型为1，则有顶帖的权限
								echo "javascript:window.location.href='settop.php?id=" . $infob["id"] . "'";
							} else {//否则不具备该权限
								echo "javascript:alert('对不起，您不具备该操作权限！');";
							}
						}
						?>"/>
						<?php
						//判断当前用户是否具有删除帖子的权限
						if (isset($_SESSION["unc"])) {
							//条件为用户不能为空，并且是管理员，才具备删除帖子的权限
							$sqlu = mysqli_query($conn,
								"select usertype from tb_user where usernc='" . $_SESSION["unc"] . "'");
							$infou = mysqli_fetch_array($sqlu);
							if ($infou["usertype"] == 1) {
								?><img src="images/lt_15_10.jpg"
                                       onclick="javascript:if(window.confirm('您确定删除该帖么？')==true){window.location.href='bbs_delete.php?id=<?php echo $infob["id"] ?>';}"
                                       style="cursor:hand"/>
								<?php
							}
						}
						?>
                    </div>
                </td>
            </tr>
            <tr id="reply_bbs1" style="display:none">
                <td bgcolor="#FFFFFF">
					<?php
					$sql2 = mysqli_query($conn, "select * from tb_user where usernc='" . $_SESSION["unc"] . "'");
					$info2 = mysqli_fetch_array($sql2);
					?>
                    <div class="lookbbs-table-left">
                        <ul>
                            <li>
                                <div align="center"><img src="<?php echo $info2['photo']; ?>"/></div>
                            </li>
                            <li>
                                <div align="center">发贴人：<?php echo $info2['usernc']; ?></div>
                            </li>
                            <li>
                                <div align="center"><img src="images/lt_15_6.jpg" width="42" height="16"
                                                         alt="<?php echo $info2['email']; ?>"/><img
                                            src="images/lt_15_7.jpg" width="48" height="16"
                                            alt="<?php echo $info2['qq']; ?>"/><img src="images/lt_15_8.jpg"
                                                                                    width="53" height="16"
                                                                                    alt="<?php echo $info2['ip']; ?>"/>
                                </div>
                            </li>
                            <li>用户级别：<?php if ($info2["usertype"] == "1") {
									echo "管理员";
								} else {
									echo "普通会员";
								} ?></li>
                            <li>发贴总数：<?php echo $info2["pubtimes"]; ?></li>
                            <li>注册时间：<?php echo $info2["regtime"]; ?></li>
                        </ul>
                    </div>
                </td>
                <td bgcolor="#FFFFFF" class="lookbbs-table-replyform">
                    <form name="form_reply" method="post" action="savereply.php" enctype="multipart/form-data">
                        <div>回复主题：
                            <input name="reply_title" type="text" class="inputcss" id="reply_title" size="60"
                                   maxlength="200">
                            <input type="hidden" name="bbsid" value="<?php echo $infob["id"]; ?>">
                        </div>
                        <div>图片：
                            <input name="bbs_photo" type="file" id="bbs_photo" size="24" class="inputcss"/>(*图片不能超过2MB,格式为.gif/.jpg)
                        </div>
                        <div>
                            <textarea name="content1" cols="50" rows="6" id="content1"></textarea>
                        </div>
                        <div>
                            <input type="submit" value="提交">
                            <input type="reset" value="重填">
                        </div>
                    </form>
                </td>
            </tr>

			<?php
			$sqlr = mysqli_query($conn, "select * from tb_reply where bbsid='" . $infob["id"] . "'");
			$infor = mysqli_fetch_array($sqlr);
			if ($infor != false) {
				do {
					?>
                    <tr>
                        <td bgcolor="#FFFFFF">
							<?php
							$sql3 = mysqli_query($conn,
								"select * from tb_user where id='" . $infor["userid"] . "'");
							$info3 = mysqli_fetch_array($sql3);
							?>
                            <div class="lookbbs-table-left">
                                <ul>
                                    <li>
                                        <div align="center"><img src="<?php echo $info3['photo']; ?>"/></div>
                                    </li>
                                    <li>
                                        <div align="center">发贴人：<?php echo $info3['usernc']; ?></div>
                                    </li>
                                    <li>
                                        <div align="center"><img src="images/lt_15_6.jpg" width="42" height="16"
                                                                 alt="<?php echo $info3['email']; ?>"/><img
                                                    src="images/lt_15_7.jpg" width="48" height="16"
                                                    alt="<?php echo $info3['qq']; ?>"/><img src="images/lt_15_8.jpg"
                                                                                            width="53" height="16"
                                                                                            alt="<?php echo $info3['ip']; ?>"/>
                                        </div>
                                    </li>
                                    <li>用户级别：<?php if ($info3["usertype"] == "1") {
											echo "管理员";
										} else {
											echo "普通会员";
										} ?></li>
                                    <li>发贴总数：<?php echo $info3["pubtimes"]; ?></li>
                                    <li>注册时间：<?php echo $info3["regtime"]; ?></li>
                                </ul>
                            </div>
                        </td>
                        <td bgcolor="#FFFFFF" class="lookbbs-table-reply">
                            <div><img src="images/lt_15_11.jpg">
                                <span><?php echo $infor["createtime"]; ?></span>
								<?php
								if (isset($_SESSION["unc"])) {
									$sql4 = mysqli_query($conn,
										"select usertype from tb_user where usernc='" . $_SESSION["unc"] . "'");
									$info4 = mysqli_fetch_array($sql4);
									if ($info4["usertype"] == 1 || $info4["usertype"] == 2) {
										?>
                                        <img class="delete-reply" src="images/lt_15_10.jpg" width="72" height="23"
                                             style="cursor:hand"
                                             onclick="javascript:if(window.confirm('您确定删除该条回复么？')==true){window.location.href='deletereply.php?id=<?php echo $infor["id"] ?>';}"/>
									<?php }
								} ?>
                            </div>
                            <div>
                                <span style="color:#336699">回复主题：</span><?php echo unhtml($infor["title"]); ?>
                            </div>
                            <div>
								<?php
								if ($infor['photo'] != "") {
									$photos = substr($infor['photo'], 2, 70);
									echo(stripslashes($infor["content"]));
									echo "<p><img width=300 src=\"$photos\">";
								} else {
									echo(stripslashes($infor["content"]));
								}
								?>

                            </div>
                        </td>
                    </tr>
					<?php
				} while ($infor = mysqli_fetch_array($sqlr));
			}
			?>
        </table>
    </div>
</div>
<?php
include_once("bottom.php");
?>
