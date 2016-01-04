<?
	$SQL = "SELECT * FROM ".$module_name." WHERE rid = 74";
	$result = $Q->query($DB, $SQL);
	for ($url = Array(); $row = mysql_fetch_assoc($result); $url[] = $row);
	
	$url_arr = Array();
	
	for ($i = 0; $i < count($url); $i++)
	{
		if ($url[$i][name] != "" && $url[$i][f1] != "")
			$url_arr["'".$url[$i][name]."'"] = $url[$i][f1];
	}
	
	function get_url($address)
	{
		global $url_arr;
		if (@$url_arr["'".$address."'"])
			return $url_arr["'".$address."'"];
		else
			return $address;
	}
	
	function get_htaccess()
	{
		global $Q, $DB, $module_name;
		$SQL = "SELECT * FROM ".$module_name." WHERE rid = 74";
		$result = $Q->query($DB, $SQL);
		for ($url = Array(); $row = mysql_fetch_assoc($result); $url[] = $row);
		
		$file = fopen($_SERVER[DOCUMENT_ROOT]."/.htaccess", "w");
		
		$output = "DirectoryIndex index.php
RewriteEngine On
";
		
		for ($i = 0; $i < count($url); $i++)
		{
			if ($url[$i][name] != "" && $url[$i][f1] != "")
				$output .= "RewriteRule ^".$url[$i][f1]."$ /".$url[$i][name]."
";
		}
		
		fputs($file, $output);
		fclose($file);
	}
?>