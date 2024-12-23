<?php
header("Content-type: text/html; charset=utf-8");
session_start();
$xym = trim($_POST['xym']);

class chkuser
{
	var $usernc;
	var $userpwd;
	var $xym;
	var $num;

	function __construct($x, $y, $m)
	{
		$this->usernc = $x;
		$this->userpwd = $y;
		$this->xym = $m;
	}

	function chkinput()
	{
		if (strval($this->xym) !== $_SESSION["autonum1"]) {
			echo "<script>alert('验证码输入错误!');history.go(-1);</script>";
			exit;
		}
		include_once("conn/conn.php");
		$sql = mysqli_query($conn, "select usernc from tb_user where usernc= '" . $this->usernc . "'");
		$info = mysqli_fetch_array($sql);
		if ($info == false) {
			echo "<script>alert('对不起，不存在该用户！');history.back();</script>";
			exit;
		} else {
			$sql = mysqli_query($conn,
				"select usernc from tb_user where usernc= '" . $this->usernc . "' and pwd='" . $this->userpwd . "'");
			$info = mysqli_fetch_array($sql);
			if ($info == false) {
				echo "<script>alert('对不起，密码输入错误！');history.back();</script>";
				exit;
			} else {
				date_default_timezone_set("Asia/Hong_Kong");
				$lastlogintime = date("Y-m-j H:i:s");
				mysqli_query($conn,
					"update tb_user set lastlogintime = '" . $lastlogintime . "', logintimes=logintimes+1 where usernc='" . $this->usernc . "'");

				if (isset($_SESSION["unc"])) {
					unset($_SESSION["unc"]);
				}

				$_SESSION["unc"] = $this->usernc;
				echo "<script>alert('登录成功！');history.back();</script>";
			}
		}
		mysqli_close($conn);
	}
}

$chk = new chkuser($_POST['usernc'], md5($_POST['userpwd']), $xym);
$chk->chkinput();