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

if($newch[rid]!="")
	$parent=$newch[rid];
if(($page=="edit") && ($id!="")){
	$query="SELECT * from ".$module_name." where id=".$id;
	$Q->query($DB,$query);
	$row=$Q->getrow();
	$parent=$row[rid];
	}
if(($parent=="") || ($parent==0) || (!isset($parent)))
	$parent="";
if($parent!=""){
	$query="SELECT * from ".$module_name." where id=".$parent;
	$Q->query($DB,$query);
	$row=$Q->getrow();
	$module_title=$row[name];
	$aaname=$row[aname];
	}
else	{
	$module_title=$lt[0];
	$aaname=$module_title;
	}
$f=file("_toshow.php");
$toshow=$f[0];

$fields=getfieldsname($aaname,$module_adminconf.$adminusername.".txt");
$f=file($module_adminconf.$adminusername.".txt");
$fields0=split("\t",$f[0]);

if(!ereg($_SERVER['HTTP_HOST'],$_SERVER['HTTP_REFERER'])){
	echo "You have no rights to view this page. For more details please contact us: <a href=mailto:info@sisols.com>info@sisols.com</a>";
	exit;
	}

$add_text=(($fields[19]=="no") && (!$root)) ? "" : "<a class=menu>&nbsp;/&nbsp;</a><a href=?page=add&parent=".((integer)$parent)." class=menu>".$lt[32]."</a>";

if($fields[27]){
	$r=split(" ",trim($fields[27]));
	for($i=0;$i<count($r);$i++){
		$reachedits[$i][name]=$fields[$r[$i]];
		$reachedits[$i][aname]=$fields0[$r[$i]];	
		}
	}
else
	$reachedits="";

if(!isset($page))
	{
        $page="view";
	}
include("_inc/_".$page.".php");
?>

</body>
</html>