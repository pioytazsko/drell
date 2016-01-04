<?
if($HTTP_COOKIE_VARS[shopcart])
	{
	$shopcart=$HTTP_COOKIE_VARS[shopcart];
	}
else
	{
	$shopcart="";
	}
$shopcart.=$id.":".$enumber.";";
setcookie("shopcart",$shopcart,0,'/');

$shopcart=docorrectcart($shopcart);
?>
