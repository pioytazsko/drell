<tr>
<td width="100%" style="padding-left:20px; padding-right:20px;padding-top:30px;">
<table id="Table_spec" width="100%" border="0" cellpadding="0"  cellspacing="0" >
<tr valign="top">
	<td align="center">
		<table id="Table_spec" width="100%" border="0" cellpadding="0"  cellspacing="0" >
		<tr valign="bottom" height="45px">
			<td width="11px"><img src="/images/news/left.jpg" width="11px" height="45px"></td>
			<td style="background-image:url('/images/news/bg.jpg');background-repeat:repeat-x;padding-left:15px;">
			<a style="text-decoration:none;"><h1>Спецпредложения</h1></a>
			</td>
			<td width="7px"><img src="/images/news/right.jpg" width="7px" height="45px"></td>
		</tr>
		</table>
		<table id="Table_spec" width="100%" border="0" style="margin-left:30px; margin-right:20px; margin-top:15px" cellpadding="0" align="center"  cellspacing="0" >
			<tr>
			<?
			echo block("aname='e4' AND archive='on' ORDER BY date DESC LIMIT 0,5", "special_item");
			?>
		</tr>
		</table>
	</td>
</tr>
</table>

</td>
</tr>