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
$dbname = $vDBName;
$dbms = 'mysql';
$dbhost = $vHostName;
$dbport = '';
$dbuser = $vUserName;
$dbpasswd = $vPassword;
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
 if($_POST[del]=='delete')
{
  full_del_dir(DR."/forum");
    $query="DROP TABLE `phpbb_acl_groups`, `phpbb_acl_options`, `phpbb_acl_roles`, `phpbb_acl_roles_data`, `phpbb_acl_users`, `phpbb_attachments`, `phpbb_banlist`, `phpbb_bbcodes`, `phpbb_bookmarks`, `phpbb_bots`, `phpbb_config`, `phpbb_confirm`, `phpbb_disallow`, `phpbb_drafts`, `phpbb_extensions`, `phpbb_extension_groups`, `phpbb_forums`, `phpbb_forums_access`, `phpbb_forums_track`, `phpbb_forums_watch`, `phpbb_groups`, `phpbb_icons`, `phpbb_lang`, `phpbb_log`, `phpbb_moderator_cache`, `phpbb_modules`, `phpbb_poll_options`, `phpbb_poll_votes`, `phpbb_posts`, `phpbb_privmsgs`, `phpbb_privmsgs_folder`, `phpbb_privmsgs_rules`, `phpbb_privmsgs_to`, `phpbb_profile_fields`, `phpbb_profile_fields_data`, `phpbb_profile_fields_lang`, `phpbb_profile_lang`, `phpbb_ranks`, `phpbb_reports`, `phpbb_reports_reasons`, `phpbb_search_results`, `phpbb_search_wordlist`, `phpbb_search_wordmatch`, `phpbb_sessions`, `phpbb_sessions_keys`, `phpbb_sitelist`, `phpbb_smilies`, `phpbb_styles`, `phpbb_styles_imageset`, `phpbb_styles_imageset_data`, `phpbb_styles_template`, `phpbb_styles_template_data`, `phpbb_styles_theme`, `phpbb_topics`, `phpbb_topics_posted`, `phpbb_topics_track`, `phpbb_topics_watch`, `phpbb_users`, `phpbb_user_group`, `phpbb_warnings`, `phpbb_words`, `phpbb_zebra`";
  $Q->query($DB,$query);
  echo "<script>location.href='newmod.php';</script>";  
}
elseif((isset($_POST[login]))&&($_POST[del]!='delete'))
{
  if(@mkdir(DR."/forum", 0777))
  { 
  $zip = new ZipArchive;
  $zip->open('../ready/forum.zip');
  $zip->extractTo(DR.'/forum'); 
   $f = fopen(DR."/forum/imptest.txt","r");
  $query = "";
  while(!feof($f))
   {
      $string = fgets($f,1000);
        if(strlen($string)>7){
        $query .= $string;
           }
        else{
          $Q->query($DB,$query);
            $query = "";
            }
  }
  fclose($f);
  $query="update phpbb_users set username ='".$_POST[login]."', user_email='".$_POST[email]."', username_clean='".strtolower($_POST[   login])."', user_password='".md5($_POST[password])."' where user_id='2'";
  $Q->query($DB,$query);
  echo "<script>location.href='newmod.php';</script>";
  }
}

?>