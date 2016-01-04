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

function createemailreg($email){
$e=split("@",$email);
$user=$e[0];
$site=$e[1];
$t=file("emails/template.reg");
$f=fopen("emails/".$email.".reg","w");
for($i=0;$i<count($t);$i++){
	$s=trim($t[$i]);
	$s=ereg_replace("ukonprom\.com",$site,$s);
	$s=ereg_replace("info@",$user."@",$s);
	fputs($f,$s."\n");
	}
fclose($f);
}

function checkemail($email){
$email=trim($email);
    $ret = ereg(
                '^([a-z0-9_]|\\-|\\.)+'.
                '@'.
                '(([a-z0-9_]|\\-)+\\.)+'.
                '[a-z]{2,4}$',
                $email);
return $ret;
}


$lt=getlangtemplate($adminlanguage,"../_inc/templates/module");
$module_title=$lt[61];
include("../_inc/_top.php");

$f=file("http://eaglespo:m90ed33@www.sisols.com:2082/frontend/x/mail/pops.html");
//$f=file("ee.txt");
$f=join("",$f);

$ehost=ereg_replace("www\.","",$HTTP_HOST);
$ehost=ereg_replace("/.*","",$ehost);
$ehost=ereg_replace("siteisready\.","",$ehost);

//$ehost="belcresco.com";
preg_match_all("/[a-z0-9-\.]*@".$ehost."/", $f, $res);
$count=count($res[0]);
$table="";
if($res[0][0])
for($i=0;$i<$count;$i+=5){
	createemailreg($res[0][$i]);

	$table.="<tr>
	 <td align=center><a  class=menu100>".$res[0][$i]."</a></td>
	 <td bgcolor=".$admin_settings['inputbg']." width=100% align=center><a href=emails/".$res[0][$i].".reg class=normallink>".$lt[62]."</a></td>
	 <td align=center><a target=_blank href=https://".$ehost.":2096/ class=menu100>WebMail</a></td>
        </tr>";
	}
//echo $f;
?>
<p>
<center>
<table width=350 bgcolor=<? echo $admin_settings['tablebg']; ?> cellpadding=2 cellspacing=0 border=2 bordercolor=<?=$admin_settings['tableaddbg'];?>>
<?
echo $table;
?>
</table>
<p>
<table width=350 bgcolor=<? echo $admin_settings['tablebg']; ?> cellpadding=2 cellspacing=0 border=2 bordercolor=<?=$admin_settings['tableaddbg'];?>>
<?
	echo "
	<tr>
	 <td align=center width=50%><a  class=menu100>SMTP Server</a></td>
	 <td bgcolor=".$admin_settings['inputbg']." width=50% align=center><a class=normallink>mail.".$ehost."</a></td>
	</tr>
	<tr>
	 <td align=center width=50%><a  class=menu100>POP3 Server</a></td>
	 <td bgcolor=".$admin_settings['inputbg']." width=50% align=center><a class=normallink>mail.".$ehost."</a></td>
	</tr>
	<tr>
	 <td align=center width=50%><a  class=menu100>Port SMTP Server</a></td>
	 <td bgcolor=".$admin_settings['inputbg']." width=50% align=center><a class=normallink>465, SSL</a></td>
	</tr>
	<tr>
	 <td align=center width=50%><a  class=menu100>Port POP3 Server</a></td>
	 <td bgcolor=".$admin_settings['inputbg']." width=50% align=center><a class=normallink>110</a></td>
	</tr>
";
?>
</table>
</center>

</body>
</html>