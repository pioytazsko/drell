<?php 
if (!isset($_COOKIE['adminusername']) and !isset($_COOKIE['adminpassword'])){header("Location:/sadmin/");};
?>
    <!DOCTYPE html>
    <html>

    <head>
        <title></title>
        <meta name="generator" content="Bluefish 2.2.5">
        <meta name="author" content="Serj">
        <meta name="date" content="2015-12-05T16:54:07+0300">
        <meta name="copyright" content="">
        <meta name="keywords" content="">
        <meta name="description" content="">
        <meta name="ROBOTS" content="NOINDEX, NOFOLLOW">
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <meta http-equiv="content-type" content="application/xhtml+xml; charset=UTF-8">
        <meta http-equiv="content-style-type" content="text/css">
        <meta http-equiv="expires" content="0">
        <link type="text/css" href="./css/export.css" rel="stylesheet">
    </head>

    <body>
        <div class="files">
            <?php
// Обратите внимание, что оператор !== не существовал до версии 4.0.0-RC2

if ($handle = opendir('./temp')) {
       echo "Файлы:\n";
$list=array();
    while (false !== ($file = readdir($handle))) { 
        if (($file<>'.') and ($file<>'..')){
//            echo "<a target=\"_blank\" download=\"\" href='./temp/$file'><div class='fileblock'><div class='filename'>$file</div><div class='date'>".date("d F Y H:i:s.",filectime('./temp/'.$file))."</div></div></a>";
            $ctime=filectime('./temp/'.$file);
            $list[$ctime]=$file;
        }
    }

    

    closedir($handle); 
  krsort($list);
//    arsort($list);
    foreach($list as $file ){
     echo "<div class='fileblock'><input class='select_file' id='select' value='".$file."' type=\"checkbox\"><a target=\"_blank\" download=\"\" href='./temp/$file'><div class='filename'>$file</div></div></a>";
    
    }
    
}
?> </div>

        <div class="export">
            <input type="button" name="export" value="EXPORT" onClick=exports();>
            <br>
            <br>
            <div class="import"><span>Импорт</span>
                <div>
                    <div id="status">
                        <div class="cssload-container">
                            <div class="cssload-loro">
                                <div class="cssload-circ"></div>
                                <div class="cssload-circ3"></div>
                                <div class="cssload-circ5"></div>
                                <div class="cssload-circ7"></div>
                                <div class="cssload-ojo"></div>
                            </div>
                        </div>
                        Внимание! Идет загрузка файла!
                    </div>
                    <input type="file" id="files" value="SELECTFILE">
                    <input type="button" name="import" value="IMPORT">
                </div>
                <a id='download' target="_blank" download="" style="display:none">скачать </a></div>
        </div>
        <div class="delete_button">
            <a href="" id="reload">
                <button>Обновить</button>
            </a>
            <button id="delete_select">Удалить выбранное</button>
            <button id="unselect">Снять выделение</button>
            <button id="delete_all">Выделить всё</button>
        </div>
        <div class="export_excel"><span>Экспорт в excel</span>
            <input type="button" id="download_excel" value="Скачать файл">
            <input type="file" id="import_excel" value="Загрузить">
            <!--   далее идет обработка нажатия и скачивание-->

        </div>

        <script>
            function exports() {
                filename = '';
                xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (xhttp.readyState == 4 && xhttp.status == 200) {
                        //                console.log(xhttp.responseText)
                        filename = xhttp.responseText;
                        var download = document.getElementById('download');

                        download.href = '/sadmin/temp/' + filename + '.csv';
                        download.click();
                    }
                }
                xhttp.open("POST", "/sadmin/export.php", true);
                xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                var str = 'x=' + filename;
                xhttp.send(str);
            }


            var file = document.getElementById("files");
            var upload_status = document.getElementById('status');
            xhr = new XMLHttpRequest();
            form = new FormData();
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    alert(xhr.responseText);
                    file.disabled = false;
                    upload_status.style.display = "none";

                }
            }
            file.onchange = function() {
                var upload_file = file.files[0];
                form.append("fil", upload_file);
                xhr.open("POST", "/sadmin/import.php", true);
                xhr.send(form);
                file.disabled = true;
                upload_status.style.display = 'block';

            }

            var download = document.getElementById('download_excel');
            download.addEventListener('click', function() {
                //var ajax=new XMLHttpRequest();
                //     ajax.onreadystatechange=function(){
                //     if(ajax.readyState==4 && ajax.status==200)
                //     {
                //     console.log("OK");
                //     
                //     }
                //     ajax.open("POST","/sadmin/export/excel.php",true);
                //         
                //     
                //     }

                var ajx = new XMLHttpRequest();
                ajx.onreadystatechange = function() {
                    if (ajx.readyState == 4 && ajx.status == 200) {
                        console.log(ajx.responseText);
                        var path = ajx.responseText;
                        upload_status.style.display = "none";
                        window.location.assign(path);


                    }
                };
                ajx.open("POST", "/sadmin/export/excel.php", true);
                ajx.send();
                upload_status.style.display = 'block';




            })
            var file_i = document.getElementById("import_excel");
            // var upload_status=document.getElementById('status');
            var xhr_import = new XMLHttpRequest();
            form = new FormData();
            xhr_import.onreadystatechange = function() {
                if (xhr_import.readyState == 4 && xhr_import.status == 200) {
                    alert(xhr_import.responseText);
//                    console.log(xhr_import.responseText);
                    file_i.disabled = false;
                    upload_status.style.display = "none";

                }
            }
            file_i.onchange = function() {
                var upload_file_s = file_i.files[0];
                form.append("fil", upload_file_s);
                xhr_import.open("POST", "/sadmin/export/excel_import.php", true);
                xhr_import.send(form);
                file_i.disabled = true;
                upload_status.style.display = 'block';

            }

        </script>
        <script src="./js/deletefile.js"></script>
    </body>

    </html>
