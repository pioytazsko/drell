<?
$query="delete from ".$module_name." where lang='".$dlang."'";
//echo $query;
$Q->query($DB,$query);

echo "<p><center><a class=normallink>Deleted.</a></center>";

?>