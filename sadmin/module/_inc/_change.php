<? 
include("../../url/url.php");

$query = "SELECT * FROM ".$module_name;
$Q->query($DB, $query);
$count=$Q->numrows();

$r=getmaxid("id",$module_name);
$r--;

$j=0;

for($i=1;$i<=$r;$i++)
	{
	$tdate="fdate".$i;
	$ttitle="ftitle".$i;
	$tarchive="farchive".$i;
    $existence=$_POST["existence".$i];
    
	$tpop="pop".$i;
	$id=$i;


	if(trim($$tdate)!=""){
		$ttarchive=($fields[4]!="") ? ", archive='".$$tarchive."'" : "";
		$name=$$ttitle;
		$name=ereg_replace("\"","&quot;",$name);
        if ($existence != "1") {
            $existence = "0";
        }
        
	if($aaname=="e3")
		$query="UPDATE ".$module_name." SET date='".$$tdate."', name='".$name."'".$ttarchive.", f3='".$$tpop."', existence = '".$existence."' WHERE id=".$id;
	else
		$query="UPDATE ".$module_name." SET date='".$$tdate."', name='".$name."'".$ttarchive." WHERE id=".$id;
//		echo $query."<br>";
		$Q->query($DB, $query);
		}
	}

//get_htaccess();

echo "<script language=JavaScript>top.mainleft.location.reload(true);</script>";
include("_view.php");
?>

