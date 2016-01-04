<?
// template: 1:2;3:4;   id:number;id:number;
if($HTTP_COOKIE_VARS[shopcart])
	{
	$shopcart=$HTTP_COOKIE_VARS[shopcart];
	}
else
	{
	$shopcart="";
	}
$shopcart=docorrectcart($shopcart);
//echo $shopcart;

?>