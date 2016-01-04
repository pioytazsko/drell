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

//include("../../_functions.php");
//echo "-".$lang;
if(!isset($lang))
	$lang="ru";
$dl=getlangtemplate($lang,"../../_inc/templates/reacheditdialogs");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
<title><?=$dl[74];?></title>
<link rel="stylesheet" href="../../css/dialoge_theme.css" type="text/css">
<script language="JavaScript" type="text/javascript" src="../../js/dialogEditorShared.js"></script>
<script language="JavaScript" type="text/javascript" src="../../js/dialogshared.js"></script>
<script language="JavaScript" type="text/javascript">
<!--//
var donereplace = false;
var donesearch = false;
var reachedbottom = false;
var do_replaceall = false;
var matches = 0;
if (wp_is_ie) {
	var rng = obj.edit_object.document.selection.createRange();
} else {
	var rng = obj.edit_object.getSelection()
}
if (wp_is_ie) {
	window.onunload = function () {
		rng=null; // releases my reference
	}
}
// returns a calculated value for matching case and
// matching whole words
function searchtype(){
  var retval = 0;
  var matchcase = 0;
  var matchword = 0;
  if (document.frmSearch.blnMatchCase.checked) matchcase = 4;
  if (document.frmSearch.blnMatchWord.checked) matchword = 2;
  retval = matchcase + matchword;
  return retval;
}
// find the text I want
function findtext(){
	reachedbottom = false
	if (document.frmSearch.strSearch.value.length < 1) {
    alert("<?=$dl[75];?>.");
  } else {
    var searchval = document.frmSearch.strSearch.value;
    // ie search routine
		if (wp_is_ie) {
			rng.collapse(false);
			if (rng.findText(searchval, 1000000000, searchtype())) {
				rng.select();
				donesearch = true
			} else {
				reachedbottom = true;
				if (!do_replaceall) {
					var startfromtop = confirm("<?=$dl[76];?>");
				} else {
					var message = "<?=$dl[77];?>";
					var startfromtop = confirm(message.replace('##matches##', matches));
					matches = 0;
				}
				if (startfromtop) {
					rng.expand("textedit"); // selects everything
					rng.collapse(); // collapse at the beginning
					rng.select(); // create the selection
					findtext(); // start again 
				} else {
					donesearch = false;
				}
			}
		} else {
		// moz search routine
			var param = null
			if (document.frmSearch.blnMatchWord.checked) {
				searchval = ' '+searchval+' ';
			}
			if (document.frmSearch.blnMatchCase.checked) { 
				param = 4
			}	
			if (obj.edit_object.find(searchval, param)) {
				donesearch = true
			} else {
				reachedbottom = true;
				var startfromtop = false;
				if (!do_replaceall) {
					startfromtop = confirm("<?=$dl[76];?>");
				} else {
					var message = "<?=$dl[77];?>";
					startfromtop = confirm(message.replace('##matches##', matches));
					matches = 0;
				}
				if (startfromtop) {
					obj.edit_object.document.execCommand('selectall', false, null);
					sel = obj.edit_object.getSelection();
					sel.removeAllRanges();
					findtext(); // start again 
				} else {
					donesearch = false;
				}
			}
		}
  }
}
function replacetext() {
	if (document.frmSearch.strSearch.value.length < 1) {
    alert("<?=$dl[75];?>");
		return;
	}
	do_replaceall = false;
	if (!donereplace && donesearch) {
		if (wp_is_ie) {
			rng.pasteHTML(document.frmSearch.strReplace.value);
		} else {
			parentWindow.wp_insert_code(obj, document.frmSearch.strReplace.value)
		}
		donereplace = true;
	} else {
		findtext()
		donereplace = false;
	}
}
function replaceall() {
	if (document.frmSearch.strSearch.value.length < 1) {
    alert("<?=$dl[75];?>");
		return;
	}
	do_replaceall = true;
	if (!reachedbottom) {
		replacetext()
		matches += 1
		replaceall()
	} else {
		return true;
	}
}
// -->
</script>
</head>
<body onLoad="hideLoadMessage();">
<div align="center" id="dialogLoadMessage" style="display:block;">
	<table width="100%" height="90%">
		<tr>
			<td align="center" valign="middle"><div id="loadMessage"><?=$dl[1];?></div></td>
		</tr>
	</table>
</div><form action="" method="post" name="frmSearch" id="frmSearch">
	<table cellspacing="0" cellpadding="5" border="0">
		<tr> 
			<td valign="top" align="left" nowrap="nowrap"> <?=$dl[78];?>: 
				<br> <input type="text" size="20" name="strSearch" id="strSearch" style="width:200px;"> 
				<br> <?=$dl[79];?>: 
				<br> <input type="text" size="20" name="strReplace" id="strReplace" style="width:200px;"> 
				<br> <input type="checkbox" name="blnMatchCase" id="blnMatchCase"> 
				<?=$dl[80];?> <br> 
				<input type="checkbox" name="blnMatchWord" id="blnMatchWord"> <label for="blnMatchWord" id="blnMatchWordLabel"><?=$dl[81];?></label> 
			<script language="JavaScript" type="text/javascript">
if (!document.all) {
	document.getElementById('blnMatchWord').style.display = 'none';
	document.getElementById('blnMatchWordLabel').style.display = 'none';
}
</script>		
			</td>
			<td rowspan="2" valign="top"> <button type="button" onClick="do_replaceall=false;findtext();" style="margin-top:5px"><?=$dl[82];?></button><br> 
				<button type="button" onClick="replacetext();" style="margin-top:2px"><?=$dl[83];?></button><br> 
				<button type="button" onClick="matches=0;reachedbottom=false;replaceall();" style="margin-top:2px"><?=$dl[84];?></button><br> 
				<button type="button" onClick="window.close();" style="margin-top:18px"><?=$dl[85];?></button></td>
		</tr>
	</table>
</form>
</body>
</html>
