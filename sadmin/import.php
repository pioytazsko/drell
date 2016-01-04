<?php

// Каталог, в который мы будем принимать файл:
$uploaddir = './files/';
$uploadfile = $uploaddir.basename($_FILES['fil']['name']);

// Копируем файл из каталога для временного хранения файлов:
if (copy($_FILES['fil']['tmp_name'], $uploadfile))
{
//    unlink('./files/temp.csv');
    $file=fopen($uploadfile,'r');
    $file1=fopen('./files/temp.txt','w');
    $head=fgets($file);
    // gпроверка на соответствие  таблицы бд. 
    $protection=explode(';',$head);
  if ($protection['0']!=trim('tool.by')){ echo 'This file is not of this database'; } else{ 

//      
//      mysql_connect('localhost','kuvaldab_drel','pentuh1984');
// mysql_select_db('kuvaldab_drelby');
      
      
    mysql_connect('localhost','toolbyto_serj','kayman');
 mysql_select_db('toolbyto_kalibr');
//          mysql_connect('localhost','root','');
// mysql_select_db('tool');

    mysql_query("SET NAMES utf8");
    while(!feof($file)){
       
//        $string=fgetcsv($file,10000,';');
        $str = fgets($file);
        $strs=str_replace('"','',$str);
        $str=mb_convert_encoding($strs,'UTF-8','Windows-1251');
$string = explode(";", $str);
       
        $query="UPDATE kalibr SET  name='".$string['1']."',f1='".$string['2']."',f6='".$string['3']."',f8='".$string['5']."',f3='".$string['6']."',f4='".$string['7']."',f5='".$string['8']."',f7='".$string['9']."',f9='".$string['10']."',f10='".$string['11']."',enabled='".$string['12']."',url='".$string['13']."',title='".$string['14']."',description='".$string['15']."',keywords='".$string['16']."',anons='".$string['17']."' WHERE id='".$string['0']."'";  
        mysql_query($query);  fputs($file1,mysql_error());
                        }
    fputs($file1, "Файл успешно загружен на сервер");
    fclose($file);
    fclose($file1);
        mysql_close();echo "ok"; }
}
?>