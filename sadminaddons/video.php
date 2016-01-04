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
<form action="save_video.php" method="post" enctype="multipart/form-data">
<input type="hidden" name="id" value="<?=$id;?>">
<table width=100%>
<?
	$output = "";
	
	$SQL = "SELECT * FROM video WHERE product_id = '".$id."'";
	$result = $Q->query($DB, $SQL);
	for ($video = Array(); $row = mysql_fetch_assoc($result); $video[] = $row);
	for ($i = 0; $i < count($video); $i++)
	{
		$preview_file = "";
		if ($video[$i][preview] != "")
			$preview_file = "<div align='left'><a href='/video/".$video[$i][preview]."' target='_blank'>".$video[$i][preview]."</a></div>";
		$output .= "
		<tr>
			<td>
				Файл:
			</td>
			<td>
				".$video[$i][filename]."
			</td>
		</tr>
		<tr>
			<td>
				Название:
			</td>
			<td>
				<input type='hidden' name='video_id[".$i."]' value='".$video[$i][video_id]."'>
				<input type='text' name='name[".$i."]' value='".$video[$i][name]."'>
			</td>
		</tr>
		<tr>
			<td valign='top'>
				Описание:
			</td>
			<td>
				<textarea name='description[".$i."]' rows=4 cols=40>".$video[$i][description]."</textarea>
			</td>
		</tr>
		<tr>
			<td>
				Изображение:
			</td>
			<td>
				".$preview_file."
				<input type='file' name='preview_".$i."'>
			</td>
		</tr>
		<tr>
			<td colspan=2>
			<a href='play_video.php?id=".$id."&video_id=".$video[$i][video_id]."' target='_blank' align='right'>Просмотреть</a>
			<a href='del_video.php?id=".$id."&video_id=".$video[$i][video_id]."' style='color:#ff0000; margin-left:220px'>Удалить</a>
			<hr width='100%' align=left>
			</td>
		</tr>
		";
	}
	echo $output;
?>
<tr>
	<td colspan="2" align="left">
		<input type="hidden" name="MAX_FILE_SIZE" value="<?=(1024*1024*100)?>" />
		<input type="file" name="new_video">
	</td>
</tr>
<tr>
	<td colspan="2" align="left">
		<input type="submit" name="save" value="Сохранить">
	</td>
</tr>
</table>
</form>
</body>
</html>