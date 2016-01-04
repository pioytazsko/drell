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

        <div id="selected" class="selected_items"><div id="main_item"></div><div id="item_complect"></div></div>
        <div class="buttons_comp">
            <input type="button"  value="Save">
            <input type="button" value="Reset">
            
        </div>
        <script>
            document.getElementsByClassName('left_block').width = window.innerWidth - 200;

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

                            var newLi = document.createElement('div');
                            newLi.setAttribute('class', 'right_items');
                            newLi.setAttribute('id', res[i]['id']);
                            arr_id.push(res[i]['id']);
                            // newLi.innerHTML = "<span>" + res[i]['name'] + "</span>";
                            if (res[i]['aname'] == 1) {
                                var radio_new = document.createElement('input');
                                radio_new.setAttribute('type', 'checkbox');
                                radio_new.setAttribute('name', 'select');
                                radio_new.setAttribute('id', res[i]['id']);
                                newLi.appendChild(radio_new);
                                var span = document.createElement('span');
                                span.innerHTML = res[i]['name'];
                                newLi.appendChild(span);
                            } else {
                                var span = document.createElement('span');
                                span.innerHTML = res[i]['name'];
                                newLi.appendChild(span);

                            }
                            arr = document.getElementsByClassName('right_items');

                            for (var p = 0; p < arr.length; p++) {
                                //                            console.log(arr[p]);
                                if (arr[p].attributes.id.value === id) {
                                    arr[p].appendChild(newLi);
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
                console.log(id);
                xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhttp.send("id=" + id);
            }

            var cat = document.getElementsByClassName("left_items");
            console.log(cat);
            for (var p = 0; p < cat.length; p++) {
                cat[p].addEventListener("click", loadDoc);
            };
            var cat_right = document.getElementsByClassName("right_items");
            console.log(cat_right);
            for (var p = 0; p < cat.length; p++) {
                cat_right[p].addEventListener("click", loadRightDoc);
            };

        </script>
    </body>

    </html>
