<?
global $usd_curs;

$SQL = "SELECT * FROM ".$module_name." WHERE id = '[f2]'";
$result = $Q->query($DB, $SQL);
$brand = mysql_fetch_assoc($result);
$brand_name = $brand['name'];

$images = getfiles_pictures("attachments/[id]/");
$images_count = 0;
for ($j = 0; $j < count($images); $j++)
{
	if ($images[$j] != "big.jpg" && $images[$j] != "1.jpg")
		$images_count++;
}

$SQL = "SELECT COUNT(*) FROM video WHERE product_id = [id]";
$result = $Q->query($DB, $SQL);
$video_count = mysql_fetch_assoc($result);
$video_count = $video_count['COUNT(*)'];
if (!$video_count)	$video_count = 0;

$anons = '[anons]';

$img = "/shortimage.php?path=attachments--[id]--big.jpg&x=186&y=165";
if (file_exists("attachments/[id]/1.jpg"))
	$img = "/shortimage.php?path=attachments--[id]--1.jpg&x=186&y=165";
?>
<table width="100%" cellspacing="0" cellpadding="0" border="0">
<tr height="1px">
<td width="100%" style="padding-left:20px;">
	<table width="100%" cellspacing="0" cellpadding="0" border="0">
	<tr height="1px" valign="top">
	<td width="100%" style="padding-bottom:5px;">
	<a href="<? echo get_link('[id]');?>" class="goodname">[name]</a>
    <table cellpadding="0" cellspacing="0">
    <tr>
    <td style="height: 20px; font-size: 12px; padding: 4px 0px 4px 20px; color: #D60000; 
    <?
    if ($anons != "")
    {
        echo 'background: url(/images/red_bullet.gif); background-repeat: no-repeat; background-position: 0px 3px;';
    }?>">
        [anons]
    </td>
    </tr>
    </table>
    
	<table width="100%" cellspacing="0" cellpadding="0" border="0">
	<tr valign="top">
		<td align="left" style="padding-right:15px;">
            <a href="<? echo get_link('[id]');?>">
                <img src="<? echo $img;?>" border="0"/>
            </a>
        </td>
		<td width="100%" valign="top">
			<?
			echo show_params('[id]', 1);
			?>
		</td>
	</tr>
	</table>		
	</td>
	<td width="150px" style="padding-left:10px; padding-right:25px;dispaly:block;">
	<?
	if ("[archive]" == "on")
		echo '<img src="/images/spisok/spec.jpg" width="108px" height="18px" border="0" style="margin-bottom:5px;margin-top:10px;" />';
		
	?>
		<span style="padding-right:3px;">Производитель:</span><a href="<? echo get_link($brand['id']);?>" class="manufacturerLinks"><? echo $brand_name;?></a>
		<table cellspacing="0" border="0" cellpadding="0" style="margin-top:15px;margin-bottom:30px;" >
		<tr><td style="color:#0A8CC6">рейтинг:&nbsp;</td>
		<?
		$rating = "[f4]";
		for ($j = 0; $j < 5; $j++)
		{
			$rating_class = "rate_inactive";
			if ($j < $rating)
				$rating_class = "rate_active";
			echo '
			<td class="'.$rating_class.'">
				<div></div>
			</td>
			';
		}
		?>
		</tr>
		</table>
		<nobr>
		<input type="checkbox" name="compare[]" value="[id]" id="check_[id]" /><span style="font-size:9px;color:#999999;"><label for="check_[id]">Выбрать</label> | <a style="font-size:9px;color:#999999;cursor:pointer" onclick="document.getElementById('compare_form').submit()">Сравнить</a></span></nobr>
	</td>
	<td width="1px" style="background:#eaeaea;padding-left:1px;"></td>
	<td width="220px" style="padding-right:15px;dispaly:block;" nowrap="nowrap" align="right">
    <div style="height: 130px;">
    <?
    if ((integer)'[f6]' > 0) {
        echo '<span>Цена в магазине:</span><span style="font-size:13px"><b> '.number_format('[f6]'*$usd_curs, 0, "", " ").' </span><span style="font-size:11px">000 </span><span style="font-size:13px">р.<b></span>
		<p style="margin:0px;padding-top:3px;"></p>';
    }
    ?>
	<?
    if ((integer)'[f1]' > 0) {
        echo '<span class="redprice">Ваша цена:</span><span class="redpricebold">'.number_format('[f1]'*$usd_curs, 0, "", " ").'<span style="font-size:14px"> 000 р.</span></span>
		<p style="margin:0px;padding-top:2px;"></p>';
    }
    ?>

    <?
    if ((integer)'[f6]' > 0 && (integer)'[f1]' > 0) {
        echo '
        <p style="margin:0px;padding-top:1px;padding-bottom:2px; font-size:12px;color:#fff;">'.number_format('[f1]', 0, "", " ").' у.е.</p>
		<p style="margin:0px;background-image:url(\'/images/spisok/economy.jpg\'); background-repeat:no-repeat;width:73px;padding-bottom:10px;font-size:12px;text-align:center;padding-top:15px;padding-left:3px;"><b>'.number_format(('[f6]' - '[f1]')*$usd_curs, 0, "", " ").'</b><span style="font-size:11px;padding-left:3px;">000р</span></p>
        ';
    }
    ?>
    </div>
        <p style="margin:0px;padding-top:10px;"></p>
        <div align="center"  style="padding-left: 27px;">
		<a href="/cart.php?id=[id]&enumber=1">
		<?
		if ('[existence]' != '0' && ((integer)'[f1]' > 0 || (integer)'[f6]' > 0))
		{
			echo '<img src="/images/spisok/buy.jpg" width="101px" border="0"/>';
		}
		else
		{
			echo '<img src="/images/spisok/order.jpg" width="101px" border="0"/>';
		}
		?></a>
        </div>
	</td>
	</tr>
	</table>

</td>
</tr>
<tr height="1px">
<td width="100%" style="padding-left:20px;">
	<table width="100%" cellspacing="0" cellpadding="0" border="0">
	<tr height="15px"><td width="100%" style="background:#eaeaea;padding-top:1px;"></td></tr>
	</table>
</td>
</tr>
<tr height="20px">
<td width="100%">
</td>
</tr>

</table>