<?
if(!isset($newch[rid]))
	{
	if($parent!="")
		$newch[rid]=$parent;
	else
		$newch[rid]=0;
	}
	
if($page=="edit")
	{
	$tid="&id=".$id;
	$query="select * from ".$module_name." where id=$id and lang='".$adminlanguage."'";
	$rr=$Q->query($DB,$query);
	if($action!="edit"){
		$ff=$Q->getrow();
		$newch[date]=getdate_mmccggg($ff[date]);
		$newch[access]=$ff[access];
		$newch[aname]=$ff[aname];
		$newch[name]=$ff[name];
		$newch[anons]=$ff[anons];
		$newch[text]=$ff[text];
		$newch[archive]=$ff[archive];
		$newch[f1]=$ff[f1];
		$newch[f2]=$ff[f2];
		$newch[f3]=$ff[f3];
		$newch[f4]=$ff[f4];
		$newch[f5]=$ff[f5];
		$newch[f6]=$ff[f6];
		$newch[f7]=$ff[f7];
		$newch[f8]=$ff[f8];
		$newch[f9]=$ff[f9];
		$newch[f10]=$ff[f10];
		$newch[url]=$ff[url];
		$newch[title]=$ff[title];
		$newch[description]=$ff[description];
		$newch[keywords]=$ff[keywords];
		}
	$submit=" ".$lt[29]." ";
	}
else	{
	$submit=" ".$lt[32]." ";
        $newch[date]=date("d-m-Y H:i:s",time());
	}

?>
<script language=JavaScript>
function fonSubmit(){
var a,r;
if(become.attachments)
	a=become.attachments.value;
else
	a="";
if(a!=""){
	a=a.replace(/.+\\/gi, "")
	a=a.replace(/[A-Za-z0-9_\.-]/gi, "")
	r=(a=="")
	if(!r){ 
	        alert('<?=$lt[48];?>');
		return false;
		}
	}
if(become.htmlCode){
	submit_form();
//	become.submit();
	}
//else
//	become.submit();
}
</script>
<form action="index.php?page=<? echo $page; ?>&action=<? echo $page.$tid; ?>" onSubmit="JavaScript:fonSubmit();" method=post enctype="multipart/form-data" name=become>
<table width="100%" cellpadding="3" cellspacing="1" border=0 align="center">
<?

if($root){
	$fff=($fields[17]!="") ? $fields[17] : $newch[aname];
	echo "<tr bgcolor=".$admin_settings['tableaddbg'].">
		<td colspan=2 align=center width=100%><a class=tabletitle>".$lt[36]."</a></td>
	</tr>
	<tr>
		<td colspan=2 align=center><input name=\"newch[aname]\" style=\"width:100%;background-color:".$admin_settings['inputbg']."\" value=\"".$fff."\" size=52></td>
	</tr>";
	echo "<tr bgcolor=".$admin_settings['tableaddbg'].">
		<td colspan=2 align=center width=100%><a class=tabletitle>rid</a></td>
	</tr>
	<tr>
		<td colspan=2 align=center><input name=\"newch[rid]\" style=\"width:100%;background-color:".$admin_settings['inputbg']."\" value=\"".((integer)$newch[rid])."\" size=52></td>
	</tr>";
	echo "<tr bgcolor=".$admin_settings['tableaddbg'].">
		<td colspan=2 align=center width=100%><a class=tabletitle>".$lt[35]."</a></td>
	</tr>
	<tr>
		<td colspan=2 align=center><textarea name=\"newch[access]\" style=\"width:100%;background-color:".$admin_settings['inputbg']."\" rows=20 cols=100>".$newch[access]."</textarea></td>
	</tr>";
	echo "<tr>
		<td  align=center colspan=2>&nbsp;<hr size=1 color=#009900>&nbsp;</td>
	</tr>";
	}
else	{
	$fff=($fields[17]!="") ? $fields[17] : $newch[aname];
	echo "<input name=\"newch[aname]\" value=\"".$fff."\" type=hidden>";
	echo "<input name=\"newch[access]\" value=\"".$newch[access]."\" type=hidden>";
	echo "<input name=\"newch[rid]\" value=\"".((integer)$newch[rid])."\" type=hidden>";
	}


//if($parent!="")
	include("_formbody.php");
//else	{
//        echo "<input name=\"newch[date]\" value=\"".$newch[date]."\" type=hidden>";
//	}
?>
	<tr>
		<td  align="center" colspan="2">
		<input name="buttonBecome" type=submit value="<?=$submit?>">&nbsp;
		<input type="Reset" value="<?=$lt[31];?>">&nbsp;
		<input type="button" value="<?=$lt[30];?>" onClick="JavaScript:window.location='';">
		</td>
	</tr>
</table>
</form>

