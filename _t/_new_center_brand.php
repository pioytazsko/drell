<td valign="top">
 	  <table id="Table2" width="100%"  border="0" cellpadding="0"  cellspacing="0"><tr height="1px" valign="top"><td  align="left" valign="top" style="padding-left:20px;padding-top:10px; padding-right:15px;">
		<table id="Table" width="100%"  border="0" cellpadding="0"  cellspacing="0">
			<tr height="1px" valign="middle">
			<td valign="top">
			<?
			echo show_path($_GET[id]);
			?>
			</td>
			</tr>
			<tr height="1px" valign="middle">
			<td style="padding-top:5px;"><h1><?=block("id='".$_GET[id]."'", "name");?></h1></td>
			</tr>
			<tr height="1px" valign="middle">
			<td style="padding-top:10px;padding-bottom:10px;">
			<?
			echo block("id='".$_GET[id]."'", "f3");
			?>
			</td>
			</tr>
		</table>	
	</td>
	<td align="right" width="195px" style="padding-top:5px;">
	<?
	include("_new_cart.php");
	?>
	
	</td>
	</tr>
	</table>
	<table width="100%" cellspacing="0" cellpadding="0" border="0">
	<tr height="1px">
	<td width="100%" style="padding-left:20px;padding-top:10px;padding-bottom:30px;">
		<table width="100%" cellspacing="0" cellpadding="0" border="0">
		<tr height="1px"><td width="100%" style="background:#eaeaea;"></td></tr>
		</table>
		<table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-top:10px;">
		<tr height="1px">
		<?
		$is_rubrics = true;
		$SQL = "SELECT * FROM ".$module_name." WHERE rid = '".$_GET[id]."' AND f1<>''";
		$result = $Q->query($DB, $SQL);
		if (mysql_num_rows($result) > 0)
			$is_rubrics = false;
		
		$link_full = "/catalog.php?id=".$_GET[id];
		$link_tabled = "/catalog.php?id=".$_GET[id];
		$link_full .= "&show=full";
		$link_tabled .= "&show=table";
		if ($_GET[page])
		{
			$link_full .= "&page=".$_GET[page];
			$link_tabled .= "&page=".$_GET[page];
		}
		?>
			<td align="left" nowrap>
			<?
			if ($is_rubrics == false)
			{
			?>
			Вид:<a href="<?=$link_full;?>" class="<?=($show=="full"?"hlinkcurrent":"hlink")?>">подробный</a>|<a href="<?=$link_tabled;?>" class="<?=($show=="table"?"hlinkcurrent":"hlink")?>">табличный</a>
			<?
			}
			else
				echo "&nbsp;"
			?>
			</td>
			<td width="100%" align="center">
			<?
			if ($is_rubrics == false)
			{
			?>
			Сортировка по:<a href="##" class="hlinkcurrent">цене</a>|<a href="##" class="hlink">рейтингу</a>
			<?
			}
			else
				echo "&nbsp;";
			?>
			</td>
			<!--
			<td align="left" style="padding-right:7px;">Страницы:</td>
			-->
			<td>
				<?
				$SQL = "SELECT DISTINCT rid FROM ".$module_name." WHERE f2 = '".$_GET[id]."' ORDER BY date DESC";
				$result = $Q->query($DB, $SQL);
				for ($rubrics_by_brand = Array(); $row = mysql_fetch_assoc($result); $rubrics_by_brand[] = $row[rid]);
				
				if (mysql_num_rows($result) > 0)
					echo showpaging("id IN (".implode(", ", $rubrics_by_brand).")", "catalog_paging", "catalog_paging_selected", 200);
				?>
			</td>
		</tr>
		</table>

	</td>
	</tr>
	</table>
	
	<table width="100%" cellspacing="0" cellpadding="0" border="0">
	<tr height="1px">
		<td width="100%" style="padding-left:20px;">
		<?
			if (mysql_num_rows($result) > 0)
				echo block("id IN (".implode(", ", $rubrics_by_brand).")  ORDER BY date DESC", "catalog_rubric_by_brand", "", "", 200);
			else
				echo "Рубрики отсутствуют";
		?>
		</td>
	</tr>
	<tr height="30px">
	<td width="100%">
	</td>
	</tr>
	</table>
	
	<table id="Table_news" width="100%" border="0" cellpadding="0"  cellspacing="0" style="margin-bottom:20px;">
	<tr valign="top">
	<td width="11px"></td>
	<td class="news">
	<?
	echo block("id='".$_GET[id]."'", "text");
	?>
	</td>
	<td width="7px"></td>
	</tr>
	
	</table>


	</td>

      </tr>
      </table>



	</td>


	</tr>
	</table>




</td>
</tr>