<?

//echo $query."<br>";

$Q->query($DB,$query);



$file=file($module_filepath."/base/base.txt");



for($i=1;$i<count($file);$i++)

{	

	if (trim($file[$i]) != "")

	{

		$row = split("\t", $file[$i]);

		$code = $row[0]; 			// Код товара

		$brand = $row[1];			// Бренд

		$price = $row[3];			// Цена

		$shop_price = $row[4];		// Цена в магазине

		$old_price = $row[5];		// Старая цена

		$discont_price = $row[6];	// Цена со скидкой

		$top_text = $row[7];		// Текст сверху

		$url = $row[8];				// URL

		$rate = $row[10];			// Рейтинг

		$related = $row[11];		// Сопутствующие товары

		$title = $row[12];			// Тайтл

		$existence = $row[13]; 		// Есть в наличии

		$enabled = $row[9];		// Вкл\Выкл
        $SQL1 = "SELECT id FROM ".$module_name." WHERE name = '".$brand."'";
		

		$Q->query($DB, $SQL1);
		$result1 = $Q->getrow();
		
		

		if ($existence != "")

			$existence = "0";

		

		if ($enabled != "")

			$enabled = "no";

		

		$SQL = "UPDATE ".$module_name." SET 

		f1 = '".$price."',

		f2 = '".$result1[0]."',

		f4 = '".$rate."',

		f5 = '".$old_price."',

		f6 = '".$shop_price."',

		f7 = '".$related."',

		f9 = '".$top_text."',

		f10 = '".$discont_price."',

		url='".$url."',		

		title='".$title."',		

		enabled = '".$enabled."',

		existence = '".$existence."'

		WHERE f8 = '".$code."'

		";

		if($code)

		$Q->query($DB, $SQL);
	}
}



$file=fopen($module_datefile,"w");

fputs($file,time());

fclose($file);

echo "Обновлено";

?>