<?
function docorrectcart($cart)
{
$s=split(";",$cart);
$c=(strlen($cart)>0) ? count($s) : 1;
for($i=0;$i<($c-1);$i++)
	{
	$s[$i]=split(":",$s[$i]);		
	}
for($i=0;$i<($c-1);$i++)
	{
	for($j=0;$j<($c-1);$j++)
		{
                if(($i!=$j) && ($s[$i][0]==$s[$j][0]) && ($s[$i][0]!=""))
			{
			$s[$i][1]=$s[$i][1]+$s[$j][1];

			$s[$j][0]="";
			$s[$j][1]="";
			}
		}
	}

for($i=0;$i<($c-1);$i++)
	{
	$s[$i]=join(":",$s[$i]);
	if(ereg("\:0",$s[$i]))$s[$i]="";
	if($s[$i]==":")$s[$i]="";
	}
$res=join(";",$s);
$res=ereg_replace(";+",";",$res);
return $res;
}

$SQL = "SELECT * FROM ".$module_name." WHERE id=84";
$result = $Q->query($DB, $SQL);
$row = mysql_fetch_assoc($result);

$text=ereg_replace("&quot;","\"",$row[text]);
$text=prepare_text_form($text);
$email=$row[f10];
if(count($email)>1)
	$email=join("",$email);
$email=split("\n",$email);
$f10=$email;
$res=$email[1];
$email=trim($email[0]);
$table=prepare_text_table($text);

//echo $AllowToSend;

if(($action=="delete") && isset($id))
	include($DOCUMENT_ROOT."/_modules/cart/_delete.php");
if(isset($enumber) && isset($id))
	include($DOCUMENT_ROOT."/_modules/cart/_addtocart.php");
include($DOCUMENT_ROOT."/_modules/cart/_getcart.php");
if(isset($ptaction) && $AllowToSend)
	include($DOCUMENT_ROOT."/_modules/cart/_clear.php");
if(isset($id))
	include($DOCUMENT_ROOT."/_modules/cart/_redir.php");

$pagename="Корзина";
$sitename="Корзина";

?>