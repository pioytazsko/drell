<?php

include("../sadmin/_bfunctions.php");
include("../sadmin/_admin_config.php");
include("./params_functions.php");

/**
 * @author kross
 * @copyright 2009
 */

if ($_POST[add_param])
{
	$SQL = "INSERT INTO params_names
	(param_name, param_type)
	VALUES
	('".trim($_POST[param_name])."', '".$_POST[param_type]."')
	";
	$Q->query($DB, $SQL);
	
	$SQL = "SELECT * FROM params_names WHERE param_name = '".trim($_POST[param_name])."' AND param_type = '".$_POST[param_type]."' ORDER BY param_id DESC LIMIT 1";
	$result = $Q->query($DB, $SQL);
	$param_id = mysql_fetch_assoc($result);
	$param_id = $param_id[param_id];
	
	$SQL = "INSERT INTO groups_params
	(group_id, param_id, sorter)
	VALUES
	('".$_POST[param_group]."', '".$param_id."', '".new_sorter("groups_params")."')
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
		alert('Вы не ввели название параметра.');
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
	$groups_list = "";
	$SQL = "SELECT * FROM category_groups INNER JOIN params_groups_names ON category_groups.group_id = params_groups_names.group_id WHERE category_id='".$category_id."'";
	$result = $Q->query($DB, $SQL);
	for ($groups = Array(); $row = mysql_fetch_assoc($result); $groups[] = $row);
	
	for ($i = 0; $i < count($groups); $i++)
	{
		$groups_list .= "<option value='".$groups[$i][group_id]."'>".$groups[$i][group_name]."</option>";
	}
?>
<form action="params_add_param.php?id=<?=$_GET[id];?>" method="post">
<table>
	<tr>
		<td>
			Группа:
		</td>
		<td>
			<select name="param_group">
				<?=$groups_list;?>
			</select>
		</td>
	</tr>
	<tr>
		<td>
			Название:
		</td>
		<td>
			<input type="text" id="name" name="param_name">
		</td>
	</tr>
	<tr>
		<td>
			Тип:
		</td>
		<td>
			<select name="param_type">
				<option value="select">Выпадающий список</option>
				<option value="text_field">Текстовое поле</option>
				<option value="checkbox">Выбор нескольких значений</option>
			</select>
		</td>
	</tr>
	<tr>
		<td colspan=2 align="center">
			<input type="button" onclick="window.location.href='params_list.php?id=<?=$_GET[id];?>'" value="Отмена">
			<input type="submit" name="add_param" onclick="return chk_field()" value="Добавить">
		</td>
	</tr>
</table>
</form>
</body>
</html>