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
<a class=menu><?=$row[name]?></a></td>
<td align=center><a href=# onclick="JavaScript:window.close();" class=menu100><?=$lt[51]?></a></td>
</tr>
</table>
<?
echo $setup_status;
?>
<form action="params_product_save.php" method="post">
<input type="hidden" name="product_id" value="<?=$id;?>">
<table border=0>
<?	
	$product_id = $_GET[id];
	$output = "";
	$param_rubric_id = get_rubric_id($_GET[id]);
	//echo "param_rubric_id=".$param_rubric_id;
	
	$SQL = "SELECT * FROM category_groups INNER JOIN params_groups_names ON category_groups.group_id = params_groups_names.group_id WHERE category_id='".$param_rubric_id."' ORDER BY category_groups.sorter ASC";
	$result = $Q->query($DB, $SQL);
	for ($groups = Array(); $row = mysql_fetch_assoc($result); $groups[] = $row);
	
	for ($i = 0; $i < count($groups); $i++)
	{
		$output .= "
		<tr>
			<td colspan=2 style='font-size:15px; font-weight:bold; color:#009933'>
				".$groups[$i][group_name]."
			</td>
		</tr>
		<tr>
			<td colspan=2>
				<hr width=100%>
			</td>
		</tr>
		";
		
		$SQL = "SELECT * FROM groups_params INNER JOIN params_names ON groups_params.param_id = params_names.param_id WHERE group_id='".$groups[$i][group_id]."' ORDER BY groups_params.sorter ASC";
		$result = $Q->query($DB, $SQL);
		for ($params = Array(); $row = mysql_fetch_assoc($result); $params[] = $row);
		
		for ($j = 0; $j < count($params); $j++)
		{
			$SQL = "SELECT * FROM products_values WHERE product_id = '".$product_id."' AND param_id = '".$params[$j][param_id]."'";
			$result = $Q->query($DB, $SQL);
			$product_value = mysql_fetch_assoc($result);
			$product_value = $product_value[value];
			
			if ($params[$j][param_type] == "select")
			{
				$SQL = "SELECT * FROM params_values INNER JOIN values_titles ON params_values.value_id = values_titles.value_id WHERE param_id = '".$params[$j][param_id]."' ORDER BY sorter ASC";
				$result = $Q->query($DB, $SQL);
				for ($values = Array(); $row = mysql_fetch_assoc($result); $values[] = $row);
				$values_list = "";
				
				for ($k = 0; $k < count($values); $k++)
				{
					if ($values[$k][value_id] == $product_value)
						$values_list .= "<option selected value='".$values[$k][value_id]."'>".$values[$k][value_title]."</option>";
					else
						$values_list .= "<option value='".$values[$k][value_id]."'>".$values[$k][value_title]."</option>";
				}
				
				$param_value_field = "
				<select name='param_value[]'>
				".$values_list."
				</select>
				";
			}
			if ($params[$j][param_type] == "text_field")
			{
				$param_value_field = "<input type='text' name='param_value[]' value='".$product_value."'>";
			}
			if ($params[$j][param_type] == "checkbox")
			{
				$SQL = "SELECT * FROM params_values INNER JOIN values_titles ON params_values.value_id = values_titles.value_id WHERE param_id = '".$params[$j][param_id]."' ORDER BY sorter ASC";
				$result = $Q->query($DB, $SQL);
				for ($values = Array(); $row = mysql_fetch_assoc($result); $values[] = $row);
				
				$values_list = "";
				
				$product_value = split(",", $product_value);
				
				for ($k = 0; $k < count($values); $k++)
				{
					if (in_array($values[$k][value_id], $product_value))
						$values_list .= "<input type='checkbox' name='checkbox_value_".$params[$j][param_id]."[]' checked value='".$values[$k][value_id]."' id='value_".$values[$k][value_id]."'><label for='value_".$values[$k][value_id]."'>".$values[$k][value_title]."</label><br>";
					else
						$values_list .= "<input type='checkbox' name='checkbox_value_".$params[$j][param_id]."[]' value='".$values[$k][value_id]."' id='value_".$values[$k][value_id]."'><label for='value_".$values[$k][value_id]."'>".$values[$k][value_title]."</label><br>";
				}
				
				$param_value_field = $values_list;
			}
			
			$output .= "
			<tr>
				<td style='width:200px; font-weight:bold;' valign='top'>
					<input type='hidden' name='param_type[]' value='".$params[$j][param_type]."'>
					<input type='hidden' name='param_id[]' value='".$params[$j][param_id]."'>
					".$params[$j][param_name]."
				</td>
				<td>
					".$param_value_field."
				</td>
			</tr>
			";
		}
		
		if (count($params) > 0)
			$output .= "<tr><td colspan=2><hr width=100%></td></tr>";
	}
	
	echo $output;
?>
<tr>
	<td colspan="2" align="left">
		<input type="button" onclick="window.close()'" value="Отмена">
		<input type="submit" value="Сохранить">
	</td>
</tr>
</table>
</form>
</body>
</html>