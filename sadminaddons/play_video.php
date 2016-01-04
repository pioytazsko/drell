<?php

include("../sadmin/_functions.php");
include("../sadmin/_config.php");
include("../sadmin/_mysql.php");
include("../sadmin/_admin_config.php");

/**
 * @author kross
 * @copyright 2009
 */

$id = $_GET[id];

$query="select * from ".$module_name." where id=".$id;
$Q->query($DB,$query);
$row=$Q->getrow();

$lt=getlangtemplate($adminlanguage,"../sadmin/_inc/templates/module");

//echo $id;
?>
<html>
<head>
<title>Administration:<?=$module_title?></title>
<link rel="stylesheet" href="../sadmin/admin.css" type="text/css">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
</head>
<body bgcolor=#FFFFFF background="../sadmin/images/adminbg.gif" rightmargin=10 leftmargin=10 topmargin=10>
<table width=100% cellpadding=5 cellspacing=2 border=1 bordercolor=#CCCCCC bgcolor="<?=$admin_settings['tablebg']?>">
<tr>
<td width=90%><img src=../sadmin/images/flags/<?=$adminlanguage?>.png border=0 alt="<?=$lt[1]?>" vspace=0 hspace=0>
&nbsp;
<a class=menu><?=$row[f5]." ".$row[name]?></a></td>
<td align=center><a href=# onclick="JavaScript:window.close();" class=menu100><?=$lt[51]?></a></td>
</tr>
</table>
<form action="save_video.php" method="post">
<input type="hidden" name="id" value="<?=$id;?>">
<table>
<tr>
	<td>
		<?
			$video_id = $_GET[video_id];
			$SQL = "SELECT * FROM video WHERE video_id = '".$video_id."'";
			$result = $Q->query($DB, $SQL);
			$video_data = mysql_fetch_assoc($result);
		?>
		<object type="application/x-shockwave-flash" id="flvplayer" data="/uflvplayer.swf" height="300" width="400">
		<param name="bgcolor" value="#222222" />
		<param name="allowFullScreen" value="true" />
		<param name="allowScriptAccess" value="always" />
		<param name="movie" value="/uflvplayer.swf" />
		<param name="FlashVars" value="way=\attachments/<?=$id?>/<?=$video_data[filename];?>&amp;swf=/uflvplayer.swf&amp;w=400&amp;h=300&amp;pic=http://&amp;autoplay=0&amp;tools=1&amp;skin=greyblack&amp;volume=0&amp;q=&amp;comment=Нажмите для просмотра" />
		</object>
	</td>
</tr>
</table>
</form>
</body>
</html>