<?
/*
$SQL = "SELECT * FROM `kalibr_tmp` WHERE rid='2'";
$result = $Q2->query($DB,$SQL);
for ($category = Array(); $row = mysql_fetch_assoc($result); $category[] = $row);

$new_id = getmaxid("id", "kalibr");


for ($i = 0; $i < count($category); $i++)
{
	$new_id++;
	//print_r($category[$i]);
	//$files = getfiles("kalibr.by/attachments/".$category[$i][id]."/");
	mkdir("attachments/".$new_id, 0777);
	copy("kalibr.by/attachments/".$category[$i][id]."/1.jpg", "attachments/".$new_id."/big.jpg");
	$SQL = "INSERT INTO ".$module_name." (id, rid, aname, lang, date, name) 
	VALUES
	(
	'".$new_id."',
	'16',
	'e2',
	'ru',
	'".$category[$i]['date']."',
	'".$category[$i][name]."'
	)
	";
	$Q2->query($DB, $SQL);
}

echo "Готово";
*/
//print_r($product);


/*
$category_id = 4035;

$new_cat_id = 530;

$new_id = getmaxid("id", "kalibr");

$new_id++;

$SQL = "SELECT * FROM kalibr_tmp WHERE rid = '".$category_id."' ORDER BY date DESC";
$result = $Q->query($DB, $SQL);
for ($subcategory = Array(); $row = mysql_fetch_assoc($result); $subcategory[] = $row);

for ($j = 0; $j < count($subcategory); $j++)
{
	$new_id++;
	
	$SQL = "INSERT INTO ".$module_name." (id, rid, aname, lang, date, name)
	VALUES
	(
	'".$new_id."',
	'".$new_cat_id."',
	'e2',
	'ru',
	'".$subcategory[$j]['date']."',
	'".$subcategory[$j][name]."'
	)
	";
	$Q2->query($DB, $SQL);
	if (!file_exists("attachments/".$new_id))
		mkdir("attachments/".$new_id."/", 0777);
	chmod("attachments/".$new_id."/", 0777);
	
	copy("kalibr.by/attachments/".$subcategory[$j][id]."/1.jpg", "attachments/".$new_id."/big.jpg");
	
	$subcategory_id = $new_id;
	
	$SQL = "SELECT * FROM kalibr_tmp WHERE rid = '".$subcategory[$j][id]."' ORDER BY date DESC";
	$result = $Q->query($DB, $SQL);
	for ($product = Array(); $row = mysql_fetch_assoc($result); $product[] = $row);
	
	for ($k = 0; $k < count($product); $k++)
	{
		$new_id++;
		
		$brand = Array()
;		if ($product[$k][f5] != "")
		{
			$SQL = "SELECT * FROM ".$module_name." WHERE name LIKE '%".$product[$k][f5]."%'";
			$Q2->query($DB, $SQL);
			$brand = mysql_fetch_assoc($result);
		}
		
		$SQL = "INSERT INTO ".$module_name." (id, rid, aname, lang, date, name, text, f1, f8, f10, f2)
		VALUES
		(
		'".$new_id."',
		'".$subcategory_id."',
		'e2',
		'ru',
		'".$product[$k]['date']."',
		'".$product[$k][name]."',
		'".$product[$k][anons]."',
		'".$product[$k][f1]."',
		'".$product[$k][f7]."',
		'".$product[$k][f3]."',
		'".$brand[id]."'
		)
		";
		$Q2->query($DB, $SQL);
		
		if (!file_exists("attachments/".$new_id))
			mkdir("attachments/".$new_id."/", 0777);
		chmod("attachments/".$new_id."/", 0777);
		
		$files = getfiles("kalibr.by/attachments/".$product[$k][id]."/");
		for ($i = 0; $i < count($files); $i++)
		{
			if ($files[$i] == "1.jpg")
				copy("kalibr.by/attachments/".$product[$k][id]."/1.jpg", "attachments/".$new_id."/big.jpg");
			else
				copy("kalibr.by/attachments/".$product[$k][id]."/".$files[$i], "attachments/".$new_id."/".$files[$i]);
		}
	}
}
*/

echo "Готово.";


/*
$dir = opendir("attachments");
$i = 0;
while ($subdir = readdir($dir))
{
	echo $i.".  ".$subdir."<br>";
	if ($subdir)
	$i++;
}
*/

/*
$files = getfiles("attachments");

for ($i = 0; $i < count($files); $i++)
{
	if ($files[$i] > 524)
	{
		$subfiles = getfiles("attachments/".$files[$i]."/");
		chmod("attachments/".$files[$i]."/", 0777);
		for ($j = 0; $j < count($subfiles); $j++)
		{
			chmod("attachments/".$files[$i]."/".$subfiles[$j], 0777);
			if (unlink("attachments/".$files[$i]."/".$subfiles[$j]))
				echo "file <b>/attachments/".$files[$i]."/".$subfiles[$j]."</b> removed<bR>";
			else
				echo "file <b>/attachments/".$files[$i]."/".$subfiles[$j]."</b> not removed<bR>";
		}
		if (rmdir("attachments/".$files[$i]."/"))
			echo "directory <b>/attachments/".$files[$i]."</b> removed<bR>";
		else
			echo "directory <b>/attachments/".$files[$i]."</b> not removed<bR>";
	}
}
*/

/*
	$SQL = "INSERT INTO ".$module_name." (id, rid, aname, lang, date, name, text)
	VALUES (
	'".$new_id."',
	'0',
	'e2',
	'ru',
	'".$category[$i]['date']."',
	'".$category[$i][name]."',
	'".$category[$i][text]."'
	)
	";
	*/
?>