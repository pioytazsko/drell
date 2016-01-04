<?php

include("../sadmin/_functions.php");
include("../sadmin/_config.php");
include("../sadmin/_mysql.php");
include("../sadmin/_admin_config.php");

/**
 * @author kross
 * @copyright 2009
 */

$id = $_POST[id];

$query="select * from ".$module_name." where id='".$id."'";
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
<?
	//print_r($_FILES[new_video]);
	$video_id = array();
	$video_id = $_POST[video_id];
	$video_name = Array();
	$video_name = $_POST[name];
	$video_description = Array();
	$video_description = $_POST[description];
	//print_r($_POST);
	for ($i = 0; $i < count($video_id); $i++)
	{
		$SQL = "UPDATE video SET name='".$video_name[$i]."', description='".$video_description[$i]."' WHERE video_id='".$video_id[$i]."'";
		$Q->query($DB, $SQL);
		if ($_FILES['preview_'.$i][name] != "")
		{
			move_uploaded_file($_FILES['preview_'.$i][tmp_name], $DOCUMENT_ROOT.'/video/'.$id."_".$video_id[$i]."_".str_replace(" ", "_", $_FILES['preview_'.$i][name]));
			$SQL = "UPDATE video SET preview = '".$id."_".$video_id[$i]."_".str_replace(" ", "_", $_FILES['preview_'.$i][name])."' WHERE video_id = '".$video_id[$i]."'";
			$Q->query($DB, $SQL);
		}
	}
	$message = "Данные успешно сохранены";
	
	if ($_FILES[new_video][name] != "")
	{
		if (move_uploaded_file($_FILES[new_video][tmp_name], $DOCUMENT_ROOT."/attachments/".$id."/".str_replace(" ", "_", $_FILES[new_video][name])))
		{
			$SQL = "INSERT INTO video (product_id, filename, name, description)
			VALUES
			('".$id."', '".str_replace(" ", "_", $_FILES[new_video][name])."', 'Новое видео', '')";
			$Q->query($DB, $SQL);
			$message = "Данные успешно сохранены";
		}
		else
		{
			$message = "В процессе загрузки файла произошла ошибка, попробуйте еще раз.";
		}
	}
	echo $message;
?>
</body>
</html>