cn=null;
hideDescrDelay=300;
tNewsstat=0;
flag = 0;
 
// ������� ������������|����������
// ,� �������������� ��� � �������������
// ������� ������� ����.
 
 
// ����:
// el - ������� ������� �� ������� 
// ��������� ���������;
// m  - ������������ ����, ������� ����
// ���������� ��� ���� ��������.
 
function showNewsDescr(el,m) {
// ���� ������� ������� ����,
// ������� ��� ���������.
 //if (cn!=null) {
 //switchDiv(cn,false);
 //}
 
// ���� ������� �������� ���� ��� �����������,
// ��:
// 1) �������� ��� ������;
// 2) X ���� = X �������;
// 3) Y ���� = Y ������� + ������ �������;
// 4) ������� ���� �������;
// 5) ��������� ����� ���� � cn.
    cancelhideNewsDescr();
    timer2=setTimeout("show_banner('"+m+"')", hideDescrDelay);
    tNewsstat=1;
}
 
 
 
// ������� "�����������" ����.
 
// ������� ������ �� ��������� �� ����
// � ���������� 1.
 
function hideNewsDescr() {
 
// ������������� �������� hideDescrDelay � �������
// �������; 
 
timer2=setTimeout("showNewsDescr(null,null)",hideDescrDelay);
 
// ������������� tNewsstat=1 - �������, ����, ��� ������ �������.
tNewsstat=1;
 
return 1;
}
 
 
 
// ������� ��������������� ������ ����������
// ������� ��������. ����� �������,
// ���� �� ���������.
 
// ������� ������ �� ��������� �� ����
// � ���������� 1.
 
function cancelhideNewsDescr() {
 if (tNewsstat==1) {
 clearTimeout(timer2);
 tNewsstat=0;
 }
return 1;
}

function newsOut() {
    setFlag();
    timer3 = setTimeout("unsetFlag()", hideDescrDelay);
}

function setFlag() {
    flag = 1;
}

function unsetFlag() {
    flag = 0;
}