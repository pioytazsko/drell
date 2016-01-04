<table class="main" border=0>
<tr><td class="maintitle" colspan="2">Интернет-магазин элекстоинструментов</td></tr>
<?
	$SQL = "SELECT * FROM ".$module_name." WHERE rid = '".$_GET[id]."' AND f1 <> ''";
	$result = $Q->query($DB, $SQL);
	if (mysql_num_rows($result) > 0 || $_GET[brand] != '')
		include("_t/_products_list.php");
	else
		echo block("rid = '".$_GET[id]."' ORDER BY date DESC", "main_rubric", "", "main_tr");
?>
</table>

<table class="info" border=0>
<tr>
<td><img src="images/info_1.jpg" height="30" width="17" border="0"></td>
<td>
<table class="infotitle"><tr><td><img src="images/info_title.jpg" height="30" width="98" border="0"></td>
	<td class="infoh1"><img src="images/blank.gif" height="30" width="1" border="0"></td>
</tr></table>
</td>
<td><img src="images/info_4.jpg" height="30" width="17" border="0"></td>
</tr>
<tr><td class="infov1"><img src="images/blank.gif" height="1" width="17" border="0"></td>
<td class="text">
<?
	echo block("id=15", "text");
?>
</td>
<td class="infov2"><img src="images/blank.gif" height="1" width="17" border="0"></td></tr>
<tr><td><img src="images/info_3.jpg" height="13" width="17" border="0"></td><td class="infoh2"><img src="images/blank.gif" height="13" width="1" border="0"></td><td><img src="images/info_6.jpg" height="13" width="17" border="0"></td></tr>
</table>