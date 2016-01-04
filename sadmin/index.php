<?
foreach($_FILES as $varname => $fileinfo ){
   $ok=$varname;
   $$ok = $fileinfo["tmp_name"];
   $ok=$varname."_name";
   $$ok = $fileinfo["name"];
   }

extract($_REQUEST,EXTR_SKIP);
if($_SESSION)extract($_SESSION,EXTR_OVERWRITE);
extract($_SERVER,EXTR_OVERWRITE);
extract($_ENV,EXTR_OVERWRITE);

include("_config.php");
include("_admin_config.php");
include("_mysql.php");
include("_checkdb.php");
include("_checking.php");
?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
<link rel="stylesheet" href="admin.css" type="text/css">
<title>Administration <? echo $admin_settings['site_url']; ?></title>
</head>
<body bgcolor=#FFFFFF background="images/adminbg.gif">
<center>
<a class=title><?=$admin_settings['site_name'];?></a>
<hr color=#FFFFFF size=1>

<?
if($caction=="displaymain")
	{
	echo "<script language=JavaScript>window.location='frames.php';</script>";
	}
	else
	{
	echo "
	<form name=fdata method=post action=index.php>
	<a class=green>Username&nbsp;:&nbsp;</a><input name=ilogin><br>
	<a class=green>Password&nbsp;:&nbsp;</a><input type=password name=ipass><p>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type=submit value=Submit>
	</form><p>";
	}
?>
</body>
</html>