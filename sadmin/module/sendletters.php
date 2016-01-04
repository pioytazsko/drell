<?
include("../_functions.php");
include("../_config.php");
include("../_mysql.php");
include("../_admin_config.php");

$rpath="../";
include("../_checking.php");

if($caction=="displayfirst")
	{
	include("../_failed.php");
	exit;
	}

$lt=getlangtemplate($adminlanguage,"../_inc/templates/module");

if(!isset($id))exit;
$query="SELECT * from ".$module_name." where id=".$id;
$Q->query($DB,$query);
$count=$Q->numrows();
if($count==0)exit;
$row=$Q->getrow();

$parent=$row[rid];

if(($parent=="") || ($parent==0) || (!isset($parent)))
	$parent="";
if($parent!=""){
	$query="SELECT * from ".$module_name." where id=".$parent;
	$Q->query($DB,$query);
	$row1=$Q->getrow();
	$aaname=$row1[aname];
	}
else	{
	exit;
	}

$fields=getfieldsname($aaname,$module_adminconf.$adminusername.".txt");
if($fields[25]!="")
	include("_inc/_lettersform.php");
else
	exit;
?>

</body>
</html>