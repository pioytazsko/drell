<?
include("../_functions.php");
include("../_config.php");
include("../_mysql.php");
include("../_admin_config.php");
include("../_checking.php");
if($caction=="displayfirst")
	{
	echo "<script language=JavaScript>top.location='../index.php';</script>";
	exit;
	}
header('Content-Type: text/plain; charset=windows-1251');

$_DB_=$vDBName;
$_Host_=$vHostName;
$_User_=$vUserName;
$_Passw_=$vPassword;

function primar($Attribute){
        if ($Attribute=="PRI"){
                $ret="primary key";
                 return $ret;
                 }
        else {
                $ret="";
                return $ret;
                }
        }
function nul($Attribute){
        if ($Attribute!="YES") {
                $ret="NOT NULL";
                return $ret;
                }
        else {
                $ret="";
                return "";
                }
        }
function def($Attribute){
        if ($Attribute!=""){
            $ret="DEFAULT '$Attribute'";
            }
        else $ret="";
        return $ret;
        }
//Проверка на наличие переданных переменных. При их отсудствии устанавливаем из скрипта
if (!isset($_Host_)) $_Host_="localhost";
if (!isset($_User_)) $_User_="root";
if (!isset($_Passw_)) $_Passw_="";
if (!isset($_DB_)) $_DB_="turist_byturist";
//рабочий директорий, задаётся из каталога, где находится скрипт
//Обязательно ставле слеш в конце пути
$WorkDir="files/";

//Соединение с сервером БД
$DBH=@mysql_connect($_Host_, $_User_, $_Passw_) or die("Немогу соедениться с сервером БД<br>");
//Выбор БД
@mysql_select_db($_DB_, $DBH) or die("Немогу выбрать БД<br>");

//Запрос списка таблиц
$query="SHOW TABLES";
$result=mysql_query($query, $DBH) or die("Не могу выполнить запрос 1");
//Заносим полученый список в массив
$Tables[]=$module_name;

//Запрос на получение инструкций к созданию таблиц
foreach($Tables as $Table){
	if($table!=$module_name)
		continue;
        $query="SHOW COLUMNS FROM $Table";
echo $query;
        $result=mysql_query($query, $DBH) or die("Не могу выполнить запрос 2");
        //Заносим полученый список в массив
        $CrStr="CREATE TABLE $Table ( ";
       while($row = mysql_fetch_array($result)){
               $CrStr=$CrStr.$row['Field']." ";
               $CrStr=$CrStr.$row['Type']." ";
               $CrStr=$CrStr.$row['Extra']." ";
               $CrStr=$CrStr.primar($row['Key'])." ";
               $CrStr=$CrStr.nul($row['Null'])." ";
               $CrStr=$CrStr.def($row[4]).", ";
               }
       $CrStr=substr($CrStr, 0, strlen($CrStr)-2);
       $CrStr=$CrStr.")";
       $CrTableLine[]=$CrStr;

        }

$NewL="\n";
$NewLRep="{n}";
//Организация цикла, в котором из каждой таблицы БД данные перезаписываются файл
for ($i=0; $i<count($Tables); $i++){
        //Запрос данных из БД
        $query="SHOW COLUMNS FROM ".$Tables[$i];
        $result=mysql_query($query, $DBH) or die("Не могу выполнить запрос к ".$Tables[$i]);
        $j=0;
        while ($row = mysql_fetch_array($result)) {
                $j++;
                $Names[]=$row[0];
                }
        $query="SELECT * FROM ".$Tables[$i];
        $result=mysql_query($query, $DBH) or die("Не могу выполнить запрос к ".$Tables[$i]);
        while ($row = mysql_fetch_array($result)) {
               for($k=0; $k<$j; $k++){
               $row[$k]=ereg_replace("\r", "", $row[$k]);
               $ImpStr[]=ereg_replace("$NewL", "$NewLRep", $row[$k]);
                     }
               $DataStr=implode("{*}", $ImpStr)."{row}\n";
               echo $DataStr;
               unset($ImpStr);
               }
        }




//Закрытие соединения с сервером БД
mysql_close($DBH);
////////////////////////////////// ОКОНЧАНИЕ //////////////////////////////////
?>
