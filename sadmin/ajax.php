<?php 
$id=$_POST['id'];
include("_config.php");
include("_mysql.php");
class ItemsCat{
    public $name;
    public $rid;
    public $id;
    public $aname;
    function __construct($name,$id,$rid,$aname){
        $this->name=$name;
        $this->id=$id;
        $this->rid=$rid;
        if($aname=="e4"){
        $this->aname=1;
        }else{
        $this->aname=0;
        }
    }   
};
$res=$Q->query($DB,"SET NAMES cp1251");
$query="SELECT name,id,rid,aname FROM kalibr WHERE rid='".$id."'";
$res=$Q->query($DB,$query);
$cat=array();

while($result=mysql_fetch_assoc($res)){
    $result['name']=mb_convert_encoding($result['name'],"UTF-8","Windows-1251");
    $cat[]=new ItemsCat($result['name'],$result['id'],$result['rid'],$result['aname']);
//    echo $result['name'];
} ;

$cat=json_encode($cat);
echo $cat;