<?
	$SQL = "SELECT * FROM ".$module_name." WHERE aname = 'e2' AND archive='on' ORDER BY date DESC LIMIT 0,3";
	$result = $Q->query($DB, $SQL);
	for ($products = Array(); $row = mysql_fetch_assoc($result); $products[] = $row);
	
	$spec = "";
	for ($i = 0; $i < count($products); $i++)
	{
		$spec .= '
		<td>
			<table class="tovar2" border=0>
			<tr>
				<td class="pic" valign="top">
					<a class="title1" href="/'.get_url('catalog.php?id='.$products[$i][id]).'"><img src="shortimage.php?x=35&y=35&path=attachments--'.$products[$i][id].'--big.jpg" border="0"></a>
				</td>
				<td>
					<table border=0>
					<tr>
						<td class="otstup">
							<a class="title1" href="/'.get_url('catalog.php?id='.$products[$i][id]).'">'.$products[$i][name].'</a>
						</td>
					</tr>
					<tr>
						<td class="otstup">
							текст текст текст текст текст текст
						</td>
					</tr>
					<tr>
						<td nowrap class="tsena">
							<a class="more" href="/catalog.php?id='.$products[$i][id].'">
								Подробнее...
							</a>&nbsp;&nbsp;
							<b>Цена: '.$products[$i][f1].' y.e.
						</td>
					</tr>
					<tr>
						<td align="right">
							<a class="zakazat" href="/cart.php?id='.$products[$i][id].'&enum=1&eprice='.$products[$i][f1].'&rand='.md5(time()).'">
								Заказать
							</a>
						</td>
					</tr>
					</table>
				</td>
			</tr>
			</table>
		</td>
		';
	}
	
?>
<table class="second" border=0>
<tr>
	<!--
	<td class="left" style="border:1px solid #000000">
		<table class="top_hit" border=0>
		<tr><td class="top_hit"><img src="images/blank.gif" height="1" width="1" border="0"></td><td><img src="images/hit_title.jpg" height="25" width="163" border="0"></td><td><img src="images/hit_border1.jpg" height="25" width="12" border="0"></td></tr>
		</table>
		<table><tr><td valign="top"><table class="tovar" border=0>
				<tr><td class="pic" valign="top"><img src="images/pic.jpg" height="35" width="35" border="0"></td><td><table border=0><tr><td class="otstup"><a class="title" href="/">Товар1</a></td></tr><tr><td class="otstup">текст текст текст текст текст текст</td></tr><tr><td class="otstup"><a class="more" href="/">Подробнее...</a></td></tr></table></td></tr>
				</table>
			    </td>
				<td><table class="tovar" border=0>
				<tr><td class="pic" valign="top"><img src="images/pic.jpg" height="35" width="35" border="0"></td><td><table border=0><tr><td class="otstup"><a class="title" href="/">Товар1</a></td></tr><tr><td class="otstup">текст текст текст текст текст текст текст текст текст текст</td></tr><tr><td class="otstup"><a class="more" href="/">Подробнее...</a></td></tr></table></td></tr>
				</table>
			    </td>
			    <td><table class="tovar" border=0>
				<tr><td class="pic" valign="top"><img src="images/pic.jpg" height="35" width="35" border="0"></td><td><table border=0><tr><td class="otstup"><a class="title" href="/">Товар1</a></td></tr><tr><td class="otstup">текст текст текст текст текст текст</td></tr><tr><td class="otstup"><a class="more" href="/">Подробнее...</a></td></tr></table></td></tr>
				</table>
			    </td>
			<td class="hit2"><img src="images/blank.gif" height="1" width="12" border="0"></td>

		</tr>
		</table>
		<table class="hit_footer" border=1>
		<tr><td class="hit_footer"><img src="images/blank.gif" height="9" width="1" border="0"></td><td class="spets2"><img src="images/hit_border3.jpg" height="9" width="12" border="0"></td></tr></table>
	</td>
	-->
	<td><img src="images/blank.gif" height="1" width="10" border="0"></td>
	
	<td class="right">
		<table class="top_spets" border=0>
		<tr><td><img src="images/spets_border1.jpg" height="25" width="12" border="0"></td><td><img src="images/spets_title.jpg" height="25" width="182" border="0"></td><td class="top_spets"><img src="images/blank.gif" height="1" width="1" border="0"></td></tr>
		</table>
			<table border="0"><tr>
				<td class="spets2"><img src="images/blank.gif" height="1" width="12" border="0"></td>
				<!--
				<td>
					<table class="tovar2" border=0>
					<tr><td class="pic" valign="top"><img src="images/pic.jpg" height="35" width="35" border="0"></td><td><table border=0><tr><td class="otstup"><a class="title1" href="/">Товар1</a></td></tr><tr><td class="otstup">текст текст текст текст текст текст</td></tr><tr><td nowrap class="tsena"><a class="more" href="/">Подробнее...</a>&nbsp;&nbsp;<b>Цена: 250 y.e.</td></tr><tr><td align="right"><a class="zakazat" href="/">Заказать</a></td></tr></table></td></tr>
					</table>
			    </td>
				<td><table class="tovar2" border=0>
				<tr><td class="pic" valign="top"><img src="images/pic.jpg" height="35" width="35" border="0"></td><td><table border=0><tr><td class="otstup"><a class="title1" href="/">Товар1</a></td></tr><tr><td class="otstup">текст текст текст текст текст текст</td></tr><tr><td nowrap class="tsena"><a class="more" href="/">Подробнее...</a>&nbsp;&nbsp;<b>Цена: 250 y.e.</td></tr><tr><td align="right"><a class="zakazat" href="/">Заказать</a></td></tr></table></td></tr>
				</table>
			    </td>
			    <td><table class="tovar2" border=0>
				<tr><td class="pic" valign="top"><img src="images/pic.jpg" height="35" width="35" border="0"></td><td><table border=0><tr><td class="otstup"><a class="title1" href="/">Товар1</a></td></tr><tr><td class="otstup">текст текст текст текст текст текст</td></tr><tr><td nowrap class="tsena"><a class="more" href="/">Подробнее...</a>&nbsp;&nbsp;<b>Цена: 250 y.e.</td></tr><tr><td align="right"><a class="zakazat" href="/">Заказать</a></td></tr></table></td></tr>
				</table>
			    </td>
			    -->
			    <?=$spec?>
		</tr></table>
		<table class="spets_footer"><tr><td class="spets2"><img src="images/spets_border3.jpg" height="9" width="12" border="0"></td><td class="spets_footer"><img src="images/blank.gif" height="1" width="1" border="0"></td></tr></table>
	</td>
</tr>
</table>