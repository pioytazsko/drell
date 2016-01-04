<?
global $usd_curs;

$img = "/shortimage.php?x=85&y=76&path=attachments--[id]--big.jpg";
if (file_exists("attachments/[id]/1.jpg"))
	$img = "/shortimage.php?x=85&y=76&path=attachments--[id]--1.jpg";
?>
<table id="Table_popular" width="100%" border="0" cellpadding="0"  cellspacing="0">
<tr valign="top">
<td width="100px" style="padding-left:5px;"><a href="<? echo get_link('[id]');?>"><img src="<? echo $img;?>" border="0" width="85px" height="76px"></a></td>
<td width="200px" style="padding-right:25px;">
	<table id="Table_popularprice" width="100%" border="0" cellpadding="0"  cellspacing="0" >
	<tr valign="middle"><td style="padding-top:10px;padding-bottom:10px;"><a href="<? echo get_link('[id]');?>" class="popular">[name]</a></td></tr>
	<tr valign="middle" height="18px">
	<td align="left">
		<table id="Table" width="100%" border="0" cellpadding="0"  cellspacing="0" >
		<tr valign="middle" height="18px">
		<td width="100%" align="right" style="padding-right:5px">
			<span style="font-size:12px;color:#25567a;"><? echo number_format("[f1]"*$usd_curs, 0, "", " ");?> 000 руб.</span>
		</td>
		
		</tr>
		</table>
	</td></tr>
	</table>
</td>
</tr>
</table>
<table width="100%" cellpading="0" cellspacing="0" border="0" style="margin-top:10px;margin-bottom:20px;"><tr height="1px"><td width="100%" style="background:#eaeaea;"></td></tr></table>	