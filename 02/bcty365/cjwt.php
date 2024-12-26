<div>
    <?php
    $sql = mysqli_query($conn, "SELECT COUNT(*) AS total FROM tb_cjwt");//读取数据库中的数据
    $info = mysqli_fetch_array($sql);//返回数据
    $total = $info['total'];
    //判断字段total是否为空，为空则执行下面的内容
    if ($total == 0){
        ?>
        <div align="center" style="height:38px; line-height:38px;">对不起，暂无常见问题！</div>
        <?php
    }else{//如果不为空，则执行下面的内容
    if (!isset($_GET["page"]) || !is_numeric($_GET["page"])) {//判断$_GET获取的page的值是否存在
        $page = 1; //如果不存在，则设置变量的值为1
    } else {
        $page = intval($_GET["page"]);//如果存在，则获取变量$_GET的值
    }
    $pagesize = 20;//设置变量$pagesize,每页显示的数据量为20
    if ($total % $pagesize == 0) {//如果变量的值为0
        $pagecount = intval($total / $pagesize);//获取变量的整数值
    } else {
        $pagecount = ceil($total / $pagesize);//如果不为0，则获取实际的整数值
    }
    //读取数据库中的数据，按照时间进行降序排列
    $sql = mysqli_query($conn, "select * from tb_cjwt order by createtime desc limit " . ($page - 1) * $pagesize . ",$pagesize  ");
    while ($info = mysqli_fetch_array($sql)) {
        ?>
        <div class="cjwt">
            <a href="lookcjwt.php?id=<?php echo $info["id"]; ?>" class="a1" target="_blank">
                <?php
                echo unhtml(msubstr($info["question"], 0, 70));
                if (strlen($info["question"]) > 70) {
                    echo " ...";
                }
                echo "<font color=blue>[" . substr(str_replace("-", "/", $info['createtime']), 0, 10) . "]</font>";
                ?>
            </a>
        </div>
        <?php
    }
    ?>
</div>
<div class="page-left">&nbsp;&nbsp;共有常见问题<?php echo $total; ?>条&nbsp;每页显示<?php echo $pagesize; ?>
    条&nbsp;第<?php echo $page; ?>页/共<?php echo $pagecount; ?>页
</div>
<div class="page-right">
    <a href="<?php echo $_SERVER["PHP_SELF"] ?>?page=1" class="a1">首页</a>&nbsp;
    <a href="<?php echo $_SERVER["PHP_SELF"] ?>?page=<?php
    if ($page > 1) //判断如果页码大于1
        echo $page - 1;//输出前一页
    else
        echo 1;
    ?>" class="a1">上一页</a>&nbsp;
    <a href="<?php echo $_SERVER["PHP_SELF"] ?>?page=<?php
    if ($page < $pagecount) //如果页码小于总页数
        echo $page + 1;//输出下一页
    else
        echo $pagecount;
    ?>" class="a1">下一页</a>&nbsp;
    <a href="<?php echo $_SERVER["PHP_SELF"] ?>?page=<?php echo $pagecount; ?>" class="a1">尾页</a>&nbsp;&nbsp;
</div>
<?php
}
?>