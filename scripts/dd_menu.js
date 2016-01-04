cm=null;
hide_delay=0;
tstat=0;
 
// Определяем браузер пользователя
 
isNS4 = (document.layers) ? true : false;
isIE4 = (document.all && !document.getElementById) ? true : false;
isIE5 = (document.all && document.getElementById) ? true : false;
isNS6 = (!document.all && document.getElementById) ? true : false;
 
 
// Функция отображающая и скрывающая слои
 
// Вход:
// objElement - идентификатор(id) слоя;
// bolVisible - булева переменная:
// true  - отобразить слой;
// false - скрыть слой.
 
// Выход:
// 1
 
 
// P.S: В зависимости от типа браузера
// сценарий для манипуляции с видимостью слоёв
// несколько различается.
 
function switchDiv(objElement,bolVisible){
if(isNS4||isIE4){
     if(!bolVisible) {
       objElement.visibility ="hidden"
     } else {
       objElement.visibility ="visible"
     }     
 } else if (isIE5 || isNS6) {
      if(!bolVisible){
         objElement.style.display = "none";
         
      } else {
        objElement.style.display = "";
        
        }
 
      }
 
return 1;
}
 
 
 
// Функция возвращающая значение указанного ей 
// свойства объекта (не обязательно слоя).
 
// Вход:
// el    - идентификатор элемента;
// sProp - свойство (left,top...)
 
// Выход:
// Значение какого-нибудь свойства объекта.
 
 
 
function getPos(el,sProp) {
	var iPos = 0;
	while (el!=null) {
		iPos+=el["offset" + sProp]
		el = el.offsetParent
	}
	return iPos
 
}
 
 
 
// Функция выдаёт объект с указанным
// ей названием.
 
// Вход:
// myid - название объекта
 
// Выход: объект.
 
function getelementbyid(myid) {
   if (isNS4){
        objElement = document.layers[myid];
     }else if (isIE4) {
        objElement = document.all[myid];
     }else if (isIE5 || isNS6) {
             objElement = document.getElementById(myid);
     }
return(objElement);
}
 
 
 
// Функция отображающая|скрывающая
// ,а предварительно ещё и передвигающая
// должным образом слои.
 
 
// Вход:
// el - яйчейка таблицы на которой 
// находится указатель;
// m  - наименование слоя, который надо
// отобразить под этой яйчейкой.
 
function showSubMenu(el,m) {
// Если имеется видимый слой,
// сделать его невидимым.
 if (cm!=null) {
 switchDiv(cm,false);
 }
 
// Если указано название слоя для отображения,
// то:
// 1) Получить его объект;
// 2) X слоя = X яйчейки;
// 3) Y слоя = Y яйчейки + высота яйчейки;
// 4) Сделать слой видимым;
// 5) Сохранить копию слоя в cm.  
 
 
 if (m!=null) {
 m=getelementbyid(m);
 m.style.left = getPos(el,"Left")+"px";
 m.style.top =  getPos(el,"Top")+el.offsetHeight+"px";
 switchDiv(m,true);
 cm=m;
 }
 
}
 
 
 
// Функция "закрывающая" меню.
 
// Функция ничего не принимает на вход
// и возвращает 1.
 
function hidemenu() {
 
// Устанавливаем задержку hide_delay с помощью
// таймера; 
 
timer1=setTimeout("showSubMenu(null,null)",hide_delay);
 
// Устанавливаем tstat=1 - признак, того, что таймер запущен.
tstat=1;
 
return 1;
}
 
 
 
// Функция останавливающая таймер запущенный
// прошлой функцией. Таким образом,
// меню не пропадает.
 
// Функция ничего не принимает на вход
// и возвращает 1.
 
function cancelhide() {
 if (tstat==1) {
 clearTimeout(timer1);
 tstat=0;
 }
return 1;
}