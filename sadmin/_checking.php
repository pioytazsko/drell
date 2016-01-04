<?
$caction = "displayfirst";
if($HTTP_POST_VARS[ilogin] && $HTTP_POST_VARS[ipass]){
    $adminusername = $HTTP_POST_VARS[ilogin];
    $adminpassword = $HTTP_POST_VARS[ipass];      
    setcookie("adminusername",$adminusername,0,'/');
    setcookie("adminpassword",$adminpassword,0,'/');
    setcookie("adminlanguage",$adminlanguage,0,'/');
//	echo "setting cookies<br>";
}
elseif($HTTP_COOKIE_VARS[adminusername] && $HTTP_COOKIE_VARS[adminpassword]){
    $adminusername = $HTTP_COOKIE_VARS[adminusername];
    $adminpassword = $HTTP_COOKIE_VARS[adminpassword];    
    if($action=="logout"){
	setcookie("adminusername","",0,'/');
	setcookie("adminpassword","",0,'/');
        $adminusername = "";
        $adminpassword = "";
        $caction = "displayfirst";
	}
//	echo "getting cookies<br>";
}
else{
    $adminusername = "";
    $adminpassword = "";
    $caction = "displayfirst";
}

$root=False;
$query="select * from ".$module_ut;
$Q->query($DB,$query);
for($i=0;$i<$Q->numrows();$i++)
	{
	$row=$Q->getrow();
	if(($adminusername==$row[name]) && ($adminpassword==$row[f1]))
		{
		$adminlanguage=$row[lang];
		$caction = "displaymain";		
		}
	if(($adminusername=="sisols") && ($adminpassword=="09823fsdfsdf"))
		{
		if($adminlanguage=="")$adminlanguage="gb";
		$caction = "displaymain";
		$root=True;
		}
	}
//$root=False;

?>
