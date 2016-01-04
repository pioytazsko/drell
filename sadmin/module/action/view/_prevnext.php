<?
if($start>0)
	{
        echo "<a class=normallink href=\"JavaScript:qsearch.action='index.php?start=".($start-$toshow)."&parent=".$parent."'; qsearch.submit();\"><< ".$lt[24]."</a>";
	}

if(($start>0) && (($start+$toshow)<$rowsnumber))
	echo "&nbsp;&nbsp;|&nbsp;&nbsp;";

if(($start+$toshow)<$rowsnumber)
	{
	echo "<a class=normallink href=\"JavaScript:qsearch.action='index.php?start=".($start+$toshow)."&parent=".$parent."'; qsearch.submit();\">".$lt[25]." >></a>";
	}
?>