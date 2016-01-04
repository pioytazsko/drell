<? 
include("../../url/url.php");

$r=getmaxid("id",$module_name);

// ATTACHMENTS
$id=$r;
$dfile=strtolower($attachments_name);
$dir=$module_filepath."/attachments/".$id;
$imfile=$dir."/".$dfile;
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
	}

$newch[lang]=$adminlanguage;
$ddate=convdate($newch[date]);
$query="INSERT INTO ".$module_name." VALUES($r,$newch[rid],'$newch[access]','$newch[aname]','$newch[lang]','$ddate','$newch[name]','$newch[anons]','$newch[text]','$newch[archive]','$newch[f1]','$newch[f2]','$newch[f3]','$newch[f4]','$newch[f5]','$newch[f6]','$newch[f7]','$newch[f8]','$newch[f9]','$newch[f10]', '', '', '$newch[url]', '$newch[title]', '$newch[description]', '$newch[keywords]')";
$Q->query($DB,$query);
//get_htaccess();
?>
