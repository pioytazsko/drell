<table border=0>
<tr><td><img src="images/katalog.jpg" height="54" width="198" border="0"></td></tr>

<?

$menu = "";

function get_menu($id, $level = 0)
{
	global $DB, $Q, $module_name, $menu, $way_array;
	
	$SQL = "SELECT * FROM ".$module_name." WHERE rid = '".$id."' AND f1 = '' ORDER BY date DESC";
	$result = $Q->query($DB, $SQL);
	for ($data = Array(); $row = mysql_fetch_assoc($result); $data[] = $row);
	
	for ($i = 0; $i < count($data); $i++)
	{
		$menu .= "
		<tr><td class='katalog_item".$level."'><a class='katalog_item' href='/".get_url("catalog.php?id=".$data[$i][id])."'>".$data[$i][name]."</a></td></tr>
		";
		if (in_array($data[$i][id], $way_array))
			get_menu($data[$i][id], $level+1);
	}
}

$way_array = Array();

unset($id);
//echo $REQUEST_URI;
//print_r($_SERVER);
if (strpos($_SERVER[SCRIPT_NAME], "catalog"))
	$id = $_GET[id];

if ($id)
{
	array_push($way_array, $_GET[id]);
	$SQL = "SELECT * FROM ".$module_name." WHERE id = '".$id."'";
	$result = $Q->query($DB, $SQL);
	$data = mysql_fetch_assoc($result);
	$rid = $data[rid];
	array_push($way_array, $rid);
	while ($rid != 16)
	{
		$SQL = "SELECT * FROM ".$module_name." WHERE id = '".$rid."'";
		$result = $Q->query($DB, $SQL);
		$data = mysql_fetch_assoc($result);
		$rid = $data[rid];
		array_push($way_array, $rid);
	}
}

//print_r($way_array);

get_menu(16);

echo $menu;
?>

<tr><td><img src="images/katalog_last.jpg" height="36" width="198" border="0"></td></tr>
</table>