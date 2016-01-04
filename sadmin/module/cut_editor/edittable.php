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
<title><?=$dl[45];?></title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
<style type="text/css">
<!--
@import url(../../css/dialoge_theme.css);
#tab_one {
	position : absolute; 
	width:420;
	top: 24px; 
	left: 4px;
	height: 300px; 
	text-align: center; 
	font-family : Verdana, Geneva, Arial, Helvetica, sans-serif;
	font-size : xx-small; 
	background: threedface; 
	border-bottom: 2px THREEDDARKSHADOW solid;
	border-right: 2px THREEDDARKSHADOW solid;
	border-left: 2px THREEDHIGHLIGHT solid;
}
#tab_two {
	display: block; 
	width:420;
	position : absolute; 
	top: 24px; 
	left: 4px;	
	height: 300px; 
	text-align: center; 
	visibility: hidden; 
	font-family : Verdana, Geneva, Arial, Helvetica, sans-serif; 
	font-size : xx-small;	
	background: threedface; 
	border-bottom: 2px THREEDDARKSHADOW solid;
	border-right: 2px THREEDDARKSHADOW solid;
	border-left: 2px THREEDHIGHLIGHT solid;
}
#tab_three {
	width:420;
	position : absolute; 
	top: 24px; 
	left: 4px;
	height: 300px; 
	text-align: center;
	visibility: hidden; 
	font-family : Verdana, Geneva, Arial, Helvetica, sans-serif;
	font-size : xx-small; 
	background: threedface; 
	border-bottom: 2px THREEDDARKSHADOW solid;
	border-right: 2px THREEDDARKSHADOW solid;
	border-left: 2px THREEDHIGHLIGHT solid;
}
-->
</style>
<script language="JavaScript" type="text/javascript" src="../../js/dialogEditorShared.js"></script>
<script language="JavaScript" type="text/javascript" src="../../js/dialogshared.js"></script>
<script type="text/javascript">
<!--//
function on_enter_cell() {
	document.getElementById('tab_one').style.visibility = "visible"
	document.getElementById('tab_two').style.visibility = "hidden"
	document.getElementById('tab_three').style.visibility = "hidden"
		
	document.getElementById('tbar1').className = "tbuttonUpLeft"
	document.getElementById('tbar2').className = "tbuttonRight"
	document.getElementById('tbar3').className = "tbuttonDown"
}

function on_enter_row() {
	document.getElementById('tab_one').style.visibility = "hidden"
	document.getElementById('tab_two').style.visibility = "visible"
	document.getElementById('tab_three').style.visibility = "hidden"
 
	document.getElementById('tbar1').className = "tbuttonLeft"
	document.getElementById('tbar2').className = "tbuttonUp"
	document.getElementById('tbar3').className = "tbuttonRight"
}

function on_enter_table() {
	document.getElementById('tab_one').style.visibility = "hidden"
	document.getElementById('tab_two').style.visibility = "hidden"
	document.getElementById('tab_three').style.visibility = "visible"
 
 	document.getElementById('tbar1').className = "tbuttonDown"
 	document.getElementById('tbar2').className = "tbuttonLeft"
	document.getElementById('tbar3').className = "tbuttonUpRight"
}
function wp_create_image_html(obj,img) {
	if (image_action == 'cell') {
		document.getElementById('cellBackground').value = img;
	} else if (image_action == 'table') {
		document.getElementById('tableBackground').value = img;
	}
	updateStyle();
}
var image_action = null
function open_image_window(action) {
	image_action = action
	szURL= 'dialog_frame.php?id=<?=$id;?>&window=' + parentWindow.wp_directory + obj.imagewindow + "&instance_img_dir="+obj.instance_img_dir+"&lang="+obj.instance_lang; 
	imgwin = wp_openDialog(szURL,'modal',730,466);
}
function wp_docolor(obj,Action,color) {
	if (color != null) {
		if (Action == 1) {
			document.getElementById('table_bordercolor').value = color;
			document.getElementById('tableborderchosencolor').style.backgroundColor = color;
			updateStyle();
			}
		if (Action == 2) {
			document.getElementById('table_bgcolor').value = color;
			document.getElementById('tablebgchosencolor').style.backgroundColor = color;
			updateStyle();
			}
		if (Action == 3) {
			document.getElementById('tr_bgcolor').value = color;
			document.getElementById('trbgchosencolor').style.backgroundColor = color;
			updateStyle();
			}
		if (Action == 4) {
			document.getElementById('td_bgcolor').value = color;
			document.getElementById('tdbgchosencolor').style.backgroundColor = color;
			updateStyle();
		}
	}
}
var currentBorder;
//this function detects the properties of the table and initialises the form's values
function initiate() {
		thisCell = parentWindow.wp_thisCell;
		thisRow = parentWindow.wp_thisRow;
		thisTable = parentWindow.wp_thisTable;
		if (thisTable.style.borderCollapse) {
			if (thisTable.style.borderCollapse == "collapse") {
				document.getElementById('collapse').checked = true;
			}
		}
		//init current values
		// Table
		document.getElementById('table_border').value = thisTable.getAttribute("BORDER");
		currentBorder = thisTable.getAttribute("BORDER");
		document.getElementById('table_cellpadding').value = thisTable.getAttribute("CELLPADDING");
		document.getElementById('table_cellspacing').value = thisTable.getAttribute("CELLSPACING");
		if (thisTable.getAttribute("WIDTH") != "") {
			document.getElementById('table_width').value = thisTable.getAttribute("WIDTH");
		}
		if (thisTable.style.width != "") {
			document.getElementById('table_width').value = thisTable.style.width;
		}
		if (thisTable.getAttribute("HEIGHT") != "") {
			document.getElementById('table_height').value = thisTable.getAttribute("HEIGHT");
		}
		if (thisTable.style.height != "") {
			document.getElementById('table_height').value = thisTable.style.height;
		}
		document.getElementById('table_align').value = thisTable.getAttribute("ALIGN");
		document.getElementById('tablebgchosencolor').style.backgroundColor = thisTable.getAttribute("BGCOLOR");
		document.getElementById('table_bgcolor').value = thisTable.getAttribute("BGCOLOR");
		document.getElementById('tableborderchosencolor').style.backgroundColor = thisTable.getAttribute("BORDERCOLOR");
		document.getElementById('table_bordercolor').value = thisTable.getAttribute("BORDERCOLOR");
		document.getElementById('tableBackground').value = thisTable.getAttribute("BACKGROUND");
		// Cell
		document.getElementById('td_width').value = thisCell.getAttribute("WIDTH");
		document.getElementById('td_height').value = thisCell.getAttribute("HEIGHT");
		document.getElementById('td_align').value = thisCell.getAttribute("ALIGN");
		document.getElementById('td_valign').value = thisCell.getAttribute("VALIGN");
		document.getElementById('cellBackground').value = thisCell.getAttribute("BACKGROUND");
		document.getElementById('tdbgchosencolor').style.backgroundColor = thisCell.getAttribute("BGCOLOR");
		document.getElementById('td_bgcolor').value = thisCell.getAttribute("BGCOLOR");
		// Row
		document.getElementById('tr_align').value = thisRow.getAttribute("ALIGN");
		document.getElementById('tr_valign').value = thisRow.getAttribute("VALIGN");
		document.getElementById('trbgchosencolor').style.backgroundColor = thisRow.getAttribute("BGCOLOR");
		document.getElementById('tr_bgcolor').value = thisRow.getAttribute("BGCOLOR");
		
		updateStyle();
}

function apply() {
	
	if (document.getElementById('collapse').checked == true) {
		thisTable.style.borderCollapse = "collapse";
	} else {
		thisTable.style.borderCollapse = "separate";
	}
	//  Cell 
	thisCell.setAttribute("BGCOLOR", document.getElementById('td_bgcolor').value, 0);
	thisCell.setAttribute("VALIGN", document.getElementById('td_valign').value, 0);
	thisCell.setAttribute("ALIGN", document.getElementById('td_align').value, 0);
	thisCell.setAttribute("WIDTH", document.getElementById('td_width').value,0);
	
	thisCell.setAttribute("HEIGHT", document.getElementById('td_height').value,0);
	thisCell.setAttribute('BACKGROUND', document.getElementById('cellBackground').value,0);
	// Row 
	thisRow.setAttribute("BGCOLOR", document.getElementById('tr_bgcolor').value, 0);
	thisRow.setAttribute("VALIGN", document.getElementById('tr_valign').value, 0);
	thisRow.setAttribute("ALIGN", document.getElementById('tr_align').value, 0);
	//  Table 
	thisTable.setAttribute("BGCOLOR", document.getElementById('table_bgcolor').value, 0);
	thisTable.setAttribute("BORDER", document.getElementById('table_border').value, 0);
	thisTable.setAttribute("CELLSPACING", document.getElementById('table_cellspacing').value, 0);
	thisTable.setAttribute("CELLPADDING", document.getElementById('table_cellpadding').value, 0);
	
	thisTable.setAttribute("WIDTH", document.getElementById('table_width').value, 0);
	
	if (thisTable.style.width)
	thisTable.style.width=document.getElementById('table_width').value;
	
	thisTable.setAttribute("HEIGHT", document.getElementById('table_height').value, 0);
	if (thisTable.style.height)
		thisTable.style.height=document.getElementById('table_height').value;
	
	thisTable.setAttribute("ALIGN", document.getElementById('table_align').value, 0);
	thisTable.setAttribute("BORDERCOLOR", document.getElementById('table_bordercolor').value, 0);
	thisTable.setAttribute("BACKGROUND", document.getElementById('tableBackground').value, 0);
	
	parentWindow.wp_current_obj.edit_object.focus();
	if (document.getElementById('table_border').value == '0') {
		parentWindow.wp_show_borders(parentWindow.wp_current_obj);
	} else if ((parentWindow.wp_current_obj.border_visible == true) && (currentBorder == 0) && (document.getElementById('table_border').value != currentBorder)) {
		parentWindow.hide_borders(parentWindow.wp_current_obj);
		parentWindow.wp_show_borders(parentWindow.wp_current_obj);
	}
	window.close();
	return false;
}
//creates the table style preview
function updateStyle() {
	// table
	document.getElementById('tbl').borderColor = document.getElementById('table_bordercolor').value;
	if (document.getElementById('collapse').checked == true) {
		document.getElementById('tbl').style.borderCollapse = "collapse";
	} else {
		document.getElementById('tbl').style.borderCollapse = "separate";
	}
	document.getElementById('tbl').setAttribute("border",document.getElementById('table_border').value);
	document.getElementById('tbl').cellPadding = document.getElementById('table_cellpadding').value; 
	document.getElementById('tbl').cellSpacing = document.getElementById('table_cellspacing').value;
	document.getElementById('tbl').style.backgroundColor = document.getElementById('table_bgcolor').value;
	document.getElementById('tbl').setAttribute("align",document.getElementById('table_align').value);
	document.getElementById('tbl').setAttribute('background', document.getElementById('tableBackground').value);
	//row
	document.getElementById('tbl_tr').setAttribute("vAlign",document.getElementById('tr_valign').value);
	document.getElementById('tbl_tr').setAttribute("align",document.getElementById('tr_align').value);
	document.getElementById('tbl_tr').style.backgroundColor = document.getElementById('tr_bgcolor').value;
	//cell
	document.getElementById('tbl_td').setAttribute("vAlign",document.getElementById('td_valign').value);
	document.getElementById('tbl_td').setAttribute("align",document.getElementById('td_align').value);
	document.getElementById('tbl_td').style.backgroundColor = document.getElementById('td_bgcolor').value;
	document.getElementById('tbl_td').setAttribute('background', document.getElementById('cellBackground').value);
}	
//-->
</script>
</head>
<body onLoad="initiate(); hideLoadMessage();">
<div align="center" id="dialogLoadMessage" style="display:block;">
	<table width="100%" height="90%">
		<tr>
			<td align="center" valign="middle"><div id="loadMessage"><?=$dl[1];?></div></td>
		</tr>
	</table>
</div><div class="dialog_content" align="center"> 
	<form id="edit_table_form" name="edit_table_form" style="display:inline" onsubmit="return apply();">
		<table id="tab_table" width="422" border="0" cellspacing="0" cellpadding="2">
			<tr> 
				<td id="tbar1" class="tbuttonUpLeft" align="center" onClick="on_enter_cell()"><nobr>&nbsp; 
					<?=$dl[46];?> &nbsp;</nobr></td>
				<td id="tbar2" class="tbuttonRight" align="center" onClick="on_enter_row()"><nobr>&nbsp; 
					<?=$dl[47];?> &nbsp;</nobr></td>
				<td id="tbar3" class="tbuttonDown" align="center" onClick="on_enter_table()"><nobr>&nbsp; 
					<?=$dl[48];?> &nbsp;</nobr></td>
				<td width="100%" style="border-bottom: 2px solid threedhighlight">&nbsp;</td>
			</tr>
		</table>
		<div id="tab_one"> 
			<table width="420" border="0" cellpadding="0" cellspacing="3" height="243">
				<tr> 
					<td> 
						<!---Cell properties----->
						<fieldset class="fieldsetLine">
						<legend><?=$dl[49];?>:</legend>
						<table width="100%" border="0" cellpadding="0" cellspacing="5">
							<tr> 
								<td width="140"><?=$dl[50];?>:</td>
								<td> <input type="text" name="td_width" id="td_width" size="6" value="" onChange="updateStyle()"></td>
							</tr>
							<tr> 
								<td width="140"><?=$dl[51];?>:</td>
								<td> <input type="text" name="td_height" id="td_height" size="6" value="" onChange="updateStyle()"></td>
							</tr>
						</table>
						</fieldset>
						<fieldset class="fieldsetLine">
						<legend><?=$dl[52];?>:</legend>
						<table width="100%" border="0" cellpadding="0" cellspacing="5">
							<tr> 
								<td width="140"><?=$dl[53];?>: </td>
								<td> <select class="text" name="td_valign" id="td_valign" style="width:100" onChange="updateStyle()">
										<option value=""><?=$dl[25];?></option>
										<option value="top"><?=$dl[29];?></option>
										<option value="middle"><?=$dl[27];?></option>
										<option value="bottom"><?=$dl[28];?></option>
										<option value="baseline"><?=$dl[32];?></option>
									</select> </td>
							</tr>
							<tr> 
								<td width="140"><?=$dl[54];?>:</td>
								<td> <select class="text" name="td_align" id="td_align" style="width:100" onChange="updateStyle()">
										<option value=""><?=$dl[25];?></option>
										<option value="left"><?=$dl[30];?></option>
										<option value="center"><?=$dl[55];?></option>
										<option value="right"><?=$dl[31];?></option>
									</select> </td>
							</tr>
						</table>
						</fieldset>
						<fieldset class="fieldsetLine">
						<legend><?=$dl[56];?>:</legend>
						<table width="100%" border="0" cellpadding="0" cellspacing="5">
							<tr> 
								<td width="140"><?=$dl[57];?>:</td>
								<td width="260"> <button class="colordisplay" type="button" onClick="colordialog(4);"> 
									<div id="tdbgchosencolor">&nbsp;</div>
									<?=$dl[58];?></button>
									<input type="hidden" name="td_bgcolor" id="td_bgcolor" value="" onChange="updateStyle()"> 
								</td>
							</tr>
							<tr> 
								<td colspan="2">&nbsp;</td>
							</tr>
							<tr> 
								<td colspan="2"> <table border="0" cellspacing="0" cellpadding="0">
										<tr> 
											<td><?=$dl[59];?>: <input type="text" style="width:225px" name="cellBackground" id="cellBackground" onChange="updateStyle()" readonly></td>
											<td> <script type="text/javascript">
											<!--//
											if (obj.imagewindow == 'image.php') {
												document.write('<button class="chooseImage" type="button" onClick="open_image_window(\'cell\')"><img src="../../images/choose_image.gif" width="18" height="15" alt=""></button>')
											}
											//-->
											</script> </td>
										</tr>
									</table></td>
							</tr>
						</table>
						</fieldset></td>
				</tr>
			</table>
		</div>
		<div id="tab_two"> 
			<table width="420" border="0" cellpadding="0" cellspacing="3">
				<tr> 
					<td> 
						<!---Row properties----->
						<fieldset class="fieldsetLine">
						<legend><?=$dl[52];?>:</legend>
						<table width="100%" border="0" cellpadding="0" cellspacing="5">
							<tr> 
								<td width="140"><?=$dl[53];?>: </td>
								<td> <select class="text" name="tr_valign" id="tr_valign" style="width:100" onChange="updateStyle()">
										<option value=""><?=$dl[25];?></option>
										<option value="top"><?=$dl[29];?></option>
										<option value="middle"><?=$dl[27];?></option>
										<option value="bottom"><?=$dl[28];?></option>
										<option value="baseline"><?=$dl[32];?></option>
									</select> </td>
							</tr>
							<tr> 
								<td width="140"><?=$dl[54];?>:</td>
								<td> <select class="text" name="tr_align" id="tr_align" style="width:100" onChange="updateStyle()">
										<option value=""><?=$dl[25];?></option>
										<option value="left"><?=$dl[30];?></option>
										<option value="center"><?=$dl[55];?></option>
										<option value="right"><?=$dl[31];?></option>
									</select> </td>
							</tr>
						</table>
						</fieldset>
						<fieldset class="fieldsetLine">
						<legend><?=$dl[56];?>:</legend>
						<table width="100%" border="0" cellpadding="0" cellspacing="5">
							<tr> 
								<td width="140"><?=$dl[57];?>:</td>
								<td width="260"> <button class="colordisplay" type="button" onClick="colordialog(3);"> 
									<div id="trbgchosencolor">&nbsp;</div>
									<?=$dl[58];?></button>
									<input type="hidden" name="tr_bgcolor" id="tr_bgcolor" value="" onChange="updateStyle()"> 
								</td>
							</tr>
						</table>
						</fieldset></td>
				</tr>
			</table>
		</div>
		<div id="tab_three"> 
			<table width="420" border="0" cellpadding="0" cellspacing="3" height="243">
				<tr> 
					<td> 
						<!---Table properties----->
						<fieldset class="fieldsetLine">
						<legend><?=$dl[60];?>:</legend>
						<table width="100%" border="0" cellpadding="0" cellspacing="5">
							<tr> 
								<td width="20%"><?=$dl[61];?>:</td>
								<td width="30%"> <input type="text" name="table_cellspacing" id="table_cellspacing" size="4" onChange="updateStyle()"></td>
								<td width="20%"><?=$dl[62];?>:</td>
								<td> <input type="text" name="table_cellpadding" id="table_cellpadding" size="4" onChange="updateStyle()"> 
								</td>
							</tr>
						</table>
						</fieldset>
						<fieldset class="fieldsetLine">
						<legend><?=$dl[73];?>:</legend>
						<table width="100%" border="0" cellpadding="0" cellspacing="3">
							<tr> 
								<td width="20%"><?=$dl[63];?>: </td>
								<td width="30%"> <input type="text" name="table_width" id="table_width" size="6"> 
								</td>
								<td width="20%"><?=$dl[64];?>: </td>
								<td> <input type="text" name="table_height" id="table_height" size="6"> 
								</td>
							</tr>
						</table>
						</fieldset>
						<fieldset class="fieldsetLine">
						<legend><?=$dl[24];?>:</legend>
						<table width="100%" border="0" cellpadding="0" cellspacing="3">
							<tr> 
								<td width="140"><?=$dl[65];?>:</td>
								<td> <select class="text" name="table_align" id="table_align" style="width:100" onChange="updateStyle()">
										<option value=""><?=$dl[25];?></option>
										<option value="left"><?=$dl[30];?></option>
										<option value="center"><?=$dl[55];?></option>
										<option value="right"><?=$dl[31];?></option>
									</select> </td>
							</tr>
						</table>
						</fieldset>
						<fieldset class="fieldsetLine">
						<legend><?=$dl[56];?>:</legend>
						<table width="100%" border="0" cellpadding="0" cellspacing="3">
							<tr> 
								<td width="20%"><?=$dl[66];?>: </td>
								<td> <input type="text" name="table_border" id="table_border" size="4" onChange="updateStyle()"></td>
								<td width="20%"><?=$dl[67];?>:</td>
								<td><input type="checkbox" name="collapse" id="collapse" value="ON" onClick="updateStyle()"> 
								</td>
							</tr>
							<tr> 
								<td width="20%"><?=$dl[57];?>:</td>
								<td> <button class="colordisplay" type="button" onClick="colordialog(2);"> 
									<div id="tablebgchosencolor">&nbsp;</div>
									<?=$dl[58];?> </button>
									<input type="hidden" name="table_bgcolor" id="table_bgcolor" value="" onChange="updateStyle()"> 
								</td>
								<td width="20%"><?=$dl[68];?>:</td>
								<td> <button class="colordisplay" type="button" onClick="colordialog(1);"> 
									<div id="tableborderchosencolor">&nbsp;</div>
									<?=$dl[58];?></button>
									<input type="hidden" name="table_bordercolor" id="table_bordercolor" value="" onChange="updateStyle()"> 
								</td>
							</tr>
							<tr> 
								<td colspan="4">&nbsp;</td>
							</tr>
							<tr> 
								<td colspan="4"> <table border="0" cellspacing="0" cellpadding="0">
										<tr> 
											<td><?=$dl[59];?>: <input type="text" style="width:225px" name="tableBackground" id="tableBackground" onChange="updateStyle()" readonly></td>
											<td> <script type="text/javascript">
											<!--//
											if (obj.imagewindow == 'image.php') {
												document.write('<button class="chooseImage" type="button" onClick="open_image_window(\'table\')"><img src="../../images/choose_image.gif" width="18" height="15" alt=""></button>')
											}
											//-->
											</script></td>
										</tr>
									</table></td>
							</tr>
						</table>
						</fieldset></td>
				</tr>
			</table>
		</div>
		<div style="position:absolute;top:325; left:5; width:420px; " id="botm"> 
			<table border="0" cellpadding="2" cellspacing="0" height="40" width="420">
				<tr> 
					<td><?=$dl[69];?>: <br> <table id="tbl_background" width="100%" height="120" cellpadding="0" cellspacing="0" style="background-color:#FFFFFF" class="previewWindow">
							<tr> 
								<td> <table cellspacing="0" cellpadding="3" border="0" height="90">
										<tr> 
											<td width="33%">&nbsp;</td>
										</tr>
										<tr> 
											<td width="34%"><?=$dl[70];?>:</td>
										</tr>
									</table></td>
								<td width="100%"> <table cellspacing="0" cellpadding="3" height="90" width="95%" id="tbl" border="0">
										<tr> 
											<td width="34%">&nbsp;</td>
											<td width="33%">&nbsp;</td>
											<td width="33%">&nbsp;</td>
										</tr>
										<tr id="tbl_tr"> 
											<td width="34%">&nbsp;</td>
											<td width="33%" id="tbl_td"><?=$dl[71];?>:</td>
											<td width="33%">&nbsp;</td>
										</tr>
									</table></td>
							</tr>
						</table></td>
				</tr>
				<tr> 
					<td align="center" height="100%" class="text" width="100%"> <button type="submit"><?=$dl[72];?></button>
						&nbsp;&nbsp; <button type="button" onClick="window.close();"><?=$dl[5];?></button></td>
				</tr>
			</table>
		</div>
	</form>
</div>
</body>
</html>
