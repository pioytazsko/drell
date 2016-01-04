<?
global $usd_curs;

$SQL = "SELECT * FROM ".$module_name." WHERE id = '[f2]'";
$result = $Q->query($DB, $SQL);
$brand = mysql_fetch_assoc($result);
$brand = $brand['name'];

$img = "/shortimage.php?path=attachments--[id]--big.jpg&x=180&y=150";
if (file_exists("attachments/[id]/1.jpg"))
	$img = "/shortimage.php?path=attachments--[id]--1.jpg&x=180&y=150";

?>
<div style="display:block;float:left;width:195px;border-right:1px solid #eaeaea;border-bottom:1px solid #eaeaea;">
<table width="195px" cellspacing="0" cellpadding="0" border="0" >
	<tr height="1px">
	<td width="100%" style="padding-top:15px;">
		<table width="100%" cellspacing="0" cellpadding="0" border="0">
		<tr height="1px" valign="top">
		<td width="100%" style="padding-bottom:0px;height:270px" valign="top">
		<div style="height:42px; width:180px; margin-left:5px">
			<a href="<? echo get_link('[id]');?>" class="goodnameSmall">[name]</a>
		</div>
		<table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-top:7px;">
		<tr valign="top">
			<td align="center"><a href="<? echo get_link('[id]');?>"><img hspace="0" vspace="" src="<? echo $img;?>" border="0"/></a></td>
			</tr>
			<tr>
			<td width="100%"  style="padding-right:0px;">
				<table width="185" cellspacing="0" cellpadding="0" border="0" style="margin-left:7px">
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
				<td nowrap="nowrap"  height="40">
                <? if ((integer)'[f1]' > 0) {
                    echo '<span class="redpricebold2">'.number_format('[f1]'*$usd_curs, 0, "", " ").' <span style="font-size:12px">000</span> р</span><p style="margin:0px;padding-top:2px;"></p>';
                }?>
                
               
                    </td><td align="right" nowrap><a href="/cart.php?id=[id]&enumber=1"><?
		if ('[existence]' != '0' && ((integer)'[f1]' > 0 || (integer)'[f6]' > 0))
		{
			echo '<img src="/images/spisok/buy.jpg" width="81px" height="24px" border="0"/>';
		}
		else
		{
			echo '<img src="/images/spisok/order.jpg" width="81px" height="24px" border="0"/>';
		}
		?></a></td>
				</tr>
				<tr height="10px"><td></td><td width="100%"></td><td></td></tr>
				<tr>
				<td nowrap align="left"><input type="checkbox" name="compare[]" value="[id]" id="check_[id]" /><span style="font-size:9px;color:#999999;"><label for="check_[id]">Выбрать | </label></span><a style="font-size:9px;color:#999999;cursor:pointer" onclick="document.getElementById('compare_form').submit()">Сравнить</a></td><td width="100%"></td><td align="right" nowrap>&nbsp;</td>
				</tr>
				<tr height="15px"><td></td><td width="100%"></td><td></td></tr>
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