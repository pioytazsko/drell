<?

$_DB_=$vDBName;
$_Host_=$vHostName;
$_User_=$vUserName;
$_Passw_=$vPassword;


/////////////////////////////////// ������ ///////////////////////////////////

//������� ����������, ������� �� ��������, ��� ��������� ������
//����������� ������ ���� � ����� ����
$WorkDir="files/";

//���������� � �������� ��
$DBH=@mysql_connect($_Host_, $_User_, $_Passw_) or die("������ ����������� � �������� ��<br>");
//����� ��
@mysql_select_db($_DB_, $DBH) or die("������ ������� ��<br>");

$Query="delete from ".$module_name;
mysql_query($Query);

$NewLRep="\n";
$NewL="{n}";
//���������� ��������� ������ ������� �� ������, ��������������� ������ ������.
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
 echo "�� ���� �������� ������ $n � ������� $Table, �������� ������������ �������<p>";
echo $Query;
		}
                }
        }
else {
       echo "<h2 align=center>�� ���� ����� ���� � ������� ��� ������� $Table, ��� ���� ������. ".$WorkDir.$Table.".dat"."<br></h2>";
       }

//�������� ���������� � �������� ��
mysql_close($DBH);

echo "<script language=JavaScript>top.mainleft.location.reload(true);</script>";
?>
