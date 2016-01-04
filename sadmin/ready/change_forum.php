<?php 
include_once("../_functions.php");
include_once("../_config.php");
include_once("../_mysql.php");
include_once("../_admin_config.php");
include_once("../_checking.php");
if($caction=="displayfirst")
	{
	include("../_failed.php");
	exit;
	}

?>


<html>
<head>
<title>Administartion: <? echo $module_title; ?></title>
<link rel="stylesheet" href="../admin.css" type="text/css">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251">

<style>
.newBT{
width:70px;
}
.newTT{
width:100px;
text-align:right;
}
.newTT1{
width:160px;
text-align:right;
}
.newtr{
height:20px;
}
A.Ahr{ color: black; text-decoration: none }
A.Ahr:visited {color: black; text-decoration: none }
</style>

</head>

<body bgcolor=#FFFFFF background="../images/adminbg.gif" rightmargin=10 leftmargin=10 topmargin=10>
<table width=100% cellpadding=5 cellspacing=2 border=1 bordercolor=#CCCCCC bgcolor=<? echo $admin_settings['tablebg']; ?>>
<tr>
<td width=100%><a href=../changelanguage/index.php><img src=../images/flags/<?=$adminlanguage;?>.png border=0 alt="<?=$lt[1];?>" vspace=0 hspace=0></a>&nbsp;<a href=newmod.php class=menu>modules</a></td>
</tr>
</table>
<br><br>
<table width="650px" cellpadding=3 cellspacing=2 border=1 bordercolor=<?=$admin_settings['tableaddbg'];?> bgcolor=<?=$admin_settings['inputbg'];?>>
<form action='change_this_forum.php' method='post'>
<tr class='newtr'>
<td width='15%' style='color:black' align=center>Forum</td>
<td width='20%' style='color:black' align=center>
<input name='login' type='text' class='newTT' value='login' />
</td>
<td width='20%' style='color:black' align=center>
<input name='password' class='newTT' type='password' value='password' />
<td width='15%' style='color:black;' align=center>
<input name='chek' class='newBT' type='submit' value='change' />

</td>
</tr>
</form>
</table>
</body>
</html>