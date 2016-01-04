<?
$id = $_GET[id];
if (!$_GET[id])
	$id = 15;
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251" />
<title>tool.by</title>	
<link href="styles/style.css" rel="stylesheet" type="text/css">
</head>
<body>
<table class="top" border=0>
<tr>
<td width=50% class="top1" align="left">Магазин стройоборудования и электроинструментов</td>
<td width=50% class="top2" align="right">Беларусь, Минск, т/ф: +375 17 1234-34-56</td>
</tr>
</table>
<table class="top2" border=0>
<tr valign="top">
<td width="50%" class="logo" align="left">
<div class="block1">
<img src="images/logo.gif" width="261" height="66" border="0">
<div>
<?
echo block("id=89", "text");
?>
</div>
</div></td>
<td class="topcenter"><div class="desc">
<?
echo block("id='".$id."'", "anons");
?>
</div></td>
<td width="50%" class="logo2" align="left"><div class="block2">
<?
echo block("id=90", "text");
?>
</div></td>
</tr>

</table>