<?php 
include("_config.php");
include("_mysql.php");
class ItemsCat{
public $name;
public $rid;
public $id;
 function __construct($name,$id,$rid){
 $this->name=$name;
 $this->id=$id;
 $this->rid=$rid;
  }   
    
};
$res=$Q->query($DB,"SET NAMES cp1251");
$query="SELECT name,id,rid FROM kalibr WHERE rid='16'";

$res=$Q->query($DB,$query);
$cat=array();
while($result=mysql_fetch_assoc($res)){
$cat[]=new ItemsCat($result['name'],$result['id'],$result['rid']);
}  

//запрос на  наличие скидок для товаров??? под копросом




?>
    <!DOCTYPE html>
    <html>

    <head>
        <title></title>
        <meta name="generator" content="Bluefish">
        <meta name="author" content="">
        <meta name="date" content="">
        <meta name="copyright" content="">
        <meta name="keywords" content="">
        <meta name="description" content="">
        <meta name="ROBOTS" content="NOINDEX, NOFOLLOW">
        <meta http-equiv="content-type" content="text/html; charset=Windows-1251">
        <meta http-equiv="content-type" content="application/xhtml+xml; charset=Windows-1251">
        <meta http-equiv="content-style-type" content="text/css">
        <meta http-equiv="expires" content="0">
        <link href="css/export.css" type="text/css" rel="stylesheet">
    </head>

    <body>
        <div class="left_block">
            <?php
foreach($cat as $value){
echo"<div id='".$value->id."' class='left_items'>
<span>".$value->name."</span>
</div>";
}
 
    ?>
        </div>
        <div class="right_block">
            <?php
foreach($cat as $value){
echo"<div id='".$value->id."' class='right_items'>
<span>".$value->name."</span>
</div>";
}
  
    
    ?>

        </div>

        <div id="selected" class="selected_items">
            <div id="main_item"></div>
            <div id="item_complect">

            </div>
        </div>
        <div class="buttons_comp">
            <input type="button" id="save" value="Save">
            <input type="button" id="reset" value="Reset">
            <input type="button" id="read" value="Read Complect">

        </div>
        <script>
            document.getElementsByClassName('left_block').width = window.innerWidth - 200;


            var cat = document.getElementsByClassName("left_items");
            //    console.log(cat);
            for (var p = 0; p < cat.length; p++) {
                cat[p].addEventListener("click", loadDoc);
            };
            var cat_right = document.getElementsByClassName("right_items");
            //console.log(cat_right);
            for (var p = 0; p < cat.length; p++) {
                cat_right[p].addEventListener("click", loadRightDoc);
            };


            //--------------------------------
            //сохранение в бд
            var save = document.getElementById('save');
            save.addEventListener('click', function() {
                var n_main = document.getElementsByAttribute('main');
                var n_complect = document.getElementsByAttribute('complect');
                if (n_main.length != 0) {
                    n_main = n_main.pop();
                    console.log(n_main);
                    var arr = Array();
                    var temp = new ItemSale(n_main.attributes.main.value, n_main.value, 1);
                    arr.push(temp);
                    for (var p = 0; p < n_complect.length; p++) {
                        arr.push(new ItemSale(n_complect[p].attributes.complect.value, n_complect[p].value, 0))

                    }

                    console.log(arr);
                    var json = JSON.stringify(arr);
                    xhttps = new XMLHttpRequest();
                    xhttps.onreadystatechange = function() {
                        if (xhttps.readyState == 4 && xhttps.status == 200) {
                            //    document.getElementById("demo").innerHTML = xhttp.responseText;
                            alert(xhttps.responseText);

                        }
                    };
                    xhttps.open('POST', 'addcomplect.php', true);
                    xhttps.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                    var str = 'json=' + json;
                    xhttps.send(str);
                } else {
                    alert("Не выбран товар для которого будет комплект");
                }

            })

            //--------------------------------




            var reset = document.getElementById('reset');
            reset.addEventListener('click', function() {
                var check = document.getElementsByTagName('input');
                console.log(check);
                for (var p = 0; p < check.length; p++) {
                    if (check[p].checked) {
                        check[p].click();
                    }
                };
                clear_complect();
            })



            var read = document.getElementById('read');
            read.addEventListener('click', function() {
                var main = document.getElementsByAttribute('main');
                if (main.length != 0) {
                    main = main.pop();
                    new_main = new ItemSale(main.attributes.main.value, main.value, 1)
                    main = JSON.stringify(new_main);
                    xhttps = new XMLHttpRequest();
                    xhttps.onreadystatechange = function() {
                        if (xhttps.readyState == 4 && xhttps.status == 200) {
                            //    document.getElementById("demo").innerHTML = xhttp.responseText;
                            var res = xhttps.responseText;
                            console.log(xhttps.responseText);
                            res = JSON.parse(res);
                            console.log(res);
                            var right_col = document.getElementById('item_complect');
                            clear_complect();
                            var div_r_c = document.createElement('div');
                            for (var p = 0; p < res.length; p++) {
                                var main_span = document.createElement('span');
                                var div_line = document.createElement('div');
                                div_line.setAttribute('class', 'div_line');
                                main_span.innerHTML = res[p].name;
                                var main_item_sale = document.createElement('input');
                                main_item_sale.setAttribute('type', 'text');
                                main_item_sale.setAttribute('complect', res[p].id_compl);
                                main_item_sale.setAttribute('value', res[p].sale);

                                div_line.appendChild(main_span);

                                div_line.appendChild(main_item_sale);
                                div_r_c.appendChild(div_line);
                            }



                            right_col.appendChild(div_r_c);
                        }
                    };
                    xhttps.open('POST', 'read_complect.php', true);
                    xhttps.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

                    var str = 'id=' + main;
                    xhttps.send(str);
                } else {
                    alert('не выбран товар')
                }
            })

            function loadDoc() {
                var id = this.attributes.id.value;
                this.removeEventListener("click", loadDoc)
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (xhttp.readyState == 4 && xhttp.status == 200) {
                        var res = JSON.parse(xhttp.responseText)
                            //                        console.log(res);
                        var arr_id = Array();
                        for (var i = 0; i < res.length; i++) {

                            var newLi = document.createElement('div');
                            newLi.setAttribute('class', 'left_items');
                            newLi.setAttribute('id', res[i]['id']);
                            arr_id.push(res[i]['id']);
                            // newLi.innerHTML = "<span>" + res[i]['name'] + "</span>";
                            if (res[i]['aname'] == 1) {
                                var radio_new = document.createElement('input');
                                radio_new.setAttribute('type', 'radio');
                                radio_new.setAttribute('name', 'select');
                                radio_new.setAttribute('id', res[i]['id']);
                                radio_new.addEventListener("click", function() {
                                    //добавим выбранный товар 

                                    var main = document.getElementById('main_item');
                                    //                                    console.log(main.firstChild);
                                    if (main.firstChild != null) {
                                        main.removeChild(main.firstChild);
                                    }
                                    var main_item = document.createElement('div');
                                    main_item.setAttribute('class', 'div_line');
                                    var main_span = document.createElement('span');
                                    main_span.innerHTML = this.nextSibling.innerHTML;
                                    var main_item_sale = document.createElement('input');
                                    main_item_sale.setAttribute('type', 'text');
                                    main_item_sale.setAttribute('data', this.attributes.id.value);
                                    main_item_sale.setAttribute('main', this.attributes.id.value);
                                    main_item_sale.setAttribute('value', '0');
                                    main_item.appendChild(main_span);
                                    main_item.appendChild(main_item_sale);
                                    main.appendChild(main_item);


                                })
                                newLi.appendChild(radio_new);
                                var span = document.createElement('span');
                                span.innerHTML = res[i]['name'];
                                newLi.appendChild(span);

                            } else {
                                var span = document.createElement('span');
                                span.innerHTML = res[i]['name'];
                                newLi.appendChild(span);

                            }
                            //                            document.getElementById(id).appendChild(newLi);
                            arr = document.getElementsByClassName('left_items');

                            for (var p = 0; p < arr.length; p++) {
                                //                            console.log(arr[p]);
                                if (arr[p].attributes.id.value === id) {
                                    arr[p].appendChild(newLi);
                                }
                            }
                            //                            document.getElementById(id).appendChild(newLi);

                        };
                        //                        var select_radio = document.getElementsByName('select');
                        //                        console.log(select_radio);
                        //                        for (var p in select_radio) {
                        //                            select_radio[p].addEventListener("click", function() {
                        //                                alert()
                        //                            })
                        //                        }
                        for (var p in arr_id) {
                            document.getElementById(arr_id[p]).addEventListener("click", loadDoc);
                        };

                    }
                };
                xhttp.open("POST", "ajax.php", true);
                //                console.log(id);
                xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhttp.send("id=" + id);
            }

            function loadRightDoc() {
                var id = this.attributes.id.value;
                this.removeEventListener("click", loadRightDoc)
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (xhttp.readyState == 4 && xhttp.status == 200) {
                        var res = JSON.parse(xhttp.responseText)
                            //                        console.log(res);
                        var arr_id = Array();
                        for (var i = 0; i < res.length; i++) {

                            var new_check = document.createElement('div');
                            new_check.setAttribute('class', 'right_items');
                            new_check.setAttribute('id', res[i]['id']);
                            arr_id.push(res[i]['id']);
                            // new_check.innerHTML = "<span>" + res[i]['name'] + "</span>";
                            if (res[i]['aname'] == 1) {
                                var check_new = document.createElement('input');
                                check_new.setAttribute('type', 'checkbox');
                                check_new.setAttribute('name', 'select');
                                check_new.setAttribute('id', res[i]['id']);
                                check_new.addEventListener("click", function() {
                                    //добавим выбранный товар 
                                    var right_col = document.getElementById('item_complect');
                                    if (this.checked === true) {


                                        var mainDiv = document.createElement('div');
                                        var main_span = document.createElement('span');
                                        var main_item_sale = document.createElement('input');
                                        var divLine = document.createElement('div');
                                        divLine.setAttribute('class', 'div_line');
                                        main_span.innerHTML = this.nextSibling.innerHTML;

                                        main_item_sale.setAttribute('type', 'text');
                                        main_item_sale.setAttribute('complect', this.attributes.id.value);
                                        main_item_sale.setAttribute('value', '0');

                                        divLine.appendChild(main_span);
                                        divLine.appendChild(main_item_sale);
                                        mainDiv.appendChild(divLine);
                                        right_col.appendChild(mainDiv);


                                    } else {
                                        var rem = document.getElementsByAttribute('complect', this.attributes.id.value);
                                        //  console.log(rem);
                                        //                                        mains.removeChild(rem[0].parentElement);
                                        clear_complect();

                                    }
                                })
                                new_check.appendChild(check_new);
                                var span = document.createElement('span');
                                span.innerHTML = res[i]['name'];
                                new_check.appendChild(span);

                            } else {
                                var span = document.createElement('span');
                                span.innerHTML = res[i]['name'];
                                new_check.appendChild(span);

                            }
                            arr = document.getElementsByClassName('right_items');

                            for (var p = 0; p < arr.length; p++) {
                                //                            console.log(arr[p]);
                                if (arr[p].attributes.id.value === id) {
                                    arr[p].appendChild(new_check);
                                }
                            }

                        };
                        //                        var select_radio = document.getElementsByName('select');
                        //                        console.log(select_radio);
                        //                        for (var p in select_radio) {
                        //                            select_radio[p].addEventListener("click", function() {
                        //                                alert()
                        //                            })
                        //                        }
                        for (var p in arr_id) {
                            document.getElementById(arr_id[p]).addEventListener("click", loadRightDoc);
                        };

                    }
                };
                xhttp.open("POST", "ajax.php", true);
                //console.log(id);
                xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhttp.send("id=" + id);
            }

            function clear_complect() {
                var main = document.getElementById('item_complect');
                //                console.log(main);
                //                main.removeChild(main.firstChild);
                main.innerHTML = '';
                var div = document.createElement('div');
                main.appendChild(div);


            }

            function ItemSale(id, sale, main) {
                this.id = id;
                this.sale = sale;
                this.main = main;
            };

            document.getElementsByAttribute = function(attrib, value, context_node, tag) {

                var nodes = [];

                if (context_node == null)

                    context_node = this;

                if (tag == null)

                    tag = '*';

                var elems = context_node.getElementsByTagName(tag);


                for (var i = 0; i < elems.length; i += 1) {

                    if (value) {

                        if (elems[i].hasAttribute(attrib) && elems[i].getAttribute(attrib) == value)

                            nodes.push(elems[i]);

                    } else {

                        if (elems[i].hasAttribute(attrib))

                            nodes.push(elems[i]);

                    }

                }

                return nodes;

            }

        </script>
    </body>

    </html>
