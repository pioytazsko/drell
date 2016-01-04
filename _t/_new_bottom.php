<tr valign="top" height="19px">
	<td width="100%" style="background:url('/images/footerbg.jpg');background-repeat:repeat-x;"></td>
</tr>
<tr valign="top">
<tr valign="top">
	<td width="100%" align="center">
	<?
	echo block("rid=1 AND id NOT IN (105, 175, 246, 5805, 5874, 5867, 5870, 5871, 5872) ORDER BY date DESC", "bottom_menu_item", "bottom_menu_item_separator");
	?>
	</td>
</tr>
<tr valign="top">
	<td width="100%" style="padding-top:20px;padding-bottom:20px;">
		<form action="<?=$_SERVER[REQUEST_URI];?>" method="post">
			<table id="Table_footer" width="100%" border="0" cellpadding="0"  cellspacing="0">
			
			<tr valign="top">
			<td width="150px" style="padding-left:30px;" align="left">
			<?
				$mobPhone1 = block("id=9271", "anons");
				$mobPhone2 = block("id=9270", "anons");
				$mobPhone3 = block("id=9269", "anons");
			?>
			<div><u><b>Контакты:</b></u><br><br>220118, РБ, г. Минск,
			Машиностроителей 29, пом 103</div><br>
			<?=$mobPhone1;?><br/>
			<?=$mobPhone2;?><br/>
			<?=$mobPhone3;?><br/>
			</td>
			<td width="150px" style="padding-left:30px;" align="left">
			<div>
			<u><b>Данные о регистрации:</b></u><br><br>
			ООО "Калибр Трейд" <br />УНП 191692719<br />
			№ 191692719, 06.12.2011, Минский Горисполком<br><br>
			В торговом реестре с 24.03.2015 №225416
			</div>
			</td>
			<td width="150px" style="padding-left:30px;table-layout: fixed" align="left">
			<div><u><b>График работы:</b></u><br><br>
			ПН-ПТ: 9:00-21:00<br>
			СБ-ВС: 10:00-19:00
			</div>
			</td>

			
			<td style="padding-left:20px;padding-right:20px" align="left">
			<table cellspacing="0" cellspacing="0" border="0" width="100%">
			<tr>
				<td align="left" width="150">
					<span style="font-size:12px;"><b>Вопросы и пожелания</b></span>
				</td>
				<td align="center">
					<b>Имя:</b>&nbsp;<input type="text" name="msg_user_name">&nbsp;<?=($_POST['msg_send']?"<font color='#33CC00'><b>Спасибо, Ваше сообщение отправлено.&nbsp;&nbsp;&nbsp;&nbsp;</b></font>":"")?>
				</td>
				<td align="right" width="100">
					<input type="submit" name="msg_send" value="Отправить">
				</td>
			</tr>
			</table>
			<textarea rows="4" class="textareaclass" name="msg_text" style="width:100%">Если на сайте что-то не работает или работает не так, расскажите, пожалуйста, об этом мне.</textarea>
			</td>
			
			
						</tr>
			</table>
		</form>
	</td>
</tr>
</table>

<!-- End Content -->
</center>
<!-- Yandex.Metrika counter -->
<script type="text/javascript">
(function (d, w, c) {
    (w[c] = w[c] || []).push(function() {
        try {
            w.yaCounter27425972 = new Ya.Metrika({id:27425972,
                    webvisor:true,
                    clickmap:true,
                    accurateTrackBounce:true});
        } catch(e) { }
    });

    var n = d.getElementsByTagName("script")[0],
        s = d.createElement("script"),
        f = function () { n.parentNode.insertBefore(s, n); };
    s.type = "text/javascript";
    s.async = true;
    s.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//mc.yandex.ru/metrika/watch.js";

    if (w.opera == "[object Opera]") {
        d.addEventListener("DOMContentLoaded", f, false);
    } else { f(); }
})(document, window, "yandex_metrika_callbacks");
</script>
<noscript><div><img src="//mc.yandex.ru/watch/27425972" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->

<!-- RedHelper -->
<script id="rhlpscrtg" type="text/javascript" charset="utf-8" async="async" 
	src="https://web.redhelper.ru/service/main.js?c=akezik">
</script> 
<!--/Redhelper -->
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-48831905-2', 'auto');
  ga('send', 'pageview');

</script>

</body>
</html>