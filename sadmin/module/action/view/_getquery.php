<?
if(!isset($q_sort))$q_sort="date desc";
$q_search=($q_search=="") ? "all" : $q_search;
if(!isset($q_sort_status))$q_sort_status="All";
if($q_search_period=="")$q_search_period="within";
$q="";
if(($q_search_within==0) && ($q_search_period=="within"))
    	{
	$y=time();
	$year=date("Y",$y);
	$month=date("n",$y);
	$day=date("d",$y);

	$to_day=$day;   
	$to_month=$month;
	$to_year=$year;

	switch($q_search_within){
	case '1':$y=time()-24*3600;
		 break;
	case '2':$y=time()-30*24*3600;
		 break;
	case '3':$y=time()-365*24*3600;
		 break;
		}
	$year=date("Y",$y);
	$month=date("n",$y);
	$day=date("d",$y);

	$from_day=$day;
	$from_month=$month;
	$from_year=$year;
          
	$q_search_from_day	=$from_day;
	$q_search_from_month	=$from_month;
	$q_search_from_year	=$from_year;

	$q_search_to_day	=$to_day;
	$q_search_to_month	=$to_month;
	$q_search_to_year	=$to_year;
	}
else	{
	$from_date=$q_search_from_year.set0($q_search_from_month,2).set0($q_search_from_day,2)."000000";
	$to_date=$q_search_to_year.set0($q_search_to_month,2).set0($q_search_to_day,2)."235959";
	$q.="AND date<=$to_date AND date>=$from_date";
	}
	
if($q_search=="all")
	{
	$q.="";
	}
else
	{
	$q.=" AND (name like '%$q_search_for%' OR anons like '%$q_search_for%' OR text like '%$q_search_for%')";
	}

$q=" WHERE lang='".$adminlanguage."' ".$q;

$query="select * from ".$module_name.$q." AND rid=".((integer)$parent)." order by ".$q_sort." limit ".$start.",".$toshow;
$ssquery=$query;
//echo "<h4>".$query."</h4>";
//exit;
?>
