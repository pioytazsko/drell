<script language=JavaScript>
function CheckSearchFor()
{
if(qsearch.q_search[0].checked==true)
	{
	qsearch.q_search_for.disabled=false;
	}
else
	{
	qsearch.q_search_for.disabled=true;
	}
}

</script>

<?
$s_q_search="
<input type=radio name=q_search value='all' onFocus=\"JavaScript:CheckSearchFor();\">  ".$lt[3]."
<input type=radio name=q_search value='query' onFocus=\"JavaScript:CheckSearchFor();\"> ".$lt[4].":
";
$s_q_search=ereg_replace($q_search."'",$q_search."' checked",$s_q_search);
$dis1=($q_search==all) ? "disabled" : "";
?>

<form action=index.php?parent=<? echo ((integer)$parent); ?> method='POST' name=qsearch>
<input type=hidden name=q_sort value="<?=$q_sort;?>">
<table width=50% border=0 cellpadding=5 cellspacing=0>
<tr  bgcolor=<?=$admin_settings['tableaddbg'];?>>
<td><a class=menu><?=$lt[2];?>:</a></td>
</tr>
<tr bgcolor=<?=$admin_settings['inputbg'];?>>
 <td>
<? echo $s_q_search; ?>
<input name=q_search_for value='<?=$q_search_for;?>' <?=$dis1?>>
 </td>
</tr>

<?
include("../_inc/_searchform_date.php");
?>

<tr  bgcolor=<?=$admin_settings['tableaddbg'];?>>
<td align=right><input type=submit value='<?=$lt[15];?>'></td>
</tr>
</table>
<p>

</form>
