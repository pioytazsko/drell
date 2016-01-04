<?php

function new_sorter($table)
{
	global $Q, $DB;
	
	$SQL = "SELECT MAX(sorter) FROM ".$table;
	$result = $Q->query($DB, $SQL);
	$sorter = mysql_fetch_assoc($result);
	$sorter = $sorter['MAX(sorter)'];
	if ($sorter == "")
		$sorter = 1;
	else
		$sorter += 1;
	return $sorter;
}

function chk_setup()
{
	global $Q, $DB;
	
	$error = false;
	
	$SQL = "SHOW TABLES FROM kuvaldab_drelby LIKE 'params_groups_names'";
	$result = $Q->query($DB, $SQL);
	if (mysql_num_rows($result) < 1)
		$error = true;
	
	$SQL = "SHOW TABLES FROM kuvaldab_drelby LIKE 'params_names'";
	$result = $Q->query($DB, $SQL);
	if (mysql_num_rows($result) < 1)
		$error = true;
	
	$SQL = "SHOW TABLES FROM kuvaldab_drelby LIKE 'values_titles'";
	$result = $Q->query($DB, $SQL);
	if (mysql_num_rows($result) < 1)
		$error = true;
		
	$SQL = "SHOW TABLES FROM kuvaldab_drelby LIKE 'products_values'";
	$result = $Q->query($DB, $SQL);
	if (mysql_num_rows($result) < 1)
		$error = true;
		
	$SQL = "SHOW TABLES FROM kuvaldab_drelby LIKE 'category_groups'";
	$result = $Q->query($DB, $SQL);
	if (mysql_num_rows($result) < 1)
		$error = true;
		
	$SQL = "SHOW TABLES FROM kuvaldab_drelby LIKE 'groups_params'";
	$result = $Q->query($DB, $SQL);
	if (mysql_num_rows($result) < 1)
		$error = true;
	
	if ($error == true)
		return "Дополнение отсутствует, либо установлено не полностью.<br><a href='install_params.php'>Установить.</a>";
	else
		return "";
}

function copy_params($from, $to)
{
	global $Q, $DB, $module_name;
	
	$SQL = "SELECT * FROM category_groups INNER JOIN params_groups_names ON category_groups.param_id = params_groups_names.param_id WHERE category_id = '".$from."' ORDER BY category_groups.sorter ASC";
	$result = $Q->query($DB, $SQL);
	for ($groups = Array(); $row = mysql_fetch_assoc($result); $groups[] = $row);
	
	for ($i = 0; $i < count($groups); $i++)
	{
		
	}
}

?>