<?
global $usd_curs;

$SQL = "SELECT * FROM ".$module_name." WHERE id = '[f2]'";
$result = $Q->query($DB, $SQL);
$brand = mysql_fetch_assoc($result);
$brand = $brand['name'];

?>
<div style="display:block;float:left;width:196px;border-right:1px solid #eaeaea;border-bottom:1px solid #eaeaea;">
<table width="196px" cellspacing="0" cellpadding="0" border="0" >
	<tr height="1px">
	<td width="100%" style="padding-top:15px;">
		<table width="100%" cellspacing="0" cellpadding="0" border="0">
		<tr height="1px" valign="top">
		<td width="100%" style="padding-bottom:0px;padding-left:5px;padding-right:5px;height:270px" valign="top">
		<div style="height:39px">
			<a href="/catalog.php?id=[id]" class="goodnameSmall">[name]</a>
		</div>
		<table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-top:7px;">
		<tr valign="top">
			<td align="left" style="padding-right:0px;"><img src="/shortimage.php?path=attachments--[id]--big.jpg&x=190&y=150" border="0"/></td>
			</tr>
			<tr>
			<td width="100%"  style="padding-right:7px;">
				<table width="100%" cellspacing="0" cellpadding="0" border="0">
				<tr>
				<td nowrap>
					<table cellspacing="0" border="0" cellpadding="0">
					<tr>
					<?
					$rating = "[f4]";
					for ($j = 0; $j < 5; $j++)
					{
						$rating_class = "rate_inactive";
						if ($j < $rating)
							$rating_class = "rate_active";
						echo '
						<td class="'.$rating_class.'">
							<div></div>
						</td>
						';
					}
					?>
					</tr>
					</table>
					<p style="margin:0px;padding-top:5px;">
				</td>
				<td width="100%"></td>
				<td align="right" nowrap>&nbsp;</td>
				</tr>
				<tr valign="bottom">
				<td nowrap><span class="redpricebold2">
                <? echo number_format('[f1]'*$usd_curs, 0, "", " ");?> 000 ð</span>
                <p style="margin:0px;padding-top:2px;"></p></td><td width="100%">
                </td><td align="right" nowrap><a href="/cart.php?id=[id]&enumber=1">
                <input type="image" src="/images/spisok/buy.jpg" width="81px" height="24px" border="0"/></a></td>
				</tr>
				<tr height="10px"><td></td><td width="100%"></td><td></td></tr>
				</table>
			</td>
		</tr>
		</table>		
		</td>
		</tr>
		</table>
	</td>
	</tr>
</table>
</div>
<!-- end item block-->