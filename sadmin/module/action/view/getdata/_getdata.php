<?
//$tabledata="";

//-------------------------------------------
// id
// language
// dateandtime
// name
// anons
// text
// archive
// delete flag
//-------------------------------------------

$Q->query($DB,$query);
$count=$Q->numrows();
for($i=0;$i<$count;$i++)
	{
	$ff=$Q->getrow();

	$tid=$ff[id];
	$query2="select count(*) from ".$module_name." where rid=".$tid;
	$Q2->query($DB,$query2);
	$flag=$Q2->getrow();
	$flag=($flag[0]==0);
	

	$tabledata[$i][0]=$ff[id];
	$tabledata[$i][1]=$ff[lang];
	$tabledata[$i][2]=$ff[date];
	$tabledata[$i][3]=$ff[name];
	$tabledata[$i][4]=$ff[anons];
	$tabledata[$i][5]=$ff[text];
	$tabledata[$i][6]=$ff[archive];
	$tabledata[$i][7]=$flag;
	$tabledata[$i][8]=$ff[aname];
	$tabledata[$i][9]=$ff[f3];
    $tabledata[$i][10]=$ff[existence];
//	echo join("|",$tabledata[$i])."<p>";
	}

$query2=ereg_replace("\*","count(id)",$ssquery);
$query2=ereg_replace("limit.*","",$query2);
$Q2->query($DB,$query2);
$row=$Q2->getrow();
$rowsnumber=$row[0];

switch($q_sort)
	{
	case "date":			$i=2;$way=1;$sorti[0]=" \/";$num=0;break;
	case "date desc":		$i=2;$way=0;$sorti[0]=" /\\";$num=0;break;
	case "name":			$i=3;$way=1;$sorti[1]=" \/";$num=0;break;
	case "name desc":		$i=3;$way=0;$sorti[1]=" /\\";$num=0;break;
	case "archive":			$i=6;$way=1;$sorti[2]=" \/";$num=0;break;
	case "archive desc":		$i=6;$way=0;$sorti[2]=" /\\";$num=0;break;
	default: $i=1;$way=1;break;
	}

?>