<?
$SQL = "SELECT * FROM ".$module_name." WHERE f2 = '".$_GET['id']."' AND rid = [id] AND aname = 'e4' LIMIT 0,1";
$result = $Q->query($DB, $SQL);
$product = mysql_fetch_assoc($result);



$image = "/shortimage.php?path=attachments--[id]--1.jpg&x=83&y=75";
if ("attachments/".$product['id']."/big.jpg")
	$image = "/shortimage.php?path=attachments--".$product['id']."--big.jpg&x=83&y=75";
?>
<div style="display:block;float:left;padding-right:20px;padding-bottom:25px; height:170px">
	<table id="Table_Catalog" width="175px" border="0" name="1" cellpadding="0"  cellspacing="0">
	<tr height="75px">
	<td align="left" width="175px" style="padding-left:30px;padding-bottom:15px;"><a href="catalog.php?id=<? echo [id];echo "&brand=".$_GET['id'];?>" ><img src="<? echo $image;?>" border="0"></a></td>
	</tr>
	<tr height="">
	<td align="left" width="175px"><a href="catalog.php?id=<?echo [id];echo "&brand=".$_GET['id'];?>" style="text-decoration:none;"><h1>[name]</h1></a></td>
	</tr>
	</table>
</div>
</div>