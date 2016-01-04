<?
function copyallfiles($dirfrom,$dirto){
$filesfrom=getfiles($dirfrom);
if(!$filesfrom){
	return 0;
	}
for($i=0;$i<count($filesfrom);$i++){
	$file1=$dirfrom."/".$filesfrom[$i];
	$file2=$dirto."/".$filesfrom[$i];
	copy($file1,$file2);
//	echo "$file1 $file2<br>";
	}

echo "<p>";
}

$query = "SELECT * FROM ".$module_name;
$Q->query($DB, $query);
$count=$Q->numrows();

$r=getmaxid("id",$module_name);
$r--;
$j=0;
if(isset($movetorid)){
   $movetorid=(integer)$movetorid;
   $query="select * from ".$module_name." where id=".$movetorid;
   $Q->query($DB, $query);
   $parentitem=$Q->getrow();

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

		$query="select * from ".$module_name." where id=".$id;
		$Q->query($DB, $query);
		$newch=$Q->getrow();

		$newch[text]=ereg_replace("/attachments/".$id."/","/attachments/".($r+$j)."/",$newch[text]);
		
		$query="INSERT INTO ".$module_name." VALUES(".($r+$j).",$movetorid,'$newch[access]','$newch[aname]','$parentitem[lang]','$newch[date]','$newch[name]','$newch[anons]','$newch[text]','$newch[archive]','$newch[f1]','$newch[f2]','$newch[f3]','$newch[f4]','$newch[f5]','$newch[f6]','$newch[f7]','$newch[f8]','$newch[f9]','$newch[f10]','$newch[enabled]','$newch[existence]', '$newch[url]', '$newch[title]', '$newch[description]', '$newch[keywords]')";
//		echo $query."<br>";
		$Q->query($DB, $query);

		$dir=$module_filepath."/attachments/".($r+$j);
		if (!is_dir($dir))
			mkdir($dir,0777);
		copyallfiles($module_filepath."/attachments/".$id,$dir);		
		}

	}
   }

echo "<script language=JavaScript>top.mainleft.location.reload(true);</script>";
include("_view.php");
?>