	<td align="left" valign="top" style="padding-left:5px; padding-right:5px">
		<table cellspacing="0" width="100%" cellpadding="0" border="0" style="margin-top:5px">
		<tr>
			<td height="265" width="320">
			<?
			$SQL = "SELECT * FROM ".$module_name." WHERE rid=3 AND archive = 'on' ORDER BY date DESC";
			$result = $Q->query($DB, $SQL);
			for ($arr_news = Array(); $row = mysql_fetch_assoc($result); $arr_news[] = $row);
			
			echo '
			<script>
			var arr_banners = Array();
			';
			
			for ($i = 0; $i < count($arr_news); $i++)
			{
				echo "\r arr_banners.push(".$arr_news[$i][id].");";
			}
			
			echo '
			</script>
			';
			
			echo block("rid=3 AND archive = 'on' ORDER BY date DESC", "news_banner_image");
			?>
			</td>
			<td valign="top">
			<?
			//echo block("rid=3 AND archive = 'on' ORDER BY date DESC", "news_banner");
			
			$SQL = "SELECT * FROM ".$module_name." WHERE rid = 3 AND archive = 'on' ORDER BY date DESC";
			$result = $Q->query($DB, $SQL);
			for ($news = Array(); $row = mysql_fetch_assoc($result); $news[] = $row);
			
			$x = 265/(count($news) + 0.625);
			
			echo "
			<script>
				var height_active = ".round($x*1.625).";
				var height_inactive = ".round($x).";
			</script>
			";
			
			for ($i = 0; $i < count($news); $i++)
			{
				if ($i == 0)
				{
					$left_class = "banner_left_top_active";
					$center_class ="banner_center_top_active";
					$right_class = "banner_right_top_active";
				}
				elseif ($i == count($news) - 1)
				{
					$left_class = "banner_left_bottom";
					$center_class ="banner_center_bottom";
					$right_class = "banner_right_bottom";
				}
				else
				{
					$left_class = "banner_left";
					$center_class ="banner_center";
					$right_class = "banner_right";
				}
				
				echo '
				<table width="100%" id="news_'.$news[$i][id].'" border=0 cellspacing=0 cellpadding=0>
				<tr>
					<td class="'.$left_class.'" id="left_'.$news[$i][id].'">
						<div></div>
					</td>
					<td class="'.$center_class.'" id="center_'.$news[$i][id].'" valign="middle" onmouseover="showNewsDescr(this,\''.$news[$i][id].'\')" style="font-weight:bold" align="left">
						<div style="margin-left:10px">
						<a href="'.get_link($news[$i][id]).'" style="text-decoration:none; font-weight:bold; font-size:17px; color:#000000" title="'.$news[$i][name].'">'.$news[$i][name].'</a>
						<div>
					</td>
					<td class="'.$right_class.'" id="right_'.$news[$i][id].'">
						<div style="width:10px"></div>
					</td>
				</tr>
				</table>
				';
			}
			?>
			</td>
		</tr>
        <tr>
            <td colspan="2" style="padding: 10px;">
            <?
            for ($i = 0; $i < count($news); $i++) {
                echo '
                <div style="display:none; font-weight:normal" onmouseover="cancelhideNewsDescr()" id="anons_'.$news[$i][id].'">
					'.$news[$i][anons].'
				</div>
                ';
            }
            
            echo '
			<script>
			show_banner('.$arr_news[0][id].');
			</script>
			';
            ?>
            </td>
        </tr>
		</table>
		<div align="right">
			<a href="<?=get_link(5805)?>">Узнать про все акции</a>
		</div>
	</td>
	</tr>
	</table>

	<table id="Table_Catalog" width="100%" border="0" cellpadding="0"  cellspacing="0" align="center">
	<tr>
	<td align="left" width="100%" style="padding-left:20px;padding-top:35px;">
	<?
	echo block("rid=16 ORDER BY date DESC", "main_rubric");
	?>
	</td>
	</tr>
	</table><br clear=all>
	<div align=left style="padding:20px;">
	<?
	echo block("id=5867", "text");
	?>
	</div>
    
    <div align="center">
    <?
    $SQL = "SELECT * FROM ".$module_name." WHERE rid = 16";
    $result = $Q->query($DB, $SQL);
    for ($rubrics = array(); $row = mysql_fetch_assoc($result); $rubrics[] = $row['id']);
    
    $SQL = "SELECT * FROM ".$module_name." WHERE rid = 16 OR rid IN (".implode(", ", $rubrics).") ORDER BY name";
    $result = $Q->query($DB, $SQL);
    for ($rubrics = array(); $row = mysql_fetch_assoc($result); $rubrics[] = $row);
    
    $columns_count = 3;
    
    $count_at_column = ceil(count($rubrics)/$columns_count);
    
    $column_width = floor(100/$columns_count);
    
    $letter = "";
    ?>
    
    
    </div>
	</td>

	<td align="right" width="195px" style="padding-top:5px;">
		<?
		include("_new_cart.php");
		?>

		
		
		<table id="Table_manufact" width="188px" border="0" cellpadding="0"  cellspacing="0" style="margin-top:15px;" >
		<tr height="31px">
		<td align="left" width="3px"><img src="/images/manufact/left.jpg" border="0" width="3px" height="31px"/></td>
		<td align="left" width="181px" style="background-image:url('/images/manufact/bg.jpg'); background-repeat:repeat-x;">
			<table id="Table" width="100%"  border="0" cellpadding="0"  cellspacing="0">
				<tr height="31px" valign="middle">
				<td width="130px" style="padding-left:15px;"><a href="/page.php?id=175" class="headlink">Производители</a></td>
				<td width="50px"><a href="/page.php?id=175"><img src="/images/manufact/all.jpg" border="0" height="13px" width="42px"></a></td>
				</tr>
			</table>
		</td>
		<td align="left" width="4px"><img src="/images/manufact/right.jpg" border="0" width="4px" height="31px"/></td>
			
		</tr>
		</table>
		<table id="Table_manufact" width="188px" border="0" cellpadding="0"  cellspacing="0">
		<tr>
		<td align="left" width="188px" style="background-image:url('/images/manufact/bgbottom.jpg'); background-repeat:repeat-y;padding-top:10px;padding-bottom:25px;">
			<table id="Table" width="100%"  border="0" cellpadding="0"  cellspacing="0">
			<?
			echo block("rid=30 ORDER BY date DESC LIMIT 0,15", "manufacturer_item_main");
			?>
			</table>
		</td>
		</tr>
		<tr valign="middle" height="25px">
		<td width="188px"><img src="/images/manufact/bottom.jpg" border="0" height="25px" width="188px"></td>
		</tr>

		</table>

	
	</td>

	</tr>
	</table>

</td>
</tr>