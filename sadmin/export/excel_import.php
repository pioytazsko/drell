<?php 
define('__ROOT__', $_SERVER['DOCUMENT_ROOT']);
require(__ROOT__.'/sadmin/export/medoo.min.php');
require(__ROOT__.'/sadmin/export/config.php');

//echo $_SERVER['SCRIPT_FILENAME'];
include(__ROOT__.'/sadmin/export/Classes/PHPExcel.php');
include(__ROOT__.'/sadmin/export/Classes/PHPExcel/Writer/Excel5.php');
include(__ROOT__.'/sadmin/export/Classes/PHPExcel/IOFactory.php');;
$database = new medoo(array(
	       // required
            'database_type' => $config['database_type'],
            'database_name'=> $config['database_name'],
            'server_name' => $config['server_name'],
            'username' => $config['username'],
            'password' => $config['password'],
            'charset'=>$config['charset']
        ));
//$filename="dir/price-drell07.12.15.xls";
$filename="./import/".$_FILES['fil']['name'];
//echo $filename;
copy($_FILES['fil']['tmp_name'],$filename);

$objPHPExcel = PHPExcel_IOFactory::load($filename);
foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {
    $worksheetTitle     = $worksheet->getTitle();
    $highestRow         = $worksheet->getHighestRow();
    $highestColumn      = $worksheet->getHighestColumn(); 
    $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);
    $nrColumns = ord($highestColumn) - 64;
    for ($row = 1; $row <= $highestRow; ++ $row) {
      $id= $worksheet->getCellByColumnAndRow(0, $row)->getValue();
      $dataType = PHPExcel_Cell_DataType::dataTypeForValue($id);       
        if($dataType=='n'){
        $name=$worksheet->getCellByColumnAndRow(1, $row)->getValue();
        $manufected=$worksheet->getCellByColumnAndRow(2, $row)->getValue();
        $price=$worksheet->getCellByColumnAndRow(3, $row)->getValue();
        $existence=$worksheet->getCellByColumnAndRow(5, $row)->getValue();
        $old_price=$worksheet->getCellByColumnAndRow(6, $row)->getValue();
        
//            echo $price."<br>";
        $title=$worksheet->getCellByColumnAndRow(4, $row)->getValue();

            $database->update("kalibr",array(
    	"name" => $name,     
    	// All age plus one
    	"f1" => $price, 
    	"f6" => $old_price,
        "existence"=>$existence        
    ),array(
    	"id" => $id
    ));
        }
//        $database
    };
};
echo "Загрузка выполнена!";
//header('Location:http://garantmarket.by/admin/catalog.php?idp=26');