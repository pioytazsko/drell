<table border=0>
<tr><td><img src="images/news.jpg" height="41" width="198" border="0"></td></tr>
<?
	echo block("rid=3 and archive='on' ORDER BY date DESC","last_news");
?>
<tr><td><img src="images/news_last.jpg" height="20" width="198" border="0"></td></tr>
</table>