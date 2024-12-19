<?php
header("Content-type: text/html; charset=utf-8");

class chkinput
{
    var $name;
    var $pwd;

    function __construct($x, $y)
    {
        $this->name = $x;
        $this->pwd = $y;
    }

    function checkinput()
    {
        include("../conn/conn.php");
        $sql = mysqli_query($conn, "select * from tb_admin where name= '" . $this->name . "' ");
        $info = mysqli_fetch_array($sql);

        if ($info == false) {
            echo "<script>alert('不存在此管理员！');history.back();</script>";
            exit;
        }else{

        }
    }


}