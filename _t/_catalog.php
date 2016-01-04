<?
include("_t/_top.php");
include("_t/_top_products.php");
?>
<table class="main" border=0>
	<tr>
		<td class="menu" valign="top">
		<?
			include("_t/_left.php");
		?>
		</td>
		<!-- end left -->
		<td class="center">
		<?
			$SQL = "SELECT * FROM ".$module_name." WHERE id = '".$_GET[id]."'";
			$result = $Q->query($DB, $SQL);
			$data = mysql_fetch_assoc($result);
			
			if ($data[f1] == '')
				include("_t/_center_catalog.php");
			else
				include("_t/_center_product.php");
		?>
		</td><!-- center	-->
		<td class="news">
		<?
			include("_t/_right.php");
		?>
		</td><!-- news	-->
	</tr>
</table>
<?
include("_t/_bottom.php");
?>