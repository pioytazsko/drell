<?
if($action=="add"){
	include("action/_checkerrors.php");
	if($err){
		include("../_inc/_top.php");
		echo $err;
		if((!$parent) && ($root))
			include("_formadd.php");
		else
			include("_form.php");
		}
	else
		{
		echo "<script language=JavaScript>top.mainleft.location.reload(true);</script>";
		include("action/_add.php");
		include("_view.php");
		}
	}
else	{
	include("../_inc/_top.php");
	if((!$parent) && ($root))
		include("_formadd.php");
	else
		include("_form.php");
	}
?>
