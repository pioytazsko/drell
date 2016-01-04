<table class="topmemu" border=0 width=100%>
<tr>
<td width="49"><img src="images/topmenu11.gif" width="49" height="36" border="0"></td>
<td width="186"><input style="font-size:11px;width:186px;height:20px;border-top:1px solid #7e7e7e;border-left:0px solid #7e7e7e;border-right:0px solid #7e7e7e;border-bottom:1px solid #7e7e7e;margin-top:3px;padding-top:2px;" name="searchword" value="Пример: сварочный аппарат"  onClick="ClearValue(this)"></td>
<td width="12"><img src="images/topmenu21.gif" width="12" height="36" border="0"></td>
<td width="15"><a href="/"><img src="images/button.gif" width="15" height="36" border="0"></a></td>
<td><img src="images/blank.gif" width="17" height="36" border="0"></td>

<?
$SQL = "SELECT * FROM ".$module_name." WHERE rid = '1' ORDER BY date DESC";
$result = $Q->query($DB, $SQL);
for ($pages = Array(); $row = mysql_fetch_assoc($result); $pages[] = $row);

for ($i = 0; $i < count($pages); $i++)
{
	if ($pages[$i][id] == $_GET[id])
		echo block("id=".$pages[$i][id], "top_menu_item_selected");
	else
		echo block("id=".$pages[$i][id], "top_menu_item");
}

?>

<td class="cart1" width="99"><a href=""><img src="images/bag.gif" width="99" height="36" border="0"></a></td><td class="cart2">
<?
$cart_info = get_cart_info();
?>
<table class="cart" border=0>
<tr><td class="price" nowrap><?=$cart_info[1];?> руб.</td></tr>
<tr><td class="count" nowrap><?=$cart_info[0];?> шт.</td></tr>
</table>
</td>
<td width="29"><img src="images/topmenu3.gif" width="29" height="36" border="0"></td>
</tr>
</table>