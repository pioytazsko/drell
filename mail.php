<?
if($_POST['name']){ // ������� � ������ �������� �����, �� ����� ���� ������
  $znach = array(
    1 => $_POST['name'],
    2 => $_POST['tel'],
    3 => $_POST['comment'],
    4 => $_POST['ttt'],
  ); 
  mail("anton@10.by", "Zakaz zvonka s www.drel.by","Tel: ".$znach[2]."\nName: ".$znach[1]."\nText: ".$znach[3]."\nSite: "."www.drel.by".$znach[4]); 
  mail("6440909@gmail.com", "Zakaz zvonka s www.drel.by","Tel: ".$znach[2]."\nName: ".$znach[1]."\nText: ".$znach[3]."\nSite: "."www.drel.by".$znach[4]);   // ������ �� ���� ����������� ����, �������� �� ���� email
}
Header("Refresh: 3; URL=".$_SERVER['HTTP_REFERER']); // ������ 8 ������ ������� ����� ��������� �� ���������� URL
?>

<!DOCTYPE html>
<title><? print "$znach[1], ������ ������� ����������!"; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
<meta name="robots" content="noindex"/>
<link rel="stylesheet" href="/styles/all.css">
<script src="/scripts/scripts.js"></script>
<script src="/scripts/dd_menu.js"></script>
<script src="/scripts/banner.js"></script>

<script type="text/javascript" src="/scripts/prototype.js"></script>
<script type="text/javascript" src="/scripts/scriptaculous.js?load=effects,builder"></script>
<script type="text/javascript" src="/scripts/lightbox.js"></script>
<script type="text/javascript" src="/scripts/jquery-1.7.2.js"></script>

<link rel="stylesheet" href="/styles/lightbox.css" type="text/css" media="screen" />

<style>
body {background: rgba(100,100,100,.9);}
body > div {
  position: absolute;
  top: 50%; left: 50%;
  -ms-transform: translate(-50%, -50%); -webkit-transform: translate(-50%, -50%); transform: translate(-50%, -50%);
  padding: .5% 1% 1%;
  border: 1px solid rgb(100,100,100);
  font-size: 140%;
  font-weight: 600;
  text-align: right;
  text-shadow: -1px -1px #666;
  color: rgb(240,240,240);
  background: rgb(255,143,44);
}
label:hover {
  color: #dbeaf9;
  cursor: pointer;
}
body > div > div {padding-top: 3%;}
</style>

<div>
<label title="����������">X</label>
<div><? print "$znach[1]"; ?>, ���� ������ ��������!<br>
�� �������� ��� � ������� 30 �����.</div>
</div>

<script> // ����� �� label ���������� ������� �� ���������� ��������, ��� �������� �����
document.getElementsByTagName('label')[0].onclick = function() {
  window.location.href="<? print $_SERVER['HTTP_REFERER']; ?>"
}
</script>