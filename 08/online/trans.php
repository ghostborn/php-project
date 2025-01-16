<?php
include "conn/conn.php";//包含数据库连接文件
include "inc/func.php";//包含函数文件
?>
<table width="558" height="110" border="0" cellpadding="0" cellspacing="0">
    <tr>
        <td width="567" height="46" valign="bottom">
            <div align="center"><font style="color:#000000; font-size:24px; padding-top:20px;">上 传 清 单</font></div>
        </td>
    </tr>
    <tr>
        <td>
            <table width="559" height="94" align="center" cellpadding="0" cellspacing="0">
                <tr>
                    <td height="92">
                        <table width="404" height="90" border="0" align="center" cellpadding="0" cellspacing="0">
                            <tr>
                                <td width="402" valign="top">
                                    <table width="400" height="300" border="0" align="center" cellpadding="0"
                                           cellspacing="0">
                                        <tr>
                                            <td colspan="2" valign="top">
                                                <table width="404" height="90" border="0" align="center" cellpadding="0"
                                                       cellspacing="0">
                                                    <tr>
                                                        <td width="402" valign="top">
                                                            <table width="400" height="480" border="0" align="center"
                                                                   cellpadding="0" cellspacing="0">
                                                                <tr>
                                                                    <td height="15" colspan="2">&nbsp;</td>
                                                                </tr>
                                                                <form action="trans_chk.php" method="post"
                                                                      enctype="multipart/form-data" name="list">
                                                                    <tr>
                                                                        <td height="30" align="right" valign="middle">
                                                                            信息类型：
                                                                        </td>
                                                                        <td height="30">
                                                                            <select name="types"
                                                                                    onchange="window.location='operation.php?action=trans&types=' + this.value;">
                                                                                <option value="Video" <?php if (isset($_REQUEST['types']) && $_REQUEST['types'] == "Video" or !isset($_REQUEST['types'])) {
																					echo "selected";
																				} ?>>视频
                                                                                </option>
                                                                                <option value="Audio" <?php if (isset($_REQUEST['types']) && ($_REQUEST['types'] == "Audio")) {
																					echo "selected";
																				} ?>>音频
                                                                                </option>
                                                                            </select></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td height="30" align="right" valign="top">
                                                                            图片信息：
                                                                        </td>
                                                                        <td height="30" valign="top">
                                                                            <input name="picture" type="file"/>
                                                                            <br/><font color="red">(上传图片大小不能超过700K，图片格式要求：jpg、jpeg、bmp、gif、png)</font>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td height="30" align="right" valign="top">
                                                                            上传数据：
                                                                        </td>
                                                                        <td height="30" valign="top">
                                                                            <input name="address" type="file"/>
                                                                            <br/><font color="red">(音频文件不能超过10M，视频文件不能超过300M，文件格式要求：avi、rm、rmvb、wav、mp3、mpg、mp4、wmv)</font>
                                                                        </td>
                                                                    </tr>
																	<?php


																	switch (isset($_REQUEST['types']) ? $_REQUEST['types'] : "") {
																		case "Audio"://如果types参数的值为Audio
																			Audio();//执行Audio()函数
																			break;//跳出switch语句
																		case "Video"://如果types参数的值为Video
																			Video();//执行Video()函数
																			break; //跳出switch语句
																		default:
																			Video();//执行Video()函数
																			break; //跳出switch语句
																	}
																	?>
                                                                    <tr>
                                                                        <td height="30" colspan="2">
                                                                            <div align="center">
                                                                                <input name="Submit" type="submit"
                                                                                       value="  添  加">
                                                                                （*为必填项）
                                                                                <input name="Submit2" type="button"
                                                                                       value="返  回  "
                                                                                       onClick="javascript:window.open('','_self');window.close()">
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                </form>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
<script type="text/javascript">
    changetype(list.type.value, "<?php echo $_REQUEST['types'] ?? "";?>");
</script>