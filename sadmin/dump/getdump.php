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
//�������� �� ������� ���������� ����������. ��� �� ���������� ������������� �� �������
if (!isset($_Host_)) $_Host_="localhost";
if (!isset($_User_)) $_User_="root";
if (!isset($_Passw_)) $_Passw_="";
if (!isset($_DB_)) $_DB_="turist_byturist";
//������� ����������, ������� �� ��������, ��� ��������� ������
//����������� ������ ���� � ����� ����
$WorkDir="files/";

//���������� � �������� ��
$DBH=@mysql_connect($_Host_, $_User_, $_Passw_) or die("������ ����������� � �������� ��<br>");
//����� ��
@mysql_select_db($_DB_, $DBH) or die("������ ������� ��<br>");

//������ ������ ������
$query="SHOW TABLES";
$result=mysql_query($query, $DBH) or die("�� ���� ��������� ������ 1");
//������� ��������� ������ � ������
$Tables[]=$module_name;

//������ �� ��������� ���������� � �������� ������
foreach($Tables as $Table){
	if($table!=$module_name)
		continue;
        $query="SHOW COLUMNS FROM $Table";
echo $query;
        $result=mysql_query($query, $DBH) or die("�� ���� ��������� ������ 2");
        //������� ��������� ������ � ������
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
//����������� �����, � ������� �� ������ ������� �� ������ ���������������� ����
for ($i=0; $i<count($Tables); $i++){
        //������ ������ �� ��
        $query="SHOW COLUMNS FROM ".$Tables[$i];
        $result=mysql_query($query, $DBH) or die("�� ���� ��������� ������ � ".$Tables[$i]);
        $j=0;
        while ($row = mysql_fetch_array($result)) {
                $j++;
                $Names[]=$row[0];
                }
        $query="SELECT * FROM ".$Tables[$i];
        $result=mysql_query($query, $DBH) or die("�� ���� ��������� ������ � ".$Tables[$i]);
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




//�������� ���������� � �������� ��
mysql_close($DBH);
////////////////////////////////// ��������� //////////////////////////////////
?>
