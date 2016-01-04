<?
include("../_functions.php");
include("../_config.php");
include("../_mysql.php");
include("../_admin_config.php");

$rpath="../";
include("../_checking.php");

if($caction=="displayfirst")
	{
	include("../_failed.php");
	exit;
	}

$lt=getlangtemplate($adminlanguage,"../_inc/templates/module");
$module_title=$lt[60];
include("../_inc/_top.php");
echo "<p>
<table width=100% cellpadding=0 cellspacing=0 border=0>
<tr>
<td width=100%>
";

if(file_exists("saved/".$module_name."-date.txt")){
	$f=file("saved/".$module_name."-date.txt");
	$d=$f[0];
	}
else
	$d=0;

$t=time();

if(($t-$d)>12*60*60){
	$f=file("http://eaglespo:plfiewe@www.sisols.com:2082/awstats.pl?config=cityslam.eaglesports.ru&lang=en&framename=mainright");
	$stat=join("",$f);
	$stat=EncodeUTF8($stat,"w");
	$stat=ereg_replace(".*</form>","",$stat);
	$stat=ereg_replace("class=[^ >]*","",$stat);
	$stat=ereg_replace("\\\\\"","",$stat);
	$stat=ereg_replace("[\r\n]","",$stat);
	$stat=ereg_replace("\\\\\'","",$stat);
	$stat=ereg_replace("<span[^>]*>([^<]*)</span>","",$stat);
	$stat=ereg_replace("/images/awstats/","images/",$stat);
	$stat=ereg_replace("images/flags","../images/flags",$stat);
	$stat=ereg_replace("<a[^>]*>([^<]*)</a>","\\1",$stat);
	$stat=ereg_replace("<[^>]*mime[^>]*>","&nbsp;",$stat);
	$stat=ereg_replace("<[^>]*/browser/[^>]*>","&nbsp;",$stat);
	$stat=ereg_replace("<[^>]*/os/[^>]*>","&nbsp;",$stat);
	if(strlen($stat)<1000)
		$stat=$lt[63];
	$f=fopen("saved/".$module_name."-stats.html","w");
	fputs($f,$stat);
	fclose($f);
	$f=fopen("saved/".$module_name."-date.txt","w");
	fputs($f,$t);
	fclose($f);
	}

include("saved/".$module_name."-stats.html");
?></td>
</tr>
</table>

</body>
</html>