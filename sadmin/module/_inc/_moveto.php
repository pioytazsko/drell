<?
$query = "SELECT * FROM ".$module_name;
$Q->query($DB, $query);
$count=$Q->numrows();

$r=getmaxid("id",$module_name);
$r--;

$j=0;
if(isset($movetorid)){
   $movetorid=(integer)$movetorid;
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

		$query="UPDATE ".$module_name." SET rid=".$movetorid." WHERE id=".$id;
//		echo $query."<br>";
		$Q->query($DB, $query);
		}

	}
   }

echo "<script language=JavaScript>top.mainleft.location.reload(true);</script>";
include("_view.php");
?>