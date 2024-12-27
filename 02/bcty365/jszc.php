<?php
include_once("top.php"); //获取头部文件
include_once("conn/conn.php")
?>
    <html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>明日科技-编程者之家网站</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="stylesheet" type="text/css" href="css/index.css">
    </head>
    <script language="javascript">
        function ld() {
            init();
        }
    </script>
    <body onLoad="ld()">

    <div class="main">
        <div style="width:220px; float:left;">
            <div>
                <div><img src="images/br_11_1.jpg" width="220" height="30"></div>
                <div id="marquees" class="middle">
					<?php
					$sql = mysqli_query($conn,
						"SELECT id,title,createtime FROM tb_tell ORDER BY createtime DESC LIMIT 0,10");
					$info = mysqli_fetch_array($sql);
					if ($info == false) {
						?>
                        <div align="center" style="height:25px;"><a href="#" class="a4">本站暂无公告发布! </a></div>
						<?php
					} else {
						$i = 1;
						do {
							?>
                            <div class="scroll">
                                <a href="tellinfo.php?id=<?php echo $info['id']; ?>" class="a1">
									<?php
									if ($i == 1) {
										echo "<span style='color:red'>";
									}
									echo $i . ".&nbsp;";
									echo unhtml(msubstr($info['title'], 0, 18));
									if (strlen($info['title']) > 18) {
										echo " ...";
									}
									echo "(" . str_replace("-", "/", $info['createtime']) . ")";
									if ($i == 1) {
										echo "</span>";
									}
									?>
                                </a>
                            </div>
							<?php
							$i++;
						} while ($info = mysqli_fetch_array($sql));
					}
					?>
                </div>
                <script language="JavaScript">
                    marqueesHeight = 222;
                    stopscroll = false;

                    with (marquees) {
                        //style.width=0;
                        style.height = marqueesHeight;
                        style.overflowX = "visible";
                        style.overflowY = "hidden";
                        noWrap = true;
                        onmouseover = new Function("stopscroll=true");
                        onmouseout = new Function("stopscroll=false");
                    }
                    document.write('<div id="templayer" style="position:absolute;z-index:1;visibility:hidden"></div>');

                    preTop = 0;
                    currentTop = 0;

                    function init() {
                        templayer.innerHTML = "";
                        while (templayer.offsetHeight < marqueesHeight) {
                            templayer.innerHTML += marquees.innerHTML;
                        }
                        marquees.innerHTML = templayer.innerHTML + templayer.innerHTML;
                        setInterval("scrollup()", 50);
                    }

                    //document.body.onload=init;

                    function scrollup() {
                        if (stopscroll == true) return;
                        preTop = marquees.scrollTop;
                        marquees.scrollTop += 1;
                        if (preTop == marquees.scrollTop) {
                            marquees.scrollTop = templayer.offsetHeight - marqueesHeight;
                            marquees.scrollTop += 1;
                        }
                    }
                </script>
            </div>
            <div>
                <div><img src="images/bg_11_2.jpg" width="220" height="30"></div>
                <div class="middle">
					<?php
					$sqluwz = mysqli_query($conn, "SELECT * FROM tb_soft ORDER BY addtime DESC LIMIT 0,7");
					$infouwz = mysqli_fetch_array($sqluwz);
					if ($infouwz == false) {
						?>
                        <div class="no-result">暂无软件提供下载！</div>
						<?php
					} else {
						$i = 1;
						do {
							?>
                            <div class="soft-download">
                                <a href="softinfo.php?id=<?php echo $infouwz["id"]; ?>" class="a1">
									<?php
									if ($i == 1) {
										echo "<span style='color:red'>";
									}
									echo unhtml(msubstr($infouwz["softname"], 0, 16));
									if (strlen($infouwz["softname"]) > 16) {
										echo " .";
									}
									if ($i == 1) {
										echo "</span>";
									}
									echo "<span style='color:red'>[" . substr(str_replace("-", "/",
											$infouwz['addtime']), 0, 10) . "]</span>";
									?>
                                </a>
                            </div>
							<?php
							$i++;
						} while ($infouwz = mysqli_fetch_array($sqluwz));
					}
					?>
                </div>
            </div>
        </div>
        <div class="jszc">
            <div style="position:relative;">
                <img src="images/bg_12_2.jpg">
                <ul>
                    <li><a href="jszc.php?jszc=常见问题" class="a2">常见问题</a></li>
                    <li><a href="jszc.php?jszc=客户反馈" class="a2">客户反馈</a></li>
                    <li><a href="jszc.php?jszc=联系方式" class="a2">联系方式</a></li>
                </ul>
            </div>
            <div class="middle">
				<?php
				switch ($_GET['jszc'] ?? "") {
					case "常见问题":
						include("cjwt.php");
						break;
					case "客户反馈":
						include("khfk.php");
						break;
					case "联系方式":
						include("lxfs.php");
						break;
					case "":
						include("cjwt.php");
						break;
				}
				?>
            </div>
        </div>
    </div>
    <div class="main">
        <img src="images/bg_11_4.jpg" width="870" height="80">
    </div>
    <div class="main">
        <div style="float:left;">
            <div><img src="images/bg_11_5.jpg" width="285" height="30"></div>
            <div class="content">
                <div>
                    <span style=" margin:3px;float:left;"><img src="images/bg_11_8.jpg" width="80" height="75"></span>
                    <ul class="top-list">
						<?php
						$sqluwz = mysqli_query($conn, "SELECT * FROM tb_cjwt ORDER BY createtime DESC LIMIT 0,3");
						$infouwz = mysqli_fetch_array($sqluwz);
						if ($infouwz == false) {
							?>
                            <img src="images/mark_0.gif" width="3" height="3"/>&nbsp;暂无常见问题！
							<?php
						} else {
							$i = 1;
							do {
								?>
                                <li>

                                    <a style="margin-left:12px;" href="lookcjwt.php?id=<?php echo $infouwz["id"]; ?>"
                                       class="a1" target="_blank">
										<?php
										if ($i == 1) {
											echo "<span style='color:red'>";
										}
										echo unhtml(msubstr($infouwz["question"], 0, 15));
										if (strlen($infouwz["question"]) > 15) {
											echo "...";
										}
										if ($i == 1) {
											echo "</span>";
										}
										echo "<span style='color:red'>[" . substr(str_replace("-", "/",
												$infouwz['createtime']), 0, 10) . "]</span>";
										?>
                                    </a>
                                </li>

								<?php
								$i++;
							} while ($infouwz = mysqli_fetch_array($sqluwz));
						}
						?>
                    </ul>
                </div>
                <ul>
					<?php
					$sqluwz = mysqli_query($conn, "SELECT * FROM tb_cjwt ORDER BY createtime DESC LIMIT 3,3");
					while ($infouwz = mysqli_fetch_array($sqluwz)) {
						?>
                        <li>
                            <a style="margin-left:12px;" href="lookcjwt.php?id=<?php echo $infouwz["id"]; ?>" class="a1"
                               target="_blank">
								<?php
								echo unhtml(msubstr($infouwz["question"], 0, 24));
								if (strlen($infouwz["question"]) > 24) {
									echo "...";
								}
								echo "<span style='color:red'>[" . substr(str_replace("-", "/", $infouwz['createtime']),
										0, 10) . "]</span>";
								?>
                            </a>
                        </li>
						<?php
					}
					?>
                </ul>
            </div>
        </div>
        <div style="float:left; margin-left:7px;">
            <div><img src="images/bg_11_6.jpg" width="285" height="30"></div>
            <div class="content">
                <div>
                    <span style=" margin:3px;float:left;"><img src="images/bg_11_9.jpg" width="80" height="75"></span>
                    <ul class="top-list">
						<?php
						$sqluwz = mysqli_query($conn, "SELECT * FROM tb_bbs ORDER BY createtime DESC LIMIT 0,3");
						$infouwz = mysqli_fetch_array($sqluwz);
						if ($infouwz == false) {
							?>
                            <img src="images/mark_0.gif" width="3" height="3"/>&nbsp;暂无人发贴！
							<?php
						} else {
							$i = 1;
							do {
								?>
                                <li>

                                    <a style="margin-left:12px;" href="bbs_lookbbs.php?id=<?php echo $infouwz["id"]; ?>"
                                       class="a1">
										<?php
										if ($i == 1) {
											echo "<span style='color:red'>";
										}
										echo unhtml(msubstr($infouwz["title"], 0, 15));
										if (strlen($infouwz["title"]) > 15) {
											echo "...";
										}
										if ($i == 1) {
											echo "</span>";
										}
										echo "<span style='color:red'>[" . substr(str_replace("-", "/",
												$infouwz['createtime']), 0, 10) . "]</span>";
										?>
                                    </a>
                                </li>

								<?php
								$i++;
							} while ($infouwz = mysqli_fetch_array($sqluwz));
						}
						?>
                    </ul>
                </div>
                <ul>
					<?php
					$sqluwz = mysqli_query($conn, "SELECT * FROM tb_bbs ORDER BY createtime DESC LIMIT 3,3");
					while ($infouwz = mysqli_fetch_array($sqluwz)) {
						?>
                        <li>
                            <a style="margin-left:12px;" href="bbs_lookbbs.php?id=<?php echo $infouwz["id"]; ?>"
                               class="a1">
								<?php
								echo unhtml(msubstr($infouwz["title"], 0, 24));
								if (strlen($infouwz["title"]) > 24) {
									echo "...";
								}
								echo "<span style='color:red'>[" . substr(str_replace("-", "/", $infouwz['createtime']),
										0, 10) . "]</span>";
								?>
                            </a>
                        </li>
						<?php
					}
					?>
                </ul>
            </div>
        </div>
        <div style="float:left; margin-left:8px;">
            <div><img src="images/bg_11_7.jpg" width="285" height="30"></div>
            <div class="content">
                <div>
                    <span style=" margin:3px;float:left;"><img src="images/bg_11_10.jpg" width="80" height="75"></span>
                    <ul class="top-list">
						<?php
						$sqluwz = mysqli_query($conn, "SELECT * FROM tb_sjxz ORDER BY addtime DESC LIMIT 0,3");
						$infouwz = mysqli_fetch_array($sqluwz);
						if ($infouwz == false) {
							?>
                            <img src="images/mark_0.gif" width="3" height="3"/>&nbsp;暂无升级下载！
							<?php
						} else {
							$i = 1;
							do {
								?>
                                <li>

                                    <a style="margin-left:12px;" href="sjxz.php?id=<?php
									$sqlt = mysqli_query($conn,
										"select id  from tb_type where id='" . $infouwz["typeid"] . "'");
									$infot = mysqli_fetch_array($sqlt);
									echo $infot["id"];
									?>" class="a1">
										<?php
										if ($i == 1) {
											echo "<span style='color:red'>";
										}
										echo unhtml(msubstr($infouwz["name"], 0, 15));
										if (strlen($infouwz["name"]) > 15) {
											echo "...";
										}
										if ($i == 1) {
											echo "</span>";
										}
										echo "<span style='color:red'>[" . substr(str_replace("-", "/",
												$infouwz['addtime']), 0, 10) . "]</span>";
										?>
                                    </a>
                                </li>

								<?php
								$i++;
							} while ($infouwz = mysqli_fetch_array($sqluwz));
						}
						?>
                    </ul>
                </div>
                <ul>
					<?php
					$sqluwz = mysqli_query($conn, "SELECT * FROM tb_sjxz ORDER BY addtime DESC LIMIT 3,3");
					while ($infouwz = mysqli_fetch_array($sqluwz)) {
						?>
                        <li>
                            <a style="margin-left:12px;" href="sjxz.php?id=<?php
							$sqlt = mysqli_query($conn,
								"select id  from tb_type where id='" . $infouwz["typeid"] . "'");
							$infot = mysqli_fetch_array($sqlt);
							echo $infot["id"];
							?>" class="a1">
								<?php
								echo unhtml(msubstr($infouwz["name"], 0, 12));
								if (strlen($infouwz["name"]) > 12) {
									echo "...";
								}
								echo "<span style='color:red'>[" . substr(str_replace("-", "/", $infouwz['addtime']), 0,
										10) . "]</span>";
								?>
                            </a>
                        </li>
						<?php
					}
					?>
                </ul>
            </div>
        </div>
    </div>
    </body>
    </html>
<?php
include_once("bottom.php");
?>