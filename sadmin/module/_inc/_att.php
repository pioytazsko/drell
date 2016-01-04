<?
// ATTACHMENTS
$dfile=strtolower($attachments_name);
$dir=$module_filepath."/attachments/".$id;
$imfile=$dir."/".$dfile;
$uplfile=$module_filepath."/base/".$dfile;
if (!is_dir($dir))
	mkdir($dir,0777);

if($attachments)
	{
	if(file_exists($imfile))
		unlink($imfile);
	$success = @copy($attachments,$imfile);

	// katalog
	$query = "SELECT * FROM ".$module_name." where id=".$id;
	$Q->query($DB, $query);
	$row=$Q->getrow();
	$rid1=(integer)$row[rid];

	if($rid1==3)
		$success = @copy($imfile,$uplfile);
	}
?>

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
<form action=attachments.php method=post enctype="multipart/form-data" name=become>
<table width="100%" cellpadding="3" cellspacing="1" border=0 align="center">
<input type=hidden name=id value="<?=$id;?>">
<?
if($fields[22]==$aaname){
	if($fields[5]!=""){
		echo "
			<tr>
			<td  align=center colspan=2><hr size=1 color=#009900></td>
		</tr>
		<tr>
			<td align=left colspan=2>";
		include("_attbody.php");
		echo "</td>
		</tr>
		<tr>
			<td  align=center colspan=2>&nbsp;<br>&nbsp;</td>
		</tr>";
		}
	}
else	{
	echo "
	<tr>
		<td  align=center colspan=2><hr size=1 color=#009900></td>
	</tr>
	<tr>
		<td align=left colspan=2>";
	include("_attbody.php");
	echo "</td>
	</tr>
	<tr>
		<td  align=center colspan=2>&nbsp;<br>&nbsp;</td>
	</tr>";
	}


?>
</table>
</form>
