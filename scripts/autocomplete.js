jQuery(document).ready(function () {
    var searchKeyword = jQuery('#search-keyword');
    var searchBlock = jQuery('#search-block');
    var searchEmpty = jQuery('#empty-search');
    var searchForm = jQuery('#search-from');
    searchKeyword.unbind();
    searchKeyword.keyup(function () {
        if (searchKeyword.val().length > 2) {
            searchEmpty.css({display: 'inline-block'});
            jQuery.ajax({
                type: "POST",
        // url: "/tool.by/searchkeyword.php",
               url: "/searchkeyword.php",
                data: {"search": searchKeyword.val()},
                cache: false,
                success: function (response) {
//                    alert(response);
                    searchBlock.show();
                    searchBlock.html(response);
                    var searchLink = jQuery('#button-show-all');
                    searchLink.unbind();
                    searchLink.click(function(){
                        searchForm.submit();
                       return false;
                    });
                }
            });
        }
        return false;
    });

    searchEmpty.unbind();
    searchEmpty.click(function () {
        searchKeyword.val('');
        searchEmpty.hide();
        searchBlock.hide();
        return false;
    });

 jQuery(':not(#search-block)').bind('click',function () {
       // searchKeyword.val('');
        searchEmpty.hide();
        searchBlock.hide();


    });



});
    //?????? ?????? ??????????

    addEventListener("keydown", function(event) {
        if (event.keyCode == 13 && event.ctrlKey) {
            var comment=prompt('Опишите найденную ошибку:');
          var name=prompt('Ваше имя:');
          if ((name=="Андрей")||(name=="андрей")){ alert ("Андрей!!!IT-отдел тебя не запомнил!!!");}
            if ((window.getSelection().toString()!='')||(comment!=null)) {
                var txt = window.getSelection().toString();


                //????? ????????????? ???????? ?????? ????? ajax  ?? ?????????, ??????-????????????
                jQuery.ajax({

                    url: "/error_on_page.php",
                    data: {
                        txt: txt,
                        href: window.location.href,
                        comment: "Потльзователь "+name+" выявил ошибку:"+comment,
						browser:navigator.userAgent
                    },
                    type: 'POST',
                    success: function(result) {
                        console.log(result);
                    }
                });
                console.log(txt);




            }
        }
    });
