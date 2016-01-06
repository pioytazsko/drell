<?php
// mysql_connect('localhost','kuvaldab_drel','pentuh1984');
// mysql_select_db('kuvaldab_drelby');
//mysql_connect('localhost','root','');
//mysql_select_db('tool');
mysql_connect('localhost','toolbyto_serj','kayman');
//// mysql_select_db('toolbyto_kalibr');
 mysql_select_db('toolbyto_old');

$json=$_POST['json'];
//echo $json;
$complect= json_decode($json);
foreach( $complect as $val){
if ($val->main===1){
    $id=$val->id;
    $query="SELECT * FROM sale WHERE id_item=".$val->id;
    $res=mysql_query($query);
//    echo mysql_num_rows($res);
    if(mysql_num_rows($res)==0){
    $query="INSERT INTO sale (id_item,sale_item)
VALUES ('".intval($val->id)."','".intval($val->sale)."')";
    $res=mysql_query($query);echo mysql_error();
    }else{
    
    $query="UPDATE sale SET sale_item='".$val->sale."'WHERE id_item='".$val->id."'";
         $res=mysql_query($query);echo mysql_error();
    }
   
//отправляем в sale
    
        }
}
 
$query="DELETE FROM complect
WHERE id_item=".$id;
    $res=mysql_query($query);
 foreach( $complect as $val){
     
 if ($val->main===0){
   
   
     
    $query="INSERT INTO complect (id_item,id_compl,sale)
VALUES ('".$id."','".intval($val->id)."','".intval($val->sale)."')";
    $res=mysql_query($query);echo mysql_error();
    
   
     
 
    } 
 }
echo"Загружено!";