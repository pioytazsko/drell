<?
	$images = "";
	//echo "/attachments/".$_GET[id]."/";
	$dir = opendir("attachments/".$_GET[id]);
	while ($file = readdir($dir))
	{
		if ($file != '.' && $file != '..' && $file != 'big.jpg' && (strpos($file, "jpg") || strpos($file, "gif") || strpos($file, "png") || strpos($file, "jpeg")))
			$images .= "<div onclick='nwindow(\"product_image.php?id=".$_GET[id]."&img=".urlencode($file)."\")' style='float:left; border:1px solid #ffcc00; margin-right:1px; cursor:pointer' align='center'><img src='shortimage.php?x=70&y=70&path=attachments--".$_GET[id]."--".$file."' border=0></a></div>";
	}
	
	if (file_exists("attachments/".$_GET[id]."/big.jpg"))
		$big_image = "attachments--".$_GET[id]."--big.jpg";
	else
		$big_image = "images/noimage.jpg";
?>
<table class="main" border=0>
<tr><td class="maintitle" colspan="2">Интернет-магазин элекстоинструментов</td></tr>
<tr>
	<td>
		<img src="shortimage.php?x=250&y=250&path=<?=$big_image?>">
	</td>
	<td>
		<?=$images;?>
	</td>
</tr>
<tr>
	<td colspan="2">
<?
	$SQL = "SELECT * FROM ".$module_name." WHERE id = '".$_GET[id]."'";
	$result = $Q->query($DB, $SQL);
	$product = mysql_fetch_assoc($result);
	
	$SQL = "SELECT * FROM ".$module_name." WHERE aname = 'h2' AND f1 = '".$product[rid]."'";
	$result = $Q->query($DB, $SQL);
	$params_rubric = mysql_fetch_assoc($result);
	
	$SQL = "SELECT * FROM ".$module_name." WHERE rid = '".$params_rubric[id]."'";
	$result = $Q->query($DB, $SQL);
	for ($params = Array(); $row = mysql_fetch_assoc($result); $params[] = $row);
	
	$output = "<table cellspacing=0 cellpadding=0 border=1>";
	
	for ($i = 0; $i < count($params); $i++)
	{
		$SQL = "SELECT * FROM char_values WHERE product_id = '".$_GET[id]."' AND char_id = '".$params[$i][id]."'";
		$result = $Q->query($DB, $SQL);
		$value = mysql_fetch_assoc($result);
		
		if ($params[$i][f2] == "" || $params[$i][f2] == 1)
		{
			$SQL = "SELECT * FROM ".$module_name." WHERE id = '".$value[value_id]."'";
			$result = $Q->query($DB, $SQL);
			$value = mysql_fetch_assoc($result);
			$value = $value[name];
		}
		elseif ($params[$i][f2] == 2)
		{
			$value = $value[value_id];
		}
		
		$output .= "
		<tr>
			<td>
				".$params[$i][name]."
			</td>
			<td>
				".$value."
			</td>
		</tr>
		";
	}
	
	$output .= "</table>";
	echo $output;
?>
	<a href="cart.php?id=<?=$_GET[id]?>&enumber=1&rand=<?=md5(time())?>&eprice=<?=$product[f1]?>">Купить</a>
	</td>
</tr>
<tr>
	<td colspan="2" style="padding-top:15px">
	<?
	include("_t/_video.php");
	?>
	</td>
</tr>
<tr>
	<td colspan="2" style="padding-top:15px">
	<?
	include("_t/_opinions.php");
	?>
	</td>
</tr>
</table>

<table class="info" border=0>
<tr>
<td><img src="images/info_1.jpg" height="30" width="17" border="0"></td>
<td>
<table class="infotitle"><tr><td><img src="images/info_title.jpg" height="30" width="98" border="0"></td>
	<td class="infoh1"><img src="images/blank.gif" height="30" width="1" border="0"></td>
</tr></table>
</td>
<td><img src="images/info_4.jpg" height="30" width="17" border="0"></td>
</tr>
<tr><td class="infov1"><img src="images/blank.gif" height="1" width="17" border="0"></td>
<td class="text">
<?
	echo block("id=15", "text");
?>
</td>
<td class="infov2"><img src="images/blank.gif" height="1" width="17" border="0"></td></tr>
<tr><td><img src="images/info_3.jpg" height="13" width="17" border="0"></td><td class="infoh2"><img src="images/blank.gif" height="13" width="1" border="0"></td><td><img src="images/info_6.jpg" height="13" width="17" border="0"></td></tr>
</table>