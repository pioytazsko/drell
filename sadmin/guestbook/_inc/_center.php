<html>

<body>

<table width="1000" border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="#3C0616">

<?
$query="select * from ".$module_name." where id=7";
$Q->query($DB,$query);
$row=$Q->getrow();
echo prepare_text($row);
?>

</table>
</body>
</html>