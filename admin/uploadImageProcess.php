<?php

include("../includes/dbaseConnector.php");

$aId = $_POST['artistId'];

$title = addslashes($_POST['title']);
$width = addslashes($_POST['width']);
$height = addslashes($_POST['height']);
$measurement = $_POST['measurement'];
$medium= addslashes($_POST['width']);
$date = $_POST['date'];
$notes = addslashes($_POST['notes']);
$sold = addslashes($_POST['sold']);

if($aId && $title && $width && $height && $medium)
  {
		$file = $_FILES['userfile'];
		
		$imgValidType = (($file['type'] == 'image/jpeg') || ($file['type'] == 'image/pjpeg'));
    $imgValidSize = ($file['size'] < 102400);
    
		if(!$imgValidType)
		  {
		    print "wrong file type";
		    exit;
		  }
		  
		if(!$imgValidSize)
		  {
		    print "file too big [ ".$file['size']." ]";
		    exit;
		  }
		 
		/*
		 * confirm artist directory
		 */
		$aInf = explode("::",$aId);
		$artistId = $aInf[0];
		$firstName = $aInf[1];
		$middleName = $aInf[2];
		$lastName = $aInf[3];
		
		$nStr = $firstName.$middleName.$lastName;
		 
		$artistDir = "/usr/local/www/data/gallery/$artistId"; 
		 
		if(!is_dir($artistDir))
		  {
		  	mkdir($artistDir);
		  }
		  
		$uniqueFName = md5(uniqid(rand(), true));  
		  
		$newName = "$artistDir/$uniqueFName.jpg";
		  
		if(!copy($file['tmp_name'],$newName))
			{
			   print 'failed';
			   exit;
			}
	  else
	    {
	    	/*
	    	 * now update filename in dbase
	    	 */
	    	$q = "insert into panels (artistId,title,width,height,measurement,medium,notes,file,date,sold) values ($artistId,'$title','$width','$height','$measurement','$medium','$notes','$uniqueFName.jpg','$date','$sold')";

	    	mysql_query($q);
	    	
	    	$imgId = mysql_insert_id();
	    	
        thumb($newName,$artistDir."/t_".$uniqueFName.".jpg",96,96,true);
	    }
		
		Header("Location:uploadPhotos.php?artistId=$artistId&dir_artist=$nStr&fName=$uniqueFName&imgId=$imgId");
  }
else
  {
  	print "information missing.";
  }
  
function thumb($filename, $destination, $th_width, $th_height, $forcefill)
	{   
	   list($width, $height) = getimagesize($filename);
	
	   $source = imagecreatefromjpeg($filename);
	
	   if($width > $th_width || $height > $th_height){
	     $a = $th_width/$th_height;
	     $b = $width/$height;
	
	     if(($a > $b)^$forcefill)
	     {
	         $src_rect_width  = $a * $height;
	         $src_rect_height = $height;
	         if(!$forcefill)
	         {
	           $src_rect_width = $width;
	           $th_width = $th_height/$height*$width;
	         }
	     }
	     else
	     {
	         $src_rect_height = $width/$a;
	         $src_rect_width  = $width;
	         if(!$forcefill)
	         {
	           $src_rect_height = $height;
	           $th_height = $th_width/$width*$height;
	         }
	     }
	
	     $src_rect_xoffset = ($width - $src_rect_width)/2*intval($forcefill);
	     $src_rect_yoffset = ($height - $src_rect_height)/2*intval($forcefill);
	
	     $thumb  = imagecreatetruecolor($th_width, $th_height);
	     imagecopyresampled($thumb, $source, 0, 0, $src_rect_xoffset, $src_rect_yoffset, $th_width, $th_height, $src_rect_width, $src_rect_height);
	
	     imagejpeg($thumb,$destination);
	   }
	}  
  
?> 
