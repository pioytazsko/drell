<?php 
include("_config.php");
include("_mysql.php");
$res=$Q->query($DB,"SET NAMES utf8");
$id=json_decode($_POST['id']);
$id=$id->id;
//$query="SELECT * FROM sale, kalibr,complect WHERE kalibr.id=".$id." AND complect.id_item=kalibr.id";
$query="SELECT  sale.sale_item, complect.id_compl,complect.id_item, kalibr.name,complect.sale FROM sale, kalibr,complect WHERE  complect.id_item='".$id."' AND kalibr.id=complect.id_compl AND sale.id_item=complect.id_item";
$res1=$Q->query($DB,$query);
$arr=array();
while($res=mysql_fetch_assoc($res1)){

$arr[]=$res;
}
$res=json_encode($arr);
echo $res;