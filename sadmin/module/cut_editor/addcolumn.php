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
if(!isset($lang))
	$lang="ru";
$dl=getlangtemplate($lang,"../../_inc/templates/reacheditdialogs");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title><?=$dl[0];?></title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
<link rel="stylesheet" href="../../css/dialoge_theme.css" type="text/css">
<script language="JavaScript" type="text/javascript" src="../../js/dialogEditorShared.js"></script>
<script language="JavaScript" type="text/javascript" src="../../js/dialogshared.js"></script>
<script type="text/javascript" language="JavaScript">
<!--//
function end() {
	if (document.getElementById('addleft').checked) {
		action="addleft"
	} else if (document.getElementById('addright').checked) {
		action="addright"
	}
	parentWindow.wp_processColumn(obj, action);
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
	<form name="add_form" id="add_form" onsubmit="return end()">
		<fieldset>
		<legend><?=$dl[2];?>:</legend>
		<table id="background" width="100%" border="0" cellspacing="3" cellpadding="0">
			<tr> 
				<td><p> 
						<input id="addleft" type="radio" name="where" value="addabove" checked="checked">
						<?=$dl[3];?></p>
					<p> 
						<input id="addright" type="radio" name="where" value="addbelow">
						<?=$dl[4];?></p></td>
			</tr>
		</table>
		</fieldset>
		<br>
		<div align="center"> 
			<button type="submit" id="ok">OK</button>
			&nbsp; 
			<button type="button" onClick="window.close();"><?=$dl[5];?></button>
		</div>
	</form>
</div>
</body>
</html>
