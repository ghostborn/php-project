<?php
$id = $_GET['id'];
include_once("conn/conn.php");
$query = mysqli_query($conn, "select * from tb_bbs where id='$id'");
$myrows = mysqli_fetch_array($query);

$query = mysqli_query($conn, "select * from tb_reply where bbsid='$id'");
$myrow = mysqli_fetch_array($query);

if ($myrows['photo'] != "") {
	if (mysqli_query($conn, "delete from tb_bbs where id='" . $id . "'")) {
		unlink($myrows['photo']);
		if ($myrow['photo'] != "") {
			if (mysqli_query($conn, "delete from tb_reply where bbsid='" . $id . "'")) {
				unlink($myrow['photo']);
				echo "<script>window.location.href='bbs_index.php';</script>";
			}
		} else {
			if (mysqli_query($conn, "delete from tb_reply where bbsid='" . $id . "'")) {
				echo "<script>window.location.href='bbs_index.php';</script>";
			}
		}
	}
} else {
	if (mysqli_query($conn, "delete from tb_bbs where id='" . $id . "'")) {
		if ($myrow['photo'] != "") {
			if (mysqli_query($conn, "delete from tb_reply where bbsid='" . $id . "'")) {
				unlink($myrow['photo']);
				echo "<script>window.location.href='bbs_index.php';</script>";
			}
		} else {
			if (mysqli_query($conn, "delete from tb_reply where bbsid='" . $id . "'")) {
				echo "<script>window.location.href='bbs_index.php';</script>";
			}
		}

	}
}