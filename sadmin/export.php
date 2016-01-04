<?php 

$filename=$_POST['x'];
$filename='drel.by-'.date('d.m.Y.G_i');echo $filename;
$filename='./temp/'.$filename.'.csv';
$file=fopen($filename,'w');

// mysql_connect('localhost','kuvaldab_drel','pentuh1984');
// mysql_select_db('kuvaldab_drelby');
//mysql_connect('localhost','root','');
//mysql_select_db('tool');
mysql_connect('localhost','toolbyto_serj','kayman');
 mysql_select_db('toolbyto_kalibr');

mysql_query("SET NAMES utf8");
$query="SELECT id,name,f1,f6,f2,f8,f3,f4,f5,f7,f9,f10,enabled,url,title,description,keywords,anons FROM kalibr WHERE f1<>0 AND id<>107";
//$query="SELECT * FROM kalibr";
$result=mysql_query($query); fputs($file,mysql_error());

$head=array('tool.by','name','cost for user','cost 2 ','manufacturer','f8','f3','rating','f5','f7','f9','f10','enabled','url','title','description','keywords','anons');
fputcsv($file,$head,';','"');
while($result_query=mysql_fetch_assoc($result)){  @fputcsv($file,mysql_error());
                                                $arr=array();
                                                  $query_manufected='SELECT name FROM kalibr WHERE id="'.$result_query['f2'].'"';
                                                $manuf=mysql_query($query_manufected);
                                                $menufected=mysql_fetch_assoc($manuf);
                                                foreach($result_query as $value=>$key){
                                                  if ($value=='f2'){
                                                  $arr[]=mb_convert_encoding($menufected['name'],'Windows-1251','UTF-8');
                                                  }else{
                                                    $arr[]=mb_convert_encoding($key,'Windows-1251','UTF-8');}
                                                    };
       fputcsv($file,$arr,';','"');};
mysql_close(); 
fclose($file);?>
