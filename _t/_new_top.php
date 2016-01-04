<?php include("sadmin/_config.php");
include("sadmin/_mysql.php");?>
<html>
<head>
<meta name='yandex-verification' content='45c5fc773031316b' />
<meta name="google-site-verification" content="8QEACh1tp_TXmHJH_BbkERveGkOQ__FTr-6kcT5Tmpc" />
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251">

<link rel="stylesheet" href="/styles/all.css">
<script src="/scripts/scripts.js"></script>
<script src="/scripts/dd_menu.js"></script>
<script src="/scripts/banner.js"></script>

<script type="text/javascript" src="/scripts/prototype.js"></script>
<script type="text/javascript" src="/scripts/scriptaculous.js?load=effects,builder"></script>
<script type="text/javascript" src="/scripts/lightbox.js"></script>


<link rel="stylesheet" href="/styles/lightbox.css" type="text/css" media="screen" />

</head>
<body>



<center>

<table id="Table_Top" width="100%" border="0" cellpadding="0" height="100%" style="min-height:100%" cellspacing="0" align="center">
<tr valign="top" height="83px">
<td width="100%" style="padding-left:20px; padding-right:20px;">
<!-- Header -->
	<table id="Table_Top" width="100%" border="0" cellpadding="0"  cellspacing="0" align="center">
	<tr valign="top" height="100px">
	<td align="left" width="230px" style="padding-right:20px;padding-left:20px;padding-top:10px"><a href="/"><?
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
		<table id="Table_Top" width-min="300px" border="0" cellpadding="0"  cellspacing="0" align="center">
		<tr height="100px">

		<td style="padding-right:13px;"><a href="http://drel.by/page.php?id=18476"><img src="/images/car.jpg" border="0" align="middle" /></a></td>
		<td style="padding-right:20px;"><a href="http://drel.by/page.php?id=18476" style="font-size:18px">�������� �� ���� ��������</a></td>

		</tr>
		</table>
	</td>

	<td align="left" style="padding-right:10px;">  <!-- Telephone -->
		<table id="Table_Top" width="100%" border="0" cellpadding="0"  cellspacing="0">
		<tr valign="top">

		<td align="left" width="100%"><img src="/images/opmobile.jpg" border="0" style="margin-top:15px;margin-right:24px"/>
		</td>
		<td align="left" width="100%"><img src="/images/telcod.jpg" border="0" style="margin-top:15px;margin-right:24px"/>
		</td>
		<td align="left" width="100%"><img src="/images/tel2.jpg" border="0" style="margin-top:11px"/>
		</td>

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
<td>


</td>
		<td align="right" width="122px"  style="padding-top:5px;">

<form action="search.php" style="margin:0px; padding:0px" method="get">
			<nobr>
				<table id="Table_Top" width="122px" border="0" cellpadding="0"  cellspacing="0">
				<tr valign="middle" height="32px">
				<td align="right" width="12px"><img src="/images/search/left.jpg" width="12px" height="22px"></td>
				<td align="right" width="82px">
					<input id="searchword" name="searchword" class="searchbox" onfocus="SearchFocus()" onblur="SearchBlur()" type="text" value="<?=($_GET[searchword]?$_GET[searchword]:"�����...");?>">
				</td>
				<td align="right" width="28px"><input type="image" src="/images/search/btn.jpg" width="28px" height="22px"></td>

				</tr>
				</table>
			</nobr>
		</form>
		</td>
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
