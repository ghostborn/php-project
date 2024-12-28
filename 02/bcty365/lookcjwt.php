<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>常见问题</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/index.css">
</head>
<body>
<div class="lookcjwt">
    <span>常见问题</span>
</div>
<?php
include_once("conn/conn.php");
include_once("function.php");
$sql = mysqli_query($conn, "select * from tb_cjwt where id='" . $_GET["id"] . "'");
$info = mysqli_fetch_array($sql);
?>

<div class="lookcjwt-main">
    <div class="question">
        <span><strong>问&nbsp;&nbsp;题：</strong></span>
        <div>
			<?php echo unhtml($info["question"]) ?>
        </div>
    </div>
    <div class="answer">
        <span><strong>解&nbsp;&nbsp;答：</strong></span>
        <div>
			<?php echo unhtml($info["answer"]) ?>
        </div>
    </div>
</div>
</body>
</html>