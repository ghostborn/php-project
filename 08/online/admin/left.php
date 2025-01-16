<?php
	include "conn/conn.php";//包含数据库连接文件
	include "inc/chec.php";//包含判断用户权限文件
?>
<table width="201" border="0" cellspacing="0" cellpadding="0" bgcolor="#f0f0f0">
  <tr>
    <td colspan="2" height="25">&nbsp;</td>
  </tr>
  <tr>
    <td height="25" class="menu_td"><div align="center">
<?php
	if(($_SESSION['type'] == "super") or ($_SESSION['type'] == "视频目录管理员")){//如果Session变量type的值为super或"视频目录管理员"
		echo "<img src='images/unlock.png' width='11' height='13' />";//输出图片
	}else{
		echo "<img src='images/lock.png' width='11' height='13' />";//输出图片
	}
?>

	</td>
    <td height="25" class="menu_td"><div align="left"><a <?php if(($_SESSION['type']=="super") or ($_SESSION['type']=="视频目录管理员")) echo "href='main.php?action=videoList'"; ?>>视频目录管理</a></div></td>
  </tr>
  <tr>
    <td height="25" class="menu_td"><div align="center">
      <?php
	if(($_SESSION['type'] == "super") or ($_SESSION['type'] == "音频目录管理员"))//如果Session变量type的值为super或"音频目录管理员"
		echo "<img src='images/unlock.png' width='11' height='13' />";//输出图片
	else
		echo "<img src='images/lock.png' width='11' height='13' />";//输出图片
?>
    </td>
    <td height="25" class="menu_td"><div align="left"><a <?php if(($_SESSION['type']=="super") or ($_SESSION['type']=="音频目录管理员")) echo "href='main.php?action=audioList'"; ?>>音频目录管理</a></div></td>
  </tr>
  <tr>
    <td height="25" class="menu_td"><div align="center">
      <?php
	if(($_SESSION['type'] == "super") or ($_SESSION['type'] == "视频数据管理员"))//如果Session变量type的值为super或"视频数据管理员"
		echo "<img src='images/unlock.png' width='11' height='13' />";//输出图片
	else
		echo "<img src='images/lock.png' width='11' height='13' />";//输出图片
?>
    </td>
    <td height="25" class="menu_td"><div align="left"><a <?php if(($_SESSION['type']=="super") or ($_SESSION['type']=="视频数据管理员")) echo "href='main.php?action=video'";  ?>>视频数据管理</a></div></td>
  </tr>
  <tr>
    <td height="25" class="menu_td"><div align="center">
      <?php
	if(($_SESSION['type'] == "super") or ($_SESSION['type'] == "音频数据管理员"))//如果Session变量type的值为super或"音频数据管理员"
		echo "<img src='images/unlock.png' width='11' height='13' />";//输出图片
	else
		echo "<img src='images/lock.png' width='11' height='13' />";//输出图片
?>
    </td>
    <td height="25" class="menu_td"><div align="left"><a  <?php if (($_SESSION['type']=="super") or ($_SESSION['type']=="音频数据管理员")) echo "href='main.php?action=audio'";  ?>>音乐数据管理</a></div></td>
  </tr>
  <tr>
    <td height="25" class="menu_td"><div align="center">
      <?php
	if(($_SESSION['type'] == "super") or ($_SESSION['type'] == "会员等级管理员"))//如果Session变量type的值为super或"会员等级管理员"
		echo "<img src='images/unlock.png' width='11' height='13' />";//输出图片
	else
		echo "<img src='images/lock.png' width='11' height='13' />";//输出图片
?>
    </td>
    <td height="25" class="menu_td"><div align="left"><a  <?php if(($_SESSION['type']=="super") or ($_SESSION['type']=="会员等级管理员")) echo "href='main.php?action=grade'"; ?>>会员等级设置</a></div></td>
  </tr>
  <tr>
    <td height="25" class="menu_td"><div align="center">
      <?php
	if(($_SESSION['type'] == "super") or ($_SESSION['type'] == "会员数据管理员"))//如果Session变量type的值为super或"会员数据管理员"
		echo "<img src='images/unlock.png' width='11' height='13' />";//输出图片
	else
		echo "<img src='images/lock.png' width='11' height='13' />";//输出图片
?>
    </td>
    <td height="25" class="menu_td"><div align="left"><a  <?php if(($_SESSION['type']=="super") or ($_SESSION['type']=="会员数据管理员")) echo "href='main.php?action=member'"; ?>>会员数据管理</a></div></td>
  </tr>
  <tr>
    <td height="25" class="menu_td"><div align="center">
      <?php
	if($_SESSION['type'] == "super")//如果Session变量type的值为super
		echo "<img src='images/unlock.png' width='11' height='13' />";//输出图片
	else
		echo "<img src='images/lock.png' width='11' height='13' />";//输出图片
?>
    </td>
    <td height="25" class="menu_td"><div align="left"><a  <?php if($_SESSION['type']=="super") echo "href='main.php?action=log'";  ?>>上传日志管理</a></div></td>
  </tr>
  <tr>
    <td height="25" class="menu_td"><div align="center">
      <?php
	if($_SESSION['type'] == "super")//如果Session变量type的值为super
		echo "<img src='images/unlock.png' width='11' height='13' />";//输出图片
	else
		echo "<img src='images/lock.png' width='11' height='13' />";//输出图片
?>
    </td>
    <td height="25" class="menu_td"><div align="left"><a  <?php if($_SESSION['type']=="super") echo "href='main.php?action=manager'";  ?>>管理员设置</a></div></td>
  </tr>
  <tr>
  	<td colspan="2" height="20">&nbsp;</td>
  </tr>
  <tr>
  	<td colspan="2"><img src="images/bottom.jpg" width="185" height="50" /></td>
  </tr>
</table>
