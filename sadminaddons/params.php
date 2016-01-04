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
<form action="save.php" method="post">
<input type="hidden" name="id" value="<?=$id;?>">
<table>
<?
	$output = "";
	
	$SQL = "SELECT * FROM ".$module_name." WHERE f1 = '".$row[rid]."'";
	$result = $Q->query($DB, $SQL);
	$params_rubric = mysql_fetch_assoc($result);
	
	if ($params_rubric)
	{
		$SQL = "SELECT * FROM ".$module_name." WHERE rid = '".$params_rubric[id]."' ORDER BY date DESC";
		$result = $Q->query($DB, $SQL);
		for ($params = Array(); $row = mysql_fetch_assoc($result); $params[] = $row);
		
		for ($i = 0; $i < count($params); $i++)
		{
			$SQL = "SELECT * FROM char_values WHERE product_id = '".$id."' AND char_id = '".$params[$i][id]."'";
			$result = $Q->query($DB, $SQL);
			$value = mysql_fetch_assoc($result);
			$char_field = "";
			if ($params[$i][f2] == "" || $params[$i][f2] == 1)
			{
				$SQL = "SELECT * FROM ".$module_name." WHERE rid = '".$params[$i][id]."' ORDER BY date DESC";
				$result = $Q->query($DB, $SQL);
				for ($values = Array(); $row = mysql_fetch_assoc($result); $values[] = $row);
				
				$list = "";
				for ($j = 0; $j < count($values); $j++)
				{
					if ($value)
					{
						if ($value[value_id] == $values[$j][id])
							$list .= "<option value='".$values[$j][id]."' selected='selected'>".$values[$j][name]."</option>";
						else
							$list .= "<option value='".$values[$j][id]."'>".$values[$j][name]."</option>";
					}
					else
					{
						$list .= "<option value='".$values[$j][id]."'>".$values[$j][name]."</option>";
					}
				}
				
				$char_field = "
				<select name='field[".$i."]'>".$list."</select>
				";
			}
			elseif ($params[$i][f2] == 2)
			{	
				$char_field = "<input type='text' name='field[".$i."]' value='".$value[value_id]."'>";
			}
			
			$output .= "
			<tr>
				<td>
					".$params[$i][name]."
				</td>
				<td>
					".$char_field."
					<input type='hidden' name='arr_id[".$i."]' value='".$params[$i][id]."'>
				</td>
			</tr>
			";
		}
	}
	echo $output;
?>
<tr>
	<td colspan="2" align="left">
		<input type="submit" name="save" value="Сохранить">
	</td>
</tr>
</table>
</form>
</body>
</html>