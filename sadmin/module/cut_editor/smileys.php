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
<title><?=$dl[114];?></title>
<style type="text/css">
<!--
@import url(../../css/dialoge_theme.css);
.text {
	 cursor: pointer; cursor: hand;
}
-->
</style>
<script language="JavaScript" type="text/javascript" src="../../js/dialogEditorShared.js"></script>
<script language="JavaScript" type="text/javascript" src="../../js/dialogshared.js"></script>
<script language="JavaScript" type="text/javascript">
<!-- //
var smiley = null;
function initiate() {
	document.getElementById('ok').blur();
	var kids = document.getElementsByTagName('TD');
	for (var i=0; i < kids.length; i++) {
		if (kids[i].className == "text") {
			kids[i].onmouseover = m_over;
			kids[i].onmouseout = m_out;
			kids[i].onclick = AddSmileyIcon;
		}
	}
}
function m_over() {
	if (smiley == this) return
	this.style.backgroundColor = "highlight"
	this.style.color = "highlighttext"
}
function m_out() {
	if (smiley == this) return
	this.style.backgroundColor = "threedface"
	this.style.color = "black"
}
//Function to add smiley
function AddSmileyIcon(){
	this.style.backgroundColor = "highlight"
	this.style.color = "highlighttext"
	if (smiley) {
			smiley.style.backgroundColor = "threedface";
			smiley.style.color = "black"
	}
	smiley = this

}
function insert() {
	if (smiley != null) {
		var images = smiley.getElementsByTagName('IMG');
		imagePath = images[0].src
		parentWindow.wp_create_image_html(obj,imagePath, '17', '17', '', '', '', '');
	}
	window.close();
	return false;
}
// -->
</script>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
</head>
<form name="foo" onsubmit="return insert();">
<body onLoad="initiate(); hideLoadMessage();">
<div align="center" id="dialogLoadMessage" style="display:block;">
	<table width="100%" height="90%">
		<tr>
			<td align="center" valign="middle"><div id="loadMessage"><?=$dl[1];?></div></td>
		</tr>
	</table>
</div><fieldset>
<legend><?=$dl[114];?>:</legend>
<table width="350" border="0" cellpadding="4" cellspacing="3" align="center">
	<tr> 
		<td width="50%" class="text"><img src="../../images/smileys/smiley1.gif" width="17" height="17" border="0" align="absmiddle" alt=""> 
			<?=$dl[115];?></td>
		<td width="50%" class="text"><img src="../../images/smileys/smiley9.gif" width="17" height="17" border="0" align="absmiddle" alt=""> 
			<?=$dl[116];?></td>
	</tr>
	<tr> 
		<td width="50%" class="text"><img src="../../images/smileys/smiley2.gif" width="17" height="17" border="0" align="absmiddle" alt=""> 
			<?=$dl[117];?></td>
		<td width="50%" class="text"><img src="../../images/smileys/smiley10.gif" width="17" height="17" border="0" align="absmiddle" alt=""> 
			<?=$dl[118];?></td>
	</tr>
	<tr> 
		<td width="50%" class="text"><img src="../../images/smileys/smiley3.gif" width="17" height="17" border="0" align="absmiddle" alt=""> 
			<?=$dl[119];?></td>
		<td width="50%" class="text"><img src="../../images/smileys/smiley11.gif" width="17" height="17" border="0" align="absmiddle" alt=""> 
			<?=$dl[120];?></td>
	</tr>
	<tr> 
		<td width="50%" class="text"><img src="../../images/smileys/smiley4.gif" width="17" height="17" border="0" align="absmiddle" alt=""> 
			<?=$dl[121];?></td>
		<td width="50%" class="text"><img src="../../images/smileys/smiley12.gif" width="17" height="17" border="0" align="absmiddle" alt=""> 
			<?=$dl[122];?></td>
	</tr>
	<tr> 
		<td width="50%" class="text"><img src="../../images/smileys/smiley5.gif" width="17" height="17" border="0" align="absmiddle" alt=""> 
			<?=$dl[123];?></td>
		<td width="50%" class="text"><img src="../../images/smileys/smiley13.gif" width="17" height="17" border="0" align="absmiddle" alt=""> 
			<?=$dl[124];?></td>
	</tr>
	<tr> 
		<td width="50%" class="text"><img src="../../images/smileys/smiley6.gif" width="17" height="17" border="0" align="absmiddle" alt=""> 
			<?=$dl[125];?></td>
		<td width="50%" class="text"><img src="../../images/smileys/smiley14.gif" width="17" height="17" border="0" align="absmiddle" alt=""> 
			<?=$dl[126];?></td>
	</tr>
	<tr> 
		<td width="50%" class="text"><img src="../../images/smileys/smiley7.gif" width="17" height="17" border="0" align="absmiddle" alt=""> 
			<?=$dl[127];?></td>
		<td width="50%" class="text"><img src="../../images/smileys/smiley15.gif" width="17" height="17" border="0" align="absmiddle" alt=""> 
			<?=$dl[128];?></td>
	</tr>
	<tr> 
		<td width="50%" class="text"><img src="../../images/smileys/smiley8.gif" width="17" height="17" border="0" align="absmiddle" alt=""> 
			<?=$dl[129];?></td>
		<td width="50%" class="text"><img src="../../images/smileys/smiley16.gif" width="17" height="17" border="0" align="absmiddle" alt=""> 
			<?=$dl[130];?></td>
	</tr>
</table>
</fieldset>
<br>
<div align="center"> 
	<button type="submit" id="ok">OK</button>
	&nbsp; 
	<button type="button" onClick="window.close();"><?=$dl[5];?></button>
</div></form>
</body>
</html>
