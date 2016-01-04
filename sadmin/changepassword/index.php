<? 
include("../_functions.php");
include("../_config.php");
include("../_mysql.php");
include("../_admin_config.php");
include("../_checking.php");
if($caction=="displayfirst")
	{
	echo "<script language=JavaScript>top.location='../index.php';</script>";
	exit;
	}

if(!isset($page))
	{
        $page="view";
	}
$lt=getlangtemplate($adminlanguage,"../_inc/templates/changepassword");
$module_title=$lt[0];
?>

<html>
<head>
<title>Administartion: <? echo $module_title; ?></title>
<link rel="stylesheet" href="../admin.css" type="text/css">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
</head>

<body bgcolor=#FFFFFF background="../images/adminbg.gif" rightmargin=10 leftmargin=10 topmargin=10>
<table width=100% cellpadding=5 cellspacing=2 border=1 bordercolor=#CCCCCC bgcolor=<? echo $admin_settings['tablebg']; ?>>
<tr>
<td width=100%><a href=../changelanguage/index.php><img src=../images/flags/<?=$adminlanguage;?>.png border=0 alt="<?=$lt[1];?>" vspace=0 hspace=0></a>&nbsp;<a href="" class=menu><? echo $module_title; ?></a></td>
<td align=right><a href=# onclick=JavaScript:sh(); class=menu><?=$admin_settings['site_url'];?></a></td>
</tr>
</table>

<script language=JavaScript>
function sh(){
if(top.frameset1.cols=='50%,*')
	top.frameset1.cols='0,*';
else
	top.frameset1.cols='50%,*';
}
</script>
<?
include("_inc/_".$page.".php");
if($root)
include("_inc/_viewpass.php");
	
?>

</body>
</html>
