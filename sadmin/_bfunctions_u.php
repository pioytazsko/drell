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

//echo $text;

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

		if((!ereg("^[^>]+submit",$text[$i])) && (!ereg("^[^>]+reset",$text[$i]))){

		        $text[$i]=" value=\"".ereg_replace("\"","&quot;",$pt_l[$id])."\" name=\"pt_l[".$id."]\"".$text[$i];



//			if($elements[$k]=="textarea")echo $pt_l[$id]."--";

			$id++;

			}

		}

	$text=join("<".$elements[$k],$text);

	$text=ereg_replace("textarea value=\"([^\"]*)\"([^>]*>)","textarea \\2\\1",$text);

	}

//echo $text;

if(ereg("<input",$text))

	$text="<form name=ptform id=ptform action=".$action." method=post enctype=\"multipart/form-data\">

<input type=hidden name=\"ptaction\" value=\"sent\">".$text."</form>";

$text=ereg_replace("value=\"\"","",$text);

return $text;

}



function prepare_text_table($text){

global $pt_l_name,$pt_l,$HTTP_HOST,$module_filepath,$AllowToSend,$AllowToSendText;

//echo $text;

$text=ereg_replace("<form[^>]+>","",$text);

$text=ereg_replace("</form>","",$text);

$text=ereg_replace("(".chr(60)."textarea[^".chr(62)."]*".chr(62).")[^".chr(60)."]*".chr(60)."/textarea".chr(62)."","\\1",$text);

$text=ereg_replace("</select>","",$text);

$text=ereg_replace("(<option[^>]*>)[^<]*</option>","",$text);

$text=ereg_replace("<input[^>]*hidden[^>]*>","",$text);

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

$AllowToSend=true;

if(ereg("\*[^\:]+".chr(60)."b".chr(62).chr(60)."/b".chr(62),strip_tags($text,"<b>"))){

	$AllowToSend=false;

	}

$AllowToSendText=$text;

//echo $text;

//echo strip_tags($text,"<b>");

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

$text=ereg_replace(".*отмечены поля обязательные для заполнения","",$text);

$un        = strtoupper(uniqid(time()));

//$head      = "From: $from\n";

//$head     .= "To: $to\n";

//$head     .= "Subject: $subj\n";

//$head     .= "X-Mailer: SiSols.com mailer\n";

//$head     .= "Reply-To: $from\n";

//$head     .= "Mime-Version: 1.0\n";

//$head     .= "Content-Type:multipart/mixed; charset=koi8-r;\n";

//$head     .= "boundary=\"----------".$un."\"\n\n";

//$zag       = "------------".Content-Type:text/html;\n";

//$zag      .= "Content-Transfer-Encoding: 8bit\n\n$text\n\n";

$zag       = "Content-Type:text/html;\n";

$zag      .= "Content-Transfer-Encoding: 8bit\n\n$text\n\n";



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

//echo $to."<p>".$subj."<p>".$zag."<p>".$head;

$subj = "=?windows-1251?b?" . base64_encode($subj) . "?=";

//$res=mail($to, $subj, "Content-Type:text/html;\nContent-Transfer-Encoding: 8bit\n\n$text\n\n", "Content-Type:multipart/mixed; charset=koi8-r;");

//$res=mail($to, $subj, $zag, $head);

$res=mail($to, $subj,$text,"From: $from\nMIME-Version: 1.0\nContent-Type: text/html; format=flowed; charset=\"Windows-1251\"\nContent-Transfer-Encoding: 8bit");

if (!$res){

return 0;

 }

else {

// echo $to."ok";

 return 1;

 }

}





function prepare_text_send($email,$table,$reply){

global $REQUEST_URI,$HTTP_HOST,$pt_l_name,$pt_l,$AllowToSend;

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

//echo "------------------------".$table;

XMail($reply,$email,$HTTP_HOST,$table,$filename);

}

function prepare_text($row,$reply=0){

global $pt_l,$ptaction,$lang,$AllowToSend, $send_error;

$text=ereg_replace("&quot;","\"",$row[text]);

$text=prepare_text_form($text);

//echo $text;

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

	if($AllowToSend){

		if(ereg("Итого:",$pt_l[1]))

			$table=$pt_l[1]."<p>".$table;
		prepare_text_send($email,$table,$reply);
		}

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

    $ret = ereg(

                '^([A-Za-z0-9_]|\\-|\\.)+'.

                '@'.

                '(([A-Za-z0-9_]|\\-)+\\.)+'.

                '[A-Za-z]{2,4}$',

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

$query=ereg_replace("and[ ]+f[0-9]+=['\"]{1}['\"]{1}","",$query);

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

//echo $inf[count($inf)-1][name]."-<br>";

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

function Insert_Probels($value)
{
	if ($value%10 != 0)
	{
		$value += 10 - $value%10;
	}
    $value = (string)$value;
    $output = '';
    $z = 0;
    for ($k = strlen($value); $k >= 0; $k--)
    {     
        $output = $value[$k].$output;
        if (($z)%3 == 0 && $k != 0 && $k != strlen($value))
        {
            $output = '&nbsp;'.$output;
        }
        $z++;
    }   
    return $output;
}

Function block($query,$template,$separator="",$template_up="",$paging="",$errormessage="",$rrid=0) {

global $DB,$Q,$Q2,$module_name,$module_filepath,$page,$id,$inf,$paging_count, $usd_price, $searchname;

$SQL = "SELECT * FROM ".$module_name." WHERE id = '1372'";
$result = $Q->query($DB, $SQL);
$curs_usd = mysql_fetch_assoc($result);
$curs_usd = $curs_usd[f1];

if(ereg("id=[^ ]+[^0-9 ]+",$query))

	return $errormessage;

if(ereg("id=$",$query))

	return $errormessage;

if(ereg("id= ",$query))

	return $errormessage;



$query=correct_query($query);



$filename=$module_filepath."/_t/_items/".$template.".tpl";

if(!file_exists($filename)){

	switch($template){

		case "date":$template_normal="[date]";break;

		case "name":$template_normal="[name]";break;

		case "anons":$template_normal="[anons]";break;

		case "text":$template_normal="[text]";break;

		case "f1":$template_normal="[f1]";break;

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

	$count=$paging;

	$paging_count=count($inf);

	}

	

//echo $query;



$row=Array();

//echo $count;

for($i=0;$i<$count;$i++){

	if($standart_query==1)

	        $info=$Q->getrow();

	if($standart_query==2){

	        $info=$inf[(($page-1)*$paging)+$i];

		}

	if(!trim($info)){

		$count=$i;

		break;

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
	$r=ereg_replace("\[archive\]",$info[archive],$r);

	$r=ereg_replace("\[aname\]",$info[aname],$r);
	$r=ereg_replace("\[rid\]",$info[rid],$r);

	$r=ereg_replace("\[ridname\]",$ridname,$r);

	$r=ereg_replace("\[anons\]",$info[anons],$r);

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

	$r=ereg_replace("\[number\]","".($i+1)."",$r);

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



return $row;

}



function showcart($formid){

global $DOCUMENT_ROOT,$id,$action,$enumber,$shopcart,$path,$DB,$Q,$Q2,$module_name,$pt_l;

include($DOCUMENT_ROOT."/_modules/cart/_center.php");

}



function showpaging($query,$template_normal,$template_selected,$onpage, $template_back="", $template_forward="", $pagescount=0){

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

$link=ereg_replace("\&$","",$link);

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



if($template_back){

	$f=file($DOCUMENT_ROOT."/_t/_items/".$template_back.".tpl");

	if(count($f)>0)

		$template_back=join("",$f);

	else

		$template_back=$f;

	}



if($template_forward){

	$f=file($DOCUMENT_ROOT."/_t/_items/".$template_forward.".tpl");

	if(count($f)>0)

		$template_forward=join("",$f);

	else

		$template_forward=$f;

	}





$query="select * from ".$module_name." where ".$query;

$Q->query($DB,$query);

$count=$Q->numrows();

if($paging_count)

	$count=$paging_count;

$paging=Array();

for($i=0;$i<($count/$onpage);$i++){

	if($page==($i+1))

		$t=$template_selected;

	else

		$t=$template_normal;

	$t=ereg_replace("\[link\]",$link."page=".($i+1),$t);

	$t=ereg_replace("\[number\]","".($i+1),$t);

	if($pagescount){

		if(((($i+1)>=floor($page-($pagescount/2)+1)) || (($i+1)>(ceil($count/$onpage)-$pagescount))) && ((($i+1)<=floor($page+($pagescount/2))) || (($i+1)<=$pagescount)))

			$paging[]=$t;

		}

	else

			$paging[]=$t;

	}

$back=ereg_replace("\[link\]",$link."page=".($page-1),$template_back);

if(($page-1)<1)

	$back="";

$forward=ereg_replace("\[link\]",$link."page=".($page+1),$template_forward);

if(($page+1)>ceil($count/$onpage))

	$forward="";

$paging=$back.join("",$paging).$forward;

return $paging;

}



function showAuthForm($rid,$authformnotlogged,$authformlogged){

global $module_filepath,$auth;

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

		}

	else

		return "File ".$authformlogged.".tpl not found.";

	}

if($auth[name])

	$res=$authformlogged;

else

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

return $res;

}



function showmeta( $rrid , $template_default_meta){

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

			$query="select * from ".$module_name." where id=".$id;

			$Q->query($DB,$query);

		        $row=$Q->getrow();

			}

		else	{



			if($rid){

			$query="select * from ".$module_name." where id=".$rid;

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

function MakeLink($id)
{
	global $Q, $DB, $module_name;
	$link = '';
	$arr_of_rid = Array();
	$SQL = "SELECT * FROM ".$module_name." WHERE id = '$id'";
	$result = $Q->query($DB, $SQL);
	$data = mysql_fetch_assoc($result);
	//print_r($data);
	$rid = $data[rid];
	$rrid = $rid;
	array_push($arr_of_rid, $rid);
	while ($rid != 2)
	{
		$SQL = "SELECT * FROM ".$module_name." WHERE id = '$rid'";
		$result = $Q->query($DB, $SQL);
		$data = mysql_fetch_assoc($result);
		$rid = $data[rid];
		array_push($arr_of_rid, $rid);
	}
	$arr_of_rid = array_reverse($arr_of_rid);
	for ($i = 0; $i < count($arr_of_rid); $i++)
	{
		$rid = $arr_of_rid[$i];
		$SQL = "SELECT * FROM ".$module_name." WHERE rid = '$rid'";
		$result = $Q->query($DB, $SQL);
		for ($data = Array(); $row = mysql_fetch_assoc($result); $data[] = $row);
		for ($j = 0; $j < count($data); $j++)
		{
			if ($data[$j][id] == $arr_of_rid[$i + 1])
			{
				if ($i == 0)
				{
					$link .= '&MenuNum='.($j - 1);
				}
				if ($i == 1)
				{
					$link .= '&MenuItem='.$j;
				}
				if ($i == 2)
				{
					$link .= '&MenuItem2='.$j;
				}
			}
		}
	}
	return $link.'&ShowNews=false&rub='.$rrid;
	
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

	$email=ereg_replace("mail","",$email);

	$email=trim(ereg_replace("^[^]+","",$email));

	$email=trim(ereg_replace("^[^a-zA-Z0-9]+","",$email));

	$email=ereg_replace("(^[a-zA-Z0-9\-\.@_]+)[^a-zA-Z0-9\-\.@_]+.*","\\1",$email);

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

		mail($email, $sitename, "Content-Type:text/html;\nContent-Transfer-Encoding: 8bit\n\n".$letter_template."\n\n", "Content-Type:multipart/mixed; charset=Windows-1251;");

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

//if(file_exists($DOCUMENT_ROOT."/_modules/secure/index.php"))
//	include("_modules/secure/index.php");


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


function chk_print_login()
{
	if ($_COOKIE[user_login] == "" || $_COOKIE[user_pass] == "")
		header("location:login.php");
}
// authorization

//include($DOCUMENT_ROOT."/_modules/auth/_start.php");
$catalog_id = 2;

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

function show_params($product_id)
{
	global $DB, $Q, $module_name;
	
	$rubric_id = get_rubric_id($product_id);
	
	if ($rubric_id != null)
	{
		$output = show_tmpl("params_table_begin", Array(), Array());
		
		$SQL = "SELECT * FROM category_groups INNER JOIN params_groups_names ON category_groups.group_id = params_groups_names.group_id WHERE category_id = '".$rubric_id."' ORDER BY sorter ASC";
		$result = $Q->query($DB, $SQL);
		for ($groups = Array(); $row = mysql_fetch_assoc($result); $groups[] = $row);
		
		for ($i = 0; $i < count($groups); $i++)
		{
			$output .= show_tmpl("params_group", Array("group"), Array($groups[$i][group_name]));
			
			$SQL = "SELECT * FROM groups_params INNER JOIN params_names ON groups_params.param_id = params_names.param_id WHERE group_id = '".$groups[$i][group_id]."' ORDER BY sorter ASC";
			$result = $Q->query($DB, $SQL);
			for ($params = Array(); $row = mysql_fetch_assoc($result); $params[] = $row);
			
			for ($j = 0; $j < count($params); $j++)
			{
				$SQL = "SELECT * FROM products_values WHERE product_id = '".$product_id."' AND param_id = '".$params[$j][param_id]."'";
				$result = $Q->query($DB, $SQL);
				$value = mysql_fetch_assoc($result);
				
				if ($params[$j][param_type] == "select")
				{
					$SQL = "SELECT * FROM values_titles WHERE value_id = '".$value[value]."'";
					$result = $Q->query($DB, $SQL);
					$value = mysql_fetch_assoc($result);
					//print_r($value);
					$value = $value[value_title];
					if ($value == "")
						$value = "&nbsp;";
					$output .= show_tmpl("params_param_value", Array("param", "value"), Array($params[$j][param_name], $value));
				}
				
				if ($params[$j][param_type] == "text_field")
				{
					$value = $value[value];
					if ($value == "")
						$value = "&nbsp;";
					$output .= show_tmpl("params_param_value", Array("param", "value"), Array($params[$j][param_name], $value));
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
					if ($value == "")
						$value = "&nbsp;";
					$output .= show_tmpl("params_param_value", Array("param", "value"), Array($params[$j][param_name], $value));
				}
			}
		}
		
		$output .= show_tmpl("params_table_end", Array(), Array());
	}
	
	return $output;
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
		array_push($arr_path, Array("name"=>"Главная", "aname"=>"a2", "id"=>15));
	$arr_path = array_reverse($arr_path);
	$arr_links = Array();
	for ($i = 0; $i < count($arr_path); $i++)
	{
		$link = "/";
		if (ereg("e", $arr_path[$i][aname]))
			$link = "/catalog.php?id=".$arr_path[$i][id];
		array_push($arr_links, "<a href='".$link."' class=\"navilinks\">".$arr_path[$i][name]."</a>");	
	}
	return implode(" / ", $arr_links);
}

// questions/answers

if(file_exists($DOCUMENT_ROOT."/_modules/opros/_start.php"))
	include($DOCUMENT_ROOT."/_modules/opros/_start.php");


?>