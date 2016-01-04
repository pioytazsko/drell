<?php

include("../sadmin/_bfunctions.php");
include("../sadmin/_admin_config.php");
include("./params_functions.php");

/**
 * @author kross
 * @copyright 2009
 */

if ($_POST[add_group])
{
	$category_id = $_GET[id];
	
	$SQL = "SHOW TABLE STATUS LIKE 'params_groups_names'";
	$result = $Q->query($DB, $SQL);
	$group_id = mysql_fetch_assoc($result);
	$group_id = $group_id[Auto_increment];
	
	$SQL = "INSERT INTO params_groups_names
	(group_name)
	VALUES
	('".trim($_POST[group_name])."')
	";
	$Q->query($DB, $SQL);
	
	/*
	$SQL = "SELECT * FROM params_groups_names WHERE group_name = '".trim($_POST[group_name])."' ORDER BY group_id DESC LIMIT 1";
	$result = $Q->query($DB, $SQL);
	$group_id = mysql_fetch_assoc($result);
	$group_id = $group_id[group_id];
	*/
	
	if ($_POST[sorter] == "begin")
	{
		$SQL = "SELECT MIN(sorter) FROM category_groups WHERE category_id = '".$category_id."'";
		$result = $Q->query($DB, $SQL);
		$min_sorter = mysql_fetch_assoc($result);
		$min_sorter = $min_sorter['MIN(sorter)'];
		if ($min_sorter == "")
		{
			$SQL = "INSERT INTO category_groups
					(category_id, group_id, sorter)
					VALUES
					('".$category_id."', '".$group_id."', '".new_sorter("category_groups")."')
					";
		}
		else
		{
			$SQL = "UPDATE category_groups SET sorter = sorter + 1 WHERE sorter >= '".$min_sorter."'";
			$Q->query($DB, $SQL);
			
			$SQL = "INSERT INTO category_groups
					(category_id, group_id, sorter)
					VALUES
					('".$category_id."', '".$group_id."', '".$min_sorter."')
					";
		}
		
		$Q->query($DB, $SQL);
	}
	
	if ($_POST[sorter] == "after")
	{
		$SQL = "SELECT sorter FROM category_groups WHERE group_id = '".$_POST[after_group]."'";
		$result = $Q->query($DB, $SQL);
		$after_sorter = mysql_fetch_assoc($result);
		$after_sorter = $after_sorter[sorter];
		if ($after_sorter == "")
		{
			$SQL = "INSERT INTO category_groups
					(category_id, group_id, sorter)
					VALUES
					('".$category_id."', '".$group_id."', '".new_sorter("category_groups")."')
					";
		}
		else
		{
			$SQL = "UPDATE category_groups SET sorter = sorter + 1 WHERE sorter > '".$after_sorter."'";
			$Q->query($DB, $SQL);
			
			$SQL = "INSERT INTO category_groups
					(category_id, group_id, sorter)
					VALUES
					('".$category_id."', '".$group_id."', '".($after_sorter+1)."')
					";
		}
		
		$Q->query($DB, $SQL);
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
function first_activate()
{
	document.getElementById("after_group").disabled = "disabled";
}

function after_activate()
{
	document.getElementById("after_group").disabled = "";
}

function chk_field()
{
	if (document.getElementById('name').value == '')
	{
		alert('Вы не ввели название группы.');
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
	$SQL = "SELECT * FROM category_groups INNER JOIN params_groups_names ON category_groups.group_id = params_groups_names.group_id WHERE category_id='".$category_id."' ORDER BY sorter ASC";
	$result = $Q->query($DB, $SQL);
	for ($groups = Array(); $row = mysql_fetch_assoc($result); $groups[] = $row);
	
	for ($i = 0; $i < count($groups); $i++)
	{
		$groups_list .= "<option value='".$groups[$i][group_id]."'>".$groups[$i][group_name]."</option>";
	}
?>
<form action="params_add_group.php?id=<?=$_GET[id]?>" method="post">
<table>
	<tr>
		<td>
			Добавить:
		</td>
		<td>
			<input type="radio" checked="checked" onclick="first_activate()" name="sorter" value="begin" id="begin">
			<label for="begin">В начало</label>
			<input type="radio" name="sorter" value="after" onclick="after_activate()" id="after">
			<label for="after">После:</label>
			<select disabled="disabled" id="after_group" name="after_group">
			<?=$groups_list;?>
			</select>
		</td>
	</tr>
	<tr>
		<td>
			Название:
		</td>
		<td>
			<input type="text" id="name" name="group_name">
		</td>
	</tr>
	<tr>
		<td colspan=2 align="center">
			<input type="button" onclick="window.location.href='params_list.php?id=<?=$_GET[id];?>'" value="Отмена">
			<input type="submit" name="add_group" onclick="return chk_field()" value="Добавить">
		</td>
	</tr>
</table>
</form>
</body>
</html>