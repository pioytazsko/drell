<?php define('__ROOT__', $_SERVER['DOCUMENT_ROOT']);
require(__ROOT__.'/sadmin/export/medoo.min.php');
require(__ROOT__.'/sadmin/export/config.php');


include(__ROOT__.'/sadmin/export/Classes/PHPExcel.php');
include(__ROOT__.'/sadmin/export/Classes/PHPExcel/Writer/Excel5.php');
//echo $_SERVER['SCRIPT_FILENAME'];
$xls = new PHPExcel();
   
//установка шрифта 
$xls->getDefaultStyle()->getFont()->setName('Arial');
$xls->getDefaultStyle()->getFont()->setSize(8);
//подключение бд
 class Items
 { public $levl;
   public $parents ;
   public $name;
   public $id;
   public $price;
   public $chpu;
  public $manufected;
  public $cat;
  public $adress;
  public $existence;
  public $old_price;
function  __construct($name,$price,$id,$manufected,$rid,$cat,$url,$existence=1,$old_price=""){
$this->name=$name;
$this->price=$price;
$this->id=$id;
$this->manufected=$manufected;
$this->parents=$rid;
$this->cat=$cat;
$this->chpu=$url;
$this->existence=$existence;
$this->old_price=$old_price;
    
}
 
 
 }


//print_r($config);
 $database = new medoo(array(
	       // required
            'database_type' => $config['database_type'],
            'database_name'=> $config['database_name'],
            'server_name' => $config['server_name'],
            'username' => $config['username'],
            'password' => $config['password'],
            'charset'=>$config['charset']
        ));
$xls->setActiveSheetIndex(0);
$sheet = $xls->getActiveSheet();
//на листе устанавливаем 
//сделаем запрос в бд за товарами
$datas=$database->select("kalibr",array("id","aname","name","f1","f2","f6","rid","url","existence"),array("rid[!]"=>0));
// Выравнивание текста

$sheet->getColumnDimension('A')->setWidth(15);
$sheet->getColumnDimension('B')->setWidth(70);
$sheet->getColumnDimension('C')->setWidth(40);
$sheet->getColumnDimension('D')->setWidth(20);
$sheet->getColumnDimension('E')->setWidth(20);
$sheet->getColumnDimension('F')->setWidth(20);
$sheet->getColumnDimension('G')->setWidth(20);
//далее делаем запрос к бд


$sheet->setCellValue("A1", 'DREL.BY');
$sheet->getStyle('A1')->getFill()->setFillType(
    PHPExcel_Style_Fill::FILL_SOLID);
$sheet->getStyle('A1')->getFill()->getStartColor()->setRGB('EEEEEE');
$sheet->getStyle('A1')->getFont()->setSize(18);
// Объединяем ячейки
$sheet->mergeCells('A1:E1');









//шапка таблицы 
$sheet->setCellValue("A5", 'ID');
$sheet->getStyle('A5')->getFill()->setFillType(
    PHPExcel_Style_Fill::FILL_SOLID);
$sheet->getStyle('A5')->getFill()->getStartColor()->setRGB('f2b078');
$sheet->setCellValue("B5", 'Название товара');
$sheet->getStyle('B5')->getFill()->setFillType(
    PHPExcel_Style_Fill::FILL_SOLID);
$sheet->getStyle('B5')->getFill()->getStartColor()->setRGB('f2b078');
$sheet->setCellValue("C5", 'Производитель');
$sheet->getStyle('C5')->getFill()->setFillType(
    PHPExcel_Style_Fill::FILL_SOLID);
$sheet->getStyle('C5')->getFill()->getStartColor()->setRGB('f2b078');
$sheet->setCellValue("D5", 'Цена');
$sheet->getStyle('D5')->getFill()->setFillType(
    PHPExcel_Style_Fill::FILL_SOLID);
$sheet->getStyle('D5')->getFill()->getStartColor()->setRGB('f2b078');

$sheet->setCellValue("E5", 'Ссылка');
$sheet->getStyle('E5')->getFill()->setFillType(
    PHPExcel_Style_Fill::FILL_SOLID);
$sheet->getStyle('E5')->getFill()->getStartColor()->setRGB('f2b078');

$sheet->setCellValue("F5", 'В наличии/под заказ(1/0)');
$sheet->getStyle('F5')->getFill()->setFillType(
    PHPExcel_Style_Fill::FILL_SOLID);
$sheet->getStyle('F5')->getFill()->getStartColor()->setRGB('f2b078');

$sheet->setCellValue("G5", 'Старая цена');
$sheet->getStyle('G5')->getFill()->setFillType(
    PHPExcel_Style_Fill::FILL_SOLID);
$sheet->getStyle('G5')->getFill()->getStartColor()->setRGB('f2b078');

$sheet->setAutoFilter('A5:G5');
 


//запись на  лист название товаров , категории...и так далее
$i=5; 
$arr=array();


foreach($datas as $val){
    if($val['aname']=="e4"){
$manufected=$database->select("kalibr",array("name"),array("id"=>$val['f2']));
$arr[]=new Items($val['name'],$val['f1'],$val['id'],$manufected[0]['name'],$val['rid'],0,$val['url'],$val['existence'],$val['f6']);  } elseif(($val['aname']=="e3")||($val['aname']=="e2")) {
 $arr[]=new Items($val['name'],$val['f1'],$val['id'],$manufected[0]['name'],$val['rid'],1,$val['url']);   
    } 
}
$abc="ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789*&%$?{";
//обработаем таким образом массивы что бы у категорий появились адреса...
add_adr($arr,16,$abc);
adress_items($arr);
//сортируем массив таким образом что бы товары размещались по возрастанию адресов 
foreach($arr as &$val)
{
    
    if(strlen($val->adress)==1)
    {
        $val->levl=1;
    }elseif(strlen($val->adress)==2)
    {
    $val->levl=2;
    }else
    {
    $val->levl=3;
    }
}
usort($arr, "cmp");
// ниже вывод уже в файл...
//установим уровни
foreach($arr as $val){
    $i++;
//$sheet->setCellValueByColumnAndRow( 0 , $j,$val->items[$i]['id'] );
        $sheet->setCellValueByColumnAndRow( 0 , $i,$val->id);
        $sheet->setCellValueByColumnAndRow( 1 , $i,$val->name);
        $sheet->setCellValueByColumnAndRow( 2 , $i,$val->manufected);
        $sheet->setCellValueByColumnAndRow( 3 ,$i,$val->price);
        $sheet->setCellValueByColumnAndRow( 5 ,$i,$val->existence);
        $sheet->setCellValueByColumnAndRow( 6 ,$i,$val->old_price);
    if(($val->chpu!==null)&&($val->chpu!=="")){
        $sheet->setCellValueByColumnAndRow( 4 , $i,"Перейти");
        $sheet->getCell('E'.($i))->getHyperlink()->setUrl( 'http://drel.by/'.$val->chpu);
        $sheet->getStyle('E'.($i))->getFont()->getColor()->setRGB('081bf8');
    }
    
        $sheet->getRowDimension($i)->setOutlineLevel($val->levl);   
        if($val->cat==1){
            $sheet->setCellValueByColumnAndRow( 0 , $i,"");
        }

}
//вывод списка товаров или категорий по выбору 

$sheet->setShowSummaryBelow(false);
$objWriter = new PHPExcel_Writer_Excel5($xls);
//$name='dir/price-tool'.date('d.m.y').'.xls';
$name='dir/price-drel'.date('d.m.y').'.xls';
//$name='test.xls';
 $objWriter->save($name);
echo "/sadmin/export/".$name;

function add_adr($arr,$n,$abc,$par_adr=""){
    $j=0;
    for($i=0;$i<count($arr);$i++)
    { if(($arr[$i]->parents==$n)&&($arr[$i]->cat==1)){
    
        $arr[$i]->adress=$par_adr.$abc[$j];
        $j++;
        add_adr($arr,$arr[$i]->id,$abc,$arr[$i]->adress);
    }
    }

};

function adress_items($arr)
{
 foreach($arr as &$val)
 {
    if($val->cat==0)
    {
        foreach($arr as $value)
        {
            if($val->parents==$value->id){
                $val->adress=$value->adress."_";
                }
        }
    }
 }
};
function cmp($a, $b)
{
    if ($a->adress == $b->adress) {
        return 0;
    }
    return ($a->adress < $b->adress) ? -1 : 1;
}