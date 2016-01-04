<?php namespace export;
require  'medoo.min.php';
require 'config.php';
use medoo;
use PDO;

Export::$config=$config;
Import::$config=$config;

class Export
{   protected $table_head;
    protected $arr;
    protected $to_encoding;
    protected $from_encoding;
    protected $table_name;
    static public $config;

    function __construct($table_name,$x='',$delimiter=',',$to_encoding='UTF-8',$from_encoding='UTF-8') 
    { 
//формируем шапку для сохраняемой таблицы,где x--  текст шапки
//create head for table, where $x -- string whith head table
        $x=mb_convert_encoding($x,$to_encoding,$from_encoding);
        $this->arr=explode($delimiter,$x);
        $this->to_encoding=$to_encoding;
        $this->from_encoding=$from_encoding;
        $this->table_name=$table_name;
    }
  //connect to db
    private function create_db_connect()
    {
        $config=Export::$config;
        $database = new medoo(array(
	       // required
            'database_type' => $config['database_type'],
            'database_name'=> $config['database_name'],
            'server_name' => $config['server_name'],
            'username' => $config['username'],
            'password' => $config['password'],
            'charset'=>$config['charset'],
 
            // optional
            'port' => 3306,
            // driver_option for connection, read more from http://www.php.net/manual/en/pdo.setattribute.php
            'option' => array(
                PDO::ATTR_CASE => PDO::CASE_NATURAL
                )
        ));
        $datas = $database->select($this->table_name, "*");
        return $datas;
    }
 
 //export data to file *.csv
     public function export($filename,$path='',$delimiter=";", $enclosure = '"' )
    {          
        if( file_exists($path)){
        $file=fopen($path.$filename,'w');
        $datas = $this->create_db_connect();
        // вывод шапки 
        fputcsv($file,$this->arr,$delimiter,$enclosure);
        //заполнение таблицы
        foreach ($datas as $value){
            foreach ($value as &$val)
            {
            $val=mb_convert_encoding($val,$this->to_encoding,$this->from_encoding);
            }
        fputcsv($file,$value,$delimiter,$enclosure);
        }
            fclose($file);
        } else
        {
            echo 'ERROR! Path is not found!Variable $path is not correct :'.$path ;
        }
    }    
}

class Import 
{
    static public $config;
    protected $file;
    public $table_name;
    public $table_head;
    protected $to_encoding;
    protected $from_encoding;
    protected $db_tables;
    
    public function __construct($head=array(),$to_encoding='UTF-8',$from_encoding='UTF-8')
    {
        $this->table_head=$head;
        $this->to_encoding=$to_encoding;
        $this->from_encoding=$from_encoding;
    }
      
  // connect to db    
    private function create_db_connect()
    {
        $config=Import::$config;
        $database = new medoo(array(
	       // required
            'database_type' => $config['database_type'],
            'database_name'=> $config['database_name'],
            'server_name' => $config['server_name'],
            'username' => $config['username'],
            'password' => $config['password'],
            'charset'=>$config['charset'],
 
            // optional
            'port' => 3306,
            // driver_option for connection, read more from http://www.php.net/manual/en/pdo.setattribute.php
            'option' => array(
                PDO::ATTR_CASE => PDO::CASE_NATURAL
                )
        ));
           $x=$database->query('SHOW COLUMNS FROM '.$this->table_name)->fetchAll();
            
        $this->db_tables=array();
        foreach($x as $value)
        {
         $this->db_tables[]=$value[0];
        }
        unset($x);
        return $database;
    }
    
    // insert into db
    public function insert($table_name,$filename,$path='',$NO_READ_1LINE='0',$delimiter=";", $enclosure = '"')
    {
        $this->read_file($filename,$path);
        $file=$this->file;
        if($NO_READ_1LINE==1)
        {
            fgetcsv($file,'0',$delimiter,$enclosure);
        }; 
        $this->table_name=$table_name;
        $database=$this->create_db_connect();
$i=0;
        while(!feof($file))
        {
    // create assoc massiv whith head table ->key, read array is value
     
            $arr=fgetcsv($file,'0',$delimiter,$enclosure); 
            //encoding 
           // check of existense massive
            if((!empty($arr))and (is_array($arr))){
            foreach ($arr as &$val)
                {
                if ($val!='')
                    {
                        $val=mb_convert_encoding($val,$this->to_encoding,$this->from_encoding);
                    }             
                }            
          
            $insert_arr=array();

            foreach ($this->db_tables as $key=>$value)
            {
                
                    $insert_arr[$value]=$arr[$key];
                
            }
             }
    
            $filter_arr=array();
            foreach($this->db_tables as $value)
            {
                foreach($this->table_head as $val)
                { if ($value==$val)
                    {
                    $filter_arr[$val]=$insert_arr[$val];
                    }
                }
            }

            $insert = $database->insert($this->table_name,$filter_arr);
            //clean all massive because they can use tomorrow
            unset ($arr);
            unset ($insert_arr);
            unset ($filter_arr);
        }
         return $insert;
    }
    //update_db
    public function update($table_name,$filename,$path='',$where='id',$NO_READ_1LINE='0')
    {
    $this->read_file($filename,$path);
    $file=$this->file;
        if($NO_READ_1LINE==1)
        {
            fgetcsv($file,'0',';','"');
        }; 
    $this->table_name=$table_name;
    $database=$this->create_db_connect();
          while(!feof($file))
        {
    // create assoc massiv whith head table ->key, read array is value
            $arr=fgetcsv($file,'0',';','"'); 
            //encoding  
            if(is_array($arr))
            {
            foreach ($arr as &$val)
                {
                if ($val!='')
                    {
                        $val=mb_convert_encoding($val,$this->to_encoding,$this->from_encoding);
                    }             
                }                    
            $insert_arr=array();
            foreach ($this->db_tables as $key=>$value)
                {         
                    $insert_arr[$value]=$arr[$key];
                }
             }  
            $filter_arr=array();
            foreach($this->db_tables as $value)
            {
                foreach($this->table_head as $val)
                { 
                   if ($value==$val)
                   {
                       $filter_arr[$val]=$insert_arr[$val];
                   }
                }
            }
            $insert = $database->update($this->table_name,$filter_arr,array($where=>$filter_arr[$where]));
        }
        return $insert;
        }
     //read file
    protected function read_file($filename,$path='')
    {
        if( file_exists($path))
         { 
            $path=$path.$filename;
            if (file_exists($path))
            {
              $this->file=fopen($path,'r');  
            }else 
            {
                echo 'ERROR! File whith '.$path.' filename not found'; 
            }
            
        }
        else
        {
            echo 'ERROR! Path is not found!Variable $path is not correct :'.$path ;
        }
 
    }
}