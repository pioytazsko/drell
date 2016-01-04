<?

function get_params($product_id)
{
	global $Q, $DB, $module_name;
	$SQL = "SELECT * FROM ".$module_name." WHERE id = '".$product_id."'";
	$result = $Q->query($DB, $SQL);
	$product = mysql_fetch_assoc($result);
	$id = $product[rid];
	
	$SQL = "SELECT * FROM ".$module_name." WHERE aname = 'h2' AND f1 = '".$id."'";
	$result = $Q->query($DB, $SQL);
	$params_rubric = mysql_fetch_assoc($result);
					
	$SQL = "SELECT * FROM ".$module_name." WHERE rid = '".$params_rubric['id']."' AND archive='on' ORDER BY date DESC";
	$result = $Q->query($DB, $SQL);
	for ($params = Array(); $row = mysql_fetch_assoc($result); $params[] = $row);
	
	$values = "";
	for ($i = 0; $i < count($params); $i++)
	{
		$SQL = "SELECT * FROM char_values WHERE product_id = '[id]' AND char_id = '".$params[$i][id]."'";
		$result = $Q->query($DB, $SQL);
		$value = mysql_fetch_assoc($result);
		if ($params[$i]['f2'] == "" || $params[$i]['f2'] == 1)
		{
			$SQL = "SELECT * FROM ".$module_name." WHERE id = '".$value[value_id]."'";
			$result = $Q->query($DB, $SQL);
			$value = mysql_fetch_assoc($result);
			$value = $value['name'];
		}
		elseif ($params[$i]['f2'] == 2)
		{
			$value = $value[value_id];
		}
					
		$values .= "<div>".$params[$i]['name'].":".$value.";</div>";
	}
	return $values;
}

if ($_GET[id])
{
	$SQL = "SELECT * FROM ".$module_name." WHERE rid = '".$_GET[id]."' ORDER BY date DESC";
	$full_link = get_url("catalog.php?id=".$_GET[id]."&show=full");
	$table_link = get_url("catalog.php?id=".$_GET[id]."&show=table");
	$compare_link = get_url("catalog.php?id=".$_GET[id]."&show=compare");
}
elseif ($_GET[brand])
{
	$SQL = "SELECT * FROM ".$module_name." WHERE f2 = '".$_GET[brand]."' AND f1<>'' AND aname = 'e2' ORDER BY date DESC";
	$full_link = get_url("catalog.php?brand=".$_GET[brand]."&show=full");
	$table_link = get_url("catalog.php?brand=".$_GET[brand]."&show=table");
	$compare_link = get_url("catalog.php?brand=".$_GET[brand]."&show=compare");
}
$result = $Q->query($DB, $SQL);
for ($products = Array(); $row = mysql_fetch_assoc($result); $products[] = $row);

$output = "<tr><td colspan='2' align='right'><a href='".$full_link."' style='".$full_style."'>Подробный список</a> | <a href='".$table_link."' style='".$table_style."'>Табличный вид</a> | <a href='".$compare_link."' style='".$compare_style."'>Одностраничный список</a></td></tr>";

if ($show == "full")
{
	for ($i = 0; $i < count($products); $i++)
	{
		$output .= "<tr>";		
		$output .= "<td colspan=2 style='padding-top:2px; padding-bottom:3px'>";
		
		$output .= "
		<table class='rubriki' border=0>
		<tr>
			<td class='pic' valign='top'>
				<img src='shortimage.php?x=70&y=70&path=attachments/".$products[$i][id]."/big.jpg' border='0'>
			</td>
			<td valign='top'>
				<table class='podrubriki' border=0>
				<tr>
					<td align='left'>
						<a class='title3' href='".get_url("/catalog.php?id=".$products[$i][id])."'>".$products[$i][name]."</a>
					</td>
				</tr>
				<tr>
					<td>
						".get_params($products[$i][id])."
					</td>
				</tr>
				</table>
			</td>
		</tr>
		</table>
		";
		
		$output .= "</td class='center1'>";
		$output .= "</tr>";
	}
	
	if (count($products)%2 != 0)
		$output .= "<td class='center1'></td></tr>";
}

if ($show == "table")
{
	for ($i = 0; $i < count($products); $i++)
	{
		if ($i%2 == 0)
			$output .= "<tr>";
			
		$output .= "<td class='center1'>";
		
		$output .= "
		<table class='rubriki' border=0>
		<tr>
			<td class='pic' valign='top'>
				<img src='images/pic.jpg' height='35' width='35' border='0'>
			</td>
			<td valign='top'>
				<table class='podrubriki' border=0>
				<tr>
					<td align='left'>
						<a class='title3' href='".get_url("/catalog.php?id=".$products[$i][id])."'>".$products[$i][name]."</a>
					</td>
				</tr>
				<tr>
					<td>
						".get_params($products[$i][id])."
					</td>
				</tr>
				</table>
			</td>
		</tr>
		</table>
		";
		
		$output .= "</td class='center1'>";
		
		if ($i%2 != 0)
			$output .= "</tr>";
	}
	
	if (count($products)%2 != 0)
		$output .= "<td class='center1'></td></tr>";
}

if ($show == "compare")
{
	if ($_POST[compare])
	{
		$output = "
		<tr>
			<td colspan=2>
				<table border=0 width=100%>
		";
		$product_id = Array();
		$product_id = $_POST[product_id];
		$where = "";
		$all_id = Array();
		
		for ($i = 0; $i < $_POST[products_count]; $i++)
		{
			if ($product_id[$i] != "")
				$all_id[] = $product_id[$i];
		}
		if ($all_id)
			$where = " id IN (".implode(", ", $all_id).") ";
		//print_r($_POST);
		if ($where != "")
		{
			$SQL = "SELECT * FROM ".$module_name." WHERE ".$where." ORDER BY date DESC";
			$result = $Q->query($DB, $SQL);
			for ($products_comp = Array(); $row = mysql_fetch_assoc($result); $products_comp[] = $row);
			$output .= "<tr><td>&nbsp;</td>";
			
			$SQL = "SELECT * FROM ".$module_name." WHERE aname = 'h2' AND f1 = '".$_GET[id]."'";
			$result = $Q->query($DB, $SQL);
			$params_rubric = mysql_fetch_assoc($result);
			
			$SQL = "SELECT * FROM ".$module_name." WHERE rid = '".$params_rubric[id]."'";
			$result = $Q->query($DB, $SQL);
			for ($params = Array(); $row = mysql_fetch_assoc($result); $params[] = $row);
			
			for ($i = 0; $i < count($products_comp); $i++)
			{
				$output .= "<td align='center' width='80' style='padding-bottom:5px'><img src='shortimage.php?x=70&y=70&path=attachments--".$products_comp[$i][id]."--big.jpg'><br>
				<a href='".get_url("catalog.php?id=".$products_comp[$i][id])."'>".$products_comp[$i][name]."</a>
				</td>";
			}
			$output .= "<td>&nbsp;</td></tr>";
			
			for ($i = 0; $i < count($params); $i++)
			{
				$output .= "<tr>
				<td style='width:200px;font-weight:bold; padding:2px 2px 2px 2px; font-size:12px; border-top:1px solid #cccccc'>
					".$params[$i][name].":
				</td>";
				$SQL = "SELECT * FROM char_values WHERE product_id IN (".implode(", ", $all_id).") AND char_id = '".$params[$i][id]."'";
				$result = $Q->query($DB, $SQL);
				for ($values = Array(); $row = mysql_fetch_assoc($result); $values[] = $row);
				
				//print_r($values);
				
				$products_values = Array();
				
				for ($j = 0; $j < count($values); $j++)
				{
					$SQl = "SELECT * FROM ".$module_name." WHERE id = '".$values[$j][char_id]."'";
					$result = $Q->query($DB, $SQL);
					$parameter = mysql_fetch_assoc($result);
					if ($parameter[f2] != 2)
					{
						$SQL = "SELECT * FROM ".$module_name." WHERE id = '".$values[$j][value_id]."'";
						$result = $Q->query($DB, $SQL);
						$value = mysql_fetch_assoc($result);
						$products_values[$values[$j][product_id]] = $value[name];
					}
					else
					{
						$products_values[$values[$j][product_id]] = $values[$j][value_id];
					}
				}
				
				for ($j = 0; $j < count($products_comp); $j++)
				{
					$output .= "<td align='center' style='border-top:1px solid #cccccc; width:80px'>".$products_values[$products_comp[$j][id]]."</td>";
				}
				$output .= "<td style='border-top:1px solid #cccccc'>&nbsp;</td>";
				$output .= "</tr>";
			}
		}
		
		$output .= "
				</table>
			</td>
		</tr>";
	}
	else
	{
		$form_action = "catalog.php?id=".$_GET[id];
		$brand_where = "";
		if ($_GET[brand])
		{
			$form_action = "catalog.php?brand=".$_GET[brand];
			$brand_where = " AND id = '".$_GET[brand]."' ";
		}
		$output .= "<form action='".$form_action."' method='post'>
		<tr><td colspan=2>";
		$SQL = "SELECT * FROM ".$module_name." WHERE rid = 30 ".$brand_where." ORDER BY date DESC";
		$result = $Q->query($DB, $SQL);
		for ($brands = Array(); $row = mysql_fetch_assoc($result); $brands[] = $row);
		
		$products_count = 0;
		
		$get_where = "";
		if ($_GET[id])
			$get_where = " rid = '".$_GET[id]."' AND ";
		
		for ($i = 0; $i < count($brands); $i++)
		{
			$SQL = "SELECT * FROM ".$module_name." WHERE ".$get_where." f2 = '".$brands[$i][id]."' AND f1<>'' ORDER BY date DESC";
			$result = $Q->query($DB, $SQL);
			for ($brand_products = Array(); $row = mysql_fetch_assoc($result); $brand_products[] = $row);
			
			if (mysql_num_rows($result) > 0)
			{
				$output .= "<div style='font-weight:bold; font-size:14px'>".$brands[$i][name]."</div>";
				for ($j = 0; $j < count($brand_products); $j++)
				{
					$output .= "
					<div style='width:200px; padding-top:2px; padding-bottom:2px'>
						<input type='checkbox' name='product_id[".$products_count."]' id='product_".$brand_products[$j][id]."' value='".$brand_products[$j][id]."'>
						<label for='product_".$brand_products[$j][id]."'>".$brand_products[$j][name]."</label>
					</div>";
					$products_count++;
				}
			}
		}
		$output .= "<input type='hidden' name='products_count' value='".$products_count."'>";
		$output .= "</td></tr>
		<tr><td colspan=2 align='right' style='padding-bottom:10px'><input type='submit' name='compare' value='Сравнить'></td></tr>
		</form>
		";
	}
}

echo $output;

?>