<?
foreach($_FILES as $varname => $fileinfo ){
   $ok=$varname;
   $$ok = $fileinfo["tmp_name"];
   $ok=$varname."_name";
   $$ok = $fileinfo["name"];
   }

extract($_REQUEST,EXTR_SKIP);
if($_SESSION)extract($_SESSION,EXTR_OVERWRITE);
extract($_SERVER,EXTR_OVERWRITE);
extract($_ENV,EXTR_OVERWRITE);

include("_config.php");
include("_mysql.php");
include("_checking.php");
?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
<link rel="stylesheet" href="admin.css" type="text/css">
<title>Administration</title>
</head>
<body bgcolor=#FFFFFF background="images/adminbg.gif">
</body>
</html>