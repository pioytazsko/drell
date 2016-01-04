<?
$SQL = "SELECT * FROM video WHERE product_id = '".$_GET[id]."'";
$result = $Q->query($DB, $SQL);
for ($video = Array(); $row = mysql_fetch_assoc($result); $video[] = $row);
//print_r($video);
if (count($video) > 0)
{	
	echo '
	<div id="player_div">
	<object type="application/x-shockwave-flash" data="/uflvplayer.swf" height="233" width="300">
		<param name="bgcolor" value="#FFFFFF" />
		<param name="allowFullScreen" value="true" />
		<param name="allowScriptAccess" value="always" />
		<param name="movie" value="/uflvplayer.swf" />
		<param name="FlashVars" value="way=/attachments/'.$_GET[id].'/'.$video[0][filename].'&amp;swf=/uflvplayer.swf&amp;w=400&amp;h=340&amp;pic=http://&amp;autoplay=0&amp;tools=1&amp;volume=0&amp;q=&amp;comment='.$video[0][name].'" />
	</object>
	</div>
	';
	
	echo '
	<table id="Table" width="300px" align="left" border="0" cellpadding="0"  cellspacing="0">
		<tr valign="top">
		<td style="background-image:url(\'images/one/htablebg.jpg\'); background-repeat:repeat-y;padding-right:10px; padding-left:10px;" align="center">
	';
	
	for ($i = 0; $i < count($video); $i++)
	{
		echo '
		<div style="display:block;float:left;padding-right:5px;padding-left:5px;padding-top:10px;">
			<a><img src="shortimage.php?x=41&y=41&path=video--'.$video[$i][preview].'" border="0" width="41px" height="41px"  onclick="insert_player(\''.$video[$i][filename].'\', \''.$video[$i][name].'\')"/></a>
		</div>';
	}
	
	echo '
		</td>
	</tr>
	<tr><td><img src="images/one/htablebottom.jpg" width="180px" height="23px" border="0"/></td></tr>
	</table>
	';
}
?>
<script>
function insert_player(filename, comment)
{
	document.getElementById("player_div").innerHTML = '<object type="application/x-shockwave-flash" data="/uflvplayer.swf" height="233" width="300"><param name="bgcolor" value="#FFFFFF" /><param name="allowFullScreen" value="true" /><param name="allowScriptAccess" value="always" /><param name="movie" value="/uflvplayer.swf" /><param name="FlashVars" value="way=/attachments/<?=$_GET[id]?>/'+filename+'&amp;swf=/uflvplayer.swf&amp;w=400&amp;h=340&amp;pic=http://&amp;autoplay=1&amp;tools=1&amp;volume=0&amp;q=&amp;comment='+comment+'" /></object>';
}
</script>