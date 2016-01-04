<?

$_DB_=$vDBName;
$_Host_=$vHostName;
$_User_=$vUserName;
$_Passw_=$vPassword;


/////////////////////////////////// НАЧАЛО ///////////////////////////////////

//рабочий директорий, задаётся из каталога, где находится скрипт
//Обязательно ставле слеш в конце пути
$WorkDir="files/";

//Соединение с сервером БД
$DBH=@mysql_connect($_Host_, $_User_, $_Passw_) or die("Немогу соедениться с сервером БД<br>");
//Выбор БД
@mysql_select_db($_DB_, $DBH) or die("Немогу выбрать БД<br>");

$Query="delete from ".$module_name;
mysql_query($Query);

$NewLRep="\n";
$NewL="{n}";
//Заполнение созданных таблиц данными из файлов, соответствующих именам таблиц.
$Table=$module_name;

$NewLRep="\n";
$NewL="{n}";
$n=0;
$uploadtxtfile=$module_adminconf."uploaddata.txt";
if(file_exists($uploadtxtfile)){
	$ftext=file($uploadtxtfile);
	$ftext=join("",$ftext);
	$ftext=ereg_replace("[\r\n]","",$ftext);
//	rename($uploadtxtfile,"olddump.txt");	
//	echo $ftext;
//	exit;
	}

$ftext=split("{row}",$ftext);
if($DataLines=$ftext){
        foreach($DataLines as $DataLine){
		if(!trim($DataLine))
			continue;
                $n++;
                $Values=explode("{*}", $DataLine);
                $Query="INSERT INTO $Table VALUES (";
                foreach($Values as $Value){
                        $Value=addslashes($Value);
                        $Value=ereg_replace($NewL, $NewLRep, $Value);
                        $Value=gettextfordb($Value);
                        $Query=$Query."'$Value', ";
                        }
                        $Query=substr($Query, 0, strlen($Query)-2);
                        $Query=$Query.")";
                if(!mysql_query($Query, $DBH)){
 echo "Не могу добавить строку $n в таблицу $Table, проверте правильность формата<p>";
echo $Query;
		}
                }
        }
else {
       echo "<h2 align=center>Не могу найти файл с данными для таблицы $Table, или файл пустой. ".$WorkDir.$Table.".dat"."<br></h2>";
       }

//Закрытие соединения с сервером БД
mysql_close($DBH);

echo "<script language=JavaScript>top.mainleft.location.reload(true);</script>";
?>
