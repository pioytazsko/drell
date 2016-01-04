cn=null;
hideDescrDelay=300;
tNewsstat=0;
flag = 0;
 
// Функция отображающая|скрывающая
// ,а предварительно ещё и передвигающая
// должным образом слои.
 
 
// Вход:
// el - яйчейка таблицы на которой 
// находится указатель;
// m  - наименование слоя, который надо
// отобразить под этой яйчейкой.
 
function showNewsDescr(el,m) {
// Если имеется видимый слой,
// сделать его невидимым.
 //if (cn!=null) {
 //switchDiv(cn,false);
 //}
 
// Если указано название слоя для отображения,
// то:
// 1) Получить его объект;
// 2) X слоя = X яйчейки;
// 3) Y слоя = Y яйчейки + высота яйчейки;
// 4) Сделать слой видимым;
// 5) Сохранить копию слоя в cn.
    cancelhideNewsDescr();
    timer2=setTimeout("show_banner('"+m+"')", hideDescrDelay);
    tNewsstat=1;
}
 
 
 
// Функция "закрывающая" меню.
 
// Функция ничего не принимает на вход
// и возвращает 1.
 
function hideNewsDescr() {
 
// Устанавливаем задержку hideDescrDelay с помощью
// таймера; 
 
timer2=setTimeout("showNewsDescr(null,null)",hideDescrDelay);
 
// Устанавливаем tNewsstat=1 - признак, того, что таймер запущен.
tNewsstat=1;
 
return 1;
}
 
 
 
// Функция останавливающая таймер запущенный
// прошлой функцией. Таким образом,
// меню не пропадает.
 
// Функция ничего не принимает на вход
// и возвращает 1.
 
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