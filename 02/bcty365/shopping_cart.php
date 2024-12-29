<?php
include_once("conn/conn.php");
include_once("top.php");
?>
<link rel="stylesheet" type="text/css" href="css/index.css">
<div class="main" style="position:relative;">
    <img src="images/bg_14_1.jpg"/>
    <span class="a9 bccd-position">购物车</span>
</div>
<div class="main-box">
    <table class="cart-table">
        <tr>
            <td width="330" height="22" bgcolor="#CCCCCC">
                <div align="center">商品名称</div>
            </td>
            <td width="155" bgcolor="#CCCCCC">
                <div align="center">单价（元）</div>
            </td>
            <td width="87" bgcolor="#CCCCCC">
                <div align="center">数量（个）</div>
            </td>
            <td width="143" bgcolor="#CCCCCC">
                <div align="center">操作</div>
            </td>
        </tr>

		<?php
		$array = explode("@", $_SESSION["goodsid"] ?? ""); //读取session变量中的商品ID，以@进行分割
		$arraynum = explode("@", $_SESSION["goodsnum"] ?? "");//读取session变量中的商品数量，以@进行分割
		$markid = 0;  //创建变量，初始值为0
		for ($i = 0; $i < count($array); $i++) {
			if ($array[$i] != "") {
				$markid++;
			}
		}
		if ($markid == 0) { //判断如果变量$markid的值为空，则输出下面的内容
			?>
            <tr>
                <td height="22" colspan="4" bgcolor="#FFFFFF">
                    <div align="center">对不起，您的购物车中暂无商品信息！</div>
                </td>
            </tr>
			<?php
		} else {
			$totalprice = 0;
			for ($i = 0; $i < count($array); $i++) {
				if ($array[$i] != "") {
					$sqlcart = mysqli_query($conn, "select * from tb_bccd where id='" . $array[$i] . "'");
					$infocart = mysqli_fetch_array($sqlcart);
					?>
                    <tr>
                        <form name="form<?php echo $array[$i] ?>" method="post" action="changegoodsnum.php">
                            <td height="22" bgcolor="#FFFFFF">&nbsp;<?php echo unhtml($infocart["bccdname"]); ?></td>
                            <td height="22" bgcolor="#FFFFFF">
                                <div align="center"><?php echo number_format($infocart["price"], 2); ?></div>
                            </td>
                            <td height="22" bgcolor="#FFFFFF">
                                <div align="center"><input type="text" name="goodsnum"
                                                           value="<?php echo $arraynum["$i"]; ?>" class="inputcss"
                                                           size="8"><input type="hidden" name="id"
                                                                           value="<?php echo $infocart["id"]; ?>"></div>
                            </td>
                            <td height="22" bgcolor="#FFFFFF">
                                <div align="center"><a href="javascript:form<?php echo $array[$i] ?>.submit();"
                                                       class="a1">更改数量</a>&nbsp;|&nbsp;<a
                                            href="delgoods.php?id=<?php echo $infocart["id"]; ?>"
                                            class="a1">删除该项</a></div>
                            </td>
                        </form>
                    </tr>
					<?php
					$totalprice += $infocart["price"] * $arraynum["$i"];
				}
			}
		}
		?>
    </table>
    <div class="cart-action">
        <span><< &nbsp;<a href='morebccd.php' class='a1'>继续购买</a></span>
        <span><a href='shopping_setcartnull.php' class='a1'>清空购物车</a>&nbsp;>></span>
        <span><?php if (isset($totalprice)) { ?>商品金额总计：<?php echo number_format($totalprice,
				2); ?>元<?php } ?></span>
        <span>
            <a href="shopping_cart_getuserinfo.php">
                <img src="images/bg_14_7.jpg" width="69" height="20" border="0" onclick="<?php
                if (!isset($_SESSION["goodsid"]) || $_SESSION["goodsid"] == "") {
	                echo "javascript:alert('请先购买商品！');return false;";
                }
                ?>"/>
            </a>
	    </span>
    </div>
</div>

<?php
include_once("bottom.php");
?>
