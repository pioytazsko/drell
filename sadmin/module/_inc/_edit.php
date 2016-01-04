<?
if($action=="edit"){
	include("action/_checkerrors.php");
	if($err){
		include("../_inc/_top.php");
		echo $err;
		include("_form.php");
		}
	else
		{
		echo "<script language=JavaScript>top.mainleft.location.reload(true);</script>";
		include("action/_edit.php");
		include("_view.php");
		}
	}
else	{
	include("../_inc/_top.php");
	include("_form.php");
	}
?>