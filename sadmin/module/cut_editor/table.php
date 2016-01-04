<?
include("../../_functions.php");
include("../../_config.php");
include("../../_mysql.php");
include("../../_admin_config.php");

include("../../_checking.php");

if($caction=="displayfirst")
	{
	include("../../_failed.php");
	exit;
	}
//echo "-".$lang;
if(!isset($lang))
	$lang="ru";
$dl=getlangtemplate($lang,"../../_inc/templates/reacheditdialogs");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title><?=$dl[133];?></title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251" />
<link rel="stylesheet" href="../../css/dialoge_theme.css" type="text/css">
<script language="JavaScript" type="text/javascript" src="../../js/dialogEditorShared.js"></script>
<script language="JavaScript" type="text/javascript" src="../../js/dialogshared.js"></script>
<script type="text/javascript">
<!--//
function wp_docolor(obj,Action,color) {   
	if (color != null) {
		if (Action == 1){
			document.table_form.bordercolor.value = color;
			document.getElementById('borderchosencolor').style.backgroundColor = color;
			updateStyle();
		}
		if (Action == 2){
			document.table_form.bgcolor.value = color;
			document.getElementById('bgchosencolor').style.backgroundColor = color;
			updateStyle();
		}
	}
}
// creates the table attributes stings
function conjunction() {  

 	var rows = document.table_form.rows.value;
 	var cols = document.table_form.cols.value;
 
 	var border = " border=\"" + document.table_form.border.value + "\" ";
 	var bordercolor;
	var bgcolor;
	var width;
	var height;
	var attrs;
	var cellspacing;
	var cellpadding;
	var style;
	var bCollapse;
 	
 	if (document.table_form.bordercolor.value == "") {
 		bordercolor = "";
	} else {
		bordercolor = " bordercolor=\"" + document.table_form.bordercolor.value + "\" ";
 	} 
	
	if (document.table_form.cellpadding.value == "") {
 		cellpadding = "";
	} else {
		cellpadding = " cellpadding=\"" + document.table_form.cellpadding.value + "\" ";
 	} 
	
	if (document.table_form.cellspacing.value == "") {
 		cellspacing = "";
	} else {
		cellspacing = " cellspacing=\"" + document.table_form.cellspacing.value + "\" ";
 	} 
 
 	if (document.table_form.bgcolor.value == "") {
 		bgcolor = "";
	} else {
		bgcolor = " bgcolor=\"" + document.table_form.bgcolor.value  + "\" ";
 	} 
 
 	if (document.table_form.width.value == "") {
 		width = "";
	} else {
		width = "width=\"" + document.table_form.width.value + document.table_form.percent1.value + "\" ";
 	} 
 
 	if (document.table_form.height.value == "") {
 		height = "";
	} else {
		height = "height=\"" + document.table_form.height.value + document.table_form.percent2.value + "\" ";
 	}

	if (document.table_form.collapse.checked == true) {
		bCollapse = true;
		style = 'style="border-collapse:collapse" ';
	} else {
		bCollapse = false;
	}
	attrs = " " + width + height + border + bordercolor + bgcolor + cellpadding + cellspacing + style;
	
	if (wp_is_ie) {
		parentWindow.wp_insertTable(obj,rows,cols,attrs);
	} else {
		parentWindow.wp_insertTable(obj,rows,cols,document.table_form.width.value,document.table_form.percent1.value,document.table_form.height.value,document.table_form.percent2.value,document.table_form.border.value,document.table_form.bordercolor.value,document.table_form.bgcolor.value,document.table_form.cellpadding.value,document.table_form.cellspacing.value,bCollapse);
	}
	if (document.table_form.border.value == '0') {
		parentWindow.wp_show_borders(obj);
		parentWindow.wp_set_button_states(obj);
	}
	window.close();
	return false;
}	
// creates the table style preview
function updateStyle() {
	if (document.table_form.collapse.checked == true) {
		document.getElementById('tbl').style.borderCollapse = "collapse";
	} else {
		document.getElementById('tbl').style.borderCollapse = "separate";
	}
	document.getElementById('tbl').setAttribute("border",document.table_form.border.value);
	document.getElementById('tbl').borderColor = document.table_form.bordercolor.value;
	document.getElementById('tbl').style.backgroundColor =  document.table_form.bgcolor.value;
	document.getElementById('tbl').cellPadding = document.table_form.cellpadding.value;
	document.getElementById('tbl').cellSpacing = document.table_form.cellspacing.value;
}
//-->	
</script>
</head>
<body onLoad="updateStyle();document.getElementById('borderchosencolor').style.backgroundColor = document.table_form.bordercolor.value; hideLoadMessage();">
<div align="center" id="dialogLoadMessage" style="display:block;">
	<table width="100%" height="90%">
		<tr>
			<td align="center" valign="middle"><div id="loadMessage"><?=$dl[1];?></div></td>
		</tr>
	</table>
</div><form name="table_form" id="table_form" onsubmit="return conjunction()">
	<fieldset class="fieldsetLine">
	<legend><?=$dl[134];?>:</legend>
	<table width="100%" border="0" cellpadding="0" cellspacing="5">
		<tr> 
			<td width="20%"><?=$dl[135];?>:</td>
			<td width="30%" > <input type="text" name="rows" id="rows" size="4" value="3" /> 
			</td>
			<td width="20%" ><?=$dl[15];?>:</td>
			<td width="30%" ><input type="text" name="width" id="width" size="4" value="100" /> 
				<select name="percent1" id="percent1" style="width:60; font-family:Verdana">
					<option value="%" selected="selected">%</option>
					<option value="">px.</option>
				</select></td>
		</tr>
		<tr> 
			<td width="20%"><?=$dl[136];?>:</td>
			<td width="30%" > <input type="text" name="cols" id="cols" size="4" value="3" /> 
			</td>
			<td width="20%" ><?=$dl[16];?>:</td>
			<td width="30%" > <input type="text" name="height" id="height" size="4" value="" /> 
				<select name="percent2" style="width:60; font-family:Verdana">
					<option value="%">%</option>
					<option value="" selected="selected">px.</option>
				</select></td>
		</tr>
	</table>
	</fieldset>
	<fieldset class="fieldsetLine">
	<legend><?=$dl[136];?><?=$dl[60];?>:</legend>
	<table width="100%" border="0" cellpadding="0" cellspacing="5">
		<tr> 
			<td width="20%"><?=$dl[61];?>:</td>
			<td width="30%" > <input type="text" name="cellspacing" id="cellspacing" size="4" value="0" onChange="updateStyle()" /> 
			</td>
			<td width="20%" ><?=$dl[62];?>:</td>
			<td width="30%" > <input type="text" name="cellpadding" id="cellpadding" size="4" value="3" onChange="updateStyle()" /> 
			</td>
		</tr>
	</table>
	</fieldset>
	<fieldset class="fieldsetLine">
	<legend><?=$dl[56];?>:</legend>
	<table width="100%" border="0" cellpadding="0" cellspacing="5">
		<tr> 
			<td width="20%"><?=$dl[66];?>:</td>
			<td width="30%" ><input type="text" name="border" id="border" size="4" value="1" onChange="updateStyle()" /></td>
			<td width="20%" ><?=$dl[67];?>:</td>
			<td width="30%" ><input type="checkbox" name="collapse" id="collapse" value="ON" onClick="updateStyle()" checked="checked" /> 
			</td>
		</tr>
		<tr> 
			<td width="20%"><?=$dl[57];?>: </td>
			<td width="30%"><button class="colordisplay" type="button" onClick="colordialog(2);"> 
				<div id="bgchosencolor">&nbsp;</div>
				<?=$dl[58];?></button>
				<input type="hidden" name="bgcolor" id="bgcolor" value="" onChange="updateStyle()" /> 
			</td>
			<td width="20%"><?=$dl[68];?>:</td>
			<td width="30%"><button class="colordisplay" type="button" onClick="colordialog(1);"> 
				<div id="borderchosencolor">&nbsp;</div>
				<?=$dl[58];?></button>
				<input type="hidden" name="bordercolor" id="bordercolor" value="#000000" onChange="updateStyle()" /> 
			</td>
		</tr>
	</table>
	</fieldset>
	<fieldset class="fieldsetLine">
	<legend><?=$dl[69];?>:</legend>
	<table width="100%" border="0" cellpadding="0" cellspacing="5">
		<tr> 
			<td height="50" colspan="2"><div id="tbl_background" style="text-align:center; width:100%; padding:10px; height:100px; background-color:#FFFFFF; overflow:auto" class="previewWindow"> 
					<table cellspacing="0" cellpadding="3" width="90%" height="50" id="tbl">
						<tr> 
							<td align="center">&nbsp;</td>
							<td align="center">&nbsp;</td>
							<td align="center">&nbsp;</td>
						</tr>
						<tr> 
							<td align="center">&nbsp;</td>
							<td align="center">&nbsp;</td>
							<td align="center">&nbsp;</td>
						</tr>
					</table>
				</div></td>
		</tr>
	</table>
	</fieldset>
	<div style="padding-bottom:10px;" align="center"> 
		<button type="submit"> OK 
		</button>
		&nbsp;&nbsp; 
		<button type="button" onClick="javascript:window.close();"><?=$dl[5];?></button>
	</div>
</form>
</body>
</html>