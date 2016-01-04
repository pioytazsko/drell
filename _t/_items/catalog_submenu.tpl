<?
global $arr_path;
if (in_array('[id]', $arr_path))
	echo block("id=[id]", "catalog_subitem_active");
else
	echo block("id=[id]", "catalog_subitem");
?>