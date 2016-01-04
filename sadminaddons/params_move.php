<?php

include("../sadmin/_bfunctions.php");
include("../sadmin/_admin_config.php");

/**
 * @author kross
 * @copyright 2009
 */

$id = $_GET[id];
$move = $_GET[move];
$direction = $_GET[direction];

if ($id != "")
{
	if ($move == "group")
	{
		$SQL = "SELECT * FROM category_groups WHERE group_id = '".$id."'";
		$result = $Q->query($DB, $SQL);
		$data = mysql_fetch_assoc($result);
		$sorter = $data[sorter];
		$category_id = $data[category_id];
		
		if ($direction == "up")
			$SQL = "SELECT * FROM category_groups WHERE category_id = '".$category_id."' AND sorter < '".$sorter."' ORDER BY sorter DESC LIMIT 1";

		if ($direction == "down")
			$SQL = "SELECT * FROM category_groups WHERE category_id = '".$category_id."' AND sorter > '".$sorter."' ORDER BY sorter ASC LIMIT 1";

		
		$result = $Q->query($DB, $SQL);
		if (mysql_num_rows($result) > 0)
		{
			$swap_data = mysql_fetch_assoc($result);
			$swap_sorter = $swap_data[sorter];
			
			$SQL = "SELECT MAX(sorter) FROM category_groups";
			$result = $Q->query($DB, $SQL);
			$max_sorter = mysql_fetch_assoc($result);
			$max_sorter = $max_sorter['MAX(sorter)'];
			$max_sorter++;
			
			$SQL = "UPDATE category_groups SET sorter='".$max_sorter."' WHERE sorter = '".$swap_sorter."'";
			$Q->query($DB, $SQL);
			
			$SQL = "UPDATE category_groups SET sorter='".$swap_sorter."' WHERE sorter='".$sorter."'";
			$Q->query($DB, $SQL);
			
			$SQL = "UPDATE category_groups SET sorter='".$sorter."' WHERE sorter = '".$max_sorter."'";
			$Q->query($DB, $SQL);
		}
		
		header("location:params_list.php?id=".$category_id);
	}
	
	if ($move == "param")
	{
		$SQL = "SELECT * FROM groups_params WHERE param_id = '".$id."'";
		$result = $Q->query($DB, $SQL);
		$data = mysql_fetch_assoc($result);
		$sorter = $data[sorter];
		$group_id = $data[group_id];
		
		if ($direction == "up")
			$SQL = "SELECT * FROM groups_params WHERE group_id = '".$group_id."' AND sorter < '".$sorter."' ORDER BY sorter DESC LIMIT 1";

		if ($direction == "down")
			$SQL = "SELECT * FROM groups_params WHERE group_id = '".$group_id."' AND sorter > '".$sorter."' ORDER BY sorter ASC LIMIT 1";
		
		$result = $Q->query($DB, $SQL);
		if (mysql_num_rows($result) > 0)
		{
			$swap_data = mysql_fetch_assoc($result);
			$swap_sorter = $swap_data[sorter];
			
			$SQL = "SELECT MAX(sorter) FROM groups_params";
			$result = $Q->query($DB, $SQL);
			$max_sorter = mysql_fetch_assoc($result);
			$max_sorter = $max_sorter['MAX(sorter)'];
			$max_sorter++;
			
			$SQL = "UPDATE groups_params SET sorter='".$max_sorter."' WHERE sorter = '".$swap_sorter."'";
			$Q->query($DB, $SQL);
			
			$SQL = "UPDATE groups_params SET sorter='".$swap_sorter."' WHERE sorter='".$sorter."'";
			$Q->query($DB, $SQL);
			
			$SQL = "UPDATE groups_params SET sorter='".$sorter."' WHERE sorter = '".$max_sorter."'";
			$Q->query($DB, $SQL);
		}
		
		$SQL = "SELECT * FROM category_groups WHERE group_id = '".$group_id."'";
		$result = $Q->query($DB, $SQL);
		$category_id = mysql_fetch_assoc($result);
		$category_id = $category_id[category_id];
		
		header("location:params_list.php?id=".$category_id);
	}
	
	if ($move == "value")
	{
		if ($direction == "up")
		{
			
		}
		if ($direction == "down")
		{
			
		}
	}
}

?>