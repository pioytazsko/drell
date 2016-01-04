<?
include("action/view/_prevnext.php");

$a=($start+1)."-".(($rowsnumber<($start+$toshow))?$rowsnumber : ($start+$toshow));
$a.="(".$rowsnumber.")";
//$a="<span class=normal><font size=-2>".$a."</font></span>";
?>
<form action=index.php?parent=<? echo (integer)$parent; ?>&start=<? echo $start;?> method='POST' name=fform>
<table width=100% cellpadding=3 cellspacing=2 border=1 bordercolor=<?=$admin_settings['tableaddbg'];?> bgcolor=<?=$admin_settings['inputbg'];?>>

<? 
$title=($fields[1]!="") ? $fields[1] : $lt[19];
$flag=($fields[4]!="") ? $fields[4] : $lt[40];
echo "<tr bgcolor=".$admin_settings['tableaddbg']."><td align=right><a width=1% onClick=\"JavaScript:ChAll();\" class=menu>".$a."</a></td>";
echo "<td width=24% align=center><a href=\"JavaScript:ChangeSort(0);\" class=menu>".$lt[18]."<br>".$sorti[0]."</a></td>";
echo "<td width=100% align=center><a href=\"JavaScript:ChangeSort(1);\" class=menu>".$title."<br>".$sorti[1]."</a></td>";
if($fields[4]!="")
	echo "<td width=8% align=center><a  href=\"JavaScript:ChangeSort(2);\" class=menu>".$flag."<br>".$sorti[2]."</a></td>";
if ($aaname == "e3")
	echo "<td width=8% align=center valign=\"middle\"><a class=menu>Поп.</a></td>";
if ($aaname == "e3") {
    echo "<td width=8% align=center valign=\"middle\"><a class=menu>В наличии</a></td>";
}
echo "<td width=1% align=center><a class=menu>&nbsp;</a></td>";
if($fields[5]!="")
	echo "<td align=center><a class=menu>&nbsp;</a></td>";
if(($fields[16]!="") || $root)
	echo "<td width=8% align=center><a  class=menu>".$lt[44]."</a></td>";
if($fields[25]!="")
	echo "<td width=1% align=center><a  class=menu>".$lt[57]."</a></td>";
if($fields[26]!="")
	echo "<td width=1% align=center><a  class=menu>&nbsp;</a></td>";
if ($aaname == 'e3')
	echo "<td width=1% align=center><a  class=menu>&nbsp;</a></td>";
echo "</tr>";
//print_r($tabledata);

for($i=0;$i<count($tabledata);$i++)
	{
	$l="?page=edit&id=".$tabledata[$i][0];
	$archive=(trim($tabledata[$i][6])=="") ? "<input type=checkbox name=farchive".$tabledata[$i][0].">" : "<input type=checkbox name=farchive".$tabledata[$i][0]." checked>";
	$title=trim($tabledata[$i][3]);
	$ch=(($tabledata[$i][7]) && ($fields[19]!="no")) ? "<input type=checkbox name=id".$tabledata[$i][0].">" : "&nbsp;";
	$ch="<input type=checkbox name=id".$tabledata[$i][0].">";
	$adda=mystrtolower($lt[32]);
	$addsublevel="<a href=?page=add&parent=".$tabledata[$i][0]." class=normallink>[ ".$adda." ]</a>";
        echo "<tr bgcolor=".$admin_settings['inputbg']."><td align=center>";
	echo $ch."</td>";
	echo "<td align=center><input name=fdate".$tabledata[$i][0]." value=\"".$tabledata[$i][2]."\" class=inputtitle onFocus=\"Ch(this);\" onBlur=\"ChOut(this);\"></td>";
	echo "<td width=100%><input name=ftitle".$tabledata[$i][0]." onFocus=\"Ch(this);\" onBlur=\"ChOut(this);\" class=inputtitle value=\"".$title."\"></td>";
	if($fields[4]!="")
		echo "<td align=center>".$archive."</td>";
	if ($aaname == "e3")
		echo "<td align=center><input type=checkbox name='pop".$tabledata[$i][0]."' ".($tabledata[$i][9]=="yes"?"checked":"")." value='yes'></td>";
    if ($aaname == "e3")
		echo "<td align=center><input type=checkbox name='existence".$tabledata[$i][0]."' ".($tabledata[$i][10]!="0"?"checked":"")." value='1'></td>";
	echo "<td width=1% align=center><a href=".$l." class=normallink>".$lt[49]."</a></td>";
	if($fields[5]!="")
		echo "<td align=center><a onClick=\"JavaScript:nwindow('attachments.php?id=".$tabledata[$i][0]."');\" target=attachments class=normallink><img src=../images/att.gif border=0 width=14 height=17 alt=\"".$lt[50]."\"></a></td>";
	if(($fields[16]!="") || $root)
		echo "<td align=center>".$addsublevel."</td>";
	if($fields[25]!="")
		echo "<td align=center><a href=# onClick=\"JavaScript:nwindow('sendletters.php?id=".$tabledata[$i][0]."&where=".$fields[25]."');\" class=normallink>>></a></td>";
	if($fields[26]!="")
	{
		$a=split("/",$fields[26]);
		echo "<td align=center><a href=# onClick=\"JavaScript:nwindow('../../sadminaddons/".$a[1]."?id=".$tabledata[$i][0]."');\" title=\"".$a[0]."\" class=normallink>>></a></td>";
	}
	if ($aaname == "e3")
		echo "<td align=center><a href=# onClick=\"JavaScript:nwindow('../../sadminaddons/video.php?id=".$tabledata[$i][0]."');\" title=\"Видео\" class=normallink>>></a></td>";
	echo "</tr>";
	}
?>
</table>
<table width=100% cellpadding=0 cellspacing=0 border=0>
<tr>
<td width=50% align=left valign=top>
<?
echo "<input type='button' onClick=\"JavaScript:if(confirm('".$lt[29]."?')){fform.page.value='change'; fform.submit();}\" name='n_submit' value='".$lt[29]."'>";
?>
</td>
<td width=50% align=right>
<?
if(($fields[19]!="no") || ($root))
	echo "<input type='button' onClick=\"JavaScript:if(confirm('".$lt[23]."'))fform.submit();\" name='n_submit' value='".$lt[22]."'>";
else
	echo "&nbsp;";
?>
</td>
</tr>
<?
if(true)
	echo "<tr><td colspan=2 width=100% align=right valign=top>
&nbsp;<br>Parent ID: <input name=movetorid  onFocus=\"Ch(this);\" onBlur=\"ChOut(this);\" class=inputtitle style=\"width:50px;\" value=\"\">&nbsp;<input type='button' onClick=\"JavaScript:if(confirm('".$lt[23]."')){fform.page.value='moveto'; fform.submit();}\" name='n_submit3' value='  ".$lt[55]."  '>&nbsp;<input type='button' onClick=\"JavaScript:if(confirm('".$lt[23]."')){fform.page.value='copyto'; fform.submit();}\" name='n_submit3' value='  ".$lt[56]."  '>
	</td>
	</tr>";
?>
</td>
</tr>
</table>
<p>
<?
include("action/view/_prevnext.php");
echo "<p>";
if(($fields[19]!="no") || (true))
	if($parent)
	echo "<table width=100% cellpadding=3 cellspacing=2 border=1 bordercolor=".$admin_settings['tableaddbg']." bgcolor=".$admin_settings['inputbg'].">
	<tr bgcolor=".$admin_settings['tableaddbg']."><td align=left><a class=menu>".$lt[32].":</a></td></tr>
	<tr><td align=left><textarea name=fnew rows=10 onFocus=\"Ch(this);\" onBlur=\"ChOut(this);\" style=\"border:1px;width:100%;background-color:".$admin_settings['inputbg']."\"></textarea></td></tr>
	</table>
	<input type='button' onClick=\"JavaScript:if(confirm('".$lt[32]."?')){fform.page.value='addlist'; fform.submit();}\" name='n_submit2' value='    ".$lt[32]."    '>";
?>
<input type=hidden name=page value="delete">
</form><p>
<?
if(($root) && (!$parent)){
	echo "<p>";
	include("_inc/_formadd.php");
	}
?>
<script language=JavaScript>
function Ch(obj){obj.style.background="#FFFFFF";}
function ChOut(obj){obj.style.background="#D3D6C0";}
function nwindow(url){
win=window.open(url, 'ok', 'dependent=yes,width=400px,height=400px,scrollbars=yes');
}

function ChAll(){
<?
$browser=$GLOBALS[HTTP_USER_AGENT];
$browser=(ereg("MSIE 5\.0",$browser)) ? "true" : "false";
?>
var wp_is_ie50 = <?=$browser;?>;
var code1,re;
re=/id/gi;
if (!wp_is_ie50) {
	var n = document.all.length
	for (i=0; i<n; i++) {
		code1=document.all[i].name;
		if(code1!=null)
		if(code1.match(re)){
			if(document.all[i].checked)
				document.all[i].checked=false;
			else
				document.all[i].checked=true;
			}
		}
	}
}
</script>
