<?php
include_once("top.php");
include_once("bbs_top.php");
$sql1 = mysqli_query($conn, "select * from tb_user where usernc='" . $_SESSION["unc"] . "'");
$info1 = mysqli_fetch_array($sql1);
?>

<div class="main-box">
    <div class="bbs-table">
        <div class="bbs-table-title">
            <span><?php echo $_GET['ids']; ?></span>
        </div>
        <table class="pubbs-table" cellspacing="1" bgcolor="#6EBEC7">
            <tr>
                <td width="220" bgcolor="#FFFFFF">
                    <div class="lookbbs-table-left">
                        <ul>
                            <li><div align="center"><img src="<?php if($info1['photo']!="") echo $info1['photo']; else echo "images/head/0.gif";?>" /></div></li>
                            <li><div align="center"><?php echo "当前用户：".$info1['usernc'];?></div></li>
                            <li><div align="center"><img src="images/lt_15_6.jpg" width="42" height="16" alt="<?php echo $info1['email'];?>"/><img src="images/lt_15_7.jpg" width="48" height="16" alt="<?php echo $info1['qq']; ?>"/><img src="images/lt_15_8.jpg" width="53" height="16" alt="<?php echo $info1['ip']; ?>"/></div></li>
                            <li>用户级别：<?php if($info1["usertype"]=="1") echo "管理员";else echo "普通会员";?></li>
                            <li>发贴总数：<?php echo $info1["pubtimes"];?></li>
                            <li>注册时间：<?php echo $info1["regtime"];?></li>
                        </ul>
                    </div>
                </td>
                <td bgcolor="#FFFFFF" class="pubbs-table-form">
                    <form name="form_bbs" method="post" action="retrieve.php" enctype="multipart/form-data">
                        <div>所属版块：
                            <select name="bbs_type" class="inputcss" style="background-color:#6EBEC7">
			                    <?php
			                    $sql=mysqli_query($conn,"select * from tb_type_small order by createtime desc");
			                    $info=mysqli_fetch_array($sql);
			                    if($info==false){
				                    echo "<option>暂无讨论区</option>";
			                    }else{
				                    do{
					                    ?>
                                        <option value="<?php echo $info['id'] ;?>"<?php if($_GET['id']==$info['id']){echo "selected=\"selected\"";}?>><?php echo $info['title'];?></option>
					                    <?php
				                    }while($info=mysqli_fetch_array($sql));
			                    }
			                    ?>
                            </select>
                        </div>
                        <div>帖子主题：
                            <input type="text" name="bbs_title" size="55" class="inputcss" maxlength="50" style="background-color:#6EBEC7">
                        </div>
                        <div>
                            <img src="images/lt_15_12.jpg" width="20" height="18">您现在的心情如何? <br />
		                    <?php
		                    for($i=1;$i<=18;$i++){
			                    ?>
                                <span>
                                    <img src=<?php echo("images/bbsface/face".($i-1).".gif");?> width="20" height="20">
                                    <input type="radio" name="bbs_head" value="<?php echo("images/bbsface/face".($i-1).".gif");?>" <?php if($i==1) { echo "checked";}?>>
                                </span>
			                    <?php
		                    }
		                    ?>
                        </div>
                        <div>
                            图片：<input name="bbs_photo" type="file" id="bbs_photo" size="24" class="inputcss" style="background-color:#6EBEC7" />(*图片不能超过2MB,格式为.gif/.jpg)
                        </div>
                        <div>
                            <textarea name="content1" cols="60" rows="10" id="content1" class="inputcss" style="background-color:#6EBEC7"></textarea>
                        </div>
                        <div>
                            <input name="Submit" type="submit" id="Submit" value="提交">
                            <input type=reset value="重填">
                        </div>
                    </form>
                </td>
            </tr>
        </table>
    </div>
</div>
<?php
include_once ("bottom.php");
?>