<?
	echo block("rid='".$_GET[id]."' AND enabled <> 'no' ".$brand_where." ".$extra_search_where." ORDER BY date DESC", "product_item_detailed", "", "", 20, "<span style=\"padding-left:20px;\">“овары в данной рубрике отсутствуют</span>");
?>