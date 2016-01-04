<?
$functions_included=true;

foreach($_FILES as $varname => $fileinfo ){
   $ok=$varname;
   $$ok = $fileinfo["tmp_name"];
   $ok=$varname."_name";
   $$ok = $fileinfo["name"];
   }

extract($_REQUEST,EXTR_SKIP);
if($_SESSION)extract($_SESSION,EXTR_OVERWRITE);
extract($_SERVER,EXTR_OVERWRITE);
extract($_ENV,EXTR_OVERWRITE);

///// STRUCTURE FUNCTIONS ///////////////

function structure_getindexbylink($link){
global $structure;
$link=ereg_replace("\.\./","",$link);
for($i=0;$i<count($structure);$i++){
        if($structure[$i][1]=="../".$link)
		return $i;
	}
return -1;
}
/*
function docorrectcart($cart)
{
$s=split(";",$cart);
$c=(strlen($cart)>0) ? count($s) : 1;
for($i=0;$i<($c-1);$i++)
	{
	$s[$i]=split(":",$s[$i]);		
	}
for($i=0;$i<($c-1);$i++)
	{
	for($j=0;$j<($c-1);$j++)
		{
                if(($i!=$j) && ($s[$i][0]==$s[$j][0]) && ($s[$i][0]!=""))
			{
			$s[$i][1]=$s[$i][1]+$s[$j][1];

			$s[$j][0]="";
			$s[$j][1]="";
			}
		}
	}

for($i=0;$i<($c-1);$i++)
	{
	$s[$i]=join(":",$s[$i]);
	if(ereg("\:0",$s[$i]))$s[$i]="";
	if($s[$i]==":")$s[$i]="";
	}
$res=join(";",$s);
$res=ereg_replace(";+",";",$res);
return $res;
}
*/
function define_structure_item(){
global $structure;
$s=$GLOBALS[REQUEST_URI];
$s=split("/",$s);
$c=count($s);
$s=$s[$c-2]."/".$s[$c-1];
$s=ereg_replace("/$","",$s);
$res=structure_getindexbylink($s);
if($res<0){
	$res=structure_getindexbylink(ereg_replace("/.*","",$s));
	}
return $res;
}

function structure_item($index){
global $structure;
$t=trim(mystrtolower($structure[$index]));
$name=ereg_replace("\([^\)]*\)$","",$t);
$t=ereg_replace(".*\(","",$t);
$link=ereg_replace("\)","",$t);
$link="../".$link;
$res[0]=$name;
$res[1]=$link;
return $res;
}

function structure_itemlevel($index)
{
global $structure;
$level=0;
for($i=0;$i<strlen($structure[$index]);$i++)
	if($structure[$index][$i]==" ")
		$level++;
	else
		break;
return $level;
}

function structure_topparent($index){
global $structure;
$i=$index;
while($structure[$i][2]!=0)
        $i--;
return $i;
}

function structure_parent($index){
global $structure;
if($structure[$index][2]==0)
	return $index;
$i=$index;
while($structure[$i][2]==$structure[$index][2])
        $i--;
return $i;
}

///// END OF STRUCTURE FUNCTIONS ///////////////


function getlangtemplate($lang,$filename){
$f=file($filename);
$langs=split("\t",$f[0]);
$langid=0;
for($i=0;$i<count($langs);$i++)
        if(trim($langs[$i])=="[".$lang."]"){
		$langid=$i;
		break;
		}
for($i=1;$i<count($f);$i++){
	$word=split("\t",$f[$i]);
	$word=$word[$langid];
        $res[$i-1]=trim($word);
	}
return $res;
}

function subdocument($path)
{
 $text_array=file($path);
 for ($i=0; $i<count($text_array);$i++)
 {
  if (eregi("(.*)<style(.*)",$text_array[$i])){$flag1=true;}
  if ($flag1){$text.=$text_array[$i];}
  if (eregi("(.*)</style>(.*)",$text_array[$i])){$flag1=false;}

  if (eregi("(.*)</body>(.*)",$text_array[$i])){$flag=false;}
  if ($flag){$text.=$text_array[$i];}
  if (eregi("(.*)<body(.*)",$text_array[$i])){$flag=true;}
 }
 //$text1=eregi_replace("(.*)<body[^>]*>(.+)</body>(.*)","<!--begin replace-->\\2<!--end replace -->",$text1);
 echo $text;
}


function gettextfordb($text){
$text=ereg_replace("\\\\\"","&quot;",$text);
$text=ereg_replace("\\\\\'","&#39;",$text);
$text=ereg_replace("\'","&#39;",$text);
$text=ereg_replace("\\\\\\\\","&#92;",$text);
return $text;
}

function statistics_getnewtext($text,$id){
if($text!=""){
	$text=split("-",$text);
	}
else	{
        for($i=0;$i<209;$i++)
		$text[$i]=0;
	}
$text[$id]++;
$text=join("-",$text);
return $text;
}

function define_language(){
$s=$GLOBALS[REQUEST_URI];
$s=split("/",$s);
$s=$s[1];
return $s;
}


function sum_arrays($s1,$s2){
$count=max(count($s1),count($s2));
$res="";
for($i=0;$i<$count;$i++){
        $res[$i]=$s1[$i]+$s2[$i];
	}
return $res;
}

function set0($id,$digits){
$sid=strlen($id);
for($i=0;$i<($digits-$sid);$i++){
        $id="0".$id;
	}
return $id;
}

function findext($name,$dir){

if (is_dir($dir)) {
    if ($dh = opendir($dir)) {
	$file="";
        while ($file = readdir($dh)) {
		if(ereg($name."\.",$file))
			return $file;
        	}
        closedir($dh);
	return 0;
    	}
	else return 0;
    }
else return 0;

}

function convdate($d)
{
$d=split("[-: ]",$d);
$d=set0($d[2],4).set0($d[1],2).set0($d[0],2).set0($d[3],2).set0($d[4],2).set0($d[5],2);
return $d;
}

function getdate_mmccggg($s){
if(strlen($s)<5)return $s;
$s=split(" ",$s);
$t=$s[1];
$s=$s[0];
$s=split("-",$s);
$s=$s[2]."-".$s[1]."-".$s[0]." ".$t;
return $s;
}

function getdate_mmccggg1($s){
$mas=array("Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec");
if(strlen($s)<5)return $s;
$t1=substr($s,0,4);
$t2=substr($s,4,2);
$t3=substr($s,6,2);
$s=$t3." ".$mas[(integer)$t2-1]." ".$t1;
return $s;
}

function numsort($str1,$str2){
$str1=(float)$str1;
$str2=(float)$str2;
if($str1==$str2)return 0;
if($str1<$str2)return -1;
if($str1>$str2)return 1;
}

function rnumsort($str1,$str2){
$str1=(float)$str1;
$str2=(float)$str2;
if($str1==$str2)return 0;
if($str1<$str2)return 1;
if($str1>$str2)return -1;
}


function sortdata($tabledata,$col,$way,$num)
{
$t=$tabledata;
for($i=0;$i<count($t);$i++)
	{
	$j=$t[$i][0];
	$t[$i][0]=$t[$i][$col];
	$t[$i][$col]=$j;
	$t[$i]=join(chr(1),$t[$i]);
	}
if($num==1)
	{
	if($way==1)
		{
		usort($t,"numsort");
		}
	else
		{
		usort($t,"rnumsort");
		}
	}
else
	{
	if($way==1)
		{
		sort($t);
		}
	else
		{
		rsort($t);
		}
	}
for($i=0;$i<count($t);$i++)
	{
	$t[$i]=split(chr(1),$t[$i]);
	$j=$t[$i][0];
	$t[$i][0]=$t[$i][$col];
	$t[$i][$col]=$j;
	}
return $t;
}

function getmaxid($id1,$tablename1)
{
global $Q,$DB;
$query="select MAX($id1) as $id1 from $tablename1";
$Q->query($DB,$query);
$getmaxid_f=$Q->getrow();
$getmaxid_r = $getmaxid_f[0];
$getmaxid_r++;
return($getmaxid_r);
}

Function mystrtolower($a)
	{
	$result=strtolower($a);
	for($i=0;$i<strlen($a);$i++)
		{
		switch($result[$i])
			{
			case "А":$result[$i]="а";break;
			case "Б":$result[$i]="б";break;
			case "В":$result[$i]="в";break;
			case "Г":$result[$i]="г";break;
			case "Д":$result[$i]="д";break;
			case "Е":$result[$i]="е";break;
			case "Ё":$result[$i]="ё";break;
			case "Ж":$result[$i]="ж";break;
			case "З":$result[$i]="з";break;
			case "И":$result[$i]="и";break;
			case "Й":$result[$i]="й";break;
			case "К":$result[$i]="к";break;
			case "Л":$result[$i]="л";break;
			case "М":$result[$i]="м";break;
			case "Н":$result[$i]="н";break;
			case "О":$result[$i]="о";break;
			case "П":$result[$i]="п";break;
			case "Р":$result[$i]="р";break;
			case "С":$result[$i]="с";break;
			case "Т":$result[$i]="т";break;
			case "У":$result[$i]="у";break;
			case "Ф":$result[$i]="ф";break;
			case "Х":$result[$i]="х";break;
			case "Ц":$result[$i]="ц";break;
			case "Ч":$result[$i]="ч";break;
			case "Ш":$result[$i]="ш";break;
			case "Щ":$result[$i]="щ";break;
			case "Ъ":$result[$i]="ъ";break;
			case "Ы":$result[$i]="ы";break;
			case "Ь":$result[$i]="ь";break;
			case "Э":$result[$i]="э";break;
			case "Ю":$result[$i]="ю";break;
			case "Я":$result[$i]="я";break;
			}
		}
	return($result);
	}

Function mystrtohigher ($a)
	{
	$result=strtolower($a);
	for($i=0;$i<strlen($a);$i++)
		{
		switch($result[$i])
			{
			case "а":$result[$i]="А";break;
			case "б":$result[$i]="Б";break;
			case "в":$result[$i]="В";break;
			case "г":$result[$i]="Г";break;
			case "д":$result[$i]="Д";break;
			case "е":$result[$i]="Е";break;
			case "ё":$result[$i]="Ё";break;
			case "ж":$result[$i]="Ж";break;
			case "з":$result[$i]="З";break;
			case "и":$result[$i]="И";break;
			case "й":$result[$i]="Й";break;
			case "к":$result[$i]="К";break;
			case "л":$result[$i]="Л";break;
			case "м":$result[$i]="М";break;
			case "н":$result[$i]="Н";break;
			case "о":$result[$i]="О";break;
			case "п":$result[$i]="П";break;
			case "р":$result[$i]="Р";break;
			case "с":$result[$i]="С";break;
			case "т":$result[$i]="Т";break;
			case "у":$result[$i]="У";break;
			case "ф":$result[$i]="Ф";break;
			case "х":$result[$i]="Х";break;
			case "ц":$result[$i]="Ц";break;
			case "ч":$result[$i]="Ч";break;
			case "ш":$result[$i]="Ш";break;
			case "щ":$result[$i]="Щ";break;
			case "ъ":$result[$i]="Ъ";break;
			case "ы":$result[$i]="Ы";break;
			case "ь":$result[$i]="Ь";break;
			case "э":$result[$i]="Э";break;
			case "ю":$result[$i]="Ю";break;
			case "я":$result[$i]="Я";break;

			case "a":$result[$i]="A";break;
			case "b":$result[$i]="B";break;
			case "c":$result[$i]="C";break;
			case "d":$result[$i]="D";break;
			case "e":$result[$i]="E";break;
			case "f":$result[$i]="F";break;
			case "g":$result[$i]="G";break;
			case "h":$result[$i]="H";break;
			case "i":$result[$i]="I";break;
			case "j":$result[$i]="J";break;
			case "k":$result[$i]="K";break;
			case "l":$result[$i]="L";break;
			case "m":$result[$i]="M";break;
			case "n":$result[$i]="N";break;
			case "o":$result[$i]="O";break;
			case "p":$result[$i]="P";break;
			case "q":$result[$i]="Q";break;
			case "r":$result[$i]="R";break;
			case "s":$result[$i]="S";break;
			case "t":$result[$i]="T";break;
			case "u":$result[$i]="U";break;
			case "v":$result[$i]="V";break;
			case "w":$result[$i]="W";break;
			case "x":$result[$i]="X";break;
			case "y":$result[$i]="Y";break;
			case "z":$result[$i]="Z";break;

			}
		}
	return($result);
	}

function getfiles_pictures($dir){
$i=0;
if (is_dir($dir)) {
    if ($dh = opendir($dir)) {
	$file="";
        while ($file = readdir($dh)) {
		if(($file!=".") && ($file!="..")){
			if(ereg("gif",$file) || ereg("jpg",$file) || ereg("jpeg",$file) || ereg("png",$file))
				$files[$i++]=$file;
			}
        	}
        closedir($dh);
    	}
	else return 0;
    }
else return 0;
return $files;
}

function getfiles($dir){
$i=0;
if (is_dir($dir)) {
    if ($dh = opendir($dir)) {
	$file="";
        while ($file = readdir($dh)) {
		if(($file!=".") && ($file!=".."))
		$files[$i++]=$file;
        	}
        closedir($dh);
    	}
	else return 0;
    }
else return 0;
return $files;
}

function getfieldsname($aname,$filename){
$f=file($filename);
for($i=1;$i<count($f);$i++){
	$s=split("\t",trim($f[$i]));
	if($s[22]==$aname)
		return $s;
	}
return "";
}

function checkre($field){
global $reachedits;
if(!$reachedits[0])
	return 0;
for($i=0;$i<count($reachedits);$i++)
        if($field==$reachedits[$i][aname])
		return 1;
return 0;
}


function EncodeUTF8( $str, $type )
{
 // $type:
// 'w' - encodes from UTF to win
 // 'u' - encodes from win to UTF

   static $conv='';
   if (!is_array ( $conv ))
   {
       $conv=array ();
       for ( $x=128; $x <=143; $x++ )
       {
         $conv['utf'][]=chr(209).chr($x);
         $conv['win'][]=chr($x+112);
       }

       for ( $x=144; $x <=191; $x++ )
       {
               $conv['utf'][]=chr(208).chr($x);
               $conv['win'][]=chr($x+48);
       }

       $conv['utf'][]=chr(208).chr(129);
       $conv['win'][]=chr(168);
       $conv['utf'][]=chr(209).chr(145);
       $conv['win'][]=chr(184);
     }
     if ( $type=='w' )
         return str_replace ( $conv['utf'], $conv['win'], $str );
     elseif ( $type=='u' )
         return str_replace ( $conv['win'], $conv['utf'], $str );
     else
       return $str;
  }

function prepare_text_form($text){
global $REQUEST_URI,$pt_l;
//echo "-begin-".$pt_l[14]."--end--";
$action=ereg_replace(".*/","",$REQUEST_URI);
if(!trim($action))
	$action="index.php";
$elements=array('input','textarea','select');
$id=1;
$text=ereg_replace("name=\"[^\"]*\"","",$text);
for($k=0;$k<count($elements);$k++){
	$text=split("<".$elements[$k],$text);
	for($i=1;$i<count($text);$i++){
		if((!ereg("^[^>]+type=\"submit",$text[$i])) && (!ereg("^[^>]+type=\"reset",$text[$i]))){
		        $text[$i]=" value=\"".ereg_replace("\"","&quot;",$pt_l[$id])."\" name=\"pt_l[".$id."]\"".$text[$i];

//			if($elements[$k]=="textarea")echo $pt_l[$id]."--";
			$id++;
			}
		}
	$text=join("<".$elements[$k],$text);
	$text=ereg_replace("textarea value=\"([^\"]*)\"([^>]*>)","textarea \\2\\1",$text);
	}
$text=ereg_replace(" value=\"\"","",$text);
//echo $text;
if(ereg("<input",$text))
	$text="<form name=ptform id=ptform action=".$action." method=post enctype=\"multipart/form-data\">
<input type=hidden name=\"ptaction\" value=\"sent\">".$text."</form>";
return $text;
}

function prepare_text_table($text){
global $pt_l_name,$pt_l,$HTTP_HOST,$module_filepath,$AllowToSend,$AllowToSendText;
$text=ereg_replace("<form[^>]+>","",$text);
$text=ereg_replace("</form>","",$text);
$text=ereg_replace("(".chr(60)."textarea[^".chr(62)."]*".chr(62).")[^".chr(60)."]*".chr(60)."/textarea".chr(62)."","\\1",$text);
$text=ereg_replace("</select>","",$text);
$text=ereg_replace("(<option[^>]*>)[^<]*</option>","",$text);
$text=ereg_replace("<input[^>]*type=\"submit[^>]*>","",$text);
$text=ereg_replace("<input[^>]*type=\"hidden[^>]*>","",$text);
$text=ereg_replace("<[^>]+name=\"pt_l\[([0-9]*)\][^>]*>","pt_l_replace\\1p",$text);
//$text=ereg_replace("src=\"/","src=\"http://".$HTTP_HOST."/",$text);
$text=ereg_replace("<img[^>]*>","",$text);
for($i=1;$i<=500;$i++){
	if($pt_l_name[$i]){
	        $text=ereg_replace("pt_l_replace".$i."p",$pt_l_name[$i],$text);
		}
	else
	        $text=ereg_replace("pt_l_replace".$i."p","<b>".$pt_l[$i]."</b>",$text);
	}
$AllowToSend=true;
$t12=ereg_replace("[ \n\r\t]+","",strip_tags($text,"<b>"));
if(ereg("\*\:".chr(60)."b".chr(62).chr(60)."/b".chr(62),$t12)){
	$AllowToSend=false;
	}
$AllowToSendText=$text;
//echo $text;
//echo $t12;
//$css="<link rel=\"stylesheet\" href=\"http://".$HTTP_HOST."/styles/style.css\" type=\"text/css\">";
$css=file("http://".$HTTP_HOST."/styles/style.css");
$css=join("",$css);
$css="<style type=text/css>".$css."</style>";
//echo $text;
//exit;
$text=$css.$text;
return $text;
}

function XMail( $from, $to, $subj, $text, $filename)
{
//$text=ereg_replace(".*отмечены поля обязательные для заполнения","",$text);
//echo $text;
$un        = strtoupper(uniqid(time()));
$head      = "From: $from\n";
//$head     .= "To: $to\n";
$head     .= "Subject: $subj\n";
$head     .= "X-Mailer: SiSols.com mailer\n";
$head     .= "Reply-To: $from\n";
$head     .= "Mime-Version: 1.0\n";
$head .= "Content-Type:multipart/mixed;";
$head .= "boundary=\"----------".$un."\" \n";
//$zag       = "\n\n$text\n\n";
$zag       = "------------".$un."\n";
$zag      .= "Content-Type:text/html; charset=windows-1251\n";
$zag      .= "Content-Transfer-Encoding: Quot-Printed\n\n$text\n";

/* $zag       = "------------".$un."\n";
$zag      .= "Content-Type: image/jpeg; name='5.jpg'\n";
$zag      .= "Content-Transfer-Encoding:base64\n";*/
//print_r($filenam e);
if($filename[0])
for($i=0;$i<count($filename);$i++){
	$f         = fopen($filename[$i][1],"rb");
	$zag      .= "------------".$un."\n";
	$zag      .= "Content-Type: application/octet-stream;";
	$zag      .= "name=\"".convert_cyr_string(basename($filename[$i][0]), "w", "k")."\"\n";
	$zag      .= "Content-Transfer-Encoding:base64\n";
	$zag      .= "Content-Disposition:attachment;";
	$zag      .= "filename=\"".basename($filename[$i][0])."\"\n\n";
	$zag      .= chunk_split(base64_encode(fread($f,filesize($filename[$i][1]))))."\n";
	fclose($f);
	}

	$zag      .= "------------".$un."--\n";
	//echo $zag;
$subj = "=?windows-1251?b?" . base64_encode($subj) . "?=";
$res=mail($to, $subj, $zag, $head);
if (!$res){
return 0;
 }
else {
 return 1;
 }
}


function prepare_text_send($email,$table,$reply){
global $REQUEST_URI,$HTTP_HOST,$pt_l_name,$pt_l;
$filename="";
$j=0;
for($i=1;$i<=500;$i++){
	if($pt_l_name[$i]){
		$filename[$j][0]=$pt_l_name[$i];
		$filename[$j][1]=$pt_l[$i];
		$j++;
		}
	}
$from=ereg_replace("www\.","feedback@",$HTTP_HOST);
if($reply)
	$reply=($pt_l[$reply])? $pt_l[$reply] : $from;
else
	$reply=$from;
//mail($email, $HTTP_HOST, convert_cyr_string($table, "w", "k") , "From: ".$from." \n".$reply."MIME-Version: 1.0\nContent-Type: text/html;\n	charset=\"koi8-r\"\nContent-Transfer-Encoding: 7bit\n");
$v=ereg_replace(".*value='([^']+)'.*","\\1",$table);
$v=ereg_replace("&qout;","\"",$v);
$v=ereg_replace("&lt;","<",$v);
$v=ereg_replace("&gt;",">",$v);
$table=ereg_replace("'>","",$table);
$table=ereg_replace("<input[^]+","",$table);
$table=$v.$table;
//echo "------------------------".$table;
//echo $email;
//XMail("info@tool.by","lelenko@mail.ru",$HTTP_HOST,$table,$filename);
XMail("info@drel.by","6440909@gmail.com",$HTTP_HOST,$table,$filename);
XMail("info@drel.by","10@10.by",$HTTP_HOST,$table,$filename);
}

function prepare_text($row,$reply=0){
global $pt_l,$ptaction,$lang,$AllowToSend,$module_filepath;

$text=ereg_replace("&quot;","\"",$row[text]);

$text=ereg_replace("\<\/modifiedtime\>","",$text);

$r=preg_match_all("/\<modifiedtime\>([^]+)/U",$text,$res,PREG_PATTERN_ORDER);
$text=ereg_replace("\<modifiedtime\>[^]+","",$text);
$text=split("",$text);
for($o=0;$o<count($res[1]);$o++){
//	$res[1][$o]=ereg_replace("","\?\>",$res[1][$o]);
//	eval(ereg_replace("echo ","\$row[\$i][$o].=",$res[1][$o]));
	$filename=trim(ereg_replace(".*lichba\.by","",$res[1][$o]));
	$filename=$module_filepath.$filename;
	if(file_exists($filename)){
		$last_modified = filemtime($filename);
		$text[$o].=date("d.m.Y", $last_modified);
		}
	}
$text=join("",$text);

$text=prepare_text_form($text);
//echo "00";
$res=$text;
if($ptaction){
	$email=$row[f10];
	if(count($email)>1)
		$email=join("",$email);
	$email=split("\n",$email);
	$f10=$email;
	$res=$email[1];
	$email=trim($email[0]);
	$table=prepare_text_table($text);
	if($AllowToSend)
		prepare_text_send($email,$table,$reply);
	else	{
		$etext=trim($f10[2]);
		if(!$etext){
		        switch($lang){
			case "ru":$etext="Пожалуйста, заполните обязательные поля, отмеченные звездочкой.";break;
			default:$etext="Please fill all required fields.";
				}
			}
		$etext="<font color=red>".$etext."</font>";
		$res=$etext.$text;
		}
	}
//echo $table;
return $res;
}

function is_email($string)
{
    // Remove whitespace
    $string = trim($string);
//echo $string;
$string=ereg_replace("\-","",$string);
    $ret = ereg(
                '^[A-Za-z0-9_\.]+'.
                '@'.
                '[A-Za-z0-9_\.]+'.
                '[a-zA-Z]{2,4}$',
                $string);

    return($ret);
}


function setlastdbupdate(){
global $module_adminconf;
$filename=$module_adminconf."lastupdate.date";
$s=date("d-m-Y H:i:s",time()+8*60*60);
$f=fopen($filename,"w");
fputs($f,$s);
fclose($f);
}

function correct_query($query){
//$query=ereg_replace("and[ ]+f[0-9]+=['\"]{1}['\"]{1}","",$query);
$query=ereg_replace("date='?([0-9]{2}).([0-9]{2}).([0-9]{4})'?","date<='\\3.\\2.\\1 23:59:59' and date>='\\3.\\2.\\1 00:00:00'",$query);
$query=ereg_replace("date>'?([0-9]{2}).([0-9]{2}).([0-9]{4})'?","date>'\\3.\\2.\\1 23:59:59'",$query);
$query=ereg_replace("date>='?([0-9]{2}).([0-9]{2}).([0-9]{4})'?","date>'\\3.\\2.\\1 00:00:00'",$query);
$query=ereg_replace("date<'?([0-9]{2}).([0-9]{2}).([0-9]{4})'?","date<'\\3.\\2.\\1 00:00:00'",$query);
$query=ereg_replace("date<='?([0-9]{2}).([0-9]{2}).([0-9]{4})'?","date<='\\3.\\2.\\1 23:59:59'",$query);
$query=ereg_replace("f[0-9]+=['\"]{1}['\"]{1}[ ]+and","",$query);
$query=ereg_replace("where[ ]+f[0-9]+=['\"]{1}['\"]{1}","",$query);
$query=ereg_replace("(f[0-9]{1})([".chr(60).chr(62)."=]+)'?([0-9]{2})\.([0-9]{2})\.([0-9]{4})'?","(date(\\1)\\2'\\5-\\4-\\3' or \\1='')",$query);
//echo $query;
return $query;
}


function rblock($query,$rid){
global $DB,$Q,$Q2,$module_name,$module_filepath,$page,$id,$inf;
$rquery=ereg_replace("where","where rid=".$rid." and",$query);
//echo $rquery;
$Q->query($DB,$rquery);
$count=$Q->numrows();
$in=Array();
for($i=0;$i<$count;$i++){
	$inf[]=$Q->getrow();
	}
$rquery="select * from ".$module_name." where rid=".$rid." order by date desc";
$Q->query($DB,$rquery);
$count=$Q->numrows();
for($i=0;$i<$count;$i++){
	$row[]=$Q->getrow();
	}

for($i=0;$i<$count;$i++){
	rblock($query,$row[$i][id]);
	}
}

Function block($query,$template,$separator="",$template_up="",$paging="",$errormessage="",$rrid=0) {
global $DB,$Q,$Q2,$module_name,$module_filepath,$page,$id,$inf,$paging_count;

//if(ereg("id=[^ ]+[^0-9 ]+",$query))
//	return $errormessage;
if(ereg("id=$",$query))
	return $errormessage;
if(ereg("id= ",$query))
	return $errormessage;

$query=correct_query($query);
//echo $query;
$filename=$module_filepath."/_t/_items/".$template.".tpl";
if(!file_exists($filename)){
	switch($template){
		case "date":$template_normal="[date]";break;
		case "name":$template_normal="[name]";break;
		case "anons":$template_normal="[anons]";break;
		case "text":$template_normal="[text]";break;
		case "f1":$template_normal="[f1]";break;
		case "f3":$template_normal="[f3]";break;
		case "f9":$template_normal="[f9]";break;
		}
	}
if(!$template_normal){
	if(!file_exists($filename))
		return "File ".$template.".tpl not found.";
	$f=file($filename);
	$template_normal=join("",$f);
	}

if($separator){
	$filename=$module_filepath."/_t/_items/".$separator.".tpl";
	if(file_exists($filename)){
		$f=file($filename);
		$separator=join("",$f);
		}
	else
		return "File ".$separator.".tpl not found.";
	}

$filename=$module_filepath."/_t/_items/".$template_up.".tpl";
if(file_exists($filename)){
	$f=file($filename);
	$template_up=join("",$f);
	}


$count="";
if(!ereg("^[0-9]+",$query)){
	$query="select * from ".$module_name." where ".$query;
	if($paging){
		if(!$page)
			$page=1;
		$query.=" limit ".(($page-1)*$paging).",".$paging;
		}
	$Q->query($DB,$query);
	$count=$Q->numrows();
	$standart_query=1;
	}
else	{
	$q=split(",",$query);
	$query=$q[1];
	$count=$q[0];
	if(trim($query)){
		$query="select * from ".$module_name." where ".$query;
		$Q->query($DB,$query);
	        $info=$Q->getrow();
		}
	$standart_query=0;
	}

// recourse rid
if($standart_query && $rrid){
	$query=ereg_replace("limit.*","",$query);
	rblock($query,$rrid);
	$standart_query=2;
	$paging_count=count($inf);
	$count=$paging_count;
	if($count>$paging)$count=$paging;
	}

//echo $query;

$row=Array();
for($i=0;$i<$count;$i++){
	if($standart_query==1)
	        $info=$Q->getrow();
	if($standart_query==2){
	        $info=$inf[(($page-1)*$paging)+$i];
		}
	$anonspicture="";
	$anypicture="";
	$ridname="";
	if(ereg("\[ridname\]",$template_normal)){
		$Q2->query($DB,"select * from ".$module_name." where id=".$info[rid]);
		$info2=$Q2->getrow();
		$ridname=$info2[name];
		}
	if(ereg("anypicture",$template_normal)){
		$s=getfiles_pictures($module_filepath."/attachments/".$info[id]."/");
		if(trim($s[0])){
			$anypicture="<img src=/attachments/".$info[id]."/".$s[0]." border=0";
			}
		}
	if(ereg("anonspicture",$template_normal)){
		$filename=$module_filepath."/attachments/".$info[id]."/anons.jpg";
		if(file_exists($filename)){
			$anonspicture="<img src=/attachments/".$info[id]."/anons.jpg border=0";
			}
		}
	$date=ereg_replace(" .+","",$info[date]);
	$date=split("\-",$date);
	$date=$date[2].".".$date[1].".".$date[0];

	$r=ereg_replace("\[name\]",$info[name],$template_normal);
	$r=ereg_replace("\[id\]",$info[id],$r);
	$r=ereg_replace("\[date\]",$date,$r);
	$r=ereg_replace("\[lang\]",$info[lang],$r);
	$r=ereg_replace("\[rid\]",$info[rid],$r);
	$r=ereg_replace("\[ridname\]",$ridname,$r);
	$r=ereg_replace("\[anons\]",$info[anons],$r);
	$r=ereg_replace("\[aname\]",$info[aname],$r);
	$r=ereg_replace("\[archive\]",$info[archive],$r);
	if(ereg("\[text\]",$r))
		$r=ereg_replace("\[text\]",prepare_text($info),$r);
	$r=ereg_replace("\[f1\]",$info[f1],$r);
	$r=ereg_replace("\[f2\]",$info[f2],$r);
	$r=ereg_replace("\[f3\]",$info[f3],$r);
	$r=ereg_replace("\[f4\]",$info[f4],$r);
	$r=ereg_replace("\[f5\]",$info[f5],$r);
	$r=ereg_replace("\[f6\]",$info[f6],$r);
	$r=ereg_replace("\[f7\]",$info[f7],$r);
	$r=ereg_replace("\[f8\]",$info[f8],$r);
	$r=ereg_replace("\[f9\]",$info[f9],$r);
	$r=ereg_replace("\[existence\]",$info[existence],$r);
	$r=ereg_replace("\[number\]","".(($page - 1)*$paging +$i+1)."",$r);
	if($anonspicture){
		$r=ereg_replace("\[anonspicture(.*)\]",$anonspicture." \\1 >",$r);
		}
	else	{
		$r=ereg_replace("\[anonspicture(.*)\]","",$r);
		}
	if($anypicture){
		$r=ereg_replace("\[anypicture(.*)\]",$anypicture." \\1 >",$r);
		}
	else	{
		$r=ereg_replace("\[anypicture(.*)\]","",$r);
		}
	$row[$i]=$r;
	}
for($i=0;$i<$count;$i++){
	$row[$i]=ereg_replace("\?\>","",$row[$i]);

	$r=preg_match_all("/<\?([^]+)/U",$row[$i],$res,PREG_PATTERN_ORDER);
//	$row[$i]=ereg_replace("\<\?[^\?]+\?\>","",$row[$i]);
	$row[$i]=ereg_replace("\<\?[^]+","",$row[$i]);
	$row[$i]=split("",$row[$i]);
	for($o=0;$o<count($res[1]);$o++){
		$res[1][$o]=ereg_replace("","\?\>",$res[1][$o]);
		eval(ereg_replace("echo ","\$row[\$i][$o].=",$res[1][$o]));
		}
	$row[$i]=join("",$row[$i]);
	}
$template_up=ereg_replace("\[item\]","",$template_up);
if($template_up){
	$template_up_new="";
	$r=Array();
	for($i=0;$i<$count;$i++){
		if(!ereg("",$template_up_new)){
			if($i!=0)
				$r[]=$template_up_new;
			$template_up_new=$template_up;
			}
		$template_up_new=ereg_replace("^([^]*)","\\1".$row[$i],$template_up_new);
		}
	$r[]=ereg_replace("","",$template_up_new);
	$row=join($separator,$r);
	}
else    {
	$row=join($separator,$row);
	}

if(!$count)
	return $errormessage;

$arr_links = Array();
$ereg = '"<a[^<]*</a>"';
$you_preg = '"href=(\"[^\"]*)\""'; 
preg_match_all($ereg, $row, $arr_links);
for ($i = 0; $i < count($arr_links[0]); $i++)
{
	if (ereg("youtube", $arr_links[0][$i]))
	{
		$params = strip_tags($arr_links[0][$i]);
		if (ereg("х", $params))
			$params = split("х", $params);
		if (ereg("x", $params))
			$params = split("x", $params);
		$youtube = Array();
		preg_match_all($you_preg, $arr_links[0][$i], $youtube);
		$youtube[1][0] = str_replace("watch?v=", "v/", $youtube[1][0]);
		$youtube[1][0] = str_replace("&amp;feature=topvideos", "", $youtube[1][0]);
		$player = '<object width="'.$params[0].'" height="'.$params[1].'"><param name="movie" value='.$youtube[1][0].'&hl=ru_RU&fs=1&rel=0"></param><param name="allowFullScreen" value="true"></param><param name="allowscriptaccess" value="always"></param><embed src='.$youtube[1][0].'&hl=ru_RU&fs=1&rel=0" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" width="'.$params[0].'" height="'.$params[1].'"></embed></object>';
		/*
		$player = '<object width="'.$params[0].'" height="'.$params[1].'"><param name="movie" value='.$youtube[1][0].'"></param><param name="allowFullScreen" value="true"></param><param name="allowscriptaccess" value="always"></param><embed src='.$youtube[1][0].'" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" width="'.$params[0].'" height="'.$params[1].'"></embed></object>';*/
		$row = str_replace($arr_links[0][$i], $player, $row);
	}
}

return $row;
}

function showcart($formid){
global $DOCUMENT_ROOT,$id,$action,$enumber,$shopcart,$path,$DB,$Q,$Q2,$module_name,$pt_l;
include($DOCUMENT_ROOT."/_modules/cart/_center.php");
}

function showpaging($query,$template_normal,$template_selected,$onpage){
global $DOCUMENT_ROOT,$id,$DB,$Q,$Q2,$module_name,$page,$REQUEST_URI,$paging_count;

$query=ereg_replace("and[ ]+f[0-9]+=['\"]{1}['\"]{1}","",$query);
$query=ereg_replace("f[0-9]+=['\"]{1}['\"]{1}[ ]+and","",$query);
$query=ereg_replace("where[ ]+f[0-9]+=['\"]{1}['\"]{1}","",$query);

if(!$page)$page=1;

$link=$REQUEST_URI;
$link=ereg_replace("page=[0-9]+","",$link);
$link=ereg_replace("\&\&","&",$link);
$link=ereg_replace("\?\&","?",$link);
$link=ereg_replace("\?$","",$link);
if(ereg("\?",$link))
	$link.="&";
else
	$link.="?";
$f=file($DOCUMENT_ROOT."/_t/_items/".$template_normal.".tpl");
if(count($f)>0)
	$template_normal=join("",$f);
else
	$template_normal=$f;

$f=file($DOCUMENT_ROOT."/_t/_items/".$template_selected.".tpl");
if(count($f)>0)
	$template_selected=join("",$f);
else
	$template_selected=$f;

$query="select * from ".$module_name." where ".$query;
$Q->query($DB,$query);
$count=$Q->numrows();
if($paging_count)
	$count=$paging_count;
$paging=Array();
    $paging[]='Страницы:&nbsp;&nbsp;';
for($i=0;$i<($count/$onpage);$i++){
	if($i==0 && $page!=($i+1))
		$paging[]='<a href="'.$link.'page='.($page-1).'">назад</a>&nbsp;&nbsp;';
	if($page==($i+1))
		$t=$template_selected;
	else
		$t=$template_normal;
	$t=ereg_replace("\[link\]",$link."page=".($i+1),$t);
	$t=ereg_replace("\[number\]","".($i+1),$t);
	$paging[]=$t;
	}
	if($page != ceil($count/$onpage))
		$paging[]='&nbsp;&nbsp;<a href="'.$link.'page='.($page+1).'">далее</a>';
$paging=join("",$paging);
if(ceil($count/$onpage) == 1 || ceil($count/$onpage) == 0)
	return FALSE;
else
	return $paging;
}

function showAuthForm($rid,$authformnotlogged,$authformlogged){
global $module_filepath,$auth,$DB,$Q;
if($authformnotlogged){
	$filename=$module_filepath."/_t/_items/".$authformnotlogged.".tpl";
	if(file_exists($filename)){
		$f=file($filename);
		$authformnotlogged=join("",$f);
		}
	else
		return "File ".$authformnotlogged.".tpl not found.";
	}
if($authformlogged){
	$filename=$module_filepath."/_t/_items/".$authformlogged.".tpl";
	if(file_exists($filename)){
		$f=file($filename);
		$authformlogged=join("",$f);
        if($auth[name])
        {
		$Q->query($DB,'SELECT * FROM lichba WHERE id='.$auth[id]);
		$row=$Q->getrow();

		if(ereg("<b>[a-zA-Zа-яА-Я1-9]+</b>",$row[text], $regs)) $name = $regs[0];
        }

		$authformlogged=ereg_replace("\[name\]",$name,$authformlogged);
		}
	else
		return "File ".$authformlogged.".tpl not found.";
	}
if($auth[name])
{
	$res=$authformlogged;
}
else
{
	$res='<div style="FONT-FAMILY:Arial;font-size:12px;color:#ff0000;font-weight:normal; margin-bottom: 10px;">Извините, но пользователя с таким логином и паролем не существует</div>'.$authformnotlogged;
$res=ereg_replace("\[name\]",$auth[name],$res);
$res=ereg_replace("\[id\]",$auth[id],$res);
$res=ereg_replace("\[f1\]",$auth[f1],$res);
$res=ereg_replace("\[f2\]",$auth[f2],$res);
$res=ereg_replace("\[f3\]",$auth[f3],$res);
$res=ereg_replace("\[f4\]",$auth[f4],$res);
$res=ereg_replace("\[f5\]",$auth[f5],$res);
$res=ereg_replace("\[f6\]",$auth[f6],$res);
if(ereg("input",$res)){
	$res=ereg_replace("(form[^>]+)name","\\1nam",$res);
	$res=ereg_replace("name=","",$res);
	$res=ereg_replace("(form[^>]+)nam","\\1name",$res);
	$res=split("input",$res);
	$res[1]=" name=LoginName ".$res[1];
	$res[2]=" name=LoginPassword ".$res[2];
	$res=join("input",$res);
	$res=ereg_replace(chr(60)."/form".chr(62),"<input type=hidden name=LoginRid value=\"".$rid."\"></form>",$res);
	}
}
return $res;

}

function showAuthForm2($rid,$authformnotlogged,$authformlogged){
global $module_filepath,$auth,$DB,$Q;
if($authformnotlogged){
	$filename=$module_filepath."/_t/_items/".$authformnotlogged.".tpl";
	if(file_exists($filename)){
		$f=file($filename);
		$authformnotlogged=join("",$f);
		}
	else
		return "File ".$authformnotlogged.".tpl not found.";
	}
if($authformlogged){
	$filename=$module_filepath."/_t/_items/".$authformlogged.".tpl";
	if(file_exists($filename)){
		$f=file($filename);
		$authformlogged=join("",$f);
        if($auth[name])
        {
		$Q->query($DB,'SELECT * FROM lichba WHERE id='.$auth[id]);
		$row=$Q->getrow();

		if(ereg("<b>[a-zA-Zа-яА-Я1-9]+</b>",$row[text], $regs)) $name = $regs[0];
        }

		$authformlogged=ereg_replace("\[name\]",$name,$authformlogged);
		}
	else
		return "File ".$authformlogged.".tpl not found.";
	}
if($auth[name])
{
	$res=$authformlogged;
}
else
{
	$res=$authformnotlogged;
$res=ereg_replace("\[name\]",$auth[name],$res);
$res=ereg_replace("\[id\]",$auth[id],$res);
$res=ereg_replace("\[f1\]",$auth[f1],$res);
$res=ereg_replace("\[f2\]",$auth[f2],$res);
$res=ereg_replace("\[f3\]",$auth[f3],$res);
$res=ereg_replace("\[f4\]",$auth[f4],$res);
$res=ereg_replace("\[f5\]",$auth[f5],$res);
$res=ereg_replace("\[f6\]",$auth[f6],$res);
if(ereg("input",$res)){
	$res=ereg_replace("(form[^>]+)name","\\1nam",$res);
	$res=ereg_replace("name=","",$res);
	$res=ereg_replace("(form[^>]+)nam","\\1name",$res);
	$res=split("input",$res);
	$res[1]=" name=LoginName ".$res[1];
	$res[2]=" name=LoginPassword ".$res[2];
	$res=join("input",$res);
	$res=ereg_replace(chr(60)."/form".chr(62),"<input type=hidden name=LoginRid value=\"".$rid."\"></form>",$res);
	}
}
return $res;

}

function showmeta($rrid , $template_default_meta){
global $module_filepath,$auth,$DB,$Q,$REQUEST_URI,$module_name,$id,$rid;

$query="select * from ".$module_name." where name='".$REQUEST_URI."' and rid=".$rrid;
$Q->query($DB,$query);
$count=$Q->numrows();
if($count==0){
	$filename=$module_filepath."/_t/_items/".$template_default_meta.".tpl";
	if(file_exists($filename)){
		$f=file($filename);
		$meta=join("",$f);
		if($id){
			$query="select * from ".$module_name." where id=".$id." and (aname='a2' or aname='b2' or aname='c2' or aname='d2')";
			$Q->query($DB,$query);
		        $row=$Q->getrow();
			}
		else	{

			if($rid){
			$query="select * from ".$module_name." where id=".$rid."  and (aname='a2' or aname='b2' or aname='c2' or aname='d2')";
			$Q->query($DB,$query);
		        $row=$Q->getrow();
			}
			}
		$meta=ereg_replace("\[name\]",$row[name],$meta);
		$meta=ereg_replace("\[id\]",$row[name],$meta);
		$meta=ereg_replace("\[anons\]",$row[name],$meta);
		$meta=ereg_replace("\[f1\]",$row[name],$meta);
		$meta=ereg_replace("\[f2\]",$row[name],$meta);
		}
	else
		return "File ".$authformlogged.".tpl not found.";
	}
else    {
	$meta=$Q->getrow();
	$meta=ereg_replace("&quot;","\"",$meta[anons]);

	}
if(($_GET[vendor]) && (!$count)) $meta = '<title>'.$_GET[vendor].'</title>';
return $meta;
}

function showoproschart($id){
global $module_filepath,$DB,$Q,$REQUEST_URI,$module_name;

$query="select * from ".$module_name." where id=".$id;
$Q->query($DB,$query);
$count=$Q->numrows();
if($count){
        $row=$Q->getrow();
	$row[f1]=ereg_replace("\r","",$row[f1]);
	$answerss=split("\n",$row[f1]);

	$chart=join("-",$answerss);
	return "<img src=/chart.php?cdata=".$chart.">";
	}
return "Error. ID=".$id." not found.";
}

function showopros($id , $template){
global $module_filepath,$DB,$Q,$REQUEST_URI,$module_name;

$query="select * from ".$module_name." where id=".$id;
$Q->query($DB,$query);
$count=$Q->numrows();
$opros="Error. ID=".$id." not found.";
if($count){
        $row=$Q->getrow();
	$filename=$module_filepath."/_t/_items/".$template.".tpl";
	if(file_exists($filename)){
		$f=file($filename);
		$opros=join("",$f);
		$opros=ereg_replace("\[question\]",$row[name],$opros);
		$opros=ereg_replace("form","",$opros);
		$oprosline=ereg_replace(".*\{([^\}]+)\}.*","\\1",$opros);
		$answer=split("\n",$row[anons]);
		for($i=0;$i<count($answer);$i++){
		        $answer[$i]=ereg_replace("\[answer\]",trim($answer[$i]),$oprosline);
		        $answer[$i]=ereg_replace("name=","",$answer[$i]);
		        $answer[$i]=ereg_replace("(radio\"?)","\\1 name=vopros",$answer[$i]);
			}
		$answer="<form action=".$REQUEST_URI." name=fvopros id=fvopros method=post><input type=hidden name=oprosid value=".$id.">".join("",$answer)."</form>";
		$opros=ereg_replace("\{([^\}]+)\}",$answer,$opros);
		}
	else
		return "File ".$template.".tpl not found.";
	}
return $opros;
}

function showRegistrationForm( $id, $aname, $rid, $letter_template, $error_message, $successful_message,$email_error_message){
global $module_filepath,$auth,$DB,$Q,$REQUEST_URI,$module_name,$pt_l,$pt_action,$AllowToSend,$AllowToSendText,$HTTP_HOST;

$filename=$module_filepath."/_t/_items/".$letter_template.".tpl";
if(file_exists($filename)){
	$f=file($filename);
	$letter_template=join("",$f);
	}
else
	return "File ".$letter_template.".tpl not found.";

$query="select * from ".$module_name." where id=".$id;
$Q->query($DB,$query);
$info=$Q->getrow();
$text=prepare_text($info);
$lang=$info[lang];

if($AllowToSend){
//        echo $AllowToSendText;
	$email=strip_tags($AllowToSendText);
	$email=ereg_replace("([^@]{1})mail","\\1",$email);
	$email=trim(ereg_replace("^[^]+","",$email));
	$email=trim(ereg_replace("^[^a-zA-Z0-9]+","",$email));
//	$email=ereg_replace("(^[a-zA-Z0-9\-\.@_]+)[^a-zA-Z0-9\-\.@_]+.*","\\1",$email);

	$email=ereg_replace("(^[a-zA-Z0-9\-\.@_]+@[a-zA-Z0-9\-\._]+).*","\\1",$email);
	$email=ereg_replace("[^a-zA-Z0-9]+$","",$email);
	$email=trim($email);

	$email=ereg_replace("^([^ \n\r]+)[\r\n ]{1}.*","\\1",$email);

//	echo $email;
	if(!is_email($email))
		return "<font color=#FF0000>".$email_error_message."</font>";

	$query="select * from ".$module_name." where rid=".$rid." and name='".$email."'";
	$Q->query($DB,$query);
	$count=$Q->numrows();
//echo $query;
	if($count)
		$text="<font color=#FF0000>".$error_message."</font>";
	else	{
		$r=getmaxid("id",$module_name);
		$ddate=convdate(date("d-m-Y H:i:s",time()));
		$password=substr(strtoupper(md5(rand())),1,5);
		$query="INSERT INTO ".$module_name." VALUES($r,".$rid.",'','".$aname."','".$lang."','".$ddate."','".$email."','".$password."','".$AllowToSendText."','','','','','','','','','','','')";
		$Q->query($DB,$query);
//		echo $query;
		$text=$successful_message;
		$sitename=ereg_replace("www\.","",$HTTP_HOST);
		$letter_template=ereg_replace("\[name\]",$email,$letter_template);
		$letter_template=ereg_replace("\[anons\]",$password,$letter_template);
//		echo $letter_template;
//		mail($email, $sitename, "Content-Type:text/html;\nContent-Transfer-Encoding: 8bit\n\n".$letter_template."\n\n", "Content-Type:multipart/mixed; charset=Windows-1251;");
		}
	}

return $text;
}


$todayDay=date("d",time());
$todayYear=date("Y",time());
$todayMonth=date("m",time());
$todayDate=$todayDay.".".$todayMonth.".".$todayYear;

if(!$module_filepath)
	include($DOCUMENT_ROOT."/sadmin/_config.php");
if(!$DB)
	include($DOCUMENT_ROOT."/sadmin/_mysql.php");

if($f10){
	$query="select * from ".$module_name." where (aname='c2' or aname='b2' or aname='a2') and f10='".urlencode($f10)."'";
	$Q->query($DB,$query);
	$row=$Q->getrow();
	$id=$row[id];
	$_GET['id']=$id;
	}


// shopping cart
$carttotal=0;
$cartcount=0;
if(ereg("cart\.php",$REQUEST_URI))
	include($DOCUMENT_ROOT."/_modules/cart/_start.php");
if($shopcart){
	include($DOCUMENT_ROOT."/_modules/cart/_getinfo.php");
	}

// forgot password
if($ForgotEmail && $ForgotRid){
	$query="select * from ".$module_name." where name='".$ForgotEmail."' and rid=".$ForgotRid;
	$Q->query($DB,$query);
	$count=$Q->numrows();
	if($count){
	        $row=$Q->getrow();
		$password=$row[anons];
		$sitename=ereg_replace("www\.","",$HTTP_HOST);
		$ForgotLetter=ereg_replace("\[site\]",$sitename,$ForgotLetter);
		$ForgotLetter=ereg_replace("\[password\]",$password,$ForgotLetter);
		mail($ForgotEmail, $sitename, "Content-Type:text/html;\nContent-Transfer-Encoding: 8bit\n\n".$ForgotLetter."\n\n", "Content-Type:multipart/mixed; charset=Windows-1251;");
		$ForgotAnswer="<font color=#009900>".$ForgotAnswerOK."</font><p>";
		}
	else	{
		$ForgotAnswer="<font color=#FF0000>".$ForgotAnswerNotOK."</font><p>";
		}
	}

//Функция для получения идентификаторов всех продуктов в каталоге для личбы

function recursive($idt)
{
	global $DB,$Q,$Q2,$module_name,$module_filepath,$page,$id,$inf,$row_we,$site_number;
	if($idt == 0)
		$result = mysql_query('SELECT * FROM lichba WHERE rid = 23');
	else
		$result = mysql_query('SELECT * FROM lichba WHERE rid ='.$idt);

    if(mysql_num_rows($result) != 0)
	{
		while ($info_get = mysql_fetch_array($result))
		{
			recursive($info_get['id']);
		}
	}
	else
	{

	$result = mysql_query('SELECT * FROM lichba WHERE id ='.$idt.' and f2 REGEXP "[[:<:]]'.$site_number.'[[:>:]]"');
    	if(mysql_num_rows($result) != 0){
		$row_we[] = $idt;
//		echo $idt." ";
		}
	}
}
//Конец функции


function products_exists($id){
global $DB,$Q,$Q2,$module_name,$module_filepath,$site_number;

$query="select * from ".$module_name." where rid=".$id." and f2 REGEXP '[[:<:]]".$site_number."[[:>:]]'";
$Q->query($DB,$query);
$count=$Q->numrows();
if($count)
	return 1;
$query="select * from ".$module_name." where rid=".$id;
$Q->query($DB,$query);
$count=$Q->numrows();

$row=Array();
for($i=0;$i<$count;$i++){
        $row[$i]=$Q->getrow();
	}
for($i=0;$i<$count;$i++){
        if(products_exists($row[$i][id])){
		return 1;
		}
	}
//echo $id."<br>";
return 0;
}

//Функция для нахождения индификатора товарной группы. Нужна для поиска по параметрам. для личбы

function recursive_prov($idt)
{
	global $DB,$Q,$Q2,$module_name,$module_filepath,$page,$id,$inf,$catalog_now_id;

		$result = mysql_query('SELECT * FROM lichba WHERE id ='.$idt);
		$info_prov = mysql_fetch_array($result);
		if($info_prov[rid] == 23)
		{
			return $idt;
		}
		else
		{
			recursive_prov($info_prov[rid]);
		}
}
//Конец функции




// authorization
//include($DOCUMENT_ROOT."/_modules/auth/_start.php");

// questions/answers
if(file_exists($DOCUMENT_ROOT."/_modules/opros/_start.php"))
	include($DOCUMENT_ROOT."/_modules/opros/_start.php");


$id=(integer)$id;

if(($id) && (!ereg("sadmin",$REQUEST_URI))){
	$query="select * from ".$module_name." where id=".$id;
	$Q->query($DB,$query);
	$count=$Q->numrows();
	if(!$count)
		header("Location: /error.php");

	}

function sortmas($mas){
for($i=0; $i<count($mas); $i++)
	$mas[$i]=trim($mas[$i]);
$mas=array_unique($mas);
if(!is_float($mas[0]))
	sort($mas);
else
	sort($mas,SORT_NUMERIC);
	
return $mas;
}

function getdate_news($s){
global $lang;
$mas['gb']=array("January","February","March","April","May","June","July","August","September","October","November","December");
$mas['ru']=array("января","февраля","марта","апреля","мая","июня","июля","августа","сентября","октября","ноября","декабря");

if(strlen($s)<5)return $s;
$t1=(integer)(substr($s,0,2));
$t2=(integer)(substr($s,3,2));
$t3=substr($s,6,4);
$s=$t1." ".$mas[$lang][(integer)$t2-1]." ".$t3;
return $s;
}

function get_image($path)
{
	$img = "";
	$files = getfiles($path);
	for ($i = 0; $i < count($files); $i++)
	{
		if (stripos($files[$i], "jpg") || stripos($files[$i], "gif") || stripos($files[$i], "png"))
			$img = $files[$i];
	}
	return "/".$path.$img;
}

function getlink($link){
return $link;
}

function get_cart_info()
{
	global $Q, $DB, $module_name;
	$shopcart = $_COOKIE[shopcart];
	$cart=split(";",$shopcart);
	
	for($i=0;$i<count($cart)-1;$i++)
	{
		$s[$i]=split(":",$cart[$i]);
	}

	$cart=$s;	
	$items_count = 0;
	$items_price = 0;
	for ($i = 0; $i < count($s); $i++)
	{
		$SQL = "SELECT * FROM ".$module_name." WHERE id = '".$cart[$i][0]."'";
		$result = $Q->query($DB, $SQL);
		$item = mysql_fetch_assoc($result);
		
		$price = round($item[f1]);
		
		$items_price += $price*$cart[$i][1];
		$items_count += $cart[$i][1];
	}
	return Array($items_count, $items_price);
}

function get_path_id($id)
{
	global $Q, $DB, $module_name;
	$arr_path = Array();
	$SQL = "SELECT * FROM ".$module_name." WHERE id = '".$id."'";
	$result = $Q->query($DB, $SQL);
	$level = mysql_fetch_assoc($result);
	$rid = $level[rid];
	array_push($arr_path, $level[id]);
	
	while($rid > 16)
	{
		array_push($arr_path, $rid);
		$SQL = "SELECT * FROM ".$module_name." WHERE id = '".$rid."'";
		$result = $Q->query($DB, $SQL);
		$level = mysql_fetch_assoc($result);
		$rid = $level[rid];
	}
	return $arr_path;
}

function get_rubric_id($id)
{
	global $Q, $DB, $module_name, $catalog_id;
	
	$SQL = "SELECT * FROM ".$module_name." WHERE id='".$id."'";
	$result = $Q->query($DB, $SQL);
	$rubric = mysql_fetch_assoc($result);
	
	$SQL = "SELECT * FROM category_groups WHERE category_id = '".$id."'";
	$result = $Q->query($DB, $SQL);
	for ($category_groups = Array(); $row = mysql_fetch_assoc($result); $category_groups[] = $row);
	
	if (count($category_groups) > 0)
	{
		$result_id = $id;
	}
	else
	{
		$find = false;
		$rid = $rubric[rid];
		
		while ($rid > $catalog_id && $find == false)
		{
			$SQL = "SELECT * FROM category_groups WHERE category_id = '".$rid."'";
			$result = $Q->query($DB, $SQL);
			if (mysql_num_rows($result) > 0)
			{
				$find = true;
				$result_id = $rid;
			}
			else
			{
				$SQL = "SELECT * FROM ".$module_name." WHERE id = '".$rid."'";
				$result = $Q->query($DB, $SQL);
				$rubric = mysql_fetch_assoc($result);
				$rid = $rubric[rid];
			}
		}
	}
	
	if ($result_id == "")
		$result_id = null;
	
	return $result_id;	
}

function show_tmpl($template, $variables, $values)
{
	$tmpl_file = file($_SERVER[DOCUMENT_ROOT]."/_t/_items/".$template.".tpl");
	$tmpl_file = implode("\r\n", $tmpl_file);
	
	for ($i = 0; $i < count($variables); $i++)
	{
		$tmpl_file = str_replace("[".$variables[$i]."]", $values[$i], $tmpl_file);
	}
	
	return $tmpl_file;
}

function show_params($product_id, $detailed = 0)
{
	global $DB, $Q, $module_name;
	
	$limit = 0;
	if ($detailed != 0)
		$limit = 7;
	
	$rubric_id = get_rubric_id($product_id);
	
	if ($rubric_id != null)
	{
		$output = show_tmpl("params_table_begin", Array(), Array());
		
		$SQL = "SELECT * FROM category_groups INNER JOIN params_groups_names ON category_groups.group_id = params_groups_names.group_id WHERE category_id = '".$rubric_id."' ORDER BY sorter ASC";
		$result = $Q->query($DB, $SQL);
		for ($groups = Array(); $row = mysql_fetch_assoc($result); $groups[] = $row);

		$shown = 0;
		
		for ($i = 0; $i < count($groups); $i++)
		{
			$output .= show_tmpl("params_group", Array("group"), Array($groups[$i][group_name]));
			
			$SQL = "SELECT * FROM groups_params INNER JOIN params_names ON groups_params.param_id = params_names.param_id WHERE group_id = '".$groups[$i][group_id]."' ORDER BY sorter ASC";
			$result = $Q->query($DB, $SQL);
			for ($params = Array(); $row = mysql_fetch_assoc($result); $params[] = $row);
			//print_r($params);
			for ($j = 0; $j < count($params); $j++)
			{
				if ($shown < $limit || $limit == 0)
				{
					$SQL = "SELECT * FROM products_values WHERE product_id = '".$product_id."' AND param_id = '".$params[$j][param_id]."'";
					$result = $Q->query($DB, $SQL);
					$value = mysql_fetch_assoc($result);
					
					$tmpl_name = "params_param_value";
					
					if ($shown%2 != 0)
						$tmpl_name = "params_param_value_2";
					if ($detailed == 1)
						$tmpl_name = "params_param_value_detailed";
					//echo $tmpl_name."<br>";
                    
                    $params[$j][param_name][0] = mystrtohigher($params[$j][param_name][0]);
                    
					if ($params[$j][param_type] == "select")
					{
						$SQL = "SELECT * FROM values_titles WHERE value_id = '".$value[value]."'";
						$result = $Q->query($DB, $SQL);
						$value = mysql_fetch_assoc($result);
						//print_r($value);
						$value = $value[value_title];
					}
					
					if ($params[$j][param_type] == "text_field")
					{
						$value = $value[value];
					}
					
					if ($params[$j][param_type] == "checkbox")
					{
						$value_id = split(",", $value[value]);
						//print_r($value_id);
						$value = "";
						if (count($value_id) > 0 && $value_id[0] != "")
						{
							$SQL = "SELECT * FROM values_titles WHERE value_id IN (".implode(", ", $value_id).")";
							$result = $Q->query($DB, $SQL);
							for ($values = Array(); $row = mysql_fetch_assoc($result); $values[] = $row);
							
							for ($k = 0; $k < count($values); $k++)
							{
								$value .= $values[$k][value_title];
								if ($k < count($values) - 1)
									$value .= ", ";
							}
						}
					}
                    
                    if ($value == "") {
                        $value = "&nbsp;";
                    }
                    else {
                        $shown++;
                        $output .= show_tmpl($tmpl_name, Array("param", "value"), Array($params[$j][param_name], $value));
                    }
				}
			}
		}
		
		$output .= show_tmpl("params_table_end", Array(), Array());
	}
	
	return $output;
}

function get_search_query()
{
	global $Q, $DB, $module_name;
	$params = Array();
	$params_type = Array();
	$values = Array();
	
	$params = $_GET[param];
	$params_type = $_GET[param_type];
	$values = $_GET[value];
	
	$query = "";
	
	$arr_id = Array();
	
	if ($_GET[extra_search])
	{
		for ($i = 0; $i < count($params); $i++)
		{
			$SQL_search = "";
			if ($params_type[$i] == "text_field")
			{
				if (trim($values[$i]) != "")
					$SQL_search .= " param_id = '".$params[$i]."' AND value LIKE '%".$values[$i]."%' ";
			}
			if ($params_type[$i] == "checkbox")
			{
				$checkbox_values = array();
				$checkbox_values = $values[$i];
				for ($j = 0; $j < count($checkbox_values); $j++)
				{
					if ($checkbox_values[$j] != "")
						$SQL_search .= " param_id = '".$params[$i]."' AND (
						value LIKE '".$checkbox_values[$j]."' OR 
						value LIKE '".$checkbox_values[$j].",%' OR
						value LIKE '%,".$checkbox_values[$j].",%' OR
						value LIKE '%,".$checkbox_values[$j]."' 
						)";
				}
			}
			if ($params_type[$i] == "select")
			{
				if ($values[$i] != "all")
					$SQL_search .= "param_id = '".$params[$i]."' AND value = '".$values[$i]."'";
			}
		
			if ($SQL_search != "")
			{
				$SQL_search = "SELECT DISTINCT product_id FROM products_values WHERE ".$SQL_search;
				//echo $SQL_search."<br>";
				$result = $Q->query($DB, $SQL_search);
				for ($products = Array(); $row = mysql_fetch_assoc($result); $products[] = $row[product_id]);
				//print_r($products);
				if (count($products) > 0)
					$arr_id[] = $products;
				else
					$arr_id[] = Array(0);
			}
		}
		
		//print_r($arr_id);
		$eval_string .= '';

		if (count($arr_id) > 0)
		{
			if (count($arr_id) > 1)
			{
				for ($i = 0; $i < count($arr_id); $i++)
				{
					$eval_string .= '$arr_id['.$i.']';
					if ($i != count($arr_id) - 1)
						$eval_string .= ',';
					//$query = " id IN (".implode(", ", $products).") ";
				}
				
				$eval_string = ' $arr_id = array_intersect('.$eval_string.');';
				eval($eval_string);
				if (count($arr_id) > 0)
					$query = " id IN (".implode(",", $arr_id).") ";
				else
					$query = " id = '' ";
			}
			else
			{
				$query = " id IN (".implode(",", $arr_id[0]).") ";
			}
			//echo $query;
		}
		else
			$query = " id = '' ";
	}
	
	//echo $query;
	
	if ($query != "")
		$query = " AND ".$query;

	return $query;
}

function show_path($id = 15)
{
	global $Q, $DB, $module_name;
	$arr_path = Array();
	$arr_exceptions = Array(1, 16);
	$SQL = "SELECT * FROM ".$module_name." WHERE id = '".$id."'";
	$result = $Q->query($DB, $SQL);
	$level = mysql_fetch_assoc($result);
	$rid = $level[rid];
	array_push($arr_path, Array("name"=>$level[name], "aname"=>$level[aname], "id"=>$level[id]));
	while ($rid > 0)
	{
		$SQL = "SELECT * FROM ".$module_name." WHERE id = '".$rid."'";
		$result = $Q->query($DB, $SQL);
		$level = mysql_fetch_assoc($result);
		if (!in_array($level[id], $arr_exceptions))
			array_push($arr_path, Array("name"=>$level[name], "aname"=>$level[aname], "id"=>$level[id]));
		$rid = $level[rid];
	}
	if ($id != 15)
		array_push($arr_path, Array("name"=>"Главная", "aname"=>"", "id"=>15));
	$arr_path = array_reverse($arr_path);
	$arr_links = Array();
	for ($i = 0; $i < count($arr_path); $i++)
	{
		$link = "/";
		if (ereg("e", $arr_path[$i][aname]))
//			$link = "/catalog.php?id=".$arr_path[$i][id];
			$link=get_link($arr_path[$i][id]);
		if (ereg("d", $arr_path[$i][aname]))
			$link = "/news.php?id=".$arr_path[$i][id];
		if (ereg("a", $arr_path[$i][aname]))
			$link = "/page.php?id=".$arr_path[$i][id];
		if (ereg("h", $arr_path[$i][aname]))
			$link = "/video.php?id=".$arr_path[$i][id];	
		array_push($arr_links, "<a href='".$link."' class=\"navilinks\">".$arr_path[$i][name]."</a>");	
	}
	return implode(" / ", $arr_links);
}

function show_title($id)
{
	global $Q, $DB, $module_name,$REQUEST_URI;

	if ($id == "") $id = 5867;
	$arr_exceptions = Array(1, 16);
	$arr_title = Array();
	
	$SQL = "SELECT * FROM ".$module_name." WHERE id = '".$id."'";
	$result = $Q->query($DB, $SQL);
	$level = mysql_fetch_assoc($result);
	
	if ($level[title] != "" || $level[description] != "" || $level[keywords] != "" || $level[name] != "")
	{
	    if($level[title] != "")
		{
		$tit = $level[title];
		}
		else
		{
		$tit = $level[name];
		}
		$title = "
		<title>".$tit."</title>
		<META Name='description' content='".$level[description]."'>
		<META Name='keywords' content='".$level[keywords]."'>
		";
	}
	else
	{
		if ($level && !in_array($level[id], $arr_exceptions))
			array_push($arr_title, $level[name]);
		$rid = $level[rid];
		
		while ($rid > 0)
		{
			$SQL = "SELECT * FROM ".$module_name." WHERE id = '".$rid."'";
			$result = $Q->query($DB, $SQL);
			$level = mysql_fetch_assoc($result);
			$rid = $level[rid];
			if (!in_array($level[id], $arr_exceptions))
				array_push($arr_title, $level[name]);
		}
		
		array_push($arr_title, "kalibr.by");
		
		$arr_title = array_reverse($arr_title);
		
		$title = implode(" :: ", $arr_title);
		$title = "<title>".$title."</title>";
	}
	return $title;
}

function make_link($link, $param)
{
	if (ereg("\?", $link))
		$link .= "&".$param;
	else
		$link .= "?".$param;
	return $link;
}

if(!$lang)$lang="ru";

function get_sec()
{
    $mtime = microtime();
    $mtime = explode(" ",$mtime);
    $mtime = $mtime[1] + $mtime[0];
    return $mtime;
}

$SQL = "SELECT * FROM ".$module_name." WHERE id = 107";
$result = $Q->query($DB, $SQL);
$usd_curs = mysql_fetch_assoc($result);
$usd_curs = $usd_curs[f1];

?>