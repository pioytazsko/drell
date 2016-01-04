<tr valign="top" height="266px">
<td width="100%" style="padding-left:20px; padding-right:20px;" valign="top">
	<table id="Table_Top" width="100%" border="0" cellpadding="0"  cellspacing="0" align="center">
	<tr valign="top" height="266px">
	<td align="right" width="100%" valign="top">
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
		</div>		
	</td>