<?
	$SQL = "SELECT * FROM ".$module_name." WHERE rid = '69' ORDER BY date DESC LIMIT 0,1";
	$result = $Q->query($DB, $SQL);
	$product = mysql_fetch_assoc($result);
?>
<table border=0>
<tr>
	<td>
		<img src="images/zakaz.jpg" height="41" width="198" border="0">
	</td>
</tr>
<tr>
	<td class="zakaz_item">
		<table class="last_zakaz" border=0>
		<tr>
			<td class="pic">
			<a class="title" href="<?=get_url('/catalog.php?id='.$product[f1])?>">
				<img src="shortimage.php?x=60&y=60&path=attachments--<?=$product[f1]?>--big.jpg"  border="0">
			</a>
			</td>
			<td>
				<table border=0>
				<tr>
					<td>
						<a class="title" href="<?=get_url('/catalog.php?id='.$product[f1])?>"><?=$product[name]?></a>
					</td>
				</tr>
				<tr>
					<td>
					<div style="height:15px">
					&nbsp;
					</div>
					</td>
				</tr>
				<tr>
					<td>
						<a class="more" href="<?=get_url('/catalog.php?id='.$product[f1])?>">Подробнее...</a>
					</td>
				</tr>
				</table>
			</td>
		</tr>
		</table>
	</td>
</tr>
<tr>
	<td>
		<img src="images/zakaz_last.jpg" height="15" width="198" border="0">
	</td>
</tr>
</table>