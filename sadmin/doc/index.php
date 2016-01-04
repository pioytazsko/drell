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
$module_title=$lt[45];
?>

<html>
<head>
<title>Administration: <? echo $module_title; ?></title>
<link rel="stylesheet" href="../admin.css" type="text/css">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
</head>

<body bgcolor=#FFFFFF background="../images/adminbg.gif" rightmargin=10 leftmargin=10 topmargin=10>
<table width=100% cellpadding=5 cellspacing=2 border=1 bordercolor=#CCCCCC bgcolor=<? echo $admin_settings['tablebg']; ?>>
<tr>
<td width=100% align=center><a class=menu><? echo $module_title; ?></a><?=$add_text;?></td>
</tr>
</table>
<p>
<table width=100% cellpadding=0 cellspacing=0 border=0>
<tr>
<td width=100% align=left>
<? 
$ehost=ereg_replace("www\.","",$HTTP_HOST);
$ehost=ereg_replace("/.*","",$ehost);

$f=file($adminlanguage);
$f=join("",$f);
$f=ereg_replace("siteisready.com",$ehost,$f);
echo $f;
?></td>
</tr>
</table>

</body>
</html>