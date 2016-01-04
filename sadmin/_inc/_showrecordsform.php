<form action=index.php?page=newpos&parent=<? echo (integer)$parent; ?> method=post name='upform'>
<a class=normal><?=$lt[16];?>:

<SELECT name=pos size=1>
<?
for($i=25;$i<300;$i*=2)
	{
	$sel="";
	if($i==$toshow){ $sel=" selected ";}
	echo "<option  ".$sel." value=".$i.">".$i."</option>";
	}
?>
</select>
<input type=submit value='<?=$lt[17];?>'>
</form>
