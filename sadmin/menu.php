<?                          
include("_functions.php");
include("_admin_config.php");
include("_config.php");
include("_mysql.php");
include("_checking.php");

$lt=getlangtemplate($adminlanguage,"_inc/templates/menu");

$i=0;

$f=$lt[5]."(changepassword/index.php)
".$lt[6]."(changelanguage/index.php)
".$lt[8]."(stat/index.php)
".$lt[9]."(mail/index.php)
Consult(ready/newmod.php)
".$lt[7]."(doc/index.php)";
if($root)$f.="
Get dump (dump/getdump.php)
Upload dump (dump/uploaddump.php)";
$f=split("[\r\n]+",$f);
for($i=0;$i<count($f);$i++)
	{
	$structure[$i]=$f[$i];
	$t=structure_item($i);
	$s[0]=$t[0];
	$s[1]=$t[1];
	$s[2]=structure_itemlevel($i);
	$structure[$i]=$s;
	}

include("_loadmenu.php");
?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
<link rel="stylesheet" href="admin.css" type="text/css">
<title>Administration</title>
</head>

<body bgcolor=#FFFFFF background="images/adminbg.gif" rightmargin=10 leftmargin=10 topmargin=10>
<center>
<table width=100% cellpadding=5 cellspacing=2 border=1 bordercolor=#CCCCCC bgcolor=<? echo $admin_settings['tablebg']; ?>>
<tr>
<td><img src=images/flags/<?=$adminlanguage;?>.png border=0 vspace=0 hspace=0>&nbsp;<a href=../../ target=_blank class=menu><?=$admin_settings['site_name'];?></a></td>
</tr>
</table>
<p>
<?
if(ereg("password",$adminpassword) || ereg("username",$adminusername))
	echo "
<table width=100% cellpadding=5 cellspacing=2 border=1 bordercolor=#FF0000 bgcolor=".$admin_settings['inputbg'].">
<tr>
<td>".$lt[10]."</td>
</tr>
</table>
		";
?>
<div id=dmenu align=left></div>

<p>
<script language=JavaScript>
var menunames,menulinks,menulevels,nodes,framewidth;

<?
$menunames="";
$menulevels="";
$menulinks="";
for($i=0;$i<count($structure);$i++){
	$menunames[$i]=$structure[$i][0];
	$menunames[$i][0]=mystrtohigher($menunames[$i][0]);
	$menulinks[$i]=ereg_replace("\.\.\/","",$structure[$i][1]);
	$menulinks[$i]=ereg_replace("/$","",$menulinks[$i]);
	$menulevels[$i]=$structure[$i][2]+1;
	$nodes[$i]="plus";
	}
$menunames="'".join("','",$menunames)."'";
$menulinks="'".join("','",$menulinks)."'";
$menulevels=join(",",$menulevels);
$nodes="'".join("','",$nodes)."'";

?>

menunames=[<?=$menunames;?>];
menulinks=[<?=$menulinks;?>];
menulevels=[<?=$menulevels;?>];
nodes=[<?=$nodes;?>];

for(i=0;i<menunames.length;i++){
	if(menulinks[i]!='#')
		nodes[i]='empty';
	}

function showmenu(){
var i,level,s,sign,skip,skiplevel,pevent,j,im;
level=0;
skip=0;
skiplevel=0;
s='';
for(i=0;i<menunames.length;i++){
	if(skip && (menulevels[i]>skiplevel))
		continue;
	else
		skip=0;
	if((level+1)==menulevels[i]){
		s=s+'<ul>';
		}
	if(level>menulevels[i])
		for(j=0;j<(level-menulevels[i]);j++)
			s=s+'</ul>';
	if(nodes[i]!='empty')
		pevent="onClick=\"JavaScript:if(nodes["+i+"]=='plus')nodes["+i+"]='minus';else nodes["+i+"]='plus';showmenu();\"";
	else
		pevent=' target=mainright ';
	im='<img src=images/menu'+nodes[i]+'.gif border=0 width=9 height=9> ';
	if(menunames[i]=='---'){
		s=s+'<hr size=1 color=#746541>';
		}
	else
		s=s+'<li>'+'<a href='+menulinks[i]+' '+pevent+' class=menulink>'+im+menunames[i]+'</a>';
	level=menulevels[i];
	if(nodes[i]=='plus'){
		skip=1;
		skiplevel=menulevels[i];
		}
	}
if(level>1)
	for(j=1;j<level;j++)
		s=s+'</ul>';
s=s+'<hr size=1 color=#746541>';
s='<ul><li><a href="dir.php" class=menulink target="mainright" ><img src="images/menuempty.gif" border="0" height="9" width="9">Импорт/экспорт</a></li></ul>'+s;
s='<ul><li><a href="complect.php" class=menulink target="mainright" ><img src="images/menuempty.gif" border="0" height="9" width="9">Комплекты</a></li></ul>'+s;
dmenu.innerHTML=s;
}

showmenu();
</script>
    
<div align=right><a href="index.php?action=logout" target=_top class=sign>[ <?=$lt[0];?> ]</a></div>
<p>
  
    


</script>
</body>
</html>