<?php
//url type参数处理 1:操作成功 2:操作失败
$type = isset($_GET['type']) && in_array(intval($_GET['type']), array(1, 2)) ? intval($_GET['type']) : 1;
$title = $type == 1 ? '操作成功' : '操作失败';
$msg = isset($_GET['msg']) ? trim($_GET['msg']) : '操作成功';
$url = isset($_GET['url']) ? trim($_GET['url']) : '';
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="Public/css/done.css">
    <title><?php echo $title ?></title>
</head>
<body>
<div class="content">
    <div class="center">
        <div class="image_center">
			<?php if ($type == 1): ?>
                <span class="smile_face">:)</span>
			<?php else: ?>
                <span class="smile_face">:(</span>
			<?php endif; ?>
        </div>
        <div class="code">
			<?php echo $msg ?>
        </div>
        <div class="jump">
            页面在 <strong id="time" style="color: #009f95">3</strong>秒后跳转
        </div>
    </div>
</div>
</body>
<script src="Public/js/jquery.min.js"></script>
<script>
    $(function () {
        let time = 3;
        let url = "<?php echo $url ?>" || null;
        let interval = setInterval(function () {
            if (time > 1) {
                time--;
                $('#time').html(time);
            } else {
                $('#time').html(0);
                if (url) {
                    location.href = url;
                    clearInterval(interval);
                } else {
                    history.go(-1);
                }
            }
        }, 1000)
    })
</script>
</html>
