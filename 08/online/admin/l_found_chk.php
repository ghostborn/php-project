<?php
	$types=$_POST['style'];//为变量赋值
	$days=$_POST['days'];//为变量赋值
?>


<script language="javascript">
	top.opener.location="main.php?action=log&types=<?php echo $types; ?>&days=<?php echo $days; ?>";
	top.window.close();
</script>
