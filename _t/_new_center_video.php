<?
$id = $_GET[id];
if (!$_GET[id])
	$id = 246;
?>
<td>
 	  <table id="Table2" width="100%"  border="0" cellpadding="0"  cellspacing="0"><tr height="1px" valign="top"><td  align="left" style="padding-left:20px;padding-top:10px; padding-right:25px;">
		<table id="Table" width="100%"  border="0" cellpadding="0"  cellspacing="0">
			<tr height="1px" valign="middle">
			<td style="padding-top:5px;"><p style="margin:0px;padding-top:10px;"></p><h1 class="nobottomed"><?=block("id='".$id."'", "name");?></h1></td>
			</tr>
			<tr height="1px" valign="middle">
			<td>
			<?
				echo show_path($id);
			?>
			</td>
			</tr>
			
			<tr height="1px" valign="middle">
			<td style="padding-top:35px;">
			<?
			
			if ($_GET[id])
			{
				$SQL = "SELECT * FROM ".$module_name." WHERE id = '".$_GET[id]."'";
				$result = $Q->query($DB, $SQL);
				$video_level = mysql_fetch_assoc($result);
				
				if ($video_level[rid] > 127)
				{
					
					if ($_GET[video])
					{
						$video_files = getfiles("attachments/".$_GET[video]."/");
						$video_file = "";
						for ($i = 0; $i < count($video_files); $i++)
						{
							if (ereg("flv", $video_files[$i]))
								$video_file = "attachments/".$_GET[video]."/".$video_files[$i];
						}
						$video_name = block("id='".$_GET[video]."'", "name");
						$text_id = $_GET[video];
					}
					else
					{
						$SQL = "SELECT * FROM ".$module_name." WHERE rid = '".$_GET[id]."' ORDER BY date DESC LIMIT 0,1";
						$result = $Q->query($DB, $SQL);
						$video = mysql_fetch_assoc($result);
						$video_files = getfiles("attachments/".$video[id]."/");
						$video_file = "";
						for ($i = 0; $i < count($video_files); $i++)
						{
							if (ereg("flv", $video_files[$i]))
								$video_file = "attachments/".$video[id]."/".$video_files[$i];
						}
						$video_name = $video[name];
						$text_id = $video[id];
					}
					
					echo '
					<center>
					<object type="application/x-shockwave-flash" data="/uflvplayer.swf" height="388" width="500">
						<param name="bgcolor" value="#EEEEEE" />
						<param name="allowFullScreen" value="true" />
						<param name="allowScriptAccess" value="always" />
						<param name="movie" value="/uflvplayer.swf" />
						<param name="FlashVars" value="way='.$video_file.'&amp;swf=/uflvplayer.swf&amp;w=400&amp;h=340&amp;pic=http://&amp;autoplay=0&amp;tools=1&amp;volume=0&amp;q=&amp;comment='.$video_name.'" />
					</object>
					</center>
					';
					
					echo "<div style='padding:10px 0px 10px 0px'>";
					echo block("id='".$text_id."'", "text");
					echo "</div>";
					
					echo block("rid='".$_GET[id]."' ORDER BY date DESC", "video_preview", "", "", 8);
					
					echo "<table width='100%' style='margin-top:15px'><tr><td align=center>";
					echo showpaging("rid='".$_GET[id]."' ORDER BY date DESC", "video_paging", "video_paging_selected", 8);
					echo "</td></tr></table>";
				}
				else
					echo block("id='".$_GET[id]."'", "text");
			}
			else
				echo block("id='246'", "text");
			?>
			</td>

			</tr>

		</table>	
	</td>
	<td align="right" width="200px" style="padding-top:5px;">
		<?
		include("_new_cart.php");
		?>
		
		<div style="margin-top:20px">
		<table id="Table_Menu" width="180px" border="0" cellpadding="0"  cellspacing="0" >
		<tr height="4px">
		<td><img src="/images/navright/top.jpg" height="4px" width="180px" /></td>
		</tr>
		<?
		echo block("rid=127 ORDER BY date DESC", "video_rubric_item", "video_rubric_item_separator");
		?>
		<tr height="4px">
		<td><img src="/images/navright/bottom.jpg" height="4px" width="180px" /></td>
		</tr>

		</table>
		</div>
		
		<p style="margin:0px;padding-top:20px;"></p>

			<table id="Table_popular" width="100%" border="0" cellpadding="0"  cellspacing="0">
			<tr valign="middle" height="31px">
			<td width="3px"><img src="/images/popular/left.jpg" width="3px" height="31px"></td>
			<td width="100%" style="background-image:url('/images/popular/bg.jpg');background-repeat:repeat-x;padding-left:15px;"><a href="##" class="headlink">Популярные товары</a></td>
			<td width="4px"><img src="/images/popular/right.jpg" width="4px" height="31px"></td>
			</tr>
			</table>			
			
			<?
			echo block("aname='e4' AND f3='yes' ORDER BY date DESC LIMIT 0,4", "popular_item_product");
			?>

	</td>
	</tr>
	</table>
	<p style="margin:0px;padding-top:20px;"></p>

</td>
</tr>
</table>



</td>
</tr>