<?
include("../../url/url.php");
// ATTACHMENTS
$dfile=strtolower($attachments_name);
$dir=$module_filepath."/attachments/".$id;
$imfile=$dir."/".$dfile;
$uplfile=$module_filepath."/base/".$dfile;
if (!is_dir($dir))
	mkdir($dir,0777);
else
	chmod($dir,0777);

if($attachments=="none")
	$attachments="";
if($attachments)
	{
	if(file_exists($imfile))
		unlink($imfile);
	$success = @copy($attachments,$imfile);
	$rid1=(integer)$newch[rid];
	// katalog
	if($rid1==3)
		$success = @copy($imfile,$uplfile);
	}

if ($newch[existence] == "") {
    $newch[existence] = 0;
}

$ddate=convdate($newch[date]);
$query="UPDATE ".$module_name." SET 
date='$ddate',
rid=".((integer)$newch[rid]).",
access='$newch[access]',
aname='$newch[aname]',
name='$newch[name]',
anons='$newch[anons]',
text='$newch[text]',
archive='$newch[archive]',
f1='$newch[f1]',
f2='$newch[f2]',
f3='$newch[f3]',
f4='$newch[f4]',
f5='$newch[f5]',
f6='$newch[f6]',
f7='$newch[f7]',
f8='$newch[f8]',
f9='$newch[f9]',
f10='$newch[f10]',
url='$newch[url]',
title='$newch[title]',
description='$newch[description]',
keywords='$newch[keywords]',
existence='$newch[existence]'
 WHERE id=$id";

$Q->query($DB,$query);

if ($newch[aname] == "h2")
{
	$SQL = "UPDATE ".$module_name." SET f2 = '".$_POST[field_type]."' WHERE id = $id";
	$Q->query($DB, $SQL);
}

//get_htaccess();
?>
