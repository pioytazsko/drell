<?
global $usd_curs;

$img = "/shortimage.php?x=105&y=102&path=attachments--[id]--big.jpg";
if (file_exists("attachments/[id]/1.jpg"))
	$img = "/shortimage.php?x=105&y=102&path=attachments--[id]--1.jpg";
?>
<td align="center" valign="top">
<div style="display:block;padding-right:20px;padding-bottom:25px;">
<table id="Table_popular" width="170px" border="0" cellpadding="0"  cellspacing="0">
<tr valign="top">
<td width="100%" style="padding-left:5px;" align="center"><a href="<? echo get_link('[id]');?>"><img src="<? echo $img;?>" width="105px" border="0" height="102px"></a></td>
</tr><tr valign="top">
<td width="100%">
	<table id="Table_popularprice" width="100%" border="0" cellpadding="0"  cellspacing="0" >
	<tr valign="middle"><td style="padding-top:10px;padding-bottom:10px; height:80px" valign="top"><a href="<? echo get_link('[id]');?>" class="popular">[name]</a></td></tr>
	<tr valign="middle" height="18px">
	<td align="left">
		<table id="Table" width="100%" border="0" cellpadding="0"  cellspacing="0" >
		<tr valign="middle" height="18px">
		<td width="50%" align="right" style="padding-right:5px">
		<span style="font-size:12px;color:#25567a;"><? echo number_format("[f1]"*$usd_curs, 0, "", " ");?> руб.</span>
		</td>
		<td width="50%" align="left" style="padding-left:5px"><span class="price">[f1] у.е.</span></td>
		</tr>
		</table>
	</td></tr>
	</table>
</td>
</tr>
</table>
</div>
</td>