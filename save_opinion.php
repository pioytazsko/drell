<?
$r=getmaxid("id",$module_name);

$SQL = "SELECT * FROM ".$module_name." WHERE id = '".$_POST[product_id]."'";
$result = $Q->query($DB, $SQL);
$product = mysql_fetch_assoc($result);
$product_id = $_POST[product_id];
$product_name = $product[name];
$opinion_text = $_POST[opinion_text];

$SQL  = "INSERT INTO ".$module_name."
(lang, id, rid, date, aname, name, text, f1)
VALUES
('ru', '".$r."', '64', '".date("Y-m-d H:i:s")."', 'g2', '".$product_name."', '".$opinion_text."', '".$product_id."')
";
$Q->query($DB, $SQL);

?>
<script>
window.parent.document.getElementById("opinion_form").style.display = "none";
window.parent.document.getElementById("opinion_save_message").style.display = "block";
</script>