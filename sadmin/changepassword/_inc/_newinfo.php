<?
$ok="yes";
echo "<p><center>";
$nusername=ereg_replace("[^a-z0-9]","",$nusername);
if((!$nusername) || (strlen($nusername)<4))
	{
        echo "<a class=error>".$lt[12]."</a><br>";
	$ok="no";
	}
if($noldpassword!=$adminpassword)
	{
        echo "<a class=error>".$lt[8]."</a><br>";
	$ok="no";
	}

if(strlen($npass)<5)
	{
        echo "<a class=error>".$lt[9]."</a><br>";
	$ok="no";
	}

if($ncpass!=$npass)
	{
        echo "<a class=error>".$lt[10].".</a><br>";
	$ok="no";
	}

if($ok=="yes")
	{
        echo "<a class=normal>".$lt[10]."</a><br>";

	$ipass=$npass;

	$query="update ".$module_ut." set name='$nusername', f1='$ipass' where name='$adminusername'";
	$Q->query($DB,$query);

	rename($module_adminconf.$adminusername.".txt",$module_adminconf.$nusername.".txt");

	echo "<script language=Javascript>top.location=\"../?action=logout\";</script>";
	}

?>
</center>