	<tr bgcolor=<?=$admin_settings['tableaddbg'];?>>
		<td align="center" width=30%><a class=tabletitle><?=$lt[18];?></a></td>
		<td align="center" width=70%><a class=tabletitle><? echo ($fields[1]!="") ? $fields[1] : $lt[19]; ?></a></td>
	</tr>
	<tr>
		<td align="center" valign=top><input name="newch[date]" value="<?=$newch[date];?>" style="width:120px;"><br>(<?=$lt[26];?>)</td>
		<td align="center" valign=top><input name="newch[name]" style="width:100%;background-color:<?=$admin_settings['inputbg'];?>" value="<?=$newch[name];?>" size=52></td>
	
<script language=JavaScript>
function chbg(obj){
var i,j,el,o=[];
<?
if($reachedits[0])
for($i=0;$i<count($reachedits);$i++){
        echo "o[".$i."]='".$reachedits[$i][aname]."';
";
	}
?>
for(i=0;i<<? echo count($reachedits);?>;i++){
        j=o[i];
        eval("tit"+j+".style.background='<? echo $admin_settings['tableaddbg'];?>';");
	}
tittext.style.background='<?=$admin_settings['tableaddbg'];?>';
obj.style.background="#746541";
changers(obj);
}

function changers(obj){
var from,to;
from=become.reachsel.value;
to=obj.id;
to = to.replace(/tit/gi, '')
become.reachsel.value=to;
if(from==to)
	return 0;
from='become.real'+from;
to='become.real'+to;
submit_form();
eval(from+'.value=become.htmlCode.value');
eval('become.htmlCode.value='+to+'.value');
wp_next(htmlCode);
}

</script>
<?

//-------- anons ---------------------------------------------

if($fields[22]==$aaname){
	if($fields[2]!=""){
		echo "
		<tr bgcolor=".$admin_settings['tableaddbg'].">
			<td colspan=2 align=center width=100%><a class=tabletitle>".$fields[2]."</a></td>
		</tr>
		<tr>
			<td colspan=2 align=center><textarea name=\"newch[anons]\" style=\"width:100%;background-color:".$admin_settings['inputbg']."\" rows=5 cols=100>".$newch[anons]."</textarea></td>
		</tr>";
		}
	else
	        echo "<input name=\"newch[anons]\" value=\"".$newch[anons]."\" type=hidden>";
	}
else
	echo "
	<tr bgcolor=".$admin_settings['tableaddbg'].">
		<td colspan=2 align=center width=100%><a class=tabletitle>".$lt[38]."</a></td>
	</tr>
	<tr>
		<td colspan=2 align=center><textarea name=\"newch[anons]\" style=\"width:100%;background-color:".$admin_settings['inputbg']."\" rows=5 cols=100>".$newch[anons]."</textarea></td>
	</tr>";

//------------ URL ------------------------------------------
if ($fields[22] == $aaname)
{
	if ($fields[29] != "")
	{
		echo "
		<tr bgcolor=".$admin_settings['tableaddbg'].">
			<td colspan=2 align=center width=100%><a class=tabletitle>URL-адрес</a></td>
		</tr>
		<tr>
			<td colspan=2 align=center>
			<input name=\"newch[url]\" style=\"width:100%;background-color:".$admin_settings['inputbg']."\" value=\"".$newch[url]."\" size=52>
			</td>
		</tr>
		";
	}
}

//---------------------------------------------------------//

//--------- Title -------------------------------------------//
if ($fields[22] == $aaname)
{
	if ($fields[30] != "")
	{
		echo "
		<tr bgcolor=".$admin_settings['tableaddbg'].">
			<td colspan=2 align=center width=100%><a class=tabletitle>Title</a></td>
		</tr>
		<tr>
			<td colspan=2 align=center>
			<input name=\"newch[title]\" style=\"width:100%;background-color:".$admin_settings['inputbg']."\" value=\"".$newch[title]."\" size=52>
			</td>
		</tr>
		";
	}
}
//-----------------------------------------------------------//

//--------- Description -------------------------------------------//
if ($fields[22] == $aaname)
{
	if ($fields[31] != "")
	{
		echo "
		<tr bgcolor=".$admin_settings['tableaddbg'].">
			<td colspan=2 align=center width=100%><a class=tabletitle>Description</a></td>
		</tr>
		<tr>
			<td colspan=2 align=center>
			<textarea name=\"newch[description]\" style=\"width:100%;background-color:".$admin_settings['inputbg']."\" rows=5 cols=100>".$newch[description]."</textarea>
			</td>
		</tr>
		";
	}
}
//-----------------------------------------------------------//

//--------- keywords -------------------------------------------//
if ($fields[22] == $aaname)
{
	if ($fields[32] != "")
	{
		echo "
		<tr bgcolor=".$admin_settings['tableaddbg'].">
			<td colspan=2 align=center width=100%><a class=tabletitle>Keywords</a></td>
		</tr>
		<tr>
			<td colspan=2 align=center>
			<textarea name=\"newch[keywords]\" style=\"width:100%;background-color:".$admin_settings['inputbg']."\" rows=5 cols=100>".$newch[keywords]."</textarea>
			</td>
		</tr>
		";
	}
}
//-----------------------------------------------------------//


// ----------- text -----------------------------------------

if($fields[22]==$aaname){
	if($fields[3]!=""){
		include("_reachtitles.php");	
		echo "<tr>
			<td colspan=2 align=center>";
		if($fields[23]=="yes")
			include("../_inc/_editcontent.php");
		else
			echo "<textarea name=\"newch[text]\" style=\"width:100%;background-color:".$admin_settings['inputbg']."\" rows=5 cols=100>".$newch[text]."</textarea>";
		echo "</td>
		</tr>";
		}
	else
	        echo "<input name=\"newch[text]\" value=\"".$newch[text]."\" type=hidden>";
	}
else
	echo "
	<tr bgcolor=".$admin_settings['tableaddbg'].">
		<td colspan=2 align=center width=100%><a class=tabletitle>".$lt[39]."</a></td>
	</tr>
	<tr>
		<td colspan=2 align=center><textarea name=\"newch[text]\" style=\"width:100%;background-color:".$admin_settings['inputbg']."\" rows=20 cols=100>".$newch[text]."</textarea></td>
	</tr>";

// ---------- additional fields ----------------------

for($i=0;$i<10;$i++)
{
	$f="f".($i+1);
	$f=$newch[$f];

	if(($aaname=="b2") && ($i==1))
	{
		$query="select * from ".$module_name." where lang='$adminlanguage' and aname='m2' order by date desc";
		$Q->query($DB,$query);
		$count=$Q->numrows();
		$select="<option value=0>-- Not defined --";
		for($j=0;$j<$count;$j++){
			$row=$Q->getrow();
			$select.="<option value=\"".$row[id]."\">".$row[name];
			}
		$select=ereg_replace("value=\"".$f."\"","value=\"".$f."\" selected",$select);
		$select="<select name=\"newch[f2]\">".$select."</select>";
		        echo "<tr bgcolor=".$admin_settings['tableaddbg'].">
				<td colspan=2 align=center width=100%><a class=tabletitle>Rubric</a></td>
			</tr>
			<tr>
			<td colspan=2>$select</td>
		</tr>";
	    continue;
	}
	
	if ($newch[aname] == "e4" && $i == 1)
	{
		$SQL = "SELECT * FROM ".$module_name." WHERE rid = '30' ORDER BY date DESC";
		$result = $Q->query($DB, $SQL);
		for ($brands = Array(); $row = mysql_fetch_assoc($result); $brands[] = $row);
		
		$options = "";
		
		for ($j = 0; $j < count($brands); $j++)
		{
			if ($f == $brands[$j][id])
				$options .= "<option value='".$brands[$j][id]."' selected='selected'>".$brands[$j][name]."</option>";
			else
				$options .= "<option value='".$brands[$j][id]."'>".$brands[$j][name]."</option>";
		}
		
		echo "<tr bgcolor=".$admin_settings['tableaddbg'].">
				<td colspan=2 align=center width=100%><a class=tabletitle>".$fields[$i+6]."</a></td>
			</tr>
			<tr>
				<td colspan=2 align=left><select name=\"newch[f".($i+1)."]\" style=\"width:100%;background-color:".$admin_settings['inputbg']."\" rows=5 cols=100>".$options."</select></td>
			</tr>";
		continue;
	}
    
	if($fields[22]==$aaname)
	{
		if(($fields[$i+6]!="") && (!checkre("f".($i+1))))
		{
		        echo "<tr bgcolor=".$admin_settings['tableaddbg'].">
				<td colspan=2 align=center width=100%><a class=tabletitle>".$fields[$i+6]."</a></td>
			</tr>
			<tr>
				<td colspan=2 align=center><textarea name=\"newch[f".($i+1)."]\" style=\"width:100%;background-color:".$admin_settings['inputbg']."\" rows=5 cols=100>".$f."</textarea></td>
			</tr>";
		}
		else    
		{
			if(!checkre("f".($i+1)))			
		        echo "<input name=\"newch[f".($i+1)."]\" value=\"".$f."\" type=hidden>";
		}
	}
	else	
	{
	        echo "<tr bgcolor=".$admin_settings['tableaddbg'].">
			<td colspan=2 align=center width=100%><a class=tabletitle>".$lt[41]." ".($i+1)."</a></td>
		</tr>
		<tr>
			<td colspan=2 align=center><textarea name=\"newch[f".($i+1)."]\" style=\"width:100%;background-color:".$admin_settings['inputbg']."\" rows=5 cols=100>".$f."</textarea></td>
		</tr>";
	}
}

if ($fields[22] == "h2")
{
	$list_selected = "";
	$field_selected = "";
	if ($newch[f2] == 1 || $newch[f2] == "")
		$list_selected = "selected='selected'";
	elseif ($newch[f2] == 2)
		$field_selected = "selected='selected'";
	$types_list = "
	<option value='1' ".$list_selected.">Выпадающий список</option>
	<option value='2' ".$field_selected.">Текстовое поле</option>
	";
	echo "
	<tr>
		<td colspan='2' align='left'>
			<select name='field_type'>
				".$types_list."
			</select>
		</td>
	</tr>
	";
}

if ($newch[aname] == "e4")
{
	echo "
		<tr bgcolor=".$admin_settings['tableaddbg'].">
			<td colspan=2 align=left><input type=checkbox ".($newch[existence]!="0"?"checked='checked'":"")." name=\"newch[existence]\" value=\"1\"> <a class=tabletitle>В наличии</a></td>
		</tr>	
		<tr>
			<td  align=center colspan=2>&nbsp;</td>
		</tr>";
}

//---------- archive --------------------------

if($fields[22]==$aaname){
	if($fields[4]!=""){
		$checked=($newch[archive]=="on") ? "checked" : "";
		echo "
		<tr bgcolor=".$admin_settings['tableaddbg'].">
			<td colspan=2 align=left><input type=checkbox name=\"newch[archive]\" ".$checked."> <a class=tabletitle>".$fields[4]."</a></td>
		</tr>	
		<tr>
			<td  align=center colspan=2>&nbsp;</td>
		</tr>";
		}
	else
	        echo "<input name=\"newch[archive]\" value=\"".$newch[archive]."\" type=hidden>";
	}
else	{
	$checked=($newch[archive]=="on") ? "checked" : "";
	echo "
	<tr bgcolor=".$admin_settings['tableaddbg'].">
		<td colspan=2 align=left><input type=checkbox name=\"newch[archive]\" ".$checked."> <a class=tabletitle>".$lt[40]."</a></td>
	</tr>	
	<tr>
		<td  align=center colspan=2>&nbsp;</td>
	</tr>";
	}

// ---------- attachments ---------------------------------
if($fields[22]==$aaname){
	if($fields[5]!=""){
		echo "
			<tr>
			<td  align=center colspan=2><hr size=1 color=#009900></td>
		</tr>
		<tr>
			<td align=left colspan=2>";
		include("action/_attachments.php");
		echo "</td>
		</tr>
		<tr>
			<td  align=center colspan=2>&nbsp;<br>&nbsp;</td>
		</tr>";
		}
	}
else	{
	echo "
	<tr>
		<td  align=center colspan=2><hr size=1 color=#009900></td>
	</tr>
	<tr>
		<td align=left colspan=2>";
	include("action/_attachments.php");
	echo "</td>
	</tr>
	<tr>
		<td  align=center colspan=2>&nbsp;<br>&nbsp;</td>
	</tr>";
	}

?>
	<tr>
		<td  align="center" colspan="2"><hr size=1 color=#009900></td>
	</tr>
