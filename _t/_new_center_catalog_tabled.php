<table width="100%" cellspacing="0" cellpadding="0" border="0">
<tr height="1px">
	<td width="100%" style="padding-left:20px;" valign="top">
	<?
	$template = "product_item_tabled";
	if ($is_rubrics)
		$template = "catalog_rubric";
//echo $at_page.$show."0";
//if(!$_GET[show])$at_page="";
	//echo "SELECT * FROM ".$module_name." rid='".$_GET[id]."' ".$brand_where." ".$extra_search_where." ORDER BY date DESC";
//echo "rid='".$_GET[id]."' AND enabled <> 'no' ".$brand_where." ".$extra_search_where." ORDER BY ".$order;
//echo $order;
if ($is_rubrics)
	echo block("rid='".$_GET[id]."' AND enabled <> 'no'".$brand_where." ".$extra_search_where." ORDER BY date desc", $template, "", "", "", "“овары в данной рубрике отсутствуют");
else
	echo block("rid='".$_GET[id]."' AND enabled <> 'no'".$brand_where." ".$extra_search_where." ORDER BY ".$order, $template, "", "", "", "“овары в данной рубрике отсутствуют");
	?>
	</td>
</tr>
<tr height="30px">
<td width="100%">
</td>
</tr>
</table>