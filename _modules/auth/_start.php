<?
if($LoginName && $LoginPassword && $LoginRid){
	$query="select * from ".$module_name." where name='".$LoginName."' and anons='".$LoginPassword."' and rid=".$LoginRid;
	$Q->query($DB,$query);
	$count=$Q->numrows();
	if($count){
	        $auth=$Q->getrow();
		setcookie("LoginName",$LoginName,0,'/');
		setcookie("LoginPassword",$LoginPassword,0,'/');
		setcookie("LoginRid",$LoginRid,0,'/');
		}
	}
else	{
	if($HTTP_COOKIE_VARS[LoginName]){
		$LoginName=$HTTP_COOKIE_VARS[LoginName];
		}
	if($HTTP_COOKIE_VARS[LoginPassword]){
		$LoginPassword=$HTTP_COOKIE_VARS[LoginPassword];
		}
	if($HTTP_COOKIE_VARS[LoginRid]){
		$LoginRid=$HTTP_COOKIE_VARS[LoginRid];
		}
	if($LoginName && $LoginPassword && $LoginRid){
		$query="select * from ".$module_name." where name='".$LoginName."' and anons='".$LoginPassword."' and rid=".$LoginRid;
		$Q->query($DB,$query);
		$count=$Q->numrows();
		if($count)
		        $auth=$Q->getrow();
		}
	}
if($logout){
	setcookie("LoginName","",0,'/');
	setcookie("LoginPassword","",0,'/');
	setcookie("LoginRid","",0,'/');
	$auth="";
	}

?>