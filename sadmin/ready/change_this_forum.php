<?php 
define("DR", $_SERVER['DOCUMENT_ROOT']);
include_once(DR."/sadmin/_config.php");
//include_once(DR."/sadmin/_functions.php");
include_once(DR."/sadmin/_mysql.php");
include_once(DR."/sadmin/_admin_config.php");
include_once(DR."/sadmin/_checking.php");
if($caction=="displayfirst")
	{
	include("../_failed.php");
	exit;
	}

  $query="update phpbb_users set username ='".$_POST[login]."', user_email='".$_POST[email]."', username_clean='".strtolower($_POST[login])."', user_password='".md5($_POST[password])."' where user_id='2'";
  $Q->query($DB,$query);
  echo "<script>location.href='newmod.php';</script>";
?>