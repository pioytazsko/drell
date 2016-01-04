<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
<title>Administration: <? echo $module_title; ?></title>
<link rel="stylesheet" href="../admin.css" type="text/css">
</head>

<body bgcolor=#FFFFFF background="../images/adminbg.gif" rightmargin=10 leftmargin=10 topmargin=10 onFocus="JavaScript:if(win)win.close();">
<table width=100% cellpadding=5 cellspacing=2 border=1 bordercolor=#CCCCCC bgcolor=<? echo $admin_settings['tablebg']; ?>>
<tr>
<td width=90%><a href=../changelanguage/index.php><img src=../images/flags/<?=$adminlanguage;?>.png border=0 alt="<?=$lt[1];?>" vspace=0 hspace=0></a>&nbsp;<a href=index.php?page=view&parent=<? echo ((integer)$parent); ?> class=menu><? echo $module_title; ?></a><?=$add_text;?></td>
<td width=10% align=center><a href=# onclick="JavaScript:sh();" class=menu100><></a></td>
<td align=center><a href=# onclick="JavaScript:window.location.reload(1);" class=menu100><?=$lt[47];?></a></td>
</tr>
</table>

<script language=JavaScript>
var win;

function sh(){
if(top.frameset1.cols=='40%,*')
	top.frameset1.cols='0,*';
else
	top.frameset1.cols='40%,*';
}

</script>
