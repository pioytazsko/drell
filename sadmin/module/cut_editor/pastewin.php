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
<title><?=$dl[109];?></title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
<link rel="stylesheet" href="../../css/dialoge_theme.css" type="text/css">
<script language="JavaScript" type="text/javascript" src="../../js/dialogEditorShared.js"></script>
<script language="JavaScript" type="text/javascript" src="../../js/dialogshared.js"></script>
<script type="text/javascript" language="JavaScript">
<!--//
function start() {
	if (wp_is_ie) {
		document.frames('pasteFrame').document.designMode = "on";
		document.frames('pasteFrame').focus()
	} else {
		document.getElementById('pasteFrame').contentWindow.document.designMode = "on";
		document.getElementById('pasteFrame').contentWindow.focus()
	}
}
function html_tidy(code) { 
	code = code.replace(/<([\w]+) class=([^ |>]+)([^>]+)/gi, "<$1$3")
	code = code.replace(/<font[^>]+>/gi, "")
	code = code.replace(/<\/font>/gi, "")
	var del = new RegExp("<del[^>]+>(.+)<\/del>","gi");
	code = code.replace(del, "")
	code = code.replace(/<ins[^>]+>/gi, "")
	code = code.replace(/<\/ins>/gi, "")
	// if remove styles
	if (document.getElementById('remove_style').checked == true) {
		if (wp_is_ie) {
			code = code.replace(/<([\w]+) style="([^"]+)"/gi, "<$1 ")
			code = code.replace(/<p(.+)&nbsp;&nbsp;&nbsp;&nbsp;(.+)<\/p>/gi,"<li>$2</li>")
			code = code.replace(/<li/gi,"<ul><li")
			code = code.replace(/<\/li>/gi,"</li></ul>")
			code = code.replace(/<\/ul>\r\n<ul>/gi,"")
		} else {
			code = code.replace(/ style="([^"]+)"/gi, "")
		}
	}

	code = code.replace(/<span[^>]+>/gi, "")
	code = code.replace(/<\/span>/gi, "")
	code = code.replace(/<([\w]+) lang=([^ |>]+)([^>]+)/gi, "<$1$3")
	code = code.replace(/<xml[^>]+>/gi, "")
	code = code.replace(/<\xml[^>]+>/gi, "")
<?	
echo "	code = code.replace(/<?xml[^>]+>/gi, \"\")
";
?>
	code = code.replace(/<\?[^>]+>/gi, "")
	code = code.replace(/<\/?\w+:[^>]+>/gi, "")
	code = code.replace(/<p[^>]+><\/p>/gi,"")
	code = code.replace(/<div[^>]+><\/div>/gi,"")
	
			
	code = code.replace(/<p(.+)<\/p>/gi,"<div$1</div>")
	code = code.replace(/\/secure\.htm#/gi,"WP_BOOKMARK#")
	code = code.replace(/<a name="([^"]+)[^>]+><\/a>/gi, "<img name=\"$1\" src=\"" + parentWindow.wp_directory + "../../images/bookmark_symbol.gif\" contenteditable=\"false\" width=\"16\" height=\"13\" title=\"Bookmark: $1\" alt=\"Bookmark: $1\" border=\"0\">")
	code = code.replace(/<a name=([^>]+)><\/a>/gi, "<img name=\"$1\" src=\"" + parentWindow.wp_directory + "../../images/bookmark_symbol.gif\" contenteditable=\"false\" width=\"16\" height=\"13\" title=\"Bookmark: $1\" alt=\"Bookmark: $1\" border=\"0\">")
	code = code.replace(/href="#/gi, "href=\"WP_BOOKMARK#")
	code = code.replace(/<?=chr(171);?>/gi,"&quot;")
	code = code.replace(/<?=chr(187);?>/gi,"&quot;")
	code = code.replace(/<td([^>]+)width=([^> ]+)([ >])/gi,"<td$1$3")
	code = code.replace(/[\n\r]<p>[\n\r]/gi,"\n\r")
	code = code.replace(/<table([^>]+)width=([^> ]+)([ >])/gi,"<table$1$3")
	code = code.replace(/<table/gi,"<table width=100%")
	code = code.replace(/<table([^>]+)(cellpadding=)0([^>]+)border=1/gi,"<table$1$2\"3\"border=1 style=\"border-collapse: collapse;\" ")

	return code
}
function insert() {
	if (wp_is_ie) {
		parentWindow.wp_insert_code(obj,html_tidy(document.frames('pasteFrame').document.body.innerHTML));
	} else {
		parentWindow.wp_insert_code(obj,html_tidy(document.getElementById('pasteFrame').contentWindow.document.body.innerHTML));
	}
	window.close();
	return false;
}
//-->
</script>
</head>
<body onLoad="start(); hideLoadMessage();">
<form name="foo" onsubmit="return insert()">
<div align="center" id="dialogLoadMessage" style="display:block;">
	<table width="100%" height="90%">
		<tr>
			<td align="center" valign="middle"><div id="loadMessage"><?=$dl[1];?></div></td>
		</tr>
	</table>
</div><div class="dialog_content"> 
	<p><?=$dl[110];?></p>
	<div align="center"> 
		<iframe src="secure.htm" id="pasteFrame" class="inset" style="background-color: #ffffff; height:145px; width:98%;" frameborder="0"></iframe>
	</div>
	<div> 
		<input id="remove_style" name="remove_style" type="checkbox" value="" checked="checked">
		<?=$dl[111];?></div>
	<div align="center"> 
		<input class="button" type="submit" value="<?=$dl[112];?>" name="Insert">
		<input class="button" type="button" value="<?=$dl[5];?>" name="Cancel" onClick="window.close();">
	</div>
</div></form>
</body>
</html>
