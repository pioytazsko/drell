<html>
<head>
<title>Administration: <? echo $module_title; ?></title>
<link rel="stylesheet" href="../admin.css" type="text/css">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
</head>

<body bgcolor=#FFFFFF background="../images/adminbg.gif" rightmargin=10 leftmargin=10 topmargin=10>
<table width=100% cellpadding=5 cellspacing=2 border=1 bordercolor=#CCCCCC bgcolor=<? echo $admin_settings['tablebg']; ?>>
<tr>
<td width=90%><img src=../images/flags/<?=$adminlanguage;?>.png border=0 alt="<?=$lt[1];?>" vspace=0 hspace=0>&nbsp;<a class=menu><? echo $row[name]; ?></a></td>
<td align=center><a href=# onclick="JavaScript:window.close();" class=menu100><?=$lt[51];?></a></td>
</tr>
</table>
<?
$query="select * from ".$module_name." where id=$id and lang='".$adminlanguage."'";
$Q->query($DB,$query);
$row=$Q->getrow();
$text=ereg_replace("&quot;","\"",$row[text]);
$subject=$row[name];
$subject=convert_cyr_string($subject,"w","k");
$text=convert_cyr_string($text,"w","k");
$at=getfiles($module_filepath."/attachments/".$row[id]."/");
$p="http://".$admin_settings['site_url']."/attachments/".$row[id]."/";
$att=array();
if($at[0])
for($i=0;$i<count($at);$i++){
	$att[]=$p.$at[$i];
	}
if($att[0])
	$att=join(";",$att);
else
	$att="";

$query="select * from ".$module_name." where aname='$where' and lang='".$adminlanguage."'";
$Q->query($DB,$query);
$count=$Q->numrows();

$sent="";
$email=Array();
$fromemail="subscribe@".$admin_settings['site_url'];
if($action=="send"){
	for($i=0;$i<$count;$i++){
		$row=$Q->getrow();
		$row[name]=strtolower($row[name]);
		if(!is_email($row[name])){
//		echo $row[name]."<br>";
			continue;
			}
		$email[]=$row[name];
		$sent="ok";
		}

	$filename=time().".txt";
//echo $filename;
	$dir=$module_filepath."/sadminaddons/";
	if (!is_dir($dir))
		mkdir($dir,0777);
	$f=fopen($module_filepath."/sadminaddons/".$filename,"w");
//echo $module_filepath."/sadminaddons/".$filename;
	fputs($f,join(";",$email)."\n");
//	fputs($f,"info@sisols.com\n");
	fputs($f,$fromemail."\n");
	fputs($f,$att."\n");
	fputs($f,$subject."\n");
	fputs($f,$text);
	fclose($f);

	$y1="http://www.site985.com/sendmails.php?url=http://".$admin_settings['site_url']."/sadminaddons/".$filename;
	$resu=join("",file($y1));
	}

?>

<form action=sendletters.php method=post enctype="multipart/form-data" name=become>
<table width="100%" cellpadding="3" cellspacing="1" border=0 align="center">
<input type=hidden name=action value="send">
<input type=hidden name=id value="<?=$id;?>">
<input type=hidden name=where value="<?=$where;?>">
<tr>
	<td  align=center><?=$lt[58];?>: <b><?=$count;?></b><p>
<?
if($sent)
	echo "<b>".$resu."</b><p>
	<input type=button value=\"".$lt[51]."\" onClick=\"JavaScript:window.close();\">";
else
	echo "<input type=submit value=".$lt[57].">";
?>

</td>
</tr>
</table>
</form>
