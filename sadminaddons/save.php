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
	$fields = $_POST[field];
	$arr_id = $_POST[arr_id];
	for ($i = 0; $i < count($arr_id); $i++)
	{
		$SQL = "SELECT * FROM char_values WHERE product_id = '".$id."' AND char_id = '".$arr_id[$i]."'";
		$result = $Q->query($DB, $SQL);
		if (mysql_num_rows($result) > 0)
		{
			$SQL = "UPDATE char_values SET value_id = '".$fields[$i]."' WHERE product_id = '".$id."' AND char_id = '".$arr_id[$i]."'";
			$Q->query($DB, $SQL);
		}
		else
		{
			$SQL = "INSERT INTO char_values (product_id, char_id, value_id) VALUES ('".$id."', '".$arr_id[$i]."', '".$fields[$i]."')";
			$Q->query($DB, $SQL);
		}
	}
	echo "Сохранено";
?>
</body>
</html>