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
<title><?=$dl[86];?></title>
<style type="text/css">
<!--
@import url(../../css/dialoge_theme.css);
p {
	margin:2px
}
.tbuttonUp {
	width: 88px;
	height: 68px;
	padding: 2px;
	border: 1px solid threedface;
	background-color: threedface;
	cursor: default;
	text-align:center;
	display: block;
}
.tbuttonDown {
	width: 88px;
	height: 68px;
	padding: 2px;
	border-top: 1px solid buttonshadow;
	border-left: 1px solid buttonshadow;
	border-bottom: 1px solid buttonhighlight;
	border-right: 1px solid buttonhighlight;
	background-color: #EEEEEE;
	cursor: default;
	text-align:center;
	display: block;
}
.tbuttonOver {
	width: 88px;
	height: 68px;
	padding: 2px;
	border-bottom: 1px solid buttonshadow;
	border-right: 1px solid buttonshadow;
	border-top: 1px solid buttonhighlight;
	border-left: 1px solid buttonhighlight;
	background-color: threedface;
	cursor: default;
	text-align:center;
	display: block;
}
#outlookbar {
	height:301; 
	border-top:1px solid threedshadow; 
	border-bottom: 1px solid threedhighlight; 
	border-left: 1px solid threedshadow; 
	border-right: 1px solid threedhighlight
}
-->
</style>
<script language="JavaScript" type="text/javascript" src="../../js/dialogEditorShared.js"></script>
<script language="JavaScript" type="text/javascript" src="../../js/dialogshared.js"></script>
<script type="text/javascript">
<!--//
var CURRENT_HIGHLIGHT
function highlight(srcElement) {
	if (CURRENT_HIGHLIGHT) {
		CURRENT_HIGHLIGHT.style.backgroundColor='#ffffff';
		CURRENT_HIGHLIGHT.style.color ='#003399';
	}
	document.getElementById(srcElement).style.backgroundColor='highlight';
	document.getElementById(srcElement).style.color = 'highlighttext';
	CURRENT_HIGHLIGHT = document.getElementById(srcElement);
}
function initialize() {
	kids = document.getElementById('outlookbar').getElementsByTagName('div');
	for (var i=0; i < kids.length; i++) {
		if (kids[i].className == "tbuttonUp") {
			kids[i].onmouseover = m_over;
			kids[i].onmouseout = m_out;
			kids[i].onmousedown = m_down;
			kids[i].onclick = m_click;
		}
	}
	// show links
	document.getElementById('links').innerHTML = obj.links;
	// show anchors
	var anchors = obj.edit_object.document.getElementsByTagName('IMG');
	var anchorLinks = '<p><a class="filelink" id="#" style="height:22px; margin:0px 0px 0px 0px;" href="#" onClick="javascript:highlight(\'#\');localLink(\'#\');" title="URL: #"><img src="../../images/spacer.gif" width="1" height="22" alt="" border="0" align="absmiddle"><?=$dl[87];?></a></p>\n';
	var l=anchors.length
	anchorLinks+='<p><b><img src="../../images/spacer.gif" width="1" height="22" alt="" border="0" align="absmiddle"><?=$dl[88];?>:</b></p>';
	for (var i=0; i < l; i++) {
		if ((anchors[i].getAttribute('name')) && (anchors[i].src.search("images/bookmark_symbol.gif") != -1)) {
			var name = anchors[i].getAttribute('name')
			var nameSlashed = name.replace(/'/, "\\'")
			anchorLinks += '<p><a class="filelink" id="#'+name+'" style="height:22px; margin:0px 0px 0px 0px;" href="#" onClick="javascript:highlight(\'#'+nameSlashed+'\');localLink(\'#'+nameSlashed+'\');" title="URL: #'+name+'"><img src="../../images/bookmark.gif" width="22" height="22" alt="" border="0" align="absmiddle">'+name+'</a></p>\n'
		}
	}

	<?
	if($id)echo "createlinksdata('".$id."');";
	else echo "createlinksrubrics();";
        ?>
	

	if (obj.showbookmarkmngr == true) {
		document.getElementById('page_button').style.display='block';
	}
	if (obj.links != '') {
		document.getElementById('site_button').style.display='block';
	}
	document.getElementById('anchors').innerHTML = anchorLinks;
	var current_href = parentWindow.wp_current_hyperlink;
	if ((current_href!="") && (current_href!=null)) {
		if (document.getElementById(current_href)) {
			document.getElementById(current_href).style.backgroundColor='highlight';
			document.getElementById(current_href).style.color = 'highlighttext';
			CURRENT_HIGHLIGHT = document.getElementById(current_href);
			if ((current_href.substring(0,1) == "#") && (obj.showbookmarkmngr == true)) {
				document.getElementById('page_address').value = current_href;
				document.getElementById('page_title').value = "";
				showAnchors();
			} else {
				document.getElementById('site_target').value = ""
				document.getElementById('site_target_list').value = ""
				document.getElementById('site_title').value = ""
				document.getElementById('site_address').value = current_href;
				showLinks();
				localLink(current_href);
			}
			document.getElementById(current_href).focus();
		} else if (current_href.substring(0,7) == "mailto:") {
			var email_array = current_href.split('?subject=');
			document.getElementById('email_address').value = email_array[0];
			if (email_array[1]) {
				document.getElementById('email_subject').value = email_array[1];
			}
			document.getElementById('email_title').value = ""
			showEmail();
		} else {
			document.getElementById('web_target').value = ""
			document.getElementById('web_target_list').value = ""
			document.getElementById('web_address').value = current_href;
			document.getElementById('web_title').value = ""
			showWeb();
		}	
	} else if (obj.links != '') {
		showLinks();
	} else {
		showWeb();
	}
}

function createlinksrubrics(){
var fileLinks;
<?
if((isset($id)) && ($id!="undefined"))
	{
  $e="";
  $filelink="";
  $start=0;
  if($id){
	  $query="select * from ".$module_name." where id=".$id;
	  $Q->query($DB,$query);
	  $row=$Q->getrow();
	  $ids[0]=$id;
	  $names[0]=$row[name];
	  $start=1;
	}

  $query="select * from ".$module_name." where lang='$lang' and aname='material'";
  $Q->query($DB,$query);
  $count=$Q->numrows();
  for($i=$start;$i<($count+$start);$i++){
	$row=$Q->getrow();
	$ids[$i]=$row[id];
	$names[$i]=$row[name];
        }

  for($i=0;$i<=$count;$i++){
	$e[$i]='<p><a class="filelink"  id="ff'.$i.'" style="height:22px; margin:0px 0px 0px 0px;" href="#" onClick="javascript:highlight(\\\'ff'.$i.'\\\');createlinksdata('.$ids[$i].');" title=""><img src="../../images/spacer.gif" width=1 height=22 alt="" border="0" align="absmiddle"><font color=#000000>'.$names[$i].'</font></a></p>';
	}
  }
if(trim($e[0])!="")
	$filelink="'".join("",$e)."';
";
	echo "fileLinks = ".$filelink;
?>
document.getElementById('web_links').innerHTML = fileLinks;
}

function createlinksdata(atid){
var fileLinks,fileIds;
fileLinks=new Array();
fileIds=new Array();
<?
if((isset($id)) && ($id!="undefined"))
	{
  $e="";
  $filelink="";
  $query="select * from ".$module_name." where lang='$lang' and aname='material'";
  $Q->query($DB,$query);
  $count=$Q->numrows();
  $ids[0]=$id;
  for($i=1;$i<=$count;$i++){
        $row=$Q->getrow();
        $ids[$i]=$row[id];
                }
  for($uy=0;$uy<=$count;$uy++){
	echo "fileIds[".$ids[$uy]."]=".$uy.";
";
	$mas=getfiles($module_filepath."/attachments/".$ids[$uy]."/");
	if($mas[0]!=""){
		for($i=0;$i<count($mas);$i++){
			$ppath[$i]=$module_filepath."/attachments/".$ids[$uy]."/";
			$ppath[$i]=$ppath[$i].$mas[$i];
			}
//	$e[0]='<p><a class=\"filelink\"  id=\"ff0\" style=\"height:22px; margin:0px 0px 0px 0px;\" href=\"#\" onClick=\"javascript:highlight(\\\'ff0\\\');fileLink(\\\'..\\\');\" title=\"URL: #\"><img src=\"../../images/spacer.gif\" width=1 height=22 alt=\"\" border=\"0\" align=\"absmiddle\">..</a></p>';
	for($i=0;$i<count($mas);$i++){
		$filesize=ceil(filesize($ppath[$i])/1000);
		$ext=split("\.",mystrtohigher($mas[$i]));
		$ext=$ext[count($ext)-1];
		$ext1=strtolower($ext);
		$ext1=ereg_replace("jpeg","jpg",$ext1);
		$emp="";
		if($filesize>0){
			if(($ext=="JPG") || ($ext=="JPEG") || ($ext=="GIF")){
				$s=getimagesize($ppath[$i]);
			        $ext.=" ".$s[0]."x".$s[1]."px";
				$ttt="<img src=../../images/".$ext1."_icon.gif width=23 height=22 alt=\"\" border=0 align=absmiddle>".$mas[$i].$emp;
				}
			else	{
				$s="";
			        $ext.="";
				$ttt=$mas[$i].$emp;
				}
			}

		if($filesize==0)$ttt.=" (".$dl[141].")";

		$e[$uy][$i]='<p><a class="filelink"  id="ff'.$i.'" style="height:22px; margin:0px 0px 0px 0px;" href="#" onClick="javascript:highlight(\\\'ff'.$i.'\\\');fileLink(\\\''.ereg_replace($module_filepath."/","/",$ppath[$i]).'\\\');" title="URL: #"><img src="../../images/spacer.gif" width=1 height=22 alt="" border="0" align="absmiddle">'.$ttt.' - ('.$ext.' '.$dl[17].': '.$filesize.'K)</a></p>';
		}
		}
	$e[$uy][$i]='<p><a class="filelink"  id="ff'.$i.'" style="height:22px; margin:0px 0px 0px 0px;" href="#" onClick="javascript:highlight(\\\'ff'.$i.'\\\');createlinksrubrics();" title=""><img src="../../images/spacer.gif" width=1 height=22 alt="" border="0" align="absmiddle"><--</a></p>';
  	   }
	}

for($i=0;$i<=$count;$i++){
	$filelink[$i]="'".$e[$i][1]."';
";
	if(count($e[$i])>1){
			$filelink[$i]="'".join("",$e[$i])."';
";
		}
	echo "fileLinks[".$i."] = ".$filelink[$i];
	}
?>                                   
document.getElementById('web_links').innerHTML = fileLinks[fileIds[atid]];
}

function m_over () {
	if (this.className!='tbuttonDown') {
		this.className = 'tbuttonOver';
	}
}
function m_out() {
	if (this.className!='tbuttonDown') {
		this.className = 'tbuttonUp';
	}
}
function m_down() {
	if (this.className!='tbuttonDown') {
		this.className = 'tbuttonDown';
	}
}
function m_click() {
	kids = document.getElementById('outlookbar').getElementsByTagName('div');
	for (var i=0; i < kids.length; i++) {
		if (kids[i].className == "tbuttonDown") {
			if (kids[i] != this) {
				kids[i].className = "tbuttonUp";
			}
		}
	}
	if (this.id=='site_button') {
		showLinks();
	} else if (this.id=='page_button') {
		showAnchors();
	} else if (this.id=='email_button') {
		showEmail();
	} else if (this.id=='web_button') {
		showWeb();
	}
}
function linkit() {
	var address = '';
	var target = '';
	var title = '';
	if (document.getElementById('placeonthissite').style.display == 'block') {
		address = document.getElementById('site_address').value;
		target = document.getElementById('site_target').value;
		title = document.getElementById('site_title').value;
	} else if (document.getElementById('placeonthispage').style.display == 'block') {
		address = document.getElementById('page_address').value;
		title = document.getElementById('page_title').value;	
	} else if (document.getElementById('email').style.display == 'block') {
		if (document.getElementById('email_address').value.substring(0,7) == "mailto:") {
			address = document.getElementById('email_address').value
		} else {
			address = 'mailto:' + document.getElementById('email_address').value
		}
		if (document.getElementById('email_subject').value != '') {
			address = address + '?subject=' + document.getElementById('email_subject').value;
		}
		title = document.getElementById('email_title').value;
	} else if (document.getElementById('external').style.display == 'block') {
		address = document.getElementById('web_address').value;
		target = document.getElementById('web_target').value;
		title = document.getElementById('web_title').value;
	} else {
		window.close();
		return false;
	}
	parentWindow.wp_hyperlink(obj,address,target,title);
	top.window.close();
	return false;
}
function localLink(page) {
	if (document.getElementById('placeonthissite').style.display == 'block') {
		document.getElementById('site_address').value=page;
	} else if (document.getElementById('placeonthispage').style.display == 'block') {
		document.getElementById('page_address').value=page;
	}
	preview(page)
}
function fileLink(page) {
	if (document.getElementById('external').style.display == 'block') {
		document.getElementById('web_address').value=page;
	}
}
function preview(url) {
	if (document.getElementById('placeonthissite').style.display == 'block') {
		var previewPane = 'site_preview';
	} else if (document.getElementById('external').style.display == 'block') {
		var previewPane = 'web_preview';
	} else {
		return true;
	}
	if (url.substring(0,1) == "#") {
		nopreview = true;
	} else if (url.substring(0,5) == "file:") {
		nopreview = true;
	} else if (url.substring(0,4) == "ftp:") {
		nopreview = true;
	} else if (url.substring(0,7) == "gopher:") {
		nopreview = true;
	} else if (url.substring(0,7) == "mailto:") {
		nopreview = true;
	} else if (url.substring(0,5) == "news:") {
		nopreview = true;
	} else if (url.substring(0,5) == "wais:") {
		nopreview = true;
	} else if (url.substring(0,5) == "http:") {
		nopreview = false;
	} else if (url.substring(0,6) == "https:") {
		nopreview = false;
	} else {
		nopreview = false;
	} 
	if (nopreview) {
		if (wp_is_ie) {
			document.frames(previewPane).location.href = 'blank.php?lang=<?=$adminlanguage;?>';
		} else {
			document.getElementById(previewPane).contentWindow.document.open();
			document.getElementById(previewPane).contentWindow.document.write('<div align="center" style="font-family:verdana"><br><br><?=$dl[18];?></div>');
			document.getElementById(previewPane).contentWindow.document.close();
		}
	} else if (wp_is_ie) {
		document.frames(previewPane).location.href = url;
	} else {
		document.getElementById(previewPane).contentWindow.location.assign(url);
	}
}
function showLinks() {
	document.getElementById('site_button').className = 'tbuttonDown';
	document.getElementById('placeonthissite').style.display = 'block';
	document.getElementById('placeonthispage').style.display = 'none';
	document.getElementById('email').style.display = 'none';
	document.getElementById('external').style.display = 'none';
}
function showAnchors() {
	document.getElementById('page_button').className = 'tbuttonDown';
	document.getElementById('placeonthissite').style.display = 'none';
	document.getElementById('placeonthispage').style.display = 'block';
	document.getElementById('email').style.display = 'none';
	document.getElementById('external').style.display = 'none';
}
function showEmail() {
	document.getElementById('email_button').className = 'tbuttonDown';
	document.getElementById('placeonthissite').style.display = 'none';
	document.getElementById('placeonthispage').style.display = 'none';
	document.getElementById('email').style.display = 'block';
	document.getElementById('external').style.display = 'none';
}
function showWeb() {
	document.getElementById('web_button').className = 'tbuttonDown';
	document.getElementById('placeonthissite').style.display = 'none';
	document.getElementById('placeonthispage').style.display = 'none';
	document.getElementById('email').style.display = 'none';
	document.getElementById('external').style.display = 'block';
}
//-->
</script>
</head>
<body scroll="no" onLoad="initialize(); hideLoadMessage();">
<div align="center" id="dialogLoadMessage" style="display:block;">
	<table width="100%" height="90%">
		<tr>
			<td align="center" valign="middle"><div id="loadMessage"><?=$dl[1];?></div></td>
		</tr>
	</table>
</div><form name="form1" id="form1" onsubmit="return linkit();">
	<table width="100%" border="0" cellspacing="0" cellpadding="4">
		<tr> 
			<td valign="top" width="90" align="center"><p><?=$dl[89];?>:</p>
				<div id="outlookbar"> 
					<div class="tbuttonUp" id="site_button" style="display:none"> 
						<p><img src="../../images/spacer.gif" width="1" height="3" alt=""><br>
							<img src="../../images/file_on_this_site.gif" width="22" height="23" alt=""></p>
						<p><?=$dl[90];?></p>
					</div>
					<div class="tbuttonUp" id="page_button" style="display:none"> 
						<p><img src="../../images/spacer.gif" width="1" height="3" alt=""><br>
							<img src="../../images/place_on_this_page.gif" width="22" height="23" alt=""></p>
						<p><?=$dl[91];?></p>
					</div>
					<div class="tbuttonUp" id="email_button" style="display:block"> 
						<p><img src="../../images/spacer.gif" width="1" height="3" alt=""><br>
							<img src="../../images/email_address.gif" width="22" height="23" alt=""></p>
						<p><?=$dl[92];?></p>
					</div>
					<div class="tbuttonUp" id="web_button" style="display:block"> 
						<p><img src="../../images/spacer.gif" width="1" height="3" alt=""><br>
							<img src="../../images/external_link.gif" width="22" height="23" alt=""></p>
						<p><?=$dl[93];?></p>
					</div>
				</div></td>
			<td><div id="placeonthissite" style="display:none"> 
					<table width="100%" border="0" cellspacing="0" cellpadding="4">
						<tr> 
							<td> <div id="links" style="width:250px; height:223px; background-color:#FFFFFF; border: 2px inset threedface; overflow:auto; padding:5px 5px"> 
									<!-- a list of links to pages on your site should be generated below: -->
								</div></td>
							<td> <iframe id="site_preview" class="previewWindow" security="restricted" frameborder="0" width="250" height="221" src="blank.php?lang=<?=$adminlanguage;?>"></iframe> 
							</td>
						</tr>
					</table>
					<table width="100%" border="0" cellspacing="3" cellpadding="1">
						<tr> 
							<td><?=$dl[94];?>:</td>
							<td><input type="text" size="50" name="site_address" id="site_address" value="" onChange="preview(this.value)" title="Example: /folder/document.html"></td>
						</tr>
						<tr> 
							<td width="60"><?=$dl[42];?>:</td>
							<td> <input type="text" size="50" name="site_title" id="site_title" value="" title="Creates a pop-up message like what you are reading now."> 
							</td>
						</tr>
						<tr> 
							<td width="60"><?=$dl[95];?>:</td>
							<td> <select name="site_target_list" id="site_target_list" onChange="document.getElementById('site_target').value=this.options[this.selectedIndex].value">
									<option value="" selected="selected"><?=$dl[25];?></option>
									<option value="_self"><?=$dl[96];?></option>
									<option value="_blank"><?=$dl[97];?></option>
									<option value="_parent"><?=$dl[98];?></option>
									<option value="_top"><?=$dl[99];?></option>
								</select> <input type="text" size="23" name="site_target" id="site_target" value=""></td>
						</tr>
					</table>
				</div>
				<div id="placeonthispage" style="display:none"> 
					<table width="100%" border="0" cellspacing="0" cellpadding="4">
						<tr> 
							<td> <div id="anchors" style="width:500px; height:250px; background-color:#FFFFFF; border: 2px inset threedface; overflow:auto; padding:5px 5px"> 
									<!-- a list of bookmarks in this page will be generated below: -->
								</div></td>
						</tr>
					</table>
					<table width="100%" border="0" cellspacing="3" cellpadding="1">
						<tr> 
							<td><?=$dl[94];?>:</td>
							<td><input type="text" size="50" name="page_address" id="page_address" value="" onChange="preview(this.value)" title="<?=$dl[100];?>: #bookmarkName"></td>
						</tr>
						<tr> 
							<td width="60"><?=$dl[42];?>:</td>
							<td> <input type="text" size="50" name="page_title" id="page_title" value="" title="<?=$dl[43];?>."> 
							</td>
						</tr>
					</table>
				</div>
				<div id="email" style="display:none"> 
					<table width="100%" border="0" cellspacing="3" cellpadding="1">
						<tr> 
							<td width="100"><?=$dl[101];?>:</td>
							<td><input type="text" size="50" name="email_address" id="email_address" value="" onChange="preview(this.value)" title="<?=$dl[100];?>: me@mycompany.com"></td>
						</tr>
						<tr> 
							<td width="100"><?=$dl[102];?>:</td>
							<td><input type="text" size="50" name="email_subject" id="email_subject" value="" title="<?=$dl[103];?>"></td>
						</tr>
						<tr> 
							<td width="100"><?=$dl[42];?>:</td>
							<td> <input type="text" size="50" name="email_title" id="email_title" value="" title="<?=$dl[43];?>"> 
							</td>
						</tr>
					</table>
				</div>
				<div id="external" style="display:none"> 
					<table width="100%" border="0" cellspacing="0" cellpadding="4">
						<tr> 
							<td> <div id="web_links" style="width:500px; height:250px; background-color:#FFFFFF; border: 2px inset threedface; overflow:auto; padding:5px 5px"> 
								</div></td>
						</tr>
					</table>
					<table width="100%" border="0" cellspacing="3" cellpadding="1">
						<tr> 
							<td><?=$dl[94];?>:</td>
							<td><input type="text" size="50" name="web_address" id="web_address" value="" title="<?=$dl[100];?>: http://www.website.com/about/index.html">
						</tr>
						<tr> 
							<td width="60"><?=$dl[42];?>:</td>
							<td> <input type="text" size="50" name="web_title" id="web_title" value="" title="<?=$dl[43];?>"> 
							</td>
						</tr>
						<tr> 
							<td width="60"><?=$dl[95];?>:</td>
							<td> <select name="web_target_list" id="web_target_list" onChange="document.getElementById('web_target').value=this.options[this.selectedIndex].value">
									<option value="" selected="selected"><?=$dl[25];?></option>
									<option value="_self"><?=$dl[96];?></option>
									<option value="_blank"><?=$dl[97];?></option>
									<option value="_parent"><?=$dl[98];?></option>
									<option value="_top"><?=$dl[99];?></option>
								</select> <input type="text" size="23" name="web_target" id="web_target" value=""></td>
						</tr>
					</table>
				</div></td>
		</tr>
	</table>
	<br>
	<div align="center"> 
		<button type="submit">OK</button>
		&nbsp;&nbsp; 
		<button type="button" onClick="top.window.close();"><?=$dl[5];?></button>
	</div>
</form>
</body>
</html>
