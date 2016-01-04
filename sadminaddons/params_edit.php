<?php
include("../sadmin/_bfunctions.php");
include("../sadmin/_admin_config.php");
include("./params_functions.php");

/**
 * @author kross
 * @copyright 2009
 */

$setup_status = chk_setup();

if ($_POST[save])
{
	$id = $_GET[id];
	$edit = $_POST[edit];
	$name = $_POST[name];
	if ($edit == "group")
	{
		$SQL = "UPDATE params_groups_names SET group_name = '".$name."' WHERE group_id = '".$id."'";
		$Q->query($DB, $SQL);
		
		$SQL = "SELECT * FROM category_groups WHERE group_id = '".$id."'";
		$result = $Q->query($DB, $SQL);
		$category_id = mysql_fetch_assoc($result);
		$category_id = $category_id[category_id];
	}
	
	if ($edit == "param")
	{
		$SQL = "UPDATE params_names SET param_name = '".$name."' WHERE param_id = '".$id."'";
		$Q->query($DB, $SQL);
		
		$SQL = "SELECT * FROM groups_params INNER JOIN category_groups ON groups_params.group_id = category_groups.group_id WHERE groups_params.param_id = '".$id."'";
		$result = $Q->query($DB, $SQL);
		$category_id = mysql_fetch_assoc($result);
		$category_id = $category_id[category_id];
	}
	
	if ($edit == "value")
	{
		$SQL = "UPDATE values_titles SET value_title = '".$name."' WHERE value_id = '".$id."'";
		$Q->query($DB, $SQL);
		
		$SQL = "SELECT * FROM params_values
		INNER JOIN groups_params 
		ON params_values.param_id = groups_params.param_id
		INNER JOIN category_groups
		ON category_groups.group_id = groups_params.group_id
		WHERE value_id = '".$id."'";
		$result = $Q->query($DB, $SQL);
		$category_id = mysql_fetch_assoc($result);
		$category_id = $category_id[category_id];
	}
	
	header("location:params_list.php?id=".$category_id);
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
		alert('Поле должно содежрать значение.');
		return false;
	}
	else
		return true;
}
</script>
<style>
a.delete {
	text-decoration: none;
	color:#333333;
}

a.delete:hover {
	text-decoration: underline;
	color: #ff0000;
}

a.edit {
	text-decoration: none;
	color:#333333;
}

a.edit:hover {
	text-decoration: underline;
	color: #33FF00;
}

a.param {
	cursor:pointer;
	font-weight: bold;
	text-decoration: none;
	color: #000000;
}

a.param:hover {
	cursor:pointer;
	font-weight: bold;
	text-decoration: underline;
	color: #000000;
}
</style>
</head>
<body bgcolor=#FFFFFF background="../sadmin/images/adminbg.gif" rightmargin=10 leftmargin=10 topmargin=10>
<table width=100% cellpadding=5 cellspacing=2 border=1 bordercolor=#CCCCCC bgcolor="<?=$admin_settings['tablebg']?>">
<tr>
<td width=90%><img src=../sadmin/images/flags/<?=$adminlanguage?>.png border=0 alt="<?=$lt[1]?>" vspace=0 hspace=0>
&nbsp;
<a class=menu>Редактирование 
<?
if ($_GET[edit] == "group")
	echo "группы";
if ($_GET[edit] == "value")
	echo "значения";
if ($_GET[edit] == "param")
	echo "параметра";
?></a></td>
<td align=center><a href=# onclick="JavaScript:window.close();" class=menu100><?=$lt[51]?></a></td>
</tr>
</table>
<form action="params_edit.php?id=<?=$id;?>" method="post">
<table border=0>
<?	
	$edit = $_GET[edit];
	if ($edit == "param")
	{
		$SQL = "SELECT * FROM params_names WHERE param_id = '".$id."'";
		$result = $Q->query($DB, $SQL);
		$name = mysql_fetch_assoc($result);
		$name = $name[param_name];
	}
	
	if ($edit == "group")
	{
		$SQL = "SELECT * FROM params_groups_names WHERE group_id = '".$id."'";
		$result = $Q->query($DB, $SQL);
		$name = mysql_fetch_assoc($result);
		$name = $name[group_name];
	}
	
	if ($edit == "value")
	{
		$SQL = "SELECT * FROM values_titles WHERE value_id = '".$id."'";
		$result = $Q->query($DB, $SQL);
		$name = mysql_fetch_assoc($result);
		$name = $name[value_title];
	}
?>
<tr>
	<td>
		<input type="hidden" name="edit" value="<?=$edit?>">
		<input type="text" name="name" id="name" value="<?=$name;?>">
	</td>
</tr>
<tr>
	<td align="left">
		<input type="button" onclick="history.back()" value="Отмена">
		<input type="submit" name="save" onclick="return chk_field()" value="Сохранить">
	</td>
</tr>
</table>
</form>
</body>
</html>