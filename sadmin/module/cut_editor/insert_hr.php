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
<title><?=$dl[104];?></title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
<link rel="stylesheet" href="../../css/dialoge_theme.css" type="text/css">
<script language="JavaScript" type="text/javascript" src="../../js/dialogEditorShared.js"></script>
<script language="JavaScript" type="text/javascript" src="../../js/dialogshared.js"></script>
<script type="text/javascript">
<!--//
function wp_docolor(obj,Action,color) {   
	if (color != null) {
		if (Action == 1){
			document.hr_form.color.value = color;
			document.getElementById('borderchosencolor').style.backgroundColor = color;
		}
	}
}
// creates the ruler attribute strings
function insertruler() {
	var code;
	var align;
	var color;
	var size;
	var width;
	if (document.hr_form.align.value == "") {
		align = "";
	} else {
		align = " align=" + document.hr_form.align.value + " ";
	} 
	if (document.hr_form.color.value == "") {
		color = "";
	} else {
		color = ' color="'+ document.hr_form.color.value +'" style="background-color:' + document.hr_form.color.value + '\" noshade="noshade"';
	} 
	if (document.hr_form.size.value == "") {
		size = "";
	} else {
		size = " size=" + document.hr_form.size.value + " ";
	} 
	if (document.hr_form.width.value == "") {
		width = "";
	} else {
		width = " width=" + document.hr_form.width.value + document.hr_form.percent2.value + " ";
	} 	
	if (document.all) {
		code="<hr " + align + color + size + width + ">";
		parentWindow.wp_create_hr(obj, code);
	} else {
		parentWindow.wp_create_hr(obj,document.hr_form.align.value,document.hr_form.color.value,document.hr_form.size.value,document.hr_form.width.value,document.hr_form.percent2.value);
	}
	window.close();
	return false;
}
//-->
</script>
</head>
<body onLoad="hideLoadMessage();">
<div align="center" id="dialogLoadMessage" style="display:block;">
	<table width="100%" height="90%">
		<tr>
			<td align="center" valign="middle"><div id="loadMessage"><?=$dl[1];?></div></td>
		</tr>
	</table>
</div><div class="dialog_content" align="center"> 
	<form name="hr_form" id="hr_form" onsubmit="return insertruler();">
		<fieldset>
		<legend>Horizontal Rule:</legend>
		<table cellpadding="1" cellspacing="3" border="0" width="204">
			<tr> 
				<td><?=$dl[24];?>:</td>
				<td> <select name="align" id="align" style="width:100; ">
						<option selected="selected" value=""><?=$dl[25];?></option>
						<option value="left"><?=$dl[30];?></option>
						<option value="center"><?=$dl[55];?></option>
						<option value="right"><?=$dl[31];?></option>
					</select> </td>
			</tr>
			<tr> 
				<td><?=$dl[16];?>:</td>
				<td> <input type="text" name="size" id="size" style="width:100;"></td>
			</tr>
			<tr> 
				<td><?=$dl[15];?>:</td>
				<td> <input type="text" name="width" id="width" size="4"> <select name="percent2" id="percent2" style="width:55; font-family:Verdana">
						<option value="%" selected="selected">%</option>
						<option value="px">px.</option>
					</select> </td>
			</tr>
			<tr> 
				<td><?=$dl[105];?>:</td>
				<td> <button class="colordisplay" type="button" onClick="colordialog(1);"> 
					<div id="borderchosencolor">&nbsp;</div>
					<?=$dl[58];?></button>
					<input type="hidden" name="color" id="color" value=""> </td>
			</tr>
		</table>
		</fieldset>
		<br>
		<button type="submit">OK</button>
		&nbsp;&nbsp; 
		<button type="button" onClick="window.close();"><?=$dl[5];?></button>
		<br>
	</form>
</div>
</body>
</html>
