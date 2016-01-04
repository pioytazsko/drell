<script language=JavaScript>
function atsubmit(){
var a;
a=become.attachments.value;
if(a!=""){
	a=a.replace(/.+\\/gi, "")
	a=a.replace(/[A-Za-z0-9_\.-]/gi, "")
	r=(a=="")
	if(!r){ 
	        alert('<?=$lt[48];?>');
		return false;
		}
	}
but.style.visibility='hidden';mar.style.visibility='visible';
become.submit();
}
</script>
<?
if($success)
	echo "<font color=#006600><b>".$dfile."</b></font> - ".$lt[54]."<hr size=1 color=#009900>";

echo $lt[28].":<br><input type=file name=\"attachments\"><p>";
?>
<div id=mar style="visibility:hidden;"><marquee width=200 direction=right scrollamount=10 bgcolor=<?=$admin_settings['tablebg'];?>><a class=normal><font color=#FFFFFF>>></font></a></marquee></div>
<div id=but>
<input name="buttonBecome" type="button" value="<?=$lt[52]?>" onClick="JavaScript:atsubmit();">&nbsp;
<input type="Reset" value="<?=$lt[31];?>">&nbsp;
<input type="button" value="<?=$lt[51];?>" onClick="JavaScript:window.close();">
<p>
<?
if(isset($delattachments))
	{
        include("action/_deleteattachments.php");
	}

$ii=0;
if(isset($id))
	{
	$dir=$module_filepath."/attachments/".$id;
	if (!is_dir($dir))
		mkdir($dir,0777);

	$mas=getfiles($module_filepath."/attachments/".$id."/");
	for($i=0;$i<count($mas);$i++){
		$ppath[$i]=$module_filepath."/attachments/".$id."/";
		$ppath[$i]=$ppath[$i].$mas[$i];
		$ii=1;
		}
	}
if($ii==0)
	{
        $e="";
	}
else
	{
	for($i=0;$i<count($mas);$i++){
		$filesize=ceil(filesize($ppath[$i])/1000);
		$ext=split("\.",strtoupper($mas[$i]));
		$ext=$ext[count($ext)-1];
		if($filesize>0){
			if(($ext=="JPG") || ($ext=="JPEG") || ($ext=="GIF")){
				$s=getimagesize($ppath[$i]);
			        $isize=", ".$s[0]."x".$s[1];
				}
			}
		$emp=($filesize>0) ? "" : " - <font color=#FF0000><b>(".$lt[53].")</b></font>";
		$ext=$mas[$i].$isize;
	        $e[$i]="<a target=_blank class=normallink href=".ereg_replace(".*/attachments","/attachments",$ppath[$i]).">".$lt[42]." (".$filesize."K, ".$ext.")&nbsp;&nbsp;</a>|&nbsp;&nbsp;<a class=normallink href=attachments.php?page=edit&id=".$id."&parent=".((integer)$parent)."&delattachments=yes&attachmentname=".ereg_replace(".*/attachments",$module_filepath."/attachments",$ppath[$i]).">".$lt[43]."</a>".$emp;
		}
	}

for($i=0;$i<count($mas);$i++){
	echo "&nbsp;".$e[$i]."<hr size=1 color=#009900>";
	}
?>
</div>
