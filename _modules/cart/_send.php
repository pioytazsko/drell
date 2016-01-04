<?
$f=file($DOCUMENT_ROOT."/_t/_items/_cart_thankyou.tpl");
$f=join("",$f);
echo $f;

$f=file($DOCUMENT_ROOT."/_t/_items/_cart_form.tpl");
$f=join("",$f);

$eprice=(trim($eprice)=="") ? "не указана" : trim($eprice)." y.e.";

$texte="ФИО: <b>".$efio."</b><br>";
$texte.="Контактный email: <b>".$eemail."</b><br>";
$texte.="Контактный телефон: <b>".$ephone."</b><br>";
$texte.=(trim($enotes)!="") ? "Примечания:<br>--------------------<br><b>".$enotes."</b><p>" : "";
$etext=ereg_replace("\\\\\"","&quot;",$etext);
$etext=ereg_replace("<td[^>]*><a[^>]*[^<]*</a></td></tr>","</tr>",$etext);
$etext=ereg_replace("colspan=5","colspan=4",$etext);
$etext=ereg_replace("<td[^>]*><b>Удалить</b></td>","",$etext);
//echo $etext;
$texte.=$etext;



$admin_mail="info@voshod.by";

$email="orderform@voshod.by";
$etheme="Order for delivery.";
$emessage=$texte;

$emessage=ereg_replace("\\\\\"","",$emessage);
/*
$emessage=ereg_replace("<b>","",$emessage);
$emessage=ereg_replace("</b>","",$emessage);
$emessage=ereg_replace("<br>","\n",$emessage);
$emessage=ereg_replace("<p>","\n\n",$emessage);
*/
$etheme=convert_cyr_string($etheme,"w","k");
$emessage=convert_cyr_string($emessage,"w","k");
//mail($admin_mail, $etheme, $emessage, "From: $email\nMIME-Version: 1.0\nContent-Type: text/html; format=flowed; charset=\"koi8-r\"\nContent-Transfer-Encoding: 8bit");
?>
