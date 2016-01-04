<?php 
define("DR", $_SERVER['DOCUMENT_ROOT']);
include_once(DR."/sadmin/_config.php");
include_once(DR."/sadmin/_functions.php");
include_once(DR."/sadmin/_mysql.php");
include_once(DR."/sadmin/_admin_config.php");
include_once(DR."/sadmin/_checking.php");
if($caction=="displayfirst")
	{
	include("../_failed.php");
	exit;
	}
$mysqlhost = $vHostName;
$mysqldb = $vDBName;
$mysqllogin = $vUserName;
$mysqlpass = $vPassword;

function full_del_dir($directory)
  {

  $dir = opendir($directory);
  while(($file = readdir($dir)))
  {
    if ( is_file ($directory."/".$file))
    {
      unlink ($directory."/".$file);
    }
    else if ( is_dir ($directory."/".$file) &&
             ($file != ".") && ($file != ".."))
    {
      full_del_dir ($directory."/".$file);  
    }
  }
  closedir ($dir);
  rmdir ($directory);
  }
if($_POST[delete]=='delete')
{
  full_del_dir(DR."/consult");
    $query="DROP TABLE `chatban`, `chatconfig`, `chatgroup`, `chatgroupoperator`, `chatmessage`, `chatoperator`, `chatresponses`, `chatrevision`, `chatthread`";
  $Q->query($DB,$query);
  echo "<script>location.href='newmod.php';</script>";  
}
else{
//$oldmask = umask(0);
if(@mkdir(DR."/consult", 0777))
  { 
  //echo DR.'/sadmin/ready/consult.zip';
  //echo phpinfo();
  $zip = new ZipArchive;
  echo "hello";
  $res = $zip->open(DR.'/sadmin/ready/consult.zip');
  if($res)
  {
  echo "goodZip";
  }
  $zip->extractTo(DR.'/consult'); 
  if($zip)
  {
  echo "goodZip";
  }
  $f = fopen(DR."/consult/base.txt","r");
  if($f)
  {echo "good_File";}
  $query = "";
  while(!feof($f))
   {
      $string = fgets($f,1000);
        if(strlen($string)>7){
        $query .= $string;
           }
        else{
          $Q->query($DB,$query);
		  echo $query;
            $query = "";
            }
    }
  fclose($f);
  echo "<script>location.href='newmod.php';</script>";
  }
}
?>