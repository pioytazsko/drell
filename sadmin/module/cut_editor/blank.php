<?
include("../../_functions.php");
include("../../_config.php");
include("../../_mysql.php");
include("../../_admin_config.php");

include("../../_checking.php");

if($caction=="displayfirst")
	{
	include("../../_failed.php");
	exit;
	}
if(!isset($lang))
	$lang="ru";
$dl=getlangtemplate($lang,"../../_inc/templates/reacheditdialogs");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title><?=$dl[10];?></title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
</head>
<head>
<style type="text/css">
<!--
 body   {font-family:Verdana; font-size:12px; background-color: threedface;}
-->
</style>
</head>
<body>
<div align="center"> <br>
	<br>
	<?=$dl[11];?></div>
</body>
</html>
