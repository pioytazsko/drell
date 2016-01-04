<?
	$query="CREATE TABLE IF NOT EXISTS ".$module_name." (
	  id int(10) DEFAULT '0' NOT NULL,		
	  rid int(10) DEFAULT '0' NOT NULL,		
	  access text DEFAULT '',
	  aname text DEFAULT '',
	  lang text DEFAULT '',
	  date datetime DEFAULT NULL,
	  name text DEFAULT '',
  	  anons text DEFAULT '',
  	  text text DEFAULT '',
	  archive text DEFAULT '',
	  f1 text DEFAULT '',
	  f2 text DEFAULT '',
	  f3 text DEFAULT '',
	  f4 text DEFAULT '',
	  f5 text DEFAULT '',
	  f6 text DEFAULT '',
	  f7 text DEFAULT '',
	  f8 text DEFAULT '',
	  f9 text DEFAULT '',
	  f10 text DEFAULT '')";
	$success=$Q->query($DB,$query);

	$query="CREATE TABLE IF NOT EXISTS ".$module_ut." (
	  id int(10) DEFAULT '0' NOT NULL,		
	  lang text DEFAULT '',
	  date datetime DEFAULT NULL,
	  name text DEFAULT '',
  	  anons text DEFAULT '',
  	  text text DEFAULT '',
	  archive text DEFAULT '',
	  f1 text DEFAULT '',
	  f2 text DEFAULT '',
	  f3 text DEFAULT '',
	  f4 text DEFAULT '',
	  f5 text DEFAULT '',
	  f6 text DEFAULT '',
	  f7 text DEFAULT '',
	  f8 text DEFAULT '',
	  f9 text DEFAULT '')";
	$success=$Q->query($DB,$query);


	$query="select * from ".$module_ut;
	$Q->query($DB,$query);
	$count=$Q->numrows();
	if($count==0)
   	   for($i=1;$i<4;$i++)
		{
		$st=$i.",'ru',20030219191214, 'username".$i."', '', '','','password".$i."', 'sessionid".$i."', '', '', '', '', '', '', ''";
		$query="insert into ".$module_ut." values(".$st.") ";
		$success=$Q->query($DB,$query);
		if(!$success){echo "Error of adding.<br>";}
		}
?>