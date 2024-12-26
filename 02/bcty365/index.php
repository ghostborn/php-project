<?php include_once("top.php"); //获取头部文件 ?>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>BCTY365网上社区</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/index.css">
</head>
<script>
    function ld() {
        change_img();
        init();
    }
</script>
<body onload="ld()">
<div class="main">
    <div style="width:220px; float:left;">
        <div>
            <div><img src="images/br_11_1.jpg" width="220" height="30"></div>
            <div id="marquees" class="middle">
                <?php //从数据库中读取公共数据
                $sql = mysqli_query($conn,
                    "SELECT id,title,createtime FROM tb_tell ORDER BY createtime DESC LIMIT 0,10"); //读取数据库中公告表中的数据
                $info = mysqli_fetch_array($sql); //执行读取数据表中数据的语句
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
                                    echo "<span style='color: red'>";
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
            <script>
                let marqueesHeight = 222;
                let stopscroll = false;
                with (marquees) {
                    style.height = marqueesHeight;
                    style.overflowX = "visible";
                    style.overflowY = "hidden";
                    noWrap = true;
                    onmouseover = new Function("stopscroll=true");
                    onmouseout = new Function("stopscroll=true")
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

    <div class="bccd">
        <div><img src="images/bg_11_3.jpg" width="642" height="30"></div>
        <div class="middle">
            <div>
                <div class="bccd-image">
                    <a href="morebccd.php">
                        <img width="140" height="172" border="0" name="image"
                             style='visibility:hidden;filter:revealtrans(duration=2.0,transition=12)'>
                    </a>
                </div>
                <div class="bccd-info">
                    <img src="images/bg_11_13.jpg" width="100" height="22">
                    <div style="line-height:1.8; margin-top:10px;">&nbsp;&nbsp;
                        <?php
                        $sqlbj = mysqli_query($conn, "SELECT * FROM tb_bccdjj WHERE mark=1");
                        $infobj = mysqli_fetch_array($sqlbj);
                        echo unhtml(msubstr($infobj["content"], 0, 560));
                        if (strlen($infobj["content"]) > 300) {
                            echo " ...";
                        }
                        echo "<font color='red'>&nbsp;&nbsp;[&nbsp;" . substr($infobj["createtime"], 0,
                                10) . "&nbsp;]</font>";
                        ?>
                    </div>
                </div>
            </div>

            <div>
                <?php
                $sqlnewbccd = mysqli_query($conn, "SELECT * FROM tb_bccd ORDER BY addtime DESC LIMIT 0,1");
                $infonewbccd = mysqli_fetch_array($sqlnewbccd);
                if ($infonewbccd == false) {
                    echo "<div align=center>对不起，暂无最新编程词典信息!</div>";
                } else {
                    ?>
                    <div class="bccd-image">
                        <a href="bccdinfo.php?id=<?php echo $infonewbccd["id"] ?>">
                            <img src="<?php echo $infonewbccd["imageaddress"]; ?>" width="140" height="170"
                                 border="0"/>
                        </a>
                    </div>
                    <div class="bccd-info">
                        <img src="images/bg_11_12.jpg" width="100" height="22">
                        <ul>
                            <li>
                                名&nbsp;&nbsp;称：
                                <a href="bccdinfo.php?id=<?php echo $infonewbccd["id"]; ?>" class="a5">
                                    <?php echo unhtml($infonewbccd["bccdname"]) ?>
                                </a>
                            </li>
                            <li>
                                所属版本：
                                <?php
                                $sqlt = mysqli_query($conn,
                                    "select id,bbname from tb_bb where id='" . $infonewbccd["bbid"] . "'");
                                $infot = mysqli_fetch_array($sqlt);
                                echo unhtml($infot["bbname"]);
                                ?>
                            </li>
                            <li>
                                价&nbsp;&nbsp;格：
                                <?php
                                echo number_format($infonewbccd["price"], 2) . "&nbsp;元";
                                ?>
                            </li>
                            <li>
                                版&nbsp;&nbsp;权：
                                <?php
                                echo unhtml($infonewbccd["owner"]);
                                ?>
                            </li>
                            <li>
                                添加时间：
                                <?php
                                echo $infonewbccd["addtime"];
                                ?>
                            </li>
                        </ul>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>
</div>
<script>
    isns = navigator.appName == "Netscape";
    img1 = new Image()
    img2 = new Image()
    img3 = new Image()
    img4 = new Image()
    img5 = new Image()

    img1.src = 'images/bccdimages/b1.gif'
    img2.src = 'images/bccdimages/b2.gif'
    img3.src = 'images/bccdimages/b3.gif'
    img4.src = 'images/bccdimages/b4.gif'
    img5.src = 'images/bccdimages/b5.gif'

    nn = 1

    function change_img() {
        eval('document.image.src=img' + nn + '.src');
        nn++;
        if (nn > 5) nn = 1
        if (!isns) {
            image.filters.item(0).apply()
            image.style.visibility = 'visible'
            image.filters.item(0).play()
            setTimeout("image.style.visibility='hidden'", 5000);
        } else
            document.image.style.visibility = 'visible'
        tt = setTimeout('change_img()', 5000)
    }
</script>

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