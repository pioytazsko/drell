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
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
<title><?=$dl[12];?></title>
<link rel="stylesheet" href="../../css/dialoge_theme.css" type="text/css">
<script language="JavaScript" type="text/javascript" src="../../js/dialogEditorShared.js"></script>
<script language="JavaScript" type="text/javascript" src="../../js/dialogshared.js"></script>
<script type="text/javascript">
<!--//
function initialize() {
	document.getElementById('name').focus();
}
function create_bookmark () {
	parentWindow.wp_create_bookmark(obj,document.getElementById('name').value)
	window.close();
	return false;
}
//-->
</script>
</head>
<body bgcolor="threedface" onLoad="initialize();hideLoadMessage();">
<div align="center" id="dialogLoadMessage" style="display:block;">
	<table width="100%" height="90%">
		<tr>
			<td align="center" valign="middle"><div id="loadMessage"><?=$dl[1];?></div></td>
		</tr>
	</table>
</div><div class="dialog_content" align="center"> 
	<form name="hyperlink_form" id="hyperlink_form" onsubmit="return create_bookmark();">
		<table border="0" cellspacing="0" cellpadding="2">
			<tr> 
				<td><?=$dl[13];?>:<br> <input name="name" id="name" type="text" style="width: 286px" value=""> 
				</td>
			</tr>
		</table>
		<br>
		<div align="center"> 
			<button type="submit">OK</button>
			&nbsp;&nbsp; 
			<button type="button" onClick="window.close();"><?=$dl[5];?></button>
		</div>
	</form>
</div>
</body>
</html>
