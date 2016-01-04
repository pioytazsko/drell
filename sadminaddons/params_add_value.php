<?php

include("../sadmin/_bfunctions.php");
include("../sadmin/_admin_config.php");

/**
 * @author kross
 * @copyright 2009
 */

if ($_POST[add_value])
{
	$SQL = "INSERT INTO values_titles
	(value_title)
	VALUES
	('".trim($_POST[value_title])."')
	";
	$Q->query($DB, $SQL);
	
	$SQL = "SELECT * FROM values_titles WHERE value_title = '".trim($_POST[value_title])."' ORDER BY value_id DESC LIMIT 1";
	$result = $Q->query($DB, $SQL);
	$value_id = mysql_fetch_assoc($result);
	$value_id = $value_id[value_id];
	
	$SQL = "INSERT INTO params_values
	(param_id, value_id)
	VALUES
	('".$_POST[param]."', '".$value_id."')
	";
	$Q->query($DB, $SQL);
	
	header("location:params_list.php?id=".$_GET[id]);
}

$id = $_GET[id];

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
<script>
function chk_field()
{
	if (document.getElementById('name').value == '')
	{
		alert('Вы не ввели значение.');
		return false;
	}
	else
		return true;
}
</script>
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
	$category_id = $_GET[id];
	$params_list = "";
	
	$SQL = "SELECT * FROM category_groups INNER JOIN groups_params ON category_groups.group_id = groups_params.group_id INNER JOIN params_names ON groups_params.param_id = params_names.param_id WHERE category_id = '".$category_id."' AND (param_type = 'select' OR param_type = 'checkbox')";
	$result = $Q->query($DB, $SQL);
	for ($params = Array(); $row = mysql_fetch_assoc($result); $params[] = $row);
	
	for ($i = 0; $i < count($params); $i++)
	{
		$params_list .= "<option value='".$params[$i][param_id]."'>".$params[$i][param_name]."</option>";
	}
?>
<form action="params_add_value.php?id=<?=$_GET[id];?>" method="post">
<table>
	<tr>
		<td>
			Параметр:
		</td>
		<td>
			<select name="param">
				<?=$params_list;?>
			</select>
		</td>
	</tr>
	<tr>
		<td>
			Значение:
		</td>
		<td>
			<input type="text" name="value_title" id="name">
		</td>
	</tr>
	<tr>
		<td colspan=2 align="center">
			<input type="button" onclick="window.location.href='params_list.php?id=<?=$_GET[id];?>'" value="Отмена">
			<input type="submit" name="add_value" onclick="return chk_field()" value="Добавить">
		</td>
	</tr>
</table>
</form>
</body>
</html>