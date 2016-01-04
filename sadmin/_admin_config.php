<?
	if(phpversion() <= "4.0.6") {
		$_POST = ($HTTP_POST_VARS);
		$_FILES = ($HTTP_POST_FILES);
	}

	putenv("upload_max_filesize=500");

	$settings["sitepath"] = $_ENV['DOCUMENT_ROOT'];
	$settings["path"] = "../../";
	$settings["minPwdLenght"] = 3;
	$settings["minLoginLenght"] = 3;
	$settings["upload"] = 1;
	$settings['maxx'] = 500;
	$settings['maxy'] = 500;
	$settings['jpegqual'] = 90;
	$settings['ip']=$REMOTE_ADDR;

	$admin_settings['tablebg']="#746541";
	$admin_settings['inputbg']="#D3D6C0";
	$admin_settings['tableaddbg']="#B5AB8D";
	$admin_settings['site_url']=ereg_replace("www\.","",$HTTP_HOST);
	$admin_settings['site_link']="../..";

	$admin_settings['site_name']=$admin_settings['site_url'];
?>