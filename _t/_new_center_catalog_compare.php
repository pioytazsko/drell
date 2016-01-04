<table width="100%" cellspacing="0" cellpadding="0" border="0">
<tr height="1px">
	<td width="100%" style="padding-left:20px;">
	<?
	$compare = $_POST[compare];
	$SQL = "SELECT * FROM ".$module_name." WHERE id IN (".implode(", ", $compare).") AND enabled <> 'no' ORDER BY date DESC";
	$result = $Q->query($DB, $SQL);
	for ($products = Array(); $row = mysql_fetch_assoc($result); $products[] = $row);
	
	$output = "
	<table>
	<tr>
		<td></td>
	";
	
	for ($i = 0; $i < count($products); $i++)
	{
		$output .= "
		<td align=center>
			<a href='".get_link($products[$i][id])."' class='goodnameSmall'>".$products[$i][name]."</a><br>
			<img src='/shortimage.php?path=attachments--".$products[$i][id]."--1.jpg&x=137&y=121' border='0'/>
		</td>
		";
	}
	
	$output .= "</tr>";
	$category_id = get_rubric_id($products[0][id]);
	
	$SQL = "SELECT * FROM category_groups INNER JOIN params_groups_names ON category_groups.group_id = params_groups_names.group_id WHERE category_id = '".$category_id."' ORDER BY sorter";
	$result = $Q->query($DB, $SQL);
	for ($groups = Array(); $row = mysql_fetch_assoc($result); $groups[] = $row);
	
	for ($i = 0; $i < count($groups); $i++)
	{
		$SQL = "SELECT * FROM groups_params INNER JOIN params_names ON groups_params.param_id = params_names.param_id WHERE group_id = '".$groups[$i][group_id]."' ORDER BY groups_params.sorter";
		$result = $Q->query($DB, $SQL);
		for ($params = Array(); $row = mysql_fetch_assoc($result); $params[] = $row);
		
		for ($j = 0; $j < count($params); $j++)
		{
			$output .= "
			<tr>
				<td>
					".$params[$j][param_name]."
				</td>
			";
			
			for ($k = 0; $k < count($products); $k++)
			{
				if ($params[$j][param_type] == "select")
				{
					$SQL = "SELECT * FROM products_values INNER JOIN values_titles ON products_values.value = values_titles.value_id WHERE product_id = '".$products[$k][id]."' AND param_id = '".$params[$j][param_id]."'";
					$result = $Q->query($DB, $SQL);
					$value = mysql_fetch_assoc($result);
					$value = $value[value_title];
				}
				if ($params[$j][param_type] == "text_field")
				{
					$SQL = "SELECT * FROM products_values WHERE product_id = '".$products[$k][id]."' AND param_id = '".$params[$j][param_id]."'";
					$result = $Q->query($DB, $SQL);
					$value = mysql_fetch_assoc($result);
					$value = $value[value];
				}
				if ($params[$j][param_type] == "checkbox")
				{
					$SQL = "SELECT * FROM products_values WHERE product_id = '".$products[$k][id]."' AND param_id = '".$params[$j][param_id]."'";
					$result = $Q->query($DB, $SQL);
					$value = mysql_fetch_assoc($result);
					$value = $value[value];
					
					$value_id = split(",", $value);
					//print_r($value_id);
					$value = "";
					if (count($value_id) > 0 && $value_id[0] != "")
					{
						$SQL = "SELECT * FROM values_titles WHERE value_id IN (".implode(", ", $value_id).")";
						$result = $Q->query($DB, $SQL);
						for ($values = Array(); $row = mysql_fetch_assoc($result); $values[] = $row[value_title]);
						$value = implode(", ", $values);
					}
					if ($value == "")
						$value = "&nbsp;";
				}
				$output .= "<td>".$value."</td>";
			}
			
			$output .= "</tr>";
		}
	}
	$output .= "</table>";
	echo $output;
	//echo block("rid='".$_GET[id]."' ORDER BY date DESC", $template, "", "", 12, "“овары в данной рубрике отсутствуют");
	?>
	</td>
</tr>
<tr height="30px">
<td width="100%">
</td>
</tr>

</table>