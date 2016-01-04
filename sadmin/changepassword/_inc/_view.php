<?
if(isset($npass))
	{
	include("_newinfo.php");
	}
?>

&nbsp;<p>
<center>
<form name=fpass method=post action=index.php>
<table width=350 bgcolor=<?=$admin_settings['tableaddbg'];?> cellpadding=4 cellspacing=0 border=0 bordercolor=#CCCCCC>
<tr>
 <td width=100%><?=$lt[2];?>:</td>
 <td align=left><input name=nusername value="<?=$adminusername;?>" size=15></td>
</tr>
<tr>
 <td><?=$lt[3];?>:</td>
 <td align=left><input type=password name=noldpassword size=15></td>
</tr>
<tr>
 <td><?=$lt[4];?>:</td>
 <td align=left><input type=password name=npass size=15></td>
</tr>
<tr>
 <td><?=$lt[5];?>:</td>
 <td align=left><input type=password name=ncpass size=15></td>
</tr>
<input type=hidden name=ilogin value=<? echo $ilogin; ?>>
<input type=hidden name=ipass value=<? echo $ipass; ?>>
</table>
<p>
<input type=submit value="<?=$lt[6];?>">
<input type=button value="<?=$lt[7];?>" onClick="JavaScript:window.location='..';">
</form>
