<?
	$at_page = 20;
	if ($show == "table")
		$at_page = 2000;

if ($_POST[compare])
	$show = "compare";
?>
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
			<tr height="1px" valign="middle">
			<td style="background:#f6f6f6;padding-top:5px;padding-bottom:5px; padding-right:40px;border:1px solid #eaeaea;">
				<table id="Table" width="100%"  border="0" cellpadding="0"  cellspacing="0">
				<tr valign="top">
				<td style="padding-left:20px;" nowrap>Производители:</td>
				<td width="100%" style="padding-left:5px;">
				<?
				$arr_products_id = Array();
				function get_level($id)
				{
					global $arr_products_id, $Q, $DB, $module_name;
					$SQL = "SELECT * FROM ".$module_name." WHERE rid = '".$id."'";
//echo "1";
					$result = $Q->query($DB, $SQL);
					for ($levels = Array(); $row = mysql_fetch_assoc($result); $levels[] = $row);
					
					for ($i = 0; $i < count($levels); $i++)
					{
						if ($levels[$i][f1] != "") {
							array_push($arr_products_id, $levels[$i][id]);
                        				}
						if($levels[$i][aname]!='e4')
				                        get_level($levels[$i][id]);
					}
				}
				
				get_level($_GET[id]);
				//print_r($arr_products_id);
				if (count($arr_products_id) > 0)
				{
					$SQL = "SELECT DISTINCT f2 FROM ".$module_name." WHERE id IN (".implode(", ", $arr_products_id).") AND aname='e4' AND f2<>''";
//echo $SQL;
					$result = $Q->query($DB, $SQL);
					$ccc=$Q->numrows();
//					echo $ccc." ";
					for ($brands = Array(); $row = mysql_fetch_assoc($result); $brands[] = $row[f2]);
//echo implode("', '", $brands);
					if (count($brands) > 0)
						echo block("id IN ('".implode("', '", $brands)."')", "brand_item", "brand_item_separator");
				}
				
				?>
				</td>
				</tr>
				</table>
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
		<table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-top:10px;<? if($show == "compare") echo "display:none;"; ?>">
		<tr height="1px">
		<?
		$link_full = get_link($_GET[id]);
		$link_tabled = get_link($_GET[id]);
		$link_full = make_link($link_full, "show=full");
		$link_tabled = make_link($link_tabled, "show=table");
		
		if ($_GET['sort'])
		{
			$link_full = make_link($link_full, "sort=".$_GET['sort']);
			$link_tabled = make_link($link_tabled, "sort=".$_GET['sort']);
		}
		if ($_GET[page])
		{
			$link_full = make_link($link_full, "page=".$_GET[page]);
			$link_tabled = make_link($link_tabled, "page=".$_GET[page]);
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
			
			$price_sort_img = "";
			$rate_sort_img = "";
			
			$arr_up = "<img src='/images/arr/arr_up.gif' border='0' align='middle'>";
			$arr_down = "<img src='/images/arr/arr_down.gif' border='0' align='middle'>";
			
			if ($_GET['sort'] == "" || $_GET['sort'] == "rate")
				$rate_sort_img = $arr_down;
			
			if ($_GET['sort'] == "rated")
				$rate_sort_img = $arr_up;
			
			if ($_GET['sort'] == "price")
				$price_sort_img = $arr_down;
			
			if ($_GET['sort'] == "priced")
				$price_sort_img = $arr_up;
			
			$sort_price = "price";
			if ($_GET['sort'] == "price")
				$sort_price = "priced";
			
			$sort_rate = "rate";
			if ($_GET['sort'] == "rate")
				$sort_rate = "rated";
			$price_sort_link = get_link($_GET[id]);
			$price_sort_link = make_link($price_sort_link, "sort=".$sort_price);
			$rate_sort_link = get_link($_GET[id]);
			$rate_sort_link = make_link($rate_sort_link, "sort=".$sort_rate);
			
			if ($_GET[page])
			{
				$price_sort_link = make_link($price_sort_link, "page=".$_GET[page]);
				$rate_sort_link = make_link($rate_sort_link, "page=".$_GET[page]);
			}
			
			$price_sort_class = "hlink";
			$rate_sort_class = "hlinkcurrent";
			if ($_GET['sort'] == "price" || $_GET['sort'] == "priced")
			{
				$price_sort_class = "hlinkcurrent";
				$rate_sort_class = "hlink";
			}
			?>
			Сортировка по:<a href="<?=$price_sort_link?>" class="<?=$price_sort_class?>">цене</a><?=$price_sort_img;?> |<a href="<?=$rate_sort_link?>" class="<?=$rate_sort_class?>">рейтингу</a><?=$rate_sort_img;?>
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
				$SQL_search = "";
				if ($_GET[extra_search])
				{
					$SQL_search = get_search_query();
				}
				$extra_search_where = "";
				if ($SQL_search)
					$extra_search_where = $SQL_search;
				
				if ($_GET[brand])
				{
					if ($is_rubrics == true)
						$brand_where = " AND id IN (SELECT rid FROM ".$module_name." WHERE f2 = '".(integer)$_GET[brand]."') ";
					else
						$brand_where = " AND f2 = '".(integer)$_GET[brand]."' ";
				}
				
				if (!$is_rubrics)
					echo showpaging("rid='".$_GET[id]."' ".$brand_where." ".$extra_search_where." ", "catalog_paging", "catalog_paging_selected", $at_page);
				?>
			</td>
		</tr>
		</table>

	</td>
	</tr>
	</table>
	<form action="<?=$_SERVER[REQUEST_URI];?>" id="compare_form" method="post">
<?
if ($show == "full" && $is_rubrics == false)
	include("_new_center_catalog_detailed.php");
elseif ($show == "table" || $is_rubrics == true)
	include("_new_center_catalog_tabled.php");
elseif ($show == "compare")
	include("_new_center_catalog_compare.php");
?>
	</form>
	
	<table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-top:0px; position:relative">
	<tr height="1px">
	<td width="100%" style="padding-left:20px;padding-bottom:30px">
		<div>
		<?
		$SQL_search = "";
		if ($_GET[extra_search])
		{
			$SQL_search = get_search_query();
		}
		$extra_search_where = "";
		if ($SQL_search)
			$extra_search_where = $SQL_search;
		//echo $extra_search_where;
		
		if ($_GET[brand])
		{
			if ($is_rubrics == true)
				$brand_where = " AND id IN (SELECT rid FROM ".$module_name." WHERE f2 = '".(integer)$_GET[brand]."') ";
			else
				$brand_where = " AND f2 = '".(integer)$_GET[brand]."' ";
		}
 if($show != "compare")
	if (!$is_rubrics)
			echo showpaging("rid='".$_GET[id]."' ".$brand_where." ".$extra_search_where." ", "catalog_paging", "catalog_paging_selected", $at_page);
		?>
		</div>
		<table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-top:25px">
		<tr height="1px"><td width="100%" style="background:#eaeaea;"></td></tr>
		</table>
		<table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-top:10px;<? if($show == "compare") echo "display:none;"; ?>">
		<tr height="1px">
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
			Сортировка по:<a href="<?=$price_sort_link?>" class="<?=$price_sort_class?>">цене</a><?=$price_sort_img?> |<a href="<?=$rate_sort_link?>" class="<?=$rate_sort_class?>">рейтингу</a><?=$rate_sort_img;?>
			<?
			}
			else
				echo "&nbsp;";
			?>
			</td>
			<td>
				&nbsp;
			</td>
		</tr>
		</table>

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