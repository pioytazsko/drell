<?
$f=fopen("_toshow.php","w");
fputs($f,$pos);
fclose($f);

$f=file("_toshow.php");
$toshow=$f[0];

$page="view";
include("_view.php");
?>