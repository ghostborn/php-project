<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="css/style.css">
	<title>易查供求信息网</title>
	<style>
        body {
            background-image: url("Images/back.gif");
        }
	</style>
</head>
<body>
<table width="920" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#ffffff">
	<tr valign="top">
		<td colspan="2"><?php include("top.php") ?></td>
	</tr>
	<tr>
		<td width="217" valign="top"><?php include("left.php"); ?></td>
		<td width="586" valign="top" bgcolor="#FEFEF6"><?php include("seekjob_info.php"); ?></td>
	</tr>
	<tr>
		<td colspan="2"><?php include("bottom.php"); ?></td>
	</tr>
</table>

</body>
</html>
<?php
