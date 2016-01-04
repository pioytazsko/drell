<?
echo "<input type=hidden name=reachsel value=\"text\">";
echo "<input type=hidden name=realtext value=\"".ereg_replace("\"","&quot;",$newch[text])."\">";
$r4=($fields[23]) ? "onClick=\"JavaScript:chbg(this);\"" : "";
echo "<tr bgcolor=#746541>
<td id=tittext ".$r4." colspan=2 align=center width=100%><a class=tabletitle>".$fields[3]."</a></td></tr>";
if($reachedits[0]){
	for($i=0;$i<count($reachedits);$i++){
		echo "<tr bgcolor=".$admin_settings['tableaddbg'].">
		<td id=tit".$reachedits[$i][aname]." onClick=\"JavaScript:chbg(this);\" colspan=2 align=center width=100%><a class=tabletitle>".$reachedits[$i][name]."</a></td></tr>";
		echo "<input type=hidden name=real".$reachedits[$i][aname]." value=\"".ereg_replace("\"","&quot;",$newch[$reachedits[$i][aname]])."\">";
		}
	}
?>
