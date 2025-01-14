<?php
$link = mysqli_connect("localhost", "root", "root");
mysqli_select_db($link, "db_tmlog");
mysqli_query($link, "set names utf8");
?>
