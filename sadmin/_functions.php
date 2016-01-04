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

function getdate_news($s){
global $lang;
$mas['gb']=array("January","February","March","April","May","June","July","August","September","October","November","December");
$mas['ru']=array("Января","Февраля","Марта","Апреля","Мая","Июня","Июля","Августа","Сентября","Октября","Ноября","Декабря");

if(strlen($s)<5)return $s;
$t1=substr($s,0,4);
$t2=substr($s,4,2);
$t3=substr($s,6,2);
$s=$t3." ".$mas[$lang][(integer)$t2-1]." ".$t1;
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
global $REQUEST_URI;
$action=ereg_replace(".*/","",$REQUEST_URI);
if(!trim($action))
	$action="index.php";
$elements=array('input','textarea','select');
$id=1;
$text=ereg_replace("name=\"[^\"]*\"","",$text);
for($k=0;$k<count($elements);$k++){
	$text=split("<".$elements[$k],$text);
	for($i=1;$i<count($text);$i++){
	        $text[$i]=" name=\"pt_l[".$id."]\"".$text[$i];
		$id++;
		}
	$text=join("<".$elements[$k],$text);
	}
if(ereg("<input",$text))
	$text="<form name=ptform id=ptform action=".$action." method=post enctype=\"multipart/form-data\">
<input type=hidden name=\"ptaction\" value=\"sent\">".$text."</form>";
return $text;
}

function prepare_text_table($text){
global $pt_l_name,$pt_l,$HTTP_HOST,$module_filepath;

$text=ereg_replace("<form[^>]+>","",$text);
$text=ereg_replace("</form>","",$text);
$text=ereg_replace("(<textarea[^>]*>)[^<]*</textarea>","\\1",$text);
$text=ereg_replace("</select>","",$text);
$text=ereg_replace("(<option[^>]*>)[^<]*</option>","",$text);
$text=ereg_replace("<input[^>]*ubmit[^>]*>","",$text);
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

//$css="<link rel=\"stylesheet\" href=\"http://".$HTTP_HOST."/styles/style.css\" type=\"text/css\">";
$css=file("http://".$HTTP_HOST."/styles/style.css");
$css=join("",$css);
$css="<style type=text/css>".$css."</style>";
$text=$css.$text;
return $text;
}

function XMail( $from, $to, $subj, $text, $filename)
{
$un        = strtoupper(uniqid(time()));
$head      = "From: $from\n";
$head     .= "To: $to\n";
$head     .= "Subject: $subj\n";
$head     .= "X-Mailer: SiSols.com mailer\n";
$head     .= "Reply-To: $from\n";
$head     .= "Mime-Version: 1.0\n";
$head     .= "Content-Type:multipart/mixed; charset=koi8-r; ";
$head     .= "boundary=\"----------".$un."\"\n\n";
$zag       = "------------".$un."\nContent-Type:text/html;\n";
$zag      .= "Content-Transfer-Encoding: 8bit\n\n$text\n\n";

if($filename[0][0])
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
//echo $to."<p>".$subj."<p>".$zag."<p>".$head;
$res=mail($to, $subj, $zag, $head);
if (!$res){
return 0;
 }
else {
// echo $to."ok";
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
XMail($reply,$email,$HTTP_HOST,convert_cyr_string($table, "w", "k"),$filename);
}

function prepare_text($row,$reply=0){
global $pt_l,$ptaction;

$text=ereg_replace("&quot;","\"",$row[text]);
$text=ereg_replace("&#39;","'",$text);
$text=ereg_replace("&#92;","\"",$text);
//$text=prepare_text_form($text);
$res=$text;
if($ptaction){
	$email=$row[f10];
	if(count($email)>1)
		$email=join("",$email);
	$email=split("\n",$email);
	$res=$email[1];
	$email=trim($email[0]);
	$table=prepare_text_table($text);
	prepare_text_send($email,$table,$reply);
	}
//echo $table;
return $res;
}

function is_email($string)
{
    // Remove whitespace
    $string = trim($string);
    $ret = ereg(
                '^([a-z0-9_]|\\-|\\.)+'.
                '@'.
                '(([a-z0-9_]|\\-)+\\.)+'.
                '[a-z]{2,4}$',
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

$lang=define_language();

?>