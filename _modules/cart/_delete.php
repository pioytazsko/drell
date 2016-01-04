<?
function getmaxcartid($cart)
{
$res=0;
$s=split(";",$cart);
$c=(strlen($cart)>0) ? count($s) : 1;
for($i=0;$i<($c-1);$i++)
	{
	$s[$i]=split(":",$s[$i]);
	if($res<$s[$i][0])
		$res=$s[$i][0];
	}
return $res;
}

function deletefromcartbyid($cart,$id)
{
$s=split(";",$cart);
$c=(strlen($cart)>0) ? count($s) : 1;
for($i=0;$i<($c-1);$i++)
	{
	$s[$i]=split(":",$s[$i]);
	if($s[$i][0]==$id)
		{
        	$s[$i][0]="";
		$s[$i][1]="";
		}
	}
for($i=0;$i<($c-1);$i++)
	{
	$s[$i]=join(":",$s[$i]);
	if($s[$i]==":")$s[$i]="";
	}
$res=join(";",$s);
$res=ereg_replace(";+",";",$res);
$res=ereg_replace("^;","",$res);
if(strlen($res)==1)$res="";
return $res;
}

if($HTTP_COOKIE_VARS[shopcart])
	{
	$shopcart=$HTTP_COOKIE_VARS[shopcart];
	}
else
	{
	$shopcart="";
	}

$shopcart=docorrectcart($shopcart);

$r=getmaxcartid($shopcart);

$shopcart=deletefromcartbyid($shopcart,$id);

setcookie("shopcart",$shopcart,0,'/');
?>
