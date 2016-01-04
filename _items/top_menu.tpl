<?
$id = $_GET['id'];
if ($id == "")
	$id = 15;

if ('[id]' == $id)
	echo block("id=[id]", "top_menu_item_selected");
else
	echo block("id=[id]", "top_menu_item");
?>