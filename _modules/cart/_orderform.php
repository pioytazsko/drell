<?
$query="select * from ".$module_name." where id='".$formid."'";
$Q->query($DB,$query);
$count=$Q->numrows();
if($count==0)exit;
$row=$Q->getrow();
$ordertext=ereg_replace("<","&lt;",$ordertext);                            
$ordertext=ereg_replace(">","&gt;",$ordertext);       
//echo $ordertext;                     
//$ordertext=ereg_replace("\&lt;a[^;]+\&gt;[^\&]+&lt;\/a&gt;","",$ordertext);                          
//echo $ordertext;  
$row[text]="<input type=hidden value='".$ordertext."'><p>".$row[text];
$p=prepare_text($row);
echo $p;
?>
