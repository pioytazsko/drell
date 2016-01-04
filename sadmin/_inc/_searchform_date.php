<script language=JavaScript>

function SetInterval()
{
var now=new Date;
var day,month,year;

year=now.getFullYear();
day=now.getDate();
month=now.getMonth()+1;

if(qsearch.q_search_within.value!=0){
	qsearch.q_search_to_month.value=month;
	qsearch.q_search_to_day.value  =day;
	qsearch.q_search_to_year.value =year;
	}

switch(qsearch.q_search_within.value)
	{
	case '1':	now.setTime(now.getTime()-1000*3600*24);
			break;
	case '2':	now.setTime(now.getTime()-1000*3600*24*30);
			break;
	case '3':	now.setTime(now.getTime()-1000*3600*24*365);
			break;
	}

year=now.getFullYear();
day=now.getDate();
month=now.getMonth()+1;

if(qsearch.q_search_within.value!=0){
	qsearch.q_search_from_month.value=month;
	qsearch.q_search_from_day.value  =day;
	qsearch.q_search_from_year.value =year;
	}
}
</script>


<tr  bgcolor=<?=$admin_settings['inputbg'];?>>
 <td>
<?
$q="<input type=radio name=q_search_period value='within' onClick=\"JavaScript:SetInterval();\">";
$q=ereg_replace($q_search_period."'",$q_search_period."' checked",$q);
echo $q;
?>

<?=$lt[5];?>:
<?
$s="
  <select name=q_search_within  onFocus=\"JavaScript:qsearch.q_search_period[0].checked=true;SetInterval();\" onChange=\"JavaScript:SetInterval();\">
  <option value=\"0\">- ".$lt[6]." -
  <option value=\"1\">".$lt[7]."
  <option value=\"2\">".$lt[8]."
  <option value=\"3\">".$lt[9]."
  </select>";
$s=ereg_replace("value=\"".$q_search_within."\"","value=\"".$q_search_within."\" selected",$s);
echo $s;
?>
<p>

<?
$q="<input type=radio name=q_search_period value='fromto'>";
$q=ereg_replace($q_search_period."'",$q_search_period."' checked",$q);
?>
<table width=100% border=0 cellpadding=0 cellspacing=0>
<tr>
<td valign=top><?=$q;?>&nbsp;<?=$lt[10];?>:&nbsp;</td>
<td><input name=q_search_from_day   value='<?=$q_search_from_day?>'  class=input15 size=2 maxlength=2 onFocus="JavaScript:qsearch.q_search_period[1].checked=true;">&nbsp;/&nbsp;<br>&nbsp;<?=$lt[12];?></td>
<td>
<input name=q_search_from_month value='<?=$q_search_from_month?>' class=input15 size=2 maxlength=2 onFocus="JavaScript:qsearch.q_search_period[1].checked=true;">&nbsp;/&nbsp;<br><?=$lt[13];?>
</td>
<td>
<input name=q_search_from_year  value='<?=$q_search_from_year?>' class=input15 size=4 maxlength=4 onFocus="JavaScript:qsearch.q_search_period[1].checked=true;"><br>&nbsp;&nbsp;<?=$lt[14];?>
</td>
<td>&nbsp;&nbsp;&nbsp;&nbsp;<?=$lt[11];?>:&nbsp;
</td>
<td>
<input name=q_search_to_day   value='<?=$q_search_to_day?>' class=input15 size=2 maxlength=2 onFocus="JavaScript:qsearch.q_search_period[1].checked=true;">&nbsp;/&nbsp;<br>&nbsp;<?=$lt[12];?>
</td>
<td>
<input name=q_search_to_month value='<?=$q_search_to_month?>' class=input15 size=2 maxlength=2 onFocus="JavaScript:qsearch.q_search_period[1].checked=true;">&nbsp;/&nbsp;<br><?=$lt[13];?>
</td>
<td>
<input name=q_search_to_year  value='<?=$q_search_to_year?>' class=input15 size=4 maxlength=4 onFocus="JavaScript:qsearch.q_search_period[1].checked=true;"><br>&nbsp;&nbsp;<?=$lt[14];?>
</td>
<td width=100%>
&nbsp;
</td>
</tr>
</table>
 </td>
</tr>
