<?
if($HTTP_COOKIE_VARS[OprosN])
	$oprosn=$HTTP_COOKIE_VARS[OprosN];
//echo $oprosn;
if((!$oprosn) && ($oprosid)){
	setcookie("OprosN","oprosn",0,'/');
	$query="select * from ".$module_name." where id=".$oprosid."";
	$Q->query($DB,$query);
	$count=$Q->numrows();
	if(!$count){
	        echo "Error. ID=".$oprosid." not found.";
		exit;
		}
	$row=$Q->getrow();
	$anons=split("\n",$row[anons]);
	$stat=split("\n",$row[f1]);
	for($i=0;$i<count($anons);$i++){
	        if(trim($anons[$i])==trim($vopros)){
	                $stat[$i]=(integer)($stat[$i])+1;
			}
		}
	$newstat=join("\n",$stat);
//	echo $newstat;
	$query="update ".$module_name." set f1='".$newstat."' where id=".$oprosid;
	$Q->query($DB,$query);
	}
?>