<?php
$conn = mysqli_connect("localhost", "root", "root");
mysqli_select_db($conn, "db_bcty365");
mysqli_query($conn, "set names utf8");