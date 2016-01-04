<td>
 	  <table id="Table2" width="100%"  border="0" cellpadding="0"  cellspacing="0"><tr height="1px" valign="top"><td  align="left" style="padding-left:20px;padding-top:10px; padding-right:25px;">
		<table id="Table" width="100%"  border="0" cellpadding="0"  cellspacing="0">
			<tr height="1px" valign="middle">
			<td style="padding-top:5px;"><p style="margin:0px;padding-top:10px;"></p><h1 class="nobottomed"><?=block("id='".$_GET[id]."'", "name");?></h1></td>
			</tr>
			<tr height="1px" valign="middle">
			<td>
			<?
				echo show_path($_GET[id]);
			?>
			</td>
			</tr>
			
			<tr height="1px" valign="middle">
			<td style="padding-top:35px;">
			<?
			$text = block("id='".$_GET[id]."'", "text");
			
			echo $text;
			?>
			</td>

			</tr>

		</table>	
	</td>
	<td align="right" width="200px" style="padding-top:5px;">
		<?
		include("_new_cart.php");
		?>

		<p style="margin:0px;padding-top:20px;"></p>

			<table id="Table_popular" width="100%" border="0" cellpadding="0"  cellspacing="0">
			<tr valign="middle" height="31px">
			<td width="3px"><img src="/images/popular/left.jpg" width="3px" height="31px"></td>
			<td width="100%" style="background-image:url('/images/popular/bg.jpg');background-repeat:repeat-x;padding-left:15px;"><a href="##" class="headlink">Популярные товары</a></td>
			<td width="4px"><img src="/images/popular/right.jpg" width="4px" height="31px"></td>
			</tr>
			</table>			
			
			<?
			echo block("aname='e4' AND f3='yes' ORDER BY date DESC LIMIT 0,4", "popular_item_product");
			?>

	</td>
	</tr>
	</table>
	<p style="margin:0px;padding-top:20px;"></p>

</td>
</tr>
</table>



</td>
</tr>