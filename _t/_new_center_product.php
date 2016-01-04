<?
$SQL = "SELECT * FROM ".$module_name." WHERE id = '".$_GET[id]."'";
$result = $Q->query($DB, $SQL);
$product = mysql_fetch_assoc($result);

$pic = "images/pic.jpg";
if (file_exists("attachments/".$_GET[id]."/big.jpg"))
	$pic = "attachments/".$_GET[id]."/big.jpg";
if (file_exists("attachments/".$_GET[id]."/1.jpg"))
	$pic = "attachments/".$_GET[id]."/1.jpg";
	
$small_pics = "";
$pics = getfiles_pictures("attachments/".$_GET[id]."/");
for ($i = 0; $i < count($pics); $i++)
{
	if (!ereg("big\.jpg", $pics[$i]) && ereg("[0-9]+", $pics[$i]) && $pics[$i] != "1.jpg")
		$small_pics .= "
		<tr valign='top'>
			<td class='vtable'><a href='/attachments/".$_GET[id]."/".$pics[$i]."' alt='".$product[name]."' title='".$product[name]."' rel='lightbox[images]'><img src='shortimage.php?path=attachments--".$_GET[id]."--".$pics[$i]."&x=41&y=41' border='0'/></a></td>
		</tr>
		";
}

$instruction = "";
$files = getfiles("attachments/".$_GET[id]."/");
for ($i = 0; $i < count($files); $i++)
{
	$ext = split("\.", $files[$i]);
	$ext = $ext[count($ext) - 1];
	if ($ext == "pdf")
		$instruction = "/attachments/".$_GET[id]."/".$files[$i];
}

?>
<td valign="top">
 	  <table id="Table2" width="100%"  border="0" cellpadding="0"  cellspacing="0"><tr height="1px" valign="top"><td  align="left" style="padding-left:20px;padding-top:10px; padding-right:25px;">
		<table id="Table" width="100%"  border="0" cellpadding="0"  cellspacing="0">
			<tr height="1px" valign="middle">
			<td style="padding-top:5px;"><p style="margin:0px;padding-top:10px;"></p><h1 class="nobottomed"><?=$product[name];?></h1></td>
			</tr>
			<tr height="1px" valign="middle">
			<td>
			<?
				echo show_path($product[id]);
			?>
			</td>
			</tr>
			
			<tr height="1px" valign="middle">
			<td style="padding-top:35px;">
				<table id="Table" width="100%"  border="0" cellpadding="0"  cellspacing="0">
				<tr valign="top">
				<td style="padding-right:20px;">
					<a href="/shortimage.php?path=<?=str_replace("/", "--", $pic)?>&x=1024&y=768" alt='<?=$product[name];?>' title='<?=$product[name]?>' rel='lightbox[images]'><img src="/shortimage.php?path=<?=str_replace("/", "--", $pic)?>&x=286&y=179" border="0"></a>
				</td>
				<td>
					<table id="Table" width="100%"  border="0" cellpadding="0"  cellspacing="0">
					<?
						echo $small_pics;
					if($small_pics)echo '					<tr valign="top">
					<td><img src="/images/one/vtablebottom.jpg" border="0" width="76px" height="23px"/></td>
					</tr>					
';
					?>
					</table>
				</td>
				<td width="100%"></td>
				<td style="padding-left:5px" align="right">
					<table id="Table" width="100%"  border="0" cellpadding="0"  cellspacing="0">
					<tr valign="top">
					<td style="dispaly:block; padding-right:130px" nowrap align="right">
					<?
						if ($instruction != "")
						{
					?>
						<table id="Table" width="100%"  border="0" cellpadding="0"  cellspacing="0">
						<tr valign="middle" height="22px"><td width="100%"></td><td nowrap style="padding-left:26px;background:url('/images/one/pdf.jpg');background-repeat:no-repeat;"><a href="<?=$instruction;?>" class="navilinks" target="_blank">Скачать инструкцию</a></td></tr>
						</table>
						<p style="margin:0px;padding-top:30px;"></p>
					<?
						}
					?>
                    <? if ((integer)$product[f6] > 0):?>
						<span style="font-size:11px">Цена в магазине: <span style="font-size:13px"><?=number_format($product[f6]*$usd_curs, "0", "", " ");?></span>  000 </span><span style="font-size:13px">р.</span>
						<p style="margin:0px;padding-top:3px;"></p>
                    <?endif;?>
                    
                    <? if ((integer)$product[f1] > 0):?>
						<span class="redprice">Ваша цена:</span><span class="redpricebold"><?=number_format($product[f1]*$usd_curs, "0", "", " ");?> <span style="font-size:16px">000</span> р.</span>
						<br style="margin:0px;"><span style="color:#fff; font-size:14px;"><b><?=number_format(($product[f1]), "0", "", " ");?> у.е.</b></span>
                    <? endif;?>
                    

                    
                    <? if ((integer)$product[f6] > 0 && (integer)$product[f1] > 0):?>
						
						<p style="margin:0px;background-image:url('/images/spisok/economy.jpg'); background-repeat:no-repeat;width:73px;padding-bottom:10px;font-size:12px;text-align:center;padding-top:15px;padding-left:3px;"><b><?=number_format(($product[f6] - $product[f1])*$usd_curs, "0", "", " ");?><span style="font-size:11px;padding-left:3px;">000р.</span></b></p>
                    <? endif;?>
						<p style="margin:0px;padding-top:10px;"></p>
						<a href="/cart.php?id=<?=$product[id];?>&enumber=1">
						<?
						if ($product[existence] != '0' && ((integer)$product[f1] > 0 || (integer)$product[f6] > 0))
						{
							echo '<img src="/images/spisok/buy.jpg" width="81px" height="24px" border="0"/>';
						}
						else
						{
							echo '<img src="/images/spisok/order.jpg" width="81px" height="24px" border="0"/>';
						}
						?>
						</a>
						<table cellspacing="0" border="0" cellpadding="0" style="margin-top:10px;" >
						<tr><td style="color:#0A8CC6">рейтинг:&nbsp;</td>
						<?
						$rating = $product[f4];
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
							
					</td>
					</tr>
					</table>
					
				</td>
				</tr>
				</table>
				<p style="margin:0px;padding-top:15px;"></p>
				<table id="Table" width="100%"  border="0" cellpadding="0"  cellspacing="0">
				<tr valign="top">
				<td align="right">
				<?
				include("_video.php");
				?>
				</td>
				<td width="100%" style="padding-left:20px;">
				<?
				echo block("id='".$_GET[id]."'", "text");
				?>
				</td>

				</tr>
				</table>
				<p style="margin:0px;padding-top:30px;"></p>
				<table id="TableDescription" width="100%" border="0" cellpadding="0"  cellspacing="0">
				<tr>
				<td style="padding-left:20px;padding-right:30px;">
					<h3 class="descrHeader">Характеристики товара: <?=$product[name];?></h3>
					<p style="margin:0px;padding-top:10px;"></p>
					
					<?
					echo show_params($_GET[id]);
					?>
					
					<p style="margin:0px;padding-top:20px;"></p>
					<table id="TablePrice" width="100%" border="0" cellpadding="0" cellspacing="0">
					<tr valign="middle">
					<td width="100%"></td>
					<td style="display:block;" nowrap align="right">
                
                    
                    <? if ((integer)$product[f1] > 0 && $usd_curs > 0):?>
						<p style="margin:0px;padding-top:2px;"></p>
						<span style="font-size:12px;color:#25567a;"><?=number_format($product[f1]*$usd_curs, 0, "", " ");?> 000 руб</span>
                    <? endif;?>
					</td>
					<td style="padding-left:15px; padding-right:100px">
						<a href="/cart.php?id=<?=$_GET[id];?>&enumber=1"><?
						if ($product[existence] != '0' && ((integer)$product[f1] > 0 || (integer)$product[f6] > 0))
						{
							echo '<img src="/images/spisok/buy.jpg" width="81px" height="24px" border="0"/>';
						}
						else
						{
							echo '<img src="/images/spisok/order.jpg" width="81px" height="24px" border="0"/>';
						}
						?></a>
					</td>
					</tr>
					</table>
					
					<p style="margin:0px;padding-top:40px;"></p>
					<h1 class="black">Отзывы к товару: <?=$product[name];?></h1>
					
					<?
					include("_opinions.php");
					?>
					<div style="margin-top:15px">
					<?
						echo block("id = '".$product[rid]."'", "text");
					?>
					</div>
				</td>
				</tr>
				</table>

			</td>

			</tr>

		</table>	
	</td>
	<td align="right" valign="top" width="200px" style="padding-top:5px;">
		<?
		include("_new_cart.php");
		
		if ($product[f7])
		{
		?>
		
		<p style="margin:0px;padding-top:20px;"></p>

			<table id="Table_popular" width="100%" border="0" cellpadding="0"  cellspacing="0">
			<tr valign="middle" height="31px">
			<td width="3px"><img src="/images/popular/left.jpg" width="3px" height="31px"></td>
			<td width="100%" style="background-image:url('/images/popular/bg.jpg');background-repeat:repeat-x;padding-left:15px;"><a class="headlink">Сопутствующие товары</a></td>
			<td width="4px"><img src="/images/popular/right.jpg" width="4px" height="31px"></td>
			</tr>
			</table>			
			
			<?
				echo block("aname='e4' AND id IN (".$product[f7].") ORDER BY date DESC LIMIT 0,4", "popular_item_product");
		}
			?>
			
		<p style="margin:0px;padding-top:20px;"></p>
		<?
			$arr_populars = Array();
			function get_populars($id)
			{
				global $Q, $DB, $module_name, $arr_populars;
				$SQL = "SELECT * FROM ".$module_name." WHERE rid = '".$id."' ORDER BY date DESC";
				$result = $Q->query($DB, $SQL);
				for ($level = Array(); $row = mysql_fetch_assoc($result); $level[] = $row);
				
				for ($i = 0; $i < count($level); $i++)
				{
					if ($level[$i][aname] == 'e' && $level[$i][f3] == 'yes' && $level[$i][f1] != "")
						array_push($arr_populars, $level[$i][id]);
					get_populars($level[$i][id]);
				}
			}
			
			$SQL = "SELECT * FROM ".$module_name." WHERE id = '".$_GET[id]."'";
			$result = $Q->query($DB, $SQL);
			$item = mysql_fetch_assoc($result);
			if ($item[f1] != "")
				get_populars($item[rid]);
			
			if (count($arr_populars) > 0)
			{
		?>
			<table id="Table_popular" width="100%" border="0" cellpadding="0"  cellspacing="0">
			<tr valign="middle" height="31px">
			<td width="3px"><img src="/images/popular/left.jpg" width="3px" height="31px"></td>
			<td width="100%" style="background-image:url('/images/popular/bg.jpg');background-repeat:repeat-x;padding-left:15px;"><a class="headlink">Популярные товары</a></td>
			<td width="4px"><img src="/images/popular/right.jpg" width="4px" height="31px"></td>
			</tr>
			</table>			
			
			<?			
				echo block("aname='e4' AND f3='yes' AND id IN (".implode(", ", $arr_populars).") ORDER BY date DESC LIMIT 0,4", "popular_item_product");
			}
			?>

	</td>
	</tr>
	</table>
	<p style="margin:0px;padding-top:20px;">
	</p>

</td>
</tr>
</table>



</td>
</tr>