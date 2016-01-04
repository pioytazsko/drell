<?
global $usd_curs;

$cart=split(";",$shopcart);
for($i=0;$i<count($cart)-1;$i++){
        $s[$i]=split(":",$cart[$i]);
	}
$cart=$s;
$f=file($DOCUMENT_ROOT."/_t/_items/_cart.tpl");
$f=join("",$f);
$cartline=ereg_replace(".*\{([^\}]+)\}.*","\\1",$f);
$lines=Array();
//echo $cartline;
$total=0;
for($i=0;$i<count($cart);$i++){
	$query="select * from ".$module_name." where id='".$cart[$i][0]."'";
	$Q->query($DB,$query);
	$count=$Q->numrows();
	if($count==0)continue;
        $row=$Q->getrow();
	$f1=(integer)(ereg_replace("[^0-9]+"," ",($row[f1]*$usd_curs)));
	$f2=$row[f1];
	$cost=$f1*$cart[$i][1];
	$minus="<a href=cart.php?id=".$row[id]."&enumber=-1&eprice=".((integer)(ereg_replace("[^0-9]+","",$row[f1])))."&path=/>[-]</a>";
	if($cart[$i][1]==1)
		$minus="<a href=cart.php?action=delete&id=".$row[id].">[-]</a>";
	$line=$cartline;
	$line=ereg_replace("\[price\]","$cost",$line);
	$line=ereg_replace("\[id\]",$row[id],$line);
	$line=ereg_replace("\[name\]",$row[name],$line);
	$line=ereg_replace("\[f1\]","$f1",$line);
	$line=ereg_replace("\[f2\]","$f2",$line);
	$line=ereg_replace("\[count\]",$cart[$i][1],$line);
	$lines[]=$line;
//	$lines[]="<tr><td>".ereg_replace("\\\\\"","&quot;",$row[name])."</td><td align=center>".$row[f1]."</td><td align=center>".$cart[$i][1]." <a href=cart.php?id=".$row[id]."&enumber=1&eprice=".((integer)(ereg_replace("[^0-9]+","",$row[f1])))."&path=/>[+]</a> ".$minus."</td><td align=center>".$cost."</td><td align=center><a href=cart.php?action=delete&id=".$row[id]." class=normallink>[x]</a></td></tr>";
	$total+=$cost;
	$total2=$cost/$usd_curs;
	}

$ordertext=join("",$lines);
$ordertext=ereg_replace("\{[^\}]+\}",$ordertext,$f);
$ordertext=ereg_replace("\[total\]","$total",$ordertext);
$ordertext=ereg_replace("\[total2\]","$total2",$ordertext);
echo $ordertext;
?>