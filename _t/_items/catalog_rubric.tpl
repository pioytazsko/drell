<?
if ($_GET[brand] != "")
{
$SQL = "SELECT * FROM ".$module_name." WHERE f2 = '".$_GET[brand]."' AND rid = [id] AND aname = 'e2' LIMIT 0,1";
$result = $Q->query($DB, $SQL);
$product = mysql_fetch_assoc($result);

$image = "/shortimage.php?path=attachments--[id]--big.jpg&x=83&y=75";
if (file_exists("attachments/[id]/1.jpg"))
	$image = "/shortimage.php?path=attachments--[id]--1.jpg&x=83&y=75";
if (file_exists("attachments/".$product['id']."/big.jpg"))
	$image = "/shortimage.php?path=attachments--".$product['id']."--big.jpg&x=83&y=75";
}
else
{
	$image = "/shortimage.php?path=attachments--[id]--big.jpg&x=83&y=75";
	if (file_exists("attachments/[id]/1.jpg"))
		$image = "/shortimage.php?path=attachments--[id]--1.jpg&x=83&y=75";
}
?>
<div style="display:block;float:left;padding-right:20px;padding-bottom:25px; height:170px">
	<table id="Table_Catalog" name="0" width="175px" border="0" cellpadding="0"  cellspacing="0">
	<tr height="75px">
	<td align="center" width="175px" style="padding-bottom:15px;"><a href="<? echo get_link('[id]');?>"><img src="<? echo $image;?>" border="0"></a></td>
	</tr>
	<tr height="">
	<td align="center" width="175px"><a href="<? echo get_link('[id]');?>" style="text-decoration:none;"><h1 style="font-size:16px;">[name]</h1></a></td>
	</tr>
	</table>
</div>