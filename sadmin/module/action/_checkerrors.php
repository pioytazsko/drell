<?
$err="";

if($realf1)
	$newch[f1]=$realf1;
if($realf2)
	$newch[f2]=$realf2;
if($realf3)
	$newch[f3]=$realf3;
if($realf4)
	$newch[f4]=$realf4;
if($realf5)
	$newch[f5]=$realf5;
if($realf6)
	$newch[f6]=$realf6;
if($realf7)
	$newch[f7]=$realf7;
if($realf8)
	$newch[f8]=$realf8;
if($realf9)
	$newch[f9]=$realf9;
if($realf10)
	$newch[f10]=$realf10;


if(isset($htmlCode)){
	$newch[text]=$realtext;
	$newch[$reachsel]=$htmlCode;
	}

while (list($var,$value) = each($newch)){
	$newch[$var]=gettextfordb($newch[$var]);
	}

if(trim($newch['aname'])==""){
	$err.="<p><div align=left><a class=error><u>".$lt[33].":</u> ".$lt[37].".</a></div>";
	}

?>