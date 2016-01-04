<table width=350 cellpadding=5 cellspacing=2 border=1 bordercolor=#746541>
<tr>
<td width=350 align=center>
<?
$query = "SELECT * FROM ".$module_ut;
$Q->query($DB, $query);
$count=$Q->numrows();
for($i=0;$i<$count;$i++){
	$row=$Q->getrow();
        echo $row[name].":".$row[f1]."<br>";
	}
?>
</td>
</tr>
</table>
