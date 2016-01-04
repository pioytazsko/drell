<?
if(isset($nsubmit))
	{
	include("_upload.php");
	}
?>

&nbsp;<p>
<center>
<form name=fpass method=post action=uploaddump.php>
<?
	echo "<table width=100% cellpadding=3 cellspacing=2 border=1 bordercolor=".$admin_settings['tableaddbg']." bgcolor=".$admin_settings['inputbg'].">
	<tr bgcolor=".$admin_settings['tableaddbg']."><td align=left><a class=menu>Dump:</a></td></tr>
	<tr><td align=left><textarea name=ftext rows=30 onFocus=\"Ch(this);\" onBlur=\"ChOut(this);\" style=\"border:1px;width:100%;background-color:".$admin_settings['inputbg']."\"></textarea></td></tr>
	</table>";
?>
</center>
<input type=submit name=nsubmit value="     Upload     ">
</form>
<script language=JavaScript>
function Ch(obj){obj.style.background="#FFFFFF";}
function ChOut(obj){obj.style.background="#D3D6C0";}
</script>