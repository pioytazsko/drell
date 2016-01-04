<?
$SQL = "SELECT * FROM ".$module_name." WHERE aname = 'e3' ORDER BY name";
$relsult = $Q->query($DB, $SQL);
for ($products = Array(); $row = mysql_fetch_assoc($relsult); $products[] = $row);

$file = fopen("base/base.txt", "a+");

for ($i = 0; $i < count($products); $i++)
{
	$line = 
	"\r\n".
	$products[$i][f8]
	."\t".
	$brand
	."\t".
	$products[$i][name]
	."\t".
	$products[$i][f1]
	."\t".
	$products[$i][f6]
	."\t".
	$products[$i][f5]
	."\t".
	$products[$i][f10]
	."\t".
	$products[$i][f9]
	."\t".
	$products[$i][url]
	."\t".
	($products[$i][enabled]=="no"?"1":"")
	."\t".
	$products[$i][f4]
	."\t".
	$products[$i][f7]
	."\t".
	$products[$i][title]
	."\t".
	($products[$i][existance]=="no"?"1":"")
	;
	fputs($file, $line);
}

fclose($file);

echo "Готово.";

?>