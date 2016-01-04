<?
global $usd_curs;

$img = "/shortimage.php?x=85&y=76&path=attachments--[id]--big.jpg";
if (file_exists("attachments/[id]/1.jpg"))
	$img = "/shortimage.php?x=85&y=76&path=attachments--[id]--1.jpg";
?>
<table id="Table_popular" width="100%" border="0" cellpadding="0"  cellspacing="0" style="margin-top:20px;"	>
<tr valign="top">
<td width="100%" style="padding-left:5px;" align="center"><a href="<? echo get_link('[id]');?>"><img src="<? echo $img;?>" width="85px" height="76px" border="0"></a></td>
</tr>
<tr valign="top">
<td width="100%" align="center" style="padding-bottom:20px;">
	<table id="Table_popularprice" width="80%" border="0" cellpadding="0"  cellspacing="0" >
	<tr valign="middle"><td style="padding-top:5px;padding-bottom:10px;"><a href="<? echo get_link('[id]');?>" class="popular">[name]</a></td></tr>
	<tr valign="middle" height="18px">
	<td align="left">
		<table id="Table" width="100%" border="0" cellpadding="0"  cellspacing="0" >
		<tr valign="middle" height="18px">
		<td width="100%" align="right" style="padding-right:5px">
		<span style="font-size:12px;color:#25567a;"><? echo number_format("[f1]"*$usd_curs, 0, "", " ");?> 000 руб.</span></td>
		
		</tr>
		</table>
	</td></tr>
	</table>
</td>
</tr>
<tr valign="top" height="1px">
<td width="100%" align="center"><img src="/images/popular/line.jpg" border="0" height="1px" width="164px"/></td>
</tr>
</table>