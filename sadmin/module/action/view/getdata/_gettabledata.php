<?
//-------------------------------------------
// id
// language
// dateandtime
// name
// anons
// text
// archive
//-------------------------------------------

if($toshow<(count($tabledata)-$start))
	{
	$ccount=$start+$toshow;
	}
else
	{
	$ccount=count($tabledata);
	}

$tabledata_all=$tabledata;
$tabledata=($tabledata[0][0]!="") ? array_slice($tabledata,$start,$ccount-$start) : null;
?>
