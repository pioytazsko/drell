<?
function loadmenu($rid,$sshow,$sadd,$slist,$sedit,$rule24){
global $menurows,$level,$adminlanguage,$module_name,$lt,$structure,$root,$adminusername,$module_adminconf;

$rule24=trim($rule24);
$rule24=ereg_replace("\\\\\'","'",$rule24);
if($rule24!=""){
	$rule24="and ".$rule24;
	}

//$query="select * from ".$module_name." where lang='".$adminlanguage."' and rid=".$rid." ".$rule24." order by date desc";
//$Q->query($DB,$query);
$count=count($menurows);
$rows="";
$cc2=0;
for($i=0;$i<$count;$i++){
	if($menurows[$i][rid]==$rid){
		$rows[]=$menurows[$i];
		$cc2++;
		}
	}
$count=$cc2;
if(strlen(trim($sshow))==0){
	array_pop($structure);
	return 0;
	}
$color="#746541";
	
$eadd[0]="<font color=".$color.">[ ".$lt[1]." ]</font>";
$eadd[1]="module/index.php?page=add&parent=".$rid;
$eadd[2]=$level;                                  

$elist[0]="<font color=".$color.">[ ".$lt[2]." ]</font>";
$elist[1]="module/index.php?page=view&parent=".$rid;
$elist[2]=$level;                                   

$eedit[0]="<font color=".$color.">[ ".$lt[3]." ]</font>";
$eedit[1]="module/index.php?page=edit&id=".$rid;
$eedit[2]=$level;                                  

if($root!=""){
	$structure[]=$eadd;
	$structure[]=$elist;
	$structure[]=$eedit;
	}
else	{
	if($sadd!="no")$structure[]=$eadd;
	if($slist!="no")$structure[]=$elist;
	if($sedit!="no")$structure[]=$eedit;
	}

if($level==0){
	$ss2[0]="---";
	$ss2[1]="#";
	$ss2[2]=$level;                                  
	$structure[]=$ss2;
	}

for($i=0;$i<$count;$i++){
	$item[0]=ereg_replace("'","&#39;",$rows[$i][name]);
//	$item[0]=ereg_replace("\"","&quot;",$item[0]);
	$item[1]="#";
	$item[2]=$level;                                  
	$structure[]=$item;
	$fields=getfieldsname($rows[$i][aname],$module_adminconf.$adminusername.".txt");
	$sshow=(trim($fields[18])!="") ? "yes" : "";
	$level++;
	loadmenu($rows[$i][id],$sshow,$fields[19],$fields[20],$fields[21],$fields[24]);
	$level--;
	}
return 0;
}

$rid=0;
$level=0;

if(!file_exists($module_adminconf.$adminusername.".txt"))
	exit;
$f=file($module_adminconf.$adminusername.".txt");
$j=0;
for($i=1;$i<count($f);$i++){
	$s=split("\t",$f[$i]);
	if(!ereg("g2",$s[22])){
	        $anames[$j]="(aname='".$s[22]."')";
		$j++;
		}
	}
$anames=join(" || ",$anames);
//$anames="(aname='a1') || (aname='a2')";
//$anames="(aname='e1') || (aname='e2') || (aname='e3')";
$query="select id,date,aname,rid,name from ".$module_name." where lang='".$adminlanguage."' and (".$anames.") order by date desc";
$Q->query($DB,$query);
$count=$Q->numrows();
//echo $count;
//exit;
for($i=0;$i<$count;$i++){
	$row=$Q->getrow();
	$menurows[$i]=$row;
//	echo join("|",$menurows[$i])."<br>";
	}

loadmenu(0,"yes","no","no","no","");
?>