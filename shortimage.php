<? 
// http://www.php.net/manual/ru/ref.image.php

//include("sadmin/_functions.php");
//include("sadmin/_config.php");
//include("sadmin/_mysql.php");

//include("_functions.php");
//include("_globals.php"); 
$path=$_GET['path'];
$x=$_GET['x'];
$x=$_GET['y'];
print_r($_GET);
if(!isset($x))$x=200;
if(!isset($y))$y=200;
$dest_x=$x;
$dest_y=$y;

 //  echo $dest_x."x".$dest_y;  
if($path!=""){
       
	header("Content-type: image/jpeg");

	$path=ereg_replace("--","/",$path);
	$path=ereg_replace("attachments/([0-9]*)/([^\.]*)/","attachments/\\1/\\2-",$path);
    echo $path;
	$ext=split("\.",$path);
	$ext=$ext[count($ext)-1];

	switch($ext){
	        case "gif":
            $source = imagecreatefromgif($path);break;
	        case "jpeg":$source = imagecreatefromjpeg($path);break;
	        case "jpg":$source = imagecreatefromjpeg($path);break;
            case "pic":$source = imagecreatefromjpeg($path);break;
	        case "png":$source = imagecreatefrompng($path);break;
		default:echo "Unknown format.";exit;
		}
    
	$picsize=getimagesize("$path"); 
	if($x == 1024)
	{
     $dest_x=$picsize[0];
     $dest_y=$picsize[1];
	 }
	$source_x = $picsize[0]; 
	$source_y  = $picsize[1]; 	$offset_y=(int)(($y-$source_y)/2);

if(($source_x<$dest_x) && ($source_y<$dest_y)){
	$x1=ceil(($dest_x-$source_x)/2);
	$y1=ceil(($dest_y-$source_y)/2);
	$x=$source_x;
	$y=$source_y;
	}
else	{
	$k=$source_x/$source_y;
	$k2=$dest_x/$dest_y;



if($k>$k2){
        $x=$dest_x;
	$y=ceil($x/$k);
	$x1=0;
	$y1=ceil(($dest_y-$y)/2);
	}
else	{
        $y=$dest_y;
	$x=ceil($y*$k);
	$x1=ceil(($dest_x-$x)/2);
	$y1=0;
	}
	}



//	echo $dest_x."x".$dest_y;
	
	$dest = imagecreatetruecolor($dest_x, $dest_y);	
	$white = imagecolorallocate($dest, 255, 255, 255);	
	$gray = imagecolorallocate($dest, 100,100,100);	
	
	imagefill($dest,0,0,$white);
//	imagecopyresized($dest, $source, 0, 0, 0, 50, $dest_x, $dest_y, $source_x, $source_y);
	imagecopyresampled($dest, $source, $x1, $y1, 0, 0, $x, $y, $source_x, $source_y);
	/*
	if($dest_x==310)
		imagestring($dest,3,65,150,"b e l k l i m a t . b y",$gray);
		*/
//echo "-".$source_x;
//exit;
$dest=imagecreatefromjpeg($path);

	imagejpeg($dest);
	}


?>