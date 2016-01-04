<?
$SQL = "SELECT * FROM ".$module_name." WHERE rid = '16'";
$result = $Q->query($DB, $SQL);
for ($rubrics = array(); $row = mysql_fetch_assoc($result); $rubrics[] = $row);

for ($i = 0; $i < count($rubrics); $i++)
{
	$SQL = "SELECT * FROM ".$module_name." WHERE rid = '".$rubrics[$i][id]."'";
	$result = $Q->query($DB, $SQL);
	for ($subrubrics = Array(); $row = mysql_fetch_assoc($result); $subrubrics[] = $row);
	
	for ($j = 0; $j < count($subrubrics); $j++)
	{
		$SQL = "UPDATE ".$module_name." SET aname = 'e4' WHERE rid = '".$subrubrics[$j][id]."'";
		$Q->query($DB, $SQL);
	}
}
?>