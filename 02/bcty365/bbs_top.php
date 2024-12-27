<link rel="stylesheet" type="text/css" href="css/index.css">
<div class="main" style="position:relative">
    <img src="images/lt_15_1.jpg"/>
    <span class="a9 bbs-position">当前位置&nbsp;&gt;&gt;&nbsp;社区论坛</span>
    <span class="a9 bbs-link">
    <a href="bbs_index.php" class="a4">论坛版块</a>&nbsp;&nbsp;
	<a href="bbs_find.php" class="a4">查找帖子</a>
  </span>
    <span class="bbs-find">
    <select name="select_type" class="inputcss"
            onChange="javascript:window.location=this.options[this.selectedIndex].value;">
	<?php
	//通过PHP语句从数据库中读取数据，使用数据的ID作为下拉列表框的值，使用数据的标题title作为下拉列表框显示的内容
	$sql = mysqli_query($conn, "SELECT * FROM tb_type_small ORDER BY createtime DESC");
	$info = mysqli_fetch_array($sql);
	if ($info == "") {
		echo "<option>暂无讨论区</option>";
	} else {
		echo "<option>-版块快速跳转-</option>";
		do {//应用do…while循环语句输出下拉列表框中的值
			echo "<option value='bbs_list.php?id=" . $info['id'] . "'>" . $info['title'] . "</option>";
		} while ($info = mysqli_fetch_array($sql));//应用do…while循环语句结束
	}
	?>
    </select>
  </span>
</div>