<? 
function sadmindeleteitem($id){
global $module_filepath,$Q,$DB,$module_name;

$query = "SELECT * FROM ".$module_name." where rid=".$id;
$Q->query($DB, $query);
$count=$Q->numrows();
$recs="";
for($i=0;$i<$count;$i++){
	$row=$Q->getrow();
        $recs[$i]=$row[id];
	}

for($i=0;$i<$count;$i++){
	sadmindeleteitem($recs[$i]);
	}

// ATTACHMENTS
$ppath=$module_filepath."/attachments/".$id."/";
$mas=getfiles($ppath);
if($mas[0]!="")
	for($j=0;$j<count($mas);$j++)
		unlink($ppath.$mas[$j]);

$query="DELETE from ".$module_name." WHERE id=".$id;
//echo $query."<br>";
$Q->query($DB, $query);

}

$query = "SELECT * FROM ".$module_name;
$Q->query($DB, $query);
$count=$Q->numrows();

$r=getmaxid("id",$module_name);
$r--;

$j=0;
for($i=1;$i<=$r;$i++)
	{
	$tname="id".$i;
        if($$tname=="on")
		{
		$j++;
		if((($count-$j)==$start) && ($start!=0))
			{
                        $start-=$toshow;
			}
		$id=$i;


		sadmindeleteitem($id);
		}

	}
?>

