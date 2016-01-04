<?
$query="SELECT * from ".$module_name." where lang='".$adminlanguage."'";
$Q->query($DB,$query);
$count=$Q->numrows();

for($i=0;$i<$count;$i++)
	$row[$i]=$Q->getrow();

$r=getmaxid("id",$module_name);

for($i=0;$i<$count;$i++){
	$rid=($row[$i][rid]=="0") ? "0" : $row[$i][rid]+$r;
	$iid=$row[$i][id]+$r;
	$query="INSERT INTO ".$module_name." VALUES($iid,".$rid.",'".$row[$i][access]."','".$row[$i][aname]."','".$lang."','".$row[$i][date]."','".$row[$i][name]."','".$row[$i][anons]."','".$row[$i][text]."','".$row[$i][archive]."','".$row[$i][f1]."','".$row[$i][f2]."','".$row[$i][f3]."','".$row[$i][f4]."','".$row[$i][f5]."','".$row[$i][f6]."','".$row[$i][f7]."','".$row[$i][f8]."','".$row[$i][f9]."','".$row[$i][f10]."')";
//	echo $query."<p>";
	$Q->query($DB,$query);
	}

if($count>0)
	echo "<p><center><a class=normallink>Cloned.</a></center>";

?>