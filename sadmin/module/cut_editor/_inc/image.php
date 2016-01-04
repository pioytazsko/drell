<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
<title><?=$dl[14];?></title>
<link rel="stylesheet" href="../../css/dialoge_theme.css" type="text/css">
<style type="text/css">
p {
	margin:2px
}
</style>
<script language="JavaScript" type="text/javascript" src="../../js/IE5script.js"></script>
<script language="JavaScript" type="text/javascript" src="../../js/dialogEditorShared.js"></script>
<script language="JavaScript" type="text/javascript" src="../../js/dialogshared.js"></script>
<script type="text/javascript">
<!--//
var CURRENT_HIGHLIGHT
function highlight(srcElement) {
	if (CURRENT_HIGHLIGHT) {
		CURRENT_HIGHLIGHT.style.backgroundColor='';
		CURRENT_HIGHLIGHT.style.color='#003399';
	}
	srcElement.style.backgroundColor = 'highlight';
	srcElement.style.color = 'highlighttext';
	CURRENT_HIGHLIGHT = srcElement;
}
function insert_image() {
	parentWindow.wp_create_image_html(obj,document.image_form.imagename.value, document.image_form.iwidth.value, document.image_form.iheight.value, '', '', '');
	top.window.close();
	return false;
}
function localImage(image,preview,iwidth,iheight,isize) {
	document.image_form.imagename.value=image;
	document.image_form.imagename.value = image
	document.image_form.iwidth.value=iwidth;
	document.getElementById('width').innerHTML = '<?=$dl[15];?>: ' + iwidth + 'px';
	document.image_form.iheight.value=iheight;
	document.getElementById('height').innerHTML = '<?=$dl[16];?>: ' + iheight + 'px';
	document.getElementById('size').innerHTML = '<?=$dl[17];?>: ' + isize;
	if (preview == 0) {
		if (wp_is_ie) {
			document.frames('preview').location.href = 'blank.php?lang=<?=$adminlanguage;?>';
		} else {
			document.getElementById('preview').contentWindow.document.open();
			document.getElementById('preview').contentWindow.document.write('<div align="center" style="font-family:verdana"><br><br><?=$dl[18];?></div>');
			document.getElementById('preview').contentWindow.document.close();
		}
	} else if (wp_is_ie) {
		document.frames('preview').location.href = image;
	} else {
		document.getElementById('preview').contentWindow.location.assign(image);
	}
	if (document.getElementById('options')) {
		document.getElementById('options').disabled = false;
	}
}
function doConfirm(url,msg) {
	if (confirm(msg)){
		document.location.assign(url)
	}
}
function showUploadMessage() {
	document.getElementById('uploadMessage').style.display = 'block'
}
function hideUploadMessage() {
	document.getElementById('uploadMessage').style.display = 'none'
}
function cancelUpload() {
	if (wp_is_ie) {
		try {
			document.execCommand('stop');
		} catch (e) {
			document.location.reload();
		}
	} else {
		window.stop();
	}
	hideUploadMessage()
}
//-->
</script>
<script type="text/javascript">
	<!--// Begin
	function uploadedimage() {
		return true;
	}
	// End -->
</script>
</head>
<body scroll="no" onLoad="uploadedimage(); hideLoadMessage();">
<div align="center" id="dialogLoadMessage" style="display:block;">
	<table width="100%" height="90%">
		<tr>
			<td align="center" valign="middle"><div id="loadMessage"><?=$dl[1];?></div></td>
		</tr>
	</table>
</div>
<div class="dialog_content"> 
	<div style="height:22px"> 
		&nbsp;	</div>
	<table border="0" cellpadding="1" cellspacing="3">
		<tr> 
			<td rowspan="10" valign="top"> <fieldset>
				<input class="disabledtextbox" type=hidden name="imagename" value="/attachments/"> 
				<table width="360px" border="0" cellspacing="0" cellpadding="0">
					<tr> 
						<td class="fileBar" width="190"><p><?=$dl[19];?>:</p></td>
						<td class="fileBar" width="170"><p><?=$dl[20];?>:</p></td>
					</tr>
				</table>
				<div class="inset" style="height:315; width:100%; overflow:auto; background-color:#FFFFFF">
<table width="100%" cellpadding="0" cellspacing="0" border="0">
<?
if((isset($id)) && ($id!="undefined"))
	{
	$mas=getfiles($module_filepath."/attachments/".$id."/");
	if($mas[0]!=""){
		for($i=0;$i<count($mas);$i++){
			$ppath[$i]=$module_filepath."/attachments/".$id."/";
			$ppath[$i]=$ppath[$i].$mas[$i];
			}

	for($i=0;$i<count($mas);$i++){
		$filesize=ceil(filesize($ppath[$i])/1000);
		$ext=split("\.",mystrtohigher($mas[$i]));
		$ext=$ext[count($ext)-1];
		$ext1=strtolower($ext);
		$ext1=ereg_replace("jpeg","jpg",$ext1);
		if(($ext1!="jpg") && ($ext1!="gif"))
			continue;
		if($filesize>0)
			if(($ext=="JPG") || ($ext=="JPEG") || ($ext=="GIF")){
				$s=getimagesize($ppath[$i]);
			        $ext.=" ".$s[0]."x".$s[1];
				}

		$emp="";
		if($filesize==0)$emp=" (".$dl[141].")";
		$ttt="<img src=../../images/".$ext1."_icon.gif width=23 height=22 alt=\"\" border=0 align=absmiddle>".$mas[$i].$emp;

		if($filesize==0)
			$imgr="<a id=\"/attachments/".$id."/".$mas[$i]."\" class=filelink><font color=#FF0000>".$ttt."</font></a>";
		else
			$imgr="<a id=\"/attachments/".$id."/".$mas[$i]."\" class=filelink href=\"#\" onClick=\"javascript:localImage('/attachments/".$id."/".$mas[$i]."',1,'".$s[0]."','".$s[1]."', '".$filesize."K');\" title=\"".$ext."px  ".$dl[17].": ".$filesize." K\">".$ttt."</a>";
	        $e[$i]="
	<tr onmouseover=\"this.style.backgroundColor='#eeeeee'\" onmouseout=\"this.style.backgroundColor='#ffffff'\">
		<td width=190>
			<p class=styled style=\"width:180px;height:22px;overflow:hidden\">".$imgr."</p>
		</td><td width=170><p class=styled>".$ext.", ".$filesize."K</p></td></tr>
		";
		}
	}
	}

if((trim($e[0])!="") || (count($e)>1))
	echo join("",$e);
?>
						
	
						</table>
				</div>
				</fieldset></td>
			<td rowspan="3">&nbsp;</td>
			<td colspan="3" valign="top"> 
				&nbsp;			</td>
		</tr>
		<tr> 
			<td colspan="3" align="right" valign="top"> <div align="center"> 
					<iframe id="preview" width="99%" height="170" frameborder="0" class="previewWindow" src="blank.php?lang=<?=$adminlanguage;?>"></iframe>
				</div></td>
		</tr>
		<tr> 
			<td colspan="3" valign="top"> <form name="image_form" id="image_form" style="display:inline" onsubmit="return insert_image()">
					<fieldset>
					<legend><?=$dl[21];?>:</legend>
					<table height="60" border="0" cellspacing="3" cellpadding="1">
						<tr> 
							<td><?=$dl[22];?>:</td>
							<td width="100%"><input type="text" name="imagename" id="imagename" value="" style="width:220px" title="" readonly> 
							</td>
						</tr>
						<tr> 
							<td colspan="2"><span id="width"> </span> <input type="hidden" name="iwidth" size="4"> 
								&nbsp; <span id="height"> </span> <input type="hidden" name="iheight" id="iheight" size="4"> 
								&nbsp; <span id="size"> </span></td>
						</tr>
					</table>
					</fieldset>
					<div align="center"> 
												<p>&nbsp;</p>
						<button type="submit">OK</button>
						&nbsp; 
						<button type="button" onClick="parent.window.close();"><?=$dl[5];?></button>
						</div>
				</form></td>
		</tr>
	</table>
</div>
</body>
</html>
