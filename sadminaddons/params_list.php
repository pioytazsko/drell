<?php

include("../sadmin/_bfunctions.php");
//include("../sadmin/_config.php");
//include("../sadmin/_mysql.php");
include("../sadmin/_admin_config.php");
include("./params_functions.php");


/**
 * @author kross
 * @copyright 2009
 */

$setup_status = chk_setup();

$id = $_GET[id];

$query="select * from ".$module_name." where id='".$id."'";

$Q->query($DB,$query);
$row=$Q->getrow();
if ($row[aname] == "e4")
	header("location:params_list_product.php?id=".$id);

$lt=getlangtemplate($adminlanguage,"../sadmin/_inc/templates/module");

//echo $id;
?>
<html>
<head>
<title>Administration:<?=$module_title?></title>
<link rel="stylesheet" href="../sadmin/admin.css" type="text/css">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
<script>
function show(id)
{
	if (document.getElementById(id).style.display == "none")
		document.getElementById(id).style.display = "block";
	else
		document.getElementById(id).style.display = "none";
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
<a class=menu><?=$row[f5]." ".$row[name]?></a></td>
<td align=center><a href=# onclick="JavaScript:window.close();" class=menu100><?=$lt[51]?></a></td>
</tr>
</table>
<?
echo $setup_status;

if ($setup_status == "")
{
?>
<table border=0>
<?	
	$category_id = $_GET[id];
	$output = "";
	
	$SQL = "SELECT * FROM category_groups INNER JOIN params_groups_names ON category_groups.group_id = params_groups_names.group_id WHERE category_id='".$category_id."' ORDER BY category_groups.sorter ASC";
	$result = $Q->query($DB, $SQL);
	for ($groups = Array(); $row = mysql_fetch_assoc($result); $groups[] = $row);
	
	for ($i = 0; $i < count($groups); $i++)
	{
		$output .= "
		<tr>
			<td colspan=3>
				<table border=0 cellspacing=0 cellpadding=0>
					<tr>
						<td width=15 align=left valign=middle><a href='params_move.php?id=".$groups[$i][group_id]."&direction=up&move=group' title='Вверх' style='margin:0px 0px 1px 0px; padding:0px'><img src='/images/arr_up.gif' border=0 hspace=0 vspace=0 style='margin:0px; padding:0px'></a><a href='params_move.php?id=".$groups[$i][group_id]."&direction=down&move=group' title='Вниз' style='margin:0px; padding:0px'><img src='/images/arr_down.gif' border=0 hspace=0 vspace=0 style='margin:1px 0px 0px 0px; padding:0px'></a></td>
						<td style='font-size:15px; font-weight:bold; color:#009933'>
							".$groups[$i][group_name]."
						</td>
					</tr>
				</table>
			</td>
			<td width=7>
				<a href='params_edit.php?id=".$groups[$i][group_id]."&edit=group' title='Редактировать' class='edit'>
				[+]
				</a>
			</td>
			<td width=7>
				<a href='params_delete.php?id=".$groups[$i][group_id]."&delete=group' title='Удалить' class='delete'>
				[X]
				</a>
			</td>
		</tr>
		<tr>
			<td colspan=5>
				<hr width=100%>
			</td>
		</tr>
		";
		
		$SQL = "SELECT * FROM groups_params INNER JOIN params_names ON groups_params.param_id = params_names.param_id WHERE group_id='".$groups[$i][group_id]."' ORDER BY groups_params.sorter ASC";
		$result = $Q->query($DB, $SQL);
		for ($params = Array(); $row = mysql_fetch_assoc($result); $params[] = $row);
		
		for ($j = 0; $j < count($params); $j++)
		{
			$type = "";
			if ($params[$j][param_type] == "select")
				$type = "Cписок";
			if ($params[$j][param_type] == "text_field")
				$type = "Поле";
			if ($params[$j][param_type] == "checkbox")
				$type = "Выбор нескольких";
			
			$output .= "
			<tr>
				<td style='width:200px'>
					<a class='param' href='#' onclick='show(\"values_".$params[$j][param_id]."\")'>".$params[$j][param_name]."</a>
				</td>
				<td>
					".$type."
				</td>
				<td width=12 valign=middle><a href='params_move.php?id=".$params[$j][param_id]."&direction=up&move=param' title='Вверх' style='margin:0px 0px 1px 0px; padding:0px'><img src='/images/arr_up.gif' border=0 hspace=0 vspace=0 style='margin:0px; padding:0px'></a><a href='params_move.php?id=".$params[$j][param_id]."&direction=down&move=param' title='Вниз' style='margin:0px; padding:0px'><img src='/images/arr_down.gif' border=0 hspace=0 vspace=0 style='margin:1px 0px 0px 0px; padding:0px'></a></td>
				<td width=7>
					<a href='params_edit.php?id=".$params[$j][param_id]."&edit=param' title='Редактировать' class='edit'>
					[+]
					</a>
				</td>
				<td width=7>
					<a href='params_delete.php?id=".$params[$j][param_id]."&delete=param' title='Удалить' class='delete'>
					[X]
					</a>
				</td>
			</tr>
			";
			
			$SQL = "SELECT * FROM params_values INNER JOIN values_titles ON params_values.value_id = values_titles.value_id WHERE param_id = '".$params[$j][param_id]."'";
			$result = $Q->query($DB, $SQL);
			for ($values = Array(); $row = mysql_fetch_assoc($result); $values[] = $row);
			
			$output .= "<tr><td colspan=4 id='values_".$params[$j][param_id]."' style='display:none'>";
			
			for ($k = 0; $k < count($values); $k++)
			{
				$output .= "
				<table style='margin-left:20px' cellspacing=0>
				<tr>
					<td width=270>
						".$values[$k][value_title]."
					</td>
					<td width=7>
						<a href='params_edit.php?id=".$values[$k][value_id]."&edit=value' title='Редактировать' class='edit'>
						[+]
						</a>
					</td>
					<td width=7>
						<a href='params_delete.php?id=".$values[$k][value_id]."&delete=value' title='Удалить' class='delete'>
						[X]
						</a>
					</td>
				</tr>
				</table>";
			}
			$output .= "</td></tr>";
		}
		
		if (count($params) > 0)
			$output .= "<tr><td colspan=5><hr width=100%></td></tr>";
	}
	
	echo $output;
?>
<tr>
	<td colspan="2" align="left">
		<input type="button" onclick="window.location.href='params_add_group.php?id=<?=$_GET[id];?>'" value="Добавить группу">
		<input type="button" onclick="window.location.href='params_add_param.php?id=<?=$_GET[id];?>'" value="Добавить характеристику">
		<br>
		<input type="button" onclick="window.location.href='params_add_value.php?id=<?=$_GET[id];?>'" value="Добавить значение">
	</td>
</tr>
</table>
</body>
</html>
<?
}
?>