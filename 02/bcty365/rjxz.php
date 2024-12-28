<?php
include_once("conn/conn.php");
include_once("top.php");
?>
<link rel="stylesheet" type="text/css" href="css/index.css">
<div class="main" style="position:relative;">
    <img src="images/bg_14_1.jpg"/>
    <span class="a9 bccd-position">软件下载</span>
</div>
<div class="main-box">
    <table class="rjxz-table" cellspacing="1">
        <tr>
            <td colspan="2" bgcolor="#CCCCCC">
                <div align="center">软件名称</div>
            </td>
            <td width="150" height="20" bgcolor="#CCCCCC">
                <div align="center">添加时间</div>
            </td>
            <td width="70" height="20" bgcolor="#CCCCCC">
                <div align="center">下载次数</div>
            </td>
        </tr>
        <?php
        $sql = mysqli_query($conn, "select count(*) as total from tb_soft");
        $info = mysqli_fetch_array($sql);
        $total = $info['total'];
        if ($total == 0) {
            echo "<div align=center>对不起，暂无软件提供下载！</div>";
        } else {
            if (empty($_GET['page']) == true || is_numeric($_GET['page']) == false) {
                $page = 1;
            } else {
                $page = intval($_GET['page']);
            }
            $pagesize = 25;
            if ($total < $pagesize) {
                $pagecount = 1;
            } else {
                if ($total % $pagesize == 0) {
                    $pagecount = intval($total / $pagesize);
                } else {
                    $pagecount = intval($total / $pagesize) + 1;
                }
            }
            $sql = mysqli_query($conn,
                "select * from tb_soft order by addtime desc limit " . ($page - 1) * $pagesize . ",$pagesize");
            while ($info = mysqli_fetch_array($sql)) {
                ?>
                <tr>
                    <td colspan="2" bgcolor="#FFFFFF">&nbsp;
                        <a href="softinfo.php?id=<?php echo $info['id']; ?>" class="a1">
                            <?php echo unhtml($info['softname']); ?>
                        </a>
                    </td>
                    <td height="20" bgcolor="#FFFFFF">
                        <div align="center"><?php echo $info['addtime']; ?></div>
                    </td>
                    <td bgcolor="#FFFFFF">
                        <div align="center"><?php echo $info['click']; ?></div>
                    </td>
                </tr>
                <?php
            }
        }
        ?>
    </table>
    <div class="bbs-page">
        <div class="bbs-page-left">共提供软件下载<?php echo $total; ?>项&nbsp;每页显示<?php echo $pagesize; ?>项&nbsp;第<?php echo $page; ?>
            页/共<?php echo $pagecount; ?>页
        </div>
        <div class="bbs-page-right">
            <a href="<?php echo $_SERVER["PHP_SELF"] ?>?page=1" class="a1">首页</a>&nbsp;
            <a href="<?php echo $_SERVER["PHP_SELF"] ?>?page=<?php
                    if ($page > 1) {
                        echo $page - 1;
                    } else {
                        echo 1;
                    }
                    ?>" class="a1">
                上一页
            </a>&nbsp;
            <a href="<?php echo $_SERVER["PHP_SELF"] ?>?page=<?php
            if ($page < $pagecount) {
                echo $page + 1;
            } else {
                echo $pagecount;
            }
            ?>" class="a1">
                下一页
            </a>&nbsp;
            <a href="<?php echo $_SERVER["PHP_SELF"] ?>?page=<?php echo $pagecount; ?>" class="a1">尾页</a>
        </div>
    </div>
</div>
<?php
include_once("bottom.php");
?>