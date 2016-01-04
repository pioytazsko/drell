<?
session_start();
$full_style = "";
$table_style = "";
$compare_style = "";

$show = "full";
if ($_COOKIE['show'] != "")
	$show = $_COOKIE['show'];

if ($_GET[show] != "")
	$show = $_GET[show];

if ($show == "full")
{
	$full_style = "text-decoration:none; font-weight:bold";
	$show = "full";
}
elseif ($show == "table")
{
	$table_style = "text-decoration:none; font-weight:bold";
	$show = "table";
}
elseif ($show == "compare")
{
	$compare_style = "text-decoration:none; font-weight:bold";
	$show = "compare";
}
setcookie("show", $show);

$order = "f4, date DESC";
if ($_GET['sort'] == "price")
	$order = "f1, date";
if ($_GET['sort'] == "priced")
	$order = "f1, date DESC";
if ($_GET['sort'] == "rate")
	$order = "f4, date";
if ($_GET['sort'] == "rated")
	$order = "f4, date DESC";

$start_time = get_sec();

$is_rubrics = true;
$SQL = "SELECT * FROM ".$module_name." WHERE rid = '".$_GET[id]."' AND (f1<>'' OR f8 <> '')";
$result = $Q->query($DB, $SQL);
if (mysql_num_rows($result) > 0)
	$is_rubrics = false;
	
$SQL = "SELECT * FROM ".$module_name." WHERE id = '".$_GET[id]."'";
$result = $Q->query($DB, $SQL);
$record = mysql_fetch_assoc($result);

include("_t/_new_top.php");

if ($record[f1] == "" && $record[f8] == "")
{
	include("_t/_new_leftmenu_catalog.php");
	include("_t/_new_center_catalog.php");
	$is_product = false;
}
else
{
	include("_t/_new_leftmenu.php");
	include("_t/_new_center_product.php");
	$is_product = true;
}
	
include("_t/_new_bottom.php");

?>