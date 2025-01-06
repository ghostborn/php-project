<?php

/**
 * 检查用户是否登录
 */
function checkLogin(): bool
{
	session_start();
	if (empty($_SESSION['user'])) {
		return false;
	}
	return true;
}

/**
 * 消息提示
 * @param int $type 1:成功 2:失败
 * @param null $msg
 * @param null $url
 */
function msg(int $type, $msg = null, $url = null)
{
	ob_start(); //开启输出缓存，确保在调用header函数之前没有任何输出

	// 假设要跳转到的页面是 target.php，并且要传递参数 param1、param2和param3
	$param1 = urlencode($type); //此函数便于将字符串编码并将其用于 URL 的请求部分，同时它还便于将变量传递给下一页。
	$param2 = urlencode($msg);
	$param3 = urlencode($url);

	$targetUrl = "msg.php?type=" . $param1 . "&msg=" . $param2 . "&url=" . $param3;
	// 进行页面跳转
	// Location是HTTP响应头的一部分，告诉浏览器跳转到指定的url
	header('Location:' . $targetUrl);
	exit; //终止脚本的执行，避免后续代码的执行影响重定向操作

}