<?php require_once('export.php');
 require_once('config.php');
use Export\Export as export ;
use Export\Import as import ;
$password=trim($_POST['password']);

if(($password=="1234")and($_FILES['files']['error']!=4)){
copy($_FILES['files']['tmp_name'],'./dir/'. basename($_FILES['files']['name']).'');

$file=$_FILES['files']['name'];

$im=new import(array('iditem','name','price',
                     'manufekted','category','deskripshn',
                     'keywords','image','spase',
                     'vip','levl','filename','filetitle','publick',
                     'linkobzor','linkobzortitle','linkotziv',
                     'lnkotzivtitle','unit','chpu',
                     'h1','title','description',
                     'share','rating','view'),
               'UTF-8','Windows-1251');

$im->insert('catalog',$file,'./dir/',1,';','"');
    header('Location:http://garant/admin/catalog.php?idp=25');} else {echo "Проверьте пароль или загружаемый файл";}