<table class="main" border="0">
<tr>
<td valign="top" class="center">
<table border=0>
<tr>
	<td class="text1">
		<?
		echo block("id=87", "text");
		?>
	</td>
</tr>
</table>
<table border="0">
</tr>
<tr><td class="center_title">Сегодня в продаже</td></tr></table>

<table border="0" width=100%>

<?
echo block("rid=16 ORDER BY date DESC LIMIT 15", "main_rubric", "", "main_rubric_sep");
?>

</table>
</td>