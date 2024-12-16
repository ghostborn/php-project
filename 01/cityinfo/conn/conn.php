<?php
//连接MySQL服务器
$conn = mysqli_connect("localhost", "root", "root") or die("数据库服务器连接错误" . mysqli_error());
mysqli_select_db($conn, "db_pursey") or die("数据库访问错误" . mysqli_error()); //连接MySQL数据库db_pursey
mysqli_query($conn, "set names utf8");