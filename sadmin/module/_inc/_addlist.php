<?
include("../../url/url.php");

$query = "SELECT * FROM ".$module_name;
$Q->query($DB, $query);
$count=$Q->numrows();

$r=getmaxid("id",$module_name);
$r--;

$fnew=split("\n",$fnew);
if(trim($fnew[0])!="")
	for($i=count($fnew)-1;$i>=0;$i--){
		$name=$fnew[$i];
		$name=trim(ereg_replace("\"","&quot;",$name));
		$r++;
		$ddate=date("Y-m-d H:i:s",time()-$i);
		$query="INSERT INTO ".$module_name." VALUES($r,$parent,'','".$fields[17]."','$adminlanguage','$ddate','$name','','','','','','','','','','','','','','','','','', '', '')";
//		echo $query."<br>";
		if($name!="")
			$Q->query($DB,$query);
		}
//get_htaccess();
echo "<script language=JavaScript>top.mainleft.location.reload(true);</script>";
include("_view.php");
?>