<script>
function set_image(img_name, div_id, images_count)
{
	//alert(img_name + "   " + div_id + "  " + images_count);
	for (i = 0; i < images_count; i++)
	{
		document.getElementById("div_"+i).style.border = "1px solid #ffcc00";
	}
	document.getElementById(div_id).style.border = "1px solid #ff0000";
	document.getElementById("big_img").src = img_name;
}
</script>
<?
$div_num = 0;
$dir = opendir("attachments/".$_GET[id]);
while ($file = readdir($dir))
{
	if ($file != '.' && $file != '..' && (ereg("jpg", $file) || ereg("gif", $file) || ereg("png", $file)))
	{
		if ($file == urldecode($_GET[img]))
			$color = "#ff0000";
		else
			$color = "#ffcc00";
		$images .= "<div id='div_".$div_num."' style='float:left; border:1px solid ".$color."; margin-right:1px; cursor:pointer' align='center' onclick='set_image(\"attachments/".$_GET[id]."/".$file."\", this.id, {img_count})'><img src='shortimage.php?x=70&y=70&path=attachments--".$_GET[id]."--".$file."' border=0></div>";
		$div_num++;
	}
}
$images = str_replace("{img_count}", $div_num, $images);

$big_image = "<img id='big_img' src='attachments/".$_GET[id]."/".urldecode($_GET[img])."' border=0>";
?>
<table border="0" cellpadding="0" cellspacing="0">
<tr>
	<td align="center" valign="middle" width="400" height="400">
	<?=$big_image;?>
	</td>
</tr>
<tr>
	<td align="center">
	<?=$images;?>
	</td>
</tr>
</table>