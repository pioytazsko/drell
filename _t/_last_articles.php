<table border=0>
<tr><td><img src="images/statiy.jpg" height="42" width="198" border="0"></td></tr>
<?
	echo block("rid=2 and archive='on' ORDER BY date DESC", "last_article");
?>
<tr><td><img src="images/statiy_last.jpg" height="24" width="198" border="0"></td></tr>
</table>