<?
//-------------------------------------------
// id
// language
// dateandtime
// name
// anons
// text
// archive
//-------------------------------------------

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

$tabledata=sortdata($tabledata,$i,$way,$num);
?>
