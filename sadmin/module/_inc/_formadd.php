<?
if(!isset($newch[rid]))
	{
	if($parent!="")
		$newch[rid]=$parent;
	else
		$newch[rid]=0;
	}
	
$submit=" ".$lt[32]." ";
$newch[date]=date("d-m-Y H:i:s",time());


?>
<form action="index.php" method=post enctype="multipart/form-data" name=become11>
<table width="100%" cellpadding="3" cellspacing="1" border=0 align="center">
<?

	$fff=$newch[aname];
	echo "<tr bgcolor=".$admin_settings['tableaddbg'].">
		<td align=center width=90%><a class=tabletitle>".$lt[19]."</a></td>
		<td align=center width=10%><a class=tabletitle>aname</a></td>
	</tr>
	<tr>
		<td align=center valign=top><input name=\"newch[name]\" style=\"width:100%;background-color:".$admin_settings['inputbg']."\" value=\"\" size=52></td>
		<td align=center><input name=\"newch[aname]\" style=\"width:100%;background-color:".$admin_settings['inputbg']."\" value=\"\" size=52></td>
	</tr>";
	echo "<tr>
		<td colspan=2 align=center><input type=hidden name=\"newch[rid]\" style=\"width:100%;background-color:".$admin_settings['inputbg']."\" value=\"".((integer)$newch[rid])."\" size=52></td>
	</tr>";

?>
<input type=hidden name="newch[date]" value="<?=$newch[date];?>">
<input type=hidden name="page" value="add">
<input type=hidden name="action" value="add">
	<tr>
		<td  align="center" colspan="2">
		<input name="buttonBecome" type="submit" value="<?=$submit?>">&nbsp;
		</td>
	</tr>
</table>
</form>

