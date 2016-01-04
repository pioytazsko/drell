<?
if(!isset($start))
	{
        $start=0;
	}
include("action/view/_getquery.php");
include("action/view/getdata/_index.php");
include("../_inc/_searchform.php");
// include("../_inc/_showrecordsform.php");
include("action/view/_showtable.php");
include("action/view/_js_sort.php");
?>
