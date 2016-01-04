<tr height="18px">
<td width="100%">
	<table id="Table_Menudiv" width="180px"  border="0" cellpadding="0"  cellspacing="0">
		<tr height="18px" valign="middle">
		<td width="2px" style="background-image:url('/images/navright/left.jpg');background-repeat:repeat-y;"><img src="/images/navright/left.jpg" height="1px" width="2px" /></td>
		<td width="177px" style="background:#f4f6f8;padding-bottom:2px;padding-left:5px;">
			<a href="<? echo get_link('[id]');?>" class="menuleft">[name]</a>
		<?
		global $arr_path;
		
		if (in_array('[id]', $arr_path))
		{
			echo '<table id="Table_Menudiv" border="0" cellpadding="0" cellspacing="0" style="margin-top:5px;line-height:170%">';
			echo block("rid=[id] ORDER BY date DESC", "catalog_submenu");
			echo '</table>';
		}
		?>
		</td>
		<td width="1px" style="background:#afb5b9;"></td>
		</tr>
	</table>
</td>
</tr>