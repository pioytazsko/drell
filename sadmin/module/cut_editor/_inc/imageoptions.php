<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
<title><?=$dl[21];?></title>
<link rel="stylesheet" href="../../css/dialoge_theme.css" type="text/css">
<style type="text/css">
p {
	margin:2px
}
</style>
<script language="JavaScript" type="text/javascript" src="../../js/IE5script<? echo ($browser=="true") ? "5" : "6"; ?>.js"></script>
<script language="JavaScript" type="text/javascript" src="../../js/dialogEditorShared.js"></script>
<script language="JavaScript" type="text/javascript" src="../../js/dialogshared.js"></script>
<script type="text/javascript">
<!--//
function insert_image() {
	parentWindow.wp_create_image_html(obj,document.image_form.imagename.value, document.image_form.iwidth.value, document.image_form.iheight.value, document.image_form.ialign.value, document.image_form.alt.value, document.image_form.border.value, document.image_form.mtop.value + 'px ' + document.image_form.mright.value + 'px ' + document.image_form.mbottom.value + 'px ' + document.image_form.mleft.value + 'px ');
	top.window.close();
	return false;
}
function doConfirm(url,msg) {
        if (confirm(msg)){
           this.location.assign(url)
        }
}
function load_settings() {
	var align = ''
	if (align != '') {
		document.image_form.ialign.value = align;
	}
	updateStyle();
}
function resetDimensionsTimeout() {
	setTimeout("resetDimensions()", 200);
}
function resetDimensions() {
	document.getElementById('imagepreview').removeAttribute('width')
	document.getElementById('imagepreview').removeAttribute('height')
	document.image_form.iwidth.value = document.getElementById('imagepreview').width
	document.image_form.iheight.value = document.getElementById('imagepreview').height
}
function updateStyle() {

	document.getElementById('wrap').align = document.image_form.ialign.value;
	
	if (document.image_form.mtop.value == '') document.image_form.mtop.value = '0';
	if (document.image_form.mbottom.value == '') document.image_form.mbottom.value = '0';
	if (document.image_form.mleft.value == '') document.image_form.mleft.value = '0';
	if (document.image_form.mright.value == '') document.image_form.mright.value = '0';
	
	document.getElementById('wrap').style.marginTop = document.image_form.mtop.value
	document.getElementById('wrap').style.marginBottom = document.image_form.mbottom.value
	document.getElementById('wrap').style.marginLeft = document.image_form.mleft.value
	document.getElementById('wrap').style.marginRight = document.image_form.mright.value
	
	document.getElementById('imagepreview').alt = document.image_form.alt.value
}
//-->
</script>
</head>
<body scroll="no" bgcolor="threedface" onLoad="load_settings(); hideLoadMessage();">
<div align="center" id="dialogLoadMessage" style="display:block;">
	<table width="100%" height="90%">
		<tr>
			<td align="center" valign="middle"><div id="loadMessage"><?=$dl[1];?></div></td>
		</tr>
	</table>
</div><form name="image_form" id="image_form" style="display:inline" onsubmit="return insert_image()">
	<div class="dialog_content" align="center"> 
		<p>&nbsp;</p>
		<table border="0" cellpadding="1" cellspacing="3">
			<tr> 
				<td align="right" valign="top">
						<div id="preview" align="center" style="width:304px; height:192px; overflow:auto; background-color:#FFFFFF; padding:5px" class="previewWindow"><img id="imagepreview" src="<?=$image;?>" width="<?=$width;?>" height="<?=$height;?>" border="<?=$border;?>" title="<?=$alt;?>" alt="<?=$image;?>"></div></td>
				<td valign="top">&nbsp;</td>
				<td rowspan="2" valign="top"><fieldset>
					<legend><?=$dl[23];?>:</legend>
					<table border="0" cellspacing="3" cellpadding="1">
						<tr> 
							<td><?=$dl[24];?>:</td>
							<td><select name="ialign" id="ialign" class="seltext" onChange="updateStyle()">
<?

$a="
<option value=\"\">".$dl[25]."</option>
<option value=\"absmiddle\">".$dl[26]."</option>
<option value=\"middle\">".$dl[27]."</option>
<option value=\"bottom\">".$dl[28]."</option>
<option value=\"top\">".$dl[29]."</option>
<option value=\"left\">".$dl[30]."</option>
<option value=\"right\">".$dl[31]."</option>
<option value=\"baseline\">".$dl[32]."</option>
<option value=\"texttop\">".$dl[33]."</option>
<option value=\"absbottom\">".$dl[34]."</option>
";
$a=ereg_replace("value=\"".$align."\"","value=\"".$align."\" selected",$a);
echo $a;
?>
								</select></td>
						</tr>
						<tr> 
							<td colspan="2">&nbsp;</td>
						</tr>
						<tr> 
							<td colspan="2"><?=$dl[35];?>:</td>
						</tr>
						<tr> 
							<td> <?=$dl[36];?>: </td>
							<td> <input type="text" name="mtop" id="mtop" size="4" value="<?=ereg_replace("px","",$mtop);?>" onChange="updateStyle()"> 
								px. </td>
						</tr>
						<tr> 
							<td><?=$dl[37];?>:</td>
							<td><input type="text" name="mbottom" id="mbottom" size="4" value="<?=ereg_replace("px","",$mbottom);?>" onChange="updateStyle()"> 
								px. </td>
						</tr>
						<tr> 
							<td> <?=$dl[38];?>: </td>
							<td> <input type="text" name="mleft" id="mleft" size="4" value="<?=ereg_replace("px","",$mleft);?>" onChange="updateStyle()"> 
								px. </td>
						</tr>
						<tr> 
							<td><?=$dl[39];?>:</td>
							<td><input type="text" name="mright" id="mright" size="4" value="<?=ereg_replace("px","",$mright);?>" onChange="updateStyle()"> 
								px. </td>
						</tr>
						<tr> 
							<td colspan="2">&nbsp;</td>
						</tr>
						<tr> 
							<td colspan="2"><?=$dl[40];?>: <div id="stylepreview" style="padding:10px; width:340px; height:128px; overflow:hidden; background-color:#FFFFFF; font-size:8px" class="previewWindow"> 
									<p><img id="wrap" src="../../images/wrap_preview.gif" width="48" height="48" align="" alt="">Lorem 
										ipsum, Dolor sit amet, consectetuer adipiscing loreum ipsum 
										edipiscing elit, sed diam nonummy nibh euismod tincidunt ut 
										laoreet dolore magna aliquam erat volutpat.Loreum ipsum edipiscing 
										elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore 
										magna aliquam erat volutpat. Ut wisi enim ad minim veniam, 
										quis nostrud exercitation ullamcorper suscipit. Lorem ipsum, 
										Dolor sit amet, consectetuer adipiscing loreum ipsum edipiscing 
										elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore 
										magna aliquam erat volutpat.</p>
									<p>Lorem ipsum, Dolor sit amet, consectetuer adipiscing loreum 
										ipsum edipiscing elit, sed diam nonummy nibh euismod tincidunt 
										ut laoreet dolore magna aliquam erat volutpat.Loreum ipsum 
										edipiscing elit, sed diam nonummy nibh euismod tincidunt ut 
										laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad 
										minim veniam, quis nostrud exercitation ullamcorper suscipit. 
										Lorem ipsum, Dolor sit amet, consectetuer adipiscing loreum 
										ipsum edipiscing elit, sed diam nonummy nibh euismod tincidunt 
										ut laoreet dolore magna aliquam erat volutpat.</p>
								</div></td>
						</tr>
					</table>
					</fieldset></td>
			</tr>
			<tr> 
				<td align="right" valign="top"><fieldset>
					<legend><?=$dl[21];?>:</legend>
					<table width="100%" border="0" cellspacing="3" cellpadding="1">
						<tr> 
							<td><span title=""><?=$dl[19];?>:</span></td>
							<td width="100%" colspan="2"><? echo "<b>".ereg_replace(".*/","",$image)."</b>"; ?><input style="width:200px;text-align:right" type="hidden" name="imagename" id="imagename" value="<?=$image;?>" size="34" onChange="document.getElementById('imagepreview').src = this.value; document.getElementById('imagepreview').onLoad = resetDimensionsTimeout()"> 
							</td>
						</tr>
						<tr> 
							<td><?=$dl[41];?>:</td>
							<td colspan="2"><input type="text" name="border" id="border" value="<?=$border;?>" size="4" onChange="document.getElementById('imagepreview').border = this.value;"></td>
						</tr>
						<tr> 
							<td><?=$dl[15];?>:</td>
							<td><input type="text" name="iwidth" id="iwidth" size="4" value="<?=$width;?>" onChange="document.getElementById('imagepreview').width=this.value">
							</td>
							<td rowspan="2"><img src="../../images/brackets.gif" width="11" height="39" align="absmiddle" alt="">&nbsp;&nbsp;<a id="reset" href="#" onClick="javascript:resetDimensions()" onMouseUp="this.blur()"><?=$dl[44];?></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
						</tr>
						<tr> 
							<td><?=$dl[16];?>:</td>
							<td><input type="text" name="iheight" id="iheight" size="4" value="<?=$height;?>" onChange="document.getElementById('imagepreview').height=this.value"></td>
						</tr>
						<tr> 
							<td height="24"><?=$dl[42];?>:</td>
							<td colspan="2"> <input style="width:200px" type="text" name="alt" id="alt" value="<?=$alt;?>" size="34" onChange="document.getElementById('imagepreview').alt = this.value;document.getElementById('imagepreview').title = this.value;" title="<?=$dl[43];?>."> 
							</td>
						</tr>
					</table>
					</fieldset></td>
				<td align="right" valign="top">&nbsp;</td>
			</tr>
			<tr> 
				<td colspan="3" align="right" valign="top">&nbsp;</td>
			</tr>
			<tr> 
				<td colspan="3" align="right" valign="top"><div align="center"> 
						<button type="submit">OK</button>
						&nbsp; 
						<button type="button" onClick="top.window.close();"><?=$dl[5];?></button></div></td>
			</tr>
		</table>
	</div>
</form>
</body>
</html>
