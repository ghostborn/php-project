<?php
$id = $_GET['id'];
include_once("conn/conn.php");
$query = mysqli_query($conn, "select * from tb_reply where id='$id'");
$myrow = mysqli_fetch_array($query);
if ($myrow['photo'] != "") {
	if (mysqli_query($conn, "delete from tb_reply where id='" . $id . "'")) {
		unlink($myrow['photo']);
		echo "<script>history.back();</script>";
	}
} else {
	if (mysqli_query($conn, "delete from tb_reply where id='" . $id . "'")) {
		echo "<script>history.back();</script>";
	}
}