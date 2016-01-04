<tr valign="top" height="266px">
<td width="100%" style="padding-left:20px; padding-right:20px;">
	<table id="Table_Top" width="100%" border="0" cellpadding="0"  cellspacing="0" align="center">
	<tr valign="top" height="266px">
	<td align="right" width="100%">
	<table id="Table_Menu" width="100%" border="0" cellpadding="0"  cellspacing="0">
	<tr>
	<td align="right" width="200px" valign="top">
		<div style="position:relative;top:-20px;">
		<table id="Table_Menu" width="180px" border="0" cellpadding="0"  cellspacing="0" >
		<tr height="4px">
		<td><img src="/images/navright/top.jpg" height="4px" width="180px" /></td>
		</tr>
		<?
		$arr_path = get_path_id($_GET[id]);
		echo block("rid=16 ORDER BY date DESC", "catalog_item", "catalog_item_separator");
		?>
		<tr height="4px">
		<td><img src="/images/navright/bottom.jpg" height="4px" width="180px" /></td>
		</tr>

		</table>
		
		
	
		
		<p style="margin:0px;padding-top:15px;"></p>
		<?
			$arr_populars = Array();
			function get_populars($id)
			{
				global $Q, $DB, $module_name, $arr_populars;
//echo $id."/";
				$SQL = "SELECT * FROM ".$module_name." WHERE rid = '".$id."' ORDER BY date DESC";
				$result = $Q->query($DB, $SQL);
				for ($level = Array(); $row = mysql_fetch_assoc($result); $level[] = $row);
				
				for ($i = 0; $i < count($level); $i++)
				{
					if ($level[$i][aname] == 'e4' && $level[$i][f3] == 'yes' && $level[$i][f1] != "")
						array_push($arr_populars, $level[$i][id]);
					if($level[$i][aname] != 'e4')
						get_populars($level[$i][id]);
				}
			}
			
			$SQL = "SELECT * FROM ".$module_name." WHERE id = '".$_GET[id]."'";
			$result = $Q->query($DB, $SQL);
			$item = mysql_fetch_assoc($result);

			if ($item[f1] != "")
				get_populars($item[rid]);
			else
				get_populars($item[id]);
			
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
				echo block("aname='e4' AND f3='yes' AND id IN (".implode(", ", $arr_populars).") ORDER BY date DESC LIMIT 0,4", "popular_item_catalog", "", "", "", "");
			}
		?>
		
		</div>
	</td>