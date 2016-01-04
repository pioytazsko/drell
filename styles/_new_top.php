<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251">

<?
echo show_title($_GET[id]);
?>

<link rel="stylesheet" href="/styles/all.css">
<script src="/scripts/scripts.js"></script>
<script src="/scripts/dd_menu.js"></script>
<script src="/scripts/banner.js"></script>

<script type="text/javascript" src="/scripts/jquery-1.9.0.js"></script>
<script type="text/javascript">jQuery.noConflict();</script>
<script type="text/javascript" src="/scripts/autocomplete.js"></script>

<script type="text/javascript" src="/scripts/prototype.js"></script>
<script type="text/javascript" src="/scripts/scriptaculous.js?load=effects,builder"></script>
<script type="text/javascript" src="/scripts/lightbox.js"></script>

<link rel="stylesheet" href="/styles/lightbox.css" type="text/css" media="screen" />

<link rel="icon" type="image/png" href="tool.png" />
<link rel="shortcut icon" href="tool.png"  type="image/png">
</head>
<body>
<center>

<table id="Table_Top" width="100%" border="0" cellpadding="0" height="100%" style="min-height:100%" cellspacing="0" align="center">
<tr valign="top" height="83px">
<td width="100%" style="padding-left:20px; padding-right:20px;">
<!-- Header -->
	<table id="Table_Top" width="100%" border="0" cellpadding="0"  cellspacing="0" align="center">
	<tr valign="top" height="83px">
	<td align="left" width="230px" style="padding-right:20px;"><a href="/"><?
	$request_uri = $_SERVER[REQUEST_URI];
	$SQL = "SELECT * FROM ".$module_name." WHERE name = '".trim($request_uri)."' AND aname LIKE '%l%' LIMIT 1";
	$result = $Q->query($DB, $SQL);
	$logo = mysql_fetch_assoc($result);
	
	$logo_pic = "/images/logo.jpg";
	
	if ((integer)$logo[id] > 0)
	{
		$logo_img = getfiles_pictures("attachments/".$logo[id]."/");
		if ($logo_img[0] != "")
		{
			$logo_pic = "/attachments/".$logo[id]."/".$logo_img[0];
		}
	}
	
	?><img src="<?=$logo_pic;?>" border="0" width="230px" /></a></td>
	<td width="100%" align="center">
		<table id="Table_Top" border="0" cellpadding="0"  cellspacing="0" align="center">
		<tr valign="middle" height="83px">
		
		<td align="center" width="100px" style="padding-right:13px;"><a href="/video.php"><img src="/images/video.jpg" border="0" /></a></td>
				<td align="center" width="100px" style="padding-right:13px;"><a href="/page.php?id=5871"><img src="/images/labruary.jpg" border="0" /></a></td>
		<td align="center" width="100px" style="padding-right:13px;"><a href="/page.php?id=5872"><img src="/images/help.jpg" border="0" /></a></td>
		</tr>
		</table>
	</td>
	
	<td align="left" width="195px" style="padding-right:10px;">  <!-- Telephone -->
		<table id="Table_Top" width="100%" border="0" cellpadding="0"  cellspacing="0">
		<tr valign="top">
		
		<td align="left" width="10px"><img src="/images/telbgl.jpg" border="0" width="9px" height="72px" /></td>
		
		<td align="left" width="100%" style="background-image:url('/images/telbg.jpg'); background-repeat:repeat-x;">
		<?
		echo block("id=5873", "text");
		?>
		</td>
		<td align="left" width="10px"><img src="/images/telbgr.jpg" border="0" width="9px" height="72px" /></td>
		
		</tr>
		</table>
	</td>
	<td align="left" width="165px">  <!-- Telephone -->
		<table id="Table_Top" width="100%" border="0" cellpadding="0"  cellspacing="0">
		<tr valign="top">
		
		<td align="left" width="10px"><img src="/images/telbgl.jpg" border="0" width="9px" height="72px" /></td>
		
		<td align="left" width="100%" style="background-image:url('/images/telbg.jpg'); background-repeat:repeat-x;">
			<table id="Table_Telephone" width="100%" border="0" cellpadding="0"  cellspacing="0">
			<tr valign="top" height="72px">
			<td align="left" style="padding-left:15px; padding-top:5px;">
				<span class="tel">
                  <?
                    $ICQ = block("id=9152", "anons");
                    $Skype = block("id=9153", "anons");
                    $email = block("id=9154", "anons");
                    $cityPhone = block("id=9268", "anons");
                  ?>
				  <nobr><img src="/images/icq_icon.png" border="0" width="16px" height="16px" /><a href="http://web.icq.com/whitepages/message_me/1,,,00.icq?uin=<?=$ICQ;?>&action=message">&nbsp;<?=$ICQ;?></a><nobr><br/>
					<!--<nobr><img src="http://status.icq.com/online.gif?icq=413042&img=5&rand=<?=rand()?>" class="icon" align="middle" /><a href="http://web.icq.com/whitepages/message_me/1,,,00.icq?uin=413042&action=message">413042</a><nobr><br/>-->
				  <!--<nobr><img src="http://mystatus.skype.com/mediumicon/lantarus" align="middle" style="border: none;" width="20" border="0" height="20" alt="My status" /><a href="skype:sdbelarus?call">lantarus</a></nobr><br/>-->
				  <nobr><img src="/images/skype_icon.png" border="0" width="16px" height="16px" /><a href="skype:<?=$Skype;?>?call">&nbsp;<?=$Skype;?></a></nobr><br/>
				  <nobr><img src="/images/tel_icon.png" border="0" width="16px" height="16px" /> <?=$cityPhone;?><nobr></b>
				</span>
			</td>
			</tr>
			</table>
		</td>
		<td align="left" width="10px"><img src="/images/telbgr.jpg" border="0" width="9px" height="72px" /></td>
		
		</tr>
		</table>
	
	</td>
	</tr>
	</table>
</td>
</tr>
<tr valign="top" height="80px">
<td width="100%" style="padding-left:20px; padding-right:20px;">
	<table id="Table_Top" width="100%" border="0" cellpadding="0"  cellspacing="0" align="center">
	<tr valign="top" height="80px">
	<td align="left" width="10px"><img src="/images/headerbgl.jpg" border="0" width="10px" height="80px" /></td>
	<td align="left" width="100%" style="background-image:url('/images/headerbg.jpg'); background-repeat:repeat-x;">
		<table id="Table_Top" width="100%" border="0" cellpadding="0"  cellspacing="0">
		<tr valign="middle" height="37px">
        
                    <form action="search.php" style="margin:0px; padding:0px" method="get" id="search-from">
                    <td width=100%>
                        <div class="live-search-wrap">
                            <div class="live-search-filed">
                                <input type="text" class="search-field" id="search-keyword" name="searchword" placeholder="Введите текст" autocomplete="off">
                                <a class="empty-search" id="empty-search"></a>
                                <input class="search-button" type="submit" value="Найти">
                            </div>
                            <div class="live-search-result" id="search-block">
                            </div>
                        </div>
                    </td>
                    </form>
                   <!--
		<td align="center" style="padding-top:5px;padding-right:17px;padding-left:250px">
				<span class="searchtext">
				<?
				$top_text = block("id='".$_GET[id]."'", "f9");
				if (!$top_text)
					$top_text = block("id=15", "f9");
				echo $top_text;
				?>
				</span>
		</td>
		<td align="right" width="122px"  style="padding-top:5px;">
		<form action="search.php" style="margin:0px; padding:0px" method="get">
			<nobr>
				<table id="Table_Top" width="122px" border="0" cellpadding="0"  cellspacing="0">
				<tr valign="middle" height="32px">
				<td align="right" width="12px"><img src="/images/search/left.jpg" width="12px" height="22px"></td>
				<td align="right" width="82px">
					<input id="searchword" name="searchword" class="searchbox" onfocus="SearchFocus()" onblur="SearchBlur()" type="text" value="<?=($_GET[searchword]?$_GET[searchword]:"поиск...");?>">
				</td>
				<td align="right" width="28px"><input type="image" src="/images/search/btn.jpg" width="28px" height="22px"></td>

				</tr>
				</table>
			</nobr>
		</form>
		</td>-->
		</tr>
		</table>
		<table id="Table_Top" width="100%" border="0" cellpadding="0"  cellspacing="0">
		<tr valign="bottom" height="43px">
		<td align="left" width="240px" style="padding-left:10px;"><a style="position:relative;top:-19px;"><img src="/images/catalog.jpg" height="43px" width="207px" border="0"></a></td>
		<td width="100%"></td>
		<?
			echo block("rid=1 AND id NOT IN (105, 175, 246, 5805, 5867, 5874, 5872, 5871, 5870) ORDER BY date DESC", "top_menu");
		?>
		</tr>
		</table>

	</td>
	<td align="left" width="10px"><img src="/images/headerbgr.jpg" border="0" width="9px" height="80px" /></td>
	</tr>
	</table>
</td>
</tr>