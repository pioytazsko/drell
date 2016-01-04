&nbsp;<p>
<center>
<form name=flang method=post action=index.php>
<table width=350 bgcolor=<?=$admin_settings['tableaddbg'];?> cellpadding=2 cellspacing=0 border=2 bordercolor=<?=$admin_settings['tableaddbg'];?>>
<?
$langsnames=array('English','Русский','Deutsch','Spanish');
$langs=array('gb','ru','de','es');

for($i=0;$i<count($langs);$i++){
	if(!$root){
		$query="select count(id) from ".$module_name." where lang='".$langs[$i]."'";
		$Q->query($DB,$query);
		$row=$Q->getrow();
		$count=$row[0];
		if(!$count)
			continue;
		}

	echo "<tr>
	 <td align=center><a href=\"JavaScript:void(0);\" onClick=\"JavaScript:flang.rlang[".$i."].checked=true;\"><img src=../images/flags/".$langs[$i].".png border=0 vspace=0 hspace=0></a></td>
	 <td bgcolor=".$admin_settings['inputbg']." width=100% onClick=\"JavaScript:flang.rlang[".$i."].checked=true;\"><input type=radio name=rlang value=".$langs[$i];
	if($adminlanguage==$langs[$i])
		echo " checked";
	echo ">&nbsp;".$langsnames[$i]."</td>";
	if($root){
		if($adminlanguage!=$langs[$i])
		        echo "<td bgcolor=".$admin_settings['inputbg']." ><a href=index.php?action=clone&lang=".$langs[$i]." class=normallink>Clone</a></td>";
		else
		        echo "<td>&nbsp;</td>";
		}
	echo "</tr>";
	}
?>
</table>
<p>
<input type=submit value="<?=$lt[1];?>">
<input type=button value="<?=$lt[2];?>" onClick="JavaScript:window.location='..';">
</form>
