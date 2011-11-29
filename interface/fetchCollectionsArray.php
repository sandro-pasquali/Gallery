<?php

$collections = Array();
$artistInfo = Array();

include("../includes/dbaseConnector.php");

$q = "select * from panels";

$r = mysql_query($q);

while($i = mysql_fetch_assoc($r))
  {
  	$panelId = $i['panelId'];
  	$artistId = $i['artistId'];
  	$showId = $i['showId'];
  	$measurement = $i['measurement'];
  	$width = htmlspecialchars($i['width'], ENT_QUOTES);
  	$height = htmlspecialchars($i['height'], ENT_QUOTES);
  	$medium = htmlspecialchars($i['medium'], ENT_QUOTES);
  	$notes = htmlspecialchars($i['notes'], ENT_QUOTES);
  	$file = $i['file'];
  	$title = htmlspecialchars($i['title'], ENT_QUOTES);
  	$date = htmlspecialchars($i['date'], ENT_QUOTES);
  	$sold = $i['sold'];
  	
  	/*
  	 * now create artist info object, if not created already
  	 */
  	if(!isset($artistInfo[$artistId]))
  	  {
  	  	$aq = "select * from artists where artistId = $artistId";
  	  	$m = mysql_query($aq);
  	  	$minf = mysql_fetch_assoc($m);
  	  	
  	  	$artistInfo[$artistId] = getArtistData($minf['firstName'],$minf['middleName'],$minf['lastName'],$minf['bio']);
  	  }
  	  
  	/*
  	 * now add panel (image)
  	 */
    
    array_push($artistInfo[$artistId]['images'],getImageData($panelId,$measurement,$width,$height,$title,$medium,$notes,$file,$date,$sold));
  }

function getArtistData($firstName,$middleName,$lastName,$bio) 
  {
  	$retArr = Array
      (
        'firstName' => htmlspecialchars($firstName, ENT_QUOTES),
        'middleName' => htmlspecialchars($middleName, ENT_QUOTES),
        'lastName' => htmlspecialchars($lastName, ENT_QUOTES),
        'bio' => htmlspecialchars($bio, ENT_QUOTES),
        'images' => Array(),
        'shows' => Array()
      );
         
    return($retArr);
  }
  
function getImageData($panelId=0,$measurement="",$width="",$height="",$title="",$medium="",$notes="",$file="",$date="",$sold="no") 
  {
    $retArr = Array
      (
        'panelId' => $panelId,
        'measurement' => htmlspecialchars($measurement, ENT_QUOTES),
        'width' => htmlspecialchars($width, ENT_QUOTES),
        'height' => htmlspecialchars($height, ENT_QUOTES),
        'title' => htmlspecialchars($title, ENT_QUOTES),
        'medium' => htmlspecialchars($medium, ENT_QUOTES),
        'notes' => htmlspecialchars($notes, ENT_QUOTES),
        'mainFile' => $file,
        'thumbFile' => 't_'.$file,
        'date' => $date,
        'sold' => $sold
      );
     
    return($retArr);
  }

print "var php = new PHP_Serializer();var collections = php.unserialize('".serialize($artistInfo)."');";

/*
print "<pre>";
print_r($artistInfo);
print "</pre>";
*/



?>