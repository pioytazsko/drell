<?
$message = "";	
//echo $_SESSION[captcha_keystring]."  ".$_POST[captcha];
if ($_POST[add_opinion])
{
	$r=getmaxid("id",$module_name);
	
	$SQL = "SELECT * FROM ".$module_name." WHERE id = '".$_POST[product_id]."'";
	$result = $Q->query($DB, $SQL);
	$product = mysql_fetch_assoc($result);
	$product_id = $_POST[product_id];
	$product_name = $product[name];
	$opinion_text = $_POST[opinion_text];
	$user_name = $_POST[user_name];
	
	if ($opinion_text != "" && $user_name != "" && $_SESSION[captcha_keystring] == $_POST[captcha])
	{
		$SQL  = "INSERT INTO ".$module_name."
		(lang, id, rid, date, aname, name, text, f1, f2)
		VALUES
		('ru', '".$r."', '64', '".date("Y-m-d H:i:s")."', 'g2', '".$product_name."', '".$opinion_text."', '".$product_id."', '".$user_name."')
		";
		$Q->query($DB, $SQL);
		
		$message = "<tr><td align=center style='color:#5065c0; font-weight:bold; padding-bottom:5px'>Спасибо, Ваш отзыв сохранён и будет отображён на сайте после проверки администрацией.</td></tr>";
		$user_name = "";
		$opinion_text = "";
	}
	else
	{
		$message = "<tr><td align=center style='color:#ff0000; font-weight:bold; padding-bottom:5px'>Заполните все поля!</td></tr>";
	}
}

echo block("f1 = '".$_GET[id]."' AND archive = 'on' ORDER BY date DESC", "opinion");	
?>
<form action="<?=$_SERVER[REQUEST_URI];?>" method="post" target="save_opinion_frame">
<input type="hidden" name="product_id" value="<?=$_GET[id];?>">
<input type="hidden" name="add_opinion" value="1">
<p style="margin:0px;padding-top:15px;"></p>	
<table id="TableFormComments" width="100%" border="0" cellpadding="0" cellspacing="0">
<?
	echo $message;
?>
<tr valign="middle">
<td width="100%" align="center">
	<span class="formtext">Имя:</span><input type="text" value="<?=$user_name?>" name="user_name" style="width:200px;font-size:12px;"/>
</td>
</tr>
<tr valign="middle">
<td width="100%" align="center">
	<p style="margin:0px;padding-top:5px;"></p>
	<textarea name="opinion_text" rows="7" style="width:340px;font-size:12px;"><?=$opinion_text?></textarea>
</td>
</tr>
<tr valign="middle">
<td width="100%" align="center">
	<p style="margin:0px;padding-top:5px;"></p>
	<table id="TableFormSubmit" width="340px" border="0" cellpadding="0" cellspacing="0">
	<tr valign="top">
	<td nowrap><span class="formtext">Ввести код:</span><input type="text" name="captcha" style="width:60px;font-size:12px;"/></td>
	<td style="padding-left:10px;"><img src="/captcha/index.php" border="0"/></td>
	<td width="100%"></td>
	<td><input type="image" src="images/one/btnComment.jpg" width="66px" height="17px"/></td>
	</tr>
	</table>
	<p style="margin:0px;padding-top:15px;"></p>
</tr>
</table>
</form>