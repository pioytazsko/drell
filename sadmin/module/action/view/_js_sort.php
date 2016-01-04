<script language=JavaScript>

function ChangeSort(i)
{
var t;
switch(i){
	case 0:t="date";break;
	case 1:t="name";break;
	case 2:t="archive";break;
}
if(document.qsearch.q_sort.value==t)
	{
	document.qsearch.q_sort.value=t+' desc';
	}
else
	{
	document.qsearch.q_sort.value=t;
	}
document.qsearch.submit();
}

</script>