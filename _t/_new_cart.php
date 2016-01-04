<table id="Table_Order" width="188px" border="0" cellpadding="0"  cellspacing="0" >
	<tr height="10px">
	<td align="left" width="188px"><img src="/images/order/top.jpg" width="188px" height="10px"></td>
	</tr>
	<tr valign="middle" height="33px">
	<td align="left" width="188px" style="background-image:url('/images/order/bg.jpg');background-repeat:repeat-y;padding-top:5px;padding-left:5px;padding-bottom:10px;"><img src="/images/order/cart.jpg"  border="0" width="43px" height="33px" style="float:left;margin-right:10px;">
	<?
	if ($cartcount > 0)
	{
	?>
		<div style="">В корзине</div>
		<div style="position:relative;top:0px;">товаров: <b><?=$cartcount;?></b><br/>на сумму: </div> 
		<div align="right"  style="padding-right:47px"><b><?= number_format($carttotal*$usd_curs, 0, "", " ");?> 000 руб.</b></div>
	<?
	}
	else
	{
	?>
		<div style="margin-top:10px">Корзина пуста</div>
	<?
	}
	?>
	</td>
	</tr>
	<tr>
	<td align="center" width="188px" style="background-image:url('/images/order/bgbtn.jpg');background-repeat:repeat-x;"><a href="/cart.php"><input type="image" src="/images/order/btn.jpg"  style="cursor:pointer" width="118px" height="20px"/></a></td>
	</tr>
	<tr>
	<td align="center" width="188px"><img src="/images/order/bottom.jpg" width="188px" height="20px"></td>
	</tr>

</table>
