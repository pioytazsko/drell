<?php

include("../sadmin/_bfunctions.php");
include("../sadmin/_admin_config.php");

/**
 * @author kross
 * @copyright 2009
 */

$id = $_GET[id];
$delete = $_GET['delete'];

if ($_GET[id])
{
	if ($delete == "group")
	{
		$SQL = "SELECT * FROM category_groups WHERE group_id = '".$id."'";
		$result = $Q->query($DB, $SQL);
		$category_id = mysql_fetch_assoc($result);
		$category_id = $category_id[category_id];
		
		$SQL = "SELECT * FROM groups_params WHERE group_id = '".$id."'";
		$result = $Q->query($DB, $SQL);
		for ($params = Array(); $row = mysql_fetch_assoc($result); $params[] = $row);
		
		for ($i = 0; $i < count($params); $i++)
		{
			$SQL = "SELECT * FROM params_values WHERE param_id = '".$params[$i][param_id]."'";
			$result = $Q->query($DB, $SQL);
			for ($values = Array(); $row = mysql_fetch_assoc($result); $values[] = $row);
			
			for ($j = 0; $j < count($values); $j++)
			{
				$SQL = "DELETE FROM values_titles WHERE value_id = '".$values[$j][value_id]."'";
				$Q->query($DB, $SQL);
			}
			
			$SQL = "DELETE FROM params_values WHERE param_id = '".$params[$i][param_id]."'";
			$Q->query($DB, $SQL);
			
			$SQL = "DELETE FROM params_names WHERE param_id = '".$params[$i][param_id]."'";
			$Q->query($DB, $SQL);
		}
		
		$SQL = "DELETE FROM params_groups_names WHERE group_id = '".$id."'";
		$Q->query($DB, $SQL);
		
		$SQL = "DELETE FROM groups_params WHERE group_id = '".$id."'";
		$Q->query($DB, $SQL);
		
		header("location:params_list.php?id=".$category_id);
	}
	
	if ($delete == "param")
	{
		$SQL = "SELECT * FROM groups_params INNER JOIN category_groups ON groups_params.group_id = category_groups.group_id WHERE groups_params.param_id = '".$id."'";
		$result = $Q->query($DB, $SQL);
		$category_id = mysql_fetch_assoc($result);
		$category_id = $category_id[category_id];
		
		$SQL = "SELECT * FROM params_values WHERE param_id = '".$id."'";
		$result = $Q->query($DB, $SQL);
		for ($values = Array(); $row = mysql_fetch_assoc($result); $values[] = $row);
		
		for ($j = 0; $j < count($values); $j++)
		{
			$SQL = "DELETE FROM values_titles WHERE value_id = '".$values[$j][value_id]."'";
			$Q->query($DB, $SQL);
		}
		
		$SQL = "DELETE FROM params_values WHERE param_id = '".$id."'";
		$Q->query($DB, $SQL);
		
		$SQL = "DELETE FROM params_names WHERE param_id = '".$id."'";
		$Q->query($DB, $SQL);
		
		header("location:params_list.php?id=".$category_id);
	}
	
	if ($delete == "value")
	{
		$SQL = "SELECT * FROM params_values WHERE value_id = '".$id."'";
		$result = $Q->query($DB, $SQL);
		$param = mysql_fetch_assoc($result);
		
		$SQL = "SELECT * FROM groups_params INNER JOIN category_groups ON groups_params.group_id = category_groups.group_id WHERE groups_params.param_id = '".$param[param_id]."'";
		$result = $Q->query($DB, $SQL);
		$category_id = mysql_fetch_assoc($result);
		$category_id = $category_id[category_id];
		
		$SQL = "DELETE FROM values_titles WHERE value_id = '".$id."'";
		$Q->query($DB, $SQL);
		
		header("location:params_list.php?id=".$category_id);
	}
}

?>