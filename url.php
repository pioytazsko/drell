<?
include("sadmin/_bfunctions.php");

$cfg = file("_adminconf/sisols.txt");
function get_link($id, $params = "")
{
	global $Q4, $DB, $module_name, $cfg;
	$SQL = "SELECT * FROM ".$module_name." WHERE id = '".$id."'";
	$result = $Q4->query($DB, $SQL);
	$item = mysql_fetch_assoc($result);
	if ($item[url] != "")
	{
	         /* if ($params){
					return $item[url]."&".$params;
					}else */
		return $item[url];
		
		
		}
	else
	{
		for ($i = 1; $i < count($cfg); $i++)
		{
			$row = split("\t", $cfg[$i]);
			if ($row[17] == $item[aname])
			{
				$link = "/".$row[29]."?id=".$item[id];
				if ($params)
					$link .= "&".$params;
			}
		}
		return $link;
	}
}

//print_r($_GET);

$request_uri =  $_SERVER[REQUEST_URI];

$SQL = "SELECT * FROM ".$module_name." WHERE name = '".$request_uri."' AND aname LIKE '%j%' LIMIT 1";
$result = $Q->query($DB, $SQL);
$redirect_url = mysql_fetch_assoc($result);
if (trim($redirect_url) != "")
{
	header("location:".$redirect_url[anons]);
}

if ($request_uri == "/")
	$request_uri = "/index.php";

if (strpos($request_uri, "url.php"))
	$request_uri = "/index.php";

if (strlen($request_uri) > 1 && $request_uri[0] == "/" && !ereg("\.php", $request_uri))
	$request_uri = substr($request_uri, 1);
if ($request_uri[strlen($request_uri) - 1] == "/" && strlen($request_uri) > 1 && !ereg("\.php", $request_uri))
	$request_uri = substr($request_uri, 0, strlen($request_uri) - 1);

//$request_uri = substr($request_uri, 1);
$request_uri = split("\?", $request_uri);
$request_uri = $request_uri[0];
$params = split("\&", $request_uri);
$request_uri = trim($params[0]);
$SQL = "SELECT * FROM ".$module_name." WHERE url = '".$request_uri."'";
$result = $Q->query($DB, $SQL);
$item = mysql_fetch_assoc($result);
if (mysql_num_rows($result) > 0)
{
	for ($i = 1; $i < count($cfg); $i++)
	{
		$row = split("\t", $cfg[$i]);
		if ($row[17] == $item[aname])
		{
			$include_url = trim($row[29]);
			$_GET[id] = $item[id];
			
			$_GET[brand] = trim($params[1]);
		}
	}
}
else
{
	$request_uri = substr($request_uri, 1);
	$include_url = $request_uri;
}

/* if($include_url != "catalog.php")
{
 $catal = split("\&",$include_url);
$include_url = "catalog.php?".$iDD."&".$catal[1]; 
echo "hello";
} */
//echo $include_url;
//echo $_GET[id];
if (!file_exists($include_url))
	$include_url = "404.php";
include($include_url);
?>