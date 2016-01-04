<td align="left" width="300px" style="padding-left:20px;">
			<table id="Table_popular" width="100%" border="0" cellpadding="0"  cellspacing="0" style="margin-bottom:20px;">
			<tr valign="middle" height="31px">
			<td width="3px"><img src="/images/popular/left.jpg" width="3px" height="31px"></td>
			<td width="293px" style="background-image:url('/images/popular/bg.jpg');background-repeat:repeat-x;padding-left:15px;"><a class="headlink">Популярные товары</a></td>
			<td width="4px"><img src="/images/popular/right.jpg" width="4px" height="31px"></td>
			</tr>
			</table>			
		<?
		echo block("aname='e4' AND f3='yes' ORDER BY date DESC LIMIT 0,4", "popular_item");
		?>

		</td>
		</tr>
		</table>
		
</td>
</tr>