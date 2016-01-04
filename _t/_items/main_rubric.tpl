<div style="display:block;float:left;padding-right:20px;padding-bottom:15px;height:180px">
	<table id="Table_Catalog" name="2" width="175px" border="0" cellpadding="0" onMouseOut="hidemenu()" onMouseOver="cancelhide()" cellspacing="0">
	<tr height="75px">
	<td align="center" width="175px" onMouseOver="showSubMenu(this,'submenu_[id]')" style="padding-bottom:15px;"><a href="<? echo get_link('[id]');?>"><img src="/shortimage.php?path=attachments--[id]--big.jpg&x=100&y=90" border="0"></a></td>
	</tr>
	<tr height="">
	<td align="center" onMouseOver="showSubMenu(this,'submenu_[id]')" width="175px"><a href="<? echo get_link('[id]');?>" style="text-decoration:none;"><h1>[name]</h1></a></td>
	</tr>
	</table>
	<div id="submenu_[id]" class="dd_menu" onMouseOut="hidemenu()" onMouseOver="cancelhide()">
		<div class="top"></div>
		<div class="middle">
		<?
			echo block("rid=[id]", "main_dd_rubric_item", "main_dd_rubric_separator");
		?>
		</div>
		<div class="bottom"></div>
		</div>
</div>