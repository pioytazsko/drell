<?php

include("../sadmin/_bfunctions.php");
include("../sadmin/_admin_config.php");

if ($_POST[product_id])
{
	$product_id = $_POST[product_id];
	$params_values = Array();
	$params_values = $_POST[param_value];
	$params_id = Array();
	$params_id = $_POST[param_id];
	$params_type = Array();
	$params_type = $_POST[param_type];
	
	$SQL = "DELETE FROM products_values WHERE product_id = '".$product_id."'";
	$Q->query($DB, $SQL);
	
	for ($i = 0; $i < count($params_id); $i++)
	{
		$value = $params_values[$i];
		if ($params_type[$i] == "checkbox")
		{
			//print_r($params_type);
			$value = $_POST["checkbox_value_".$params_id[$i]];
			if (count($value) < 1)
				$value = "";
			else
				$value = implode(",", $value);
		}
		
		$SQL = "INSERT INTO products_values
		(product_id, param_id, value)
		VALUES
		(
		'".$product_id."',
		'".$params_id[$i]."',
		'".$value."'
		)
		";
		$Q->query($DB, $SQL);
	}
	
	header("location: params_list_product.php?id=".$product_id);
}

?>