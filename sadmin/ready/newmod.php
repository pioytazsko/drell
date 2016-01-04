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
<p>
<?php 
define("DR", $_SERVER['DOCUMENT_ROOT']);
$dirForum = DR."/forum";
$dirConsult = DR."/consult";

?>

<table width="650px" cellpadding=3 cellspacing=2 border=1 bordercolor=<?=$admin_settings['tableaddbg'];?> bgcolor=<?=$admin_settings['inputbg'];?>>
<tr bgcolor="<?=$admin_settings['tableaddbg'];?>">
<td colspan="5" width="15%" style="color:white" align=center>Modules</td>
</tr>
<form action='install_forum.php' method='post'>
<?php
if(@opendir($dirForum))
{
  echo "<tr height='15px'>
<td width='45%' colspan='3' style='color:black' align=left><a class=Ahr target=_blank href='/forum'>Forum installed</a></td>
</td>
<td width='40%' style='color:black' align=left><a class=Ahr href='change_forum.php'>Change password/login</a></td>
</td>
<td width='15%' style='color:black;' align=center>
<input name='del' class='newBT' type='submit' value='delete' />

</td>
</tr>";
}
else{
 echo "<tr class='newtr'>
<td width='15%' style='color:black' align=center>Forum</td>
<td width='20%' style='color:black' align=center>
<input name='login' type='text' class='newTT' value='login' />
</td>
<td width='20%' style='color:black' align=center>
<input name='password' class='newTT' type='password' value='password' />
</td>
<td width='30%' style='color:black' align=center>
<input name='email' class='newTT1' type='text' value='e-mail' />
</td>
<td width='15%' style='color:black;' align=center>
<input name='chek' class='newBT' type='submit' value='install' />

</td>
</tr>";
} ?>
</form>
<form action='install_consult.php' method='post'>

<?php 
if(@opendir($dirConsult))
{
$query = "SELECT vclogin FROM chatoperator WHERE operatorid='1'";
$Q->query($DB,$query);
$res = $Q->getrow();
echo "<tr class='newtr'>
<td width='45%' colspan='3' style='color:black' align=left><a class=Ahr target=_blank href='/consult'>Online-consultant installed</a></td>
<td width='30%' style='color:black' align=left>Your login name '".$res[vclogin]."'</td>
<td width='15%' style='color:black;' align=center>
<input name='delete' class='newBT' type='submit' value='delete' />

</td>
</tr>";
}
else{
echo "<tr class='newtr'>
<td width='75%' colspan='4' style='color:black' align=left>Online-consultant</td>
<td width='15%' style='color:black;' align=center>
<input name='install' class='newBT' type='submit' value='install' />

</td>
</tr>";
}
?>

</form>
<tr bgcolor="<?=$admin_settings['tableaddbg'];?>">
<td colspan="5" width="15%" style="color:white" align=center>You can see here all modules</td>
</tr>

</table>
</body>
</html>