var select = document.getElementById('delete_all');
var unselect = document.getElementById('unselect');
var delete_select = document.getElementById('delete_select');
var checkbox = document.getElementsByClassName('select_file');

select.addEventListener('click', function () {
    for (var i = 0; i < checkbox.length; i++) {
        checkbox[i].checked = "checed";
    };
});

unselect.addEventListener('click', function () {
    for (var i = 0; checkbox.length; i++) {
        checkbox[i].checked = 0;
    }
})

delete_select.addEventListener('click', function () {
    if (confirm('Удалить выбранные файлы без возможности восстановления?')) {
        if (confirm('ВЫ УВЕРЕНЫ ?????? !!!!!!!!!')) {
            delete_selected()
        };
    } else {

    };
})

function delete_selected() {
   var check= Array();
    for(var i=0;i<checkbox.length;i++){
        if(checkbox[i].checked!=''){
            check.push(checkbox[i].value);
        }
        
    }
    myJsonString = JSON.stringify(check);
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (xhttp.readyState == 4 && xhttp.status == 200) {
            console.log(xhttp.responseText);location.reload();
        };
    }
    xhttp.open("POST", "/sadmin/delete_select.php", true);
    xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    var str = 'x='+myJsonString;
    xhttp.send(str);
}
