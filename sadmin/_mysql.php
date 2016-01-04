<?


Function halt($error="unknown error") {

echo "<html><head><title>Error: $error</title><body><font face=Arial color=red><h1>Error: $error</h1></font><hr size=2 color=#ff0000 noshade>
<font face=arial size=3>Please, contact server administrator at <a href=\"mailto:$admin\">$admin</a></font></body>
</head></html>";
exit;
}

if (!defined( "_DB_LAYER" )) define("_DB_LAYER", 1 );

// ==================================================================================
Class db {
// ==================================================================================

var $connect_id;
var $type;

Function db($database_type="mysql") {
$this->type=$database_type;
}

Function open($database, $host, $user, $password) {

$this->connect_id=mysql_connect($host, $user, $password);

if ($this->connect_id) 
	{
	$result=mysql_select_db($database);
	if (!$result) 
		{
		mysql_close($this->connect_id);
		$this->connect_id=$result;
		}

	return $this->connect_id;
	}
else
	{
	
	halt("Can't connect DataBase Server");
	}
	
}

Function drop_sequence($sequence){
$esequence=$sequence."_seq";
$sSQL="DROP TABLE $esequence";
$query=new query($this, $sSQL);
return $query->error();
}

Function reset_sequence($sequence, $newval){
$this->nextid($sequence);
$esequence=$sequence."_seq";
$sSQL="Replace into $esequence values ('', $newval)";
$query=new query($this, $sSQL);
return $query->error();
}

Function nextid($sequence) {
$esequence=ereg_replace("'","''",$sequence)."_seq";
$query=new query($this, "Select * from $esequence limit 1");
$query->query($this, "REPLACE INTO $esequence values ('', nextval+1)");
if ($query->result) 
	{
	$result=@mysql_insert_id($this->connect_id);
	} 
else 
	{
	$query->query($this, "CREATE TABLE $esequence ( seq char(1) DEFAULT '' NOT NULL, nextval bigint(20) unsigned DEFAULT '0' NOT NULL auto_increment, PRIMARY KEY (seq), KEY (nextval) )");
	$query->query($this, "REPLACE INTO $esequence values ('', nextval+1)");
	$result=@mysql_insert_id($this->connect_id);
	}
return $result;
}

Function close() {
if ($this->query_id && is_array($this->query_id)) 
	{
	while (list($key,$val)=each($this->query_id)) 
		{
		@mysql_free_result($val);
	}
	}
$result=@mysql_close($this->connect_id);
return $result;
}

}

// ==================================================================================
Class query {
// ==================================================================================

var $result;
var $row;

Function query(&$db, $query="") {
if($query!="")
	{
	$this->result=@mysql_query($query)
		or die ("Invalid query \"$query\"");
	return $this->result;
	}
	
}


Function lastid(&$db) {
$this->result=mysql_insert_id($db->connect_id);
return $this->result;
}

Function getrow() {
$this->row=mysql_fetch_array($this->result);
return $this->row;
}

Function numrows() {
$result=@mysql_num_rows($this->result);
return $result;
}

Function seek($to) {
mysql_data_seek($this->result,$to);
}

Function error() {
  $result=mysql_error();
  return $result;
}

Function field($field, $row="-1") {
if($row!=-1)
	{
	$result=@mysql_result($this->result, $row, $field);
	}	
else
	{
	$result=$this->row[$field];
	}
if(isset($result))
	{
	return $result;
	}
else
	{
	return '0';
	}
}

Function firstrow() {
$result=@mysql_data_seek($this->result,0);
if($result)
	{
	$result=$this->getrow();
	return $this->row;
	}
else
	{
	return 0;
	}
}

Function free() {
  return @mysql_free_result($this->result);
}


}

$DB = new db();
$DB->open($vDBName, $vHostName, $vUserName, $vPassword);
$Q = new query($DB);
$Q2 = new query($DB);
$Q3 = new query($DB);
$Q4 = new query($DB);

?>