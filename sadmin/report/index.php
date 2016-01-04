<?
include("../_functions.php");
include("../_config.php");
include("../_mysql.php");
include("../_admin_config.php");
include("../_checking.php");

if(!$id)exit;
$report=Array();
$query="select * from ".$module_name." where rid='".$id."'";
$Q->query($DB,$query);
$count=$Q->numrows();
for($i=0;$i<$count;$i++){
	$row=$Q->getrow();
	$s=$row[name]."\t".$row[anons]."\t".$row[archive]."\t".$row[f1]."\t".$row[f2]."\t".$row[f3]."\t".$row[f4]."\t".$row[f5]."\t".$row[f6]."\t".$row[f7]."\t".$row[f8]."\t".$row[f9]."\t".$row[f10];
//	if(!ereg("<a",$s)){
		$s=ereg_replace("\n","{n}",$s);
		$s=ereg_replace("\r","",$s);
		$report[]=$s;
//		}
	}

$report=join("\n",$report);

$ctype="xls";
$header="Content-Disposition: attachment; filename=".time().".xls;";

header("Pragma: public");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: public"); 
header("Content-Description: File Transfer");

header("Content-Type: $ctype");
header($header );
header("Content-Transfer-Encoding: binary");
//header("Content-Length: ".$len);
//@readfile($f);

echo $report;
?>