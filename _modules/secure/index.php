<?
function safe_string($s){
$s=ereg_replace("<","&lt;",$s);
$s=ereg_replace(">","&gt;",$s);
$s=ereg_replace("\\\\'","'",$s);
$s=ereg_replace("\\\\\"","\"",$s);
$s=ereg_replace("'","&#39;",$s);
$s=ereg_replace("\"","&quot;",$s);
//echo $s;
return $s;
}

$query="CREATE TABLE IF NOT EXISTS ".$module_name."_url (url text DEFAULT '')";
$success=$Q->query($DB,$query);

$url_from=ereg_replace("http://","",$_SERVER['HTTP_REFERER']);
$url_from=ereg_replace("/.*","",$url_from);

//echo $url_from;
//exit;

foreach($_POST as $var => $value ){
	$$var=safe_string($value);
   	}

$current_url=$HTTP_HOST.$REQUEST_URI;

$query="select * from ".$module_name."_url  where url='".$current_url."'";
$success=$Q->query($DB,$query);
$count=$Q->numrows();

if(!$count){
	// OK
	if(($url_from==$HTTP_HOST) || ($REQUEST_URI=="/")){
		$query="insert into ".$module_name."_url  values('".$current_url."')";
		$success=$Q->query($DB,$query);
		}
	else	{
	// access is not allowed
		header("Location: /error.php");
		}
	}
?>