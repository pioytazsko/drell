<table class="alltable" width=100% border=0>
<tr>
<td><img src="images/l1.gif" width="43" height="36" border="0"></td><td colspan="5" class="table1" valign=top style="padding-bottom:0px;"><font style="background-color: #ffffff;">&nbsp;Специальные предложения&nbsp;</font></td><td><img src="images/l3.gif" width="40" height="36" border="0"></td>
</tr>
<tr>
<td width=43 class="table2"><img src="images/blank.gif" width="43" height="16" border="0"></td>
<?
$SQL = "SELECT COUNT(id) FROM ".$module_name." WHERE aname = 'e2' AND archive = 'on'";
$result = $Q->query($DB, $SQL);
$count = mysql_fetch_assoc($result);
$count = $count['COUNT(id)'];
if ($count == "")
	$count = 0;

if ($count > 5)
	$count = 5;

$selected = 0;
$arr_selected = Array();
while ($selected < $count)
{
	$limit = rand(0, $count);
	if (!in_array($limit, $arr_selected))
	{
		echo block("aname='e2' AND archive = 'on' LIMIT ".$limit.", 1", "special");
		array_push($arr_selected, $limit);
		$selected++;
	}
}
?>
<td class="table5"><img src="images/blank.gif" width="22" height="1" border="0"></td>
</tr>
<tr>
<td><img src="images/l6.gif" width="43" height="22" border="0"></td><td colspan="5" class="table4"><img src="images/blank.gif" width="1" height="22" border="0"></td><td><img src="images/l8.gif" width="40" height="22" border="0"></td>
</tr>
</table>