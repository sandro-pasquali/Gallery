<?php

include("../includes/dbaseConnector.php");

$imgId = $_POST['imgId'];
$main = $_POST['mainImage'];
$thumb = $_POST['thumbImage'];
if($main && $thumb)
  {
    unlink($main);
    unlink($thumb);
    
    $q = "delete from panels where panelId = $imgId";
    
    mysql_query($q);
    
    header("Location: uploadPhotos.php");
  
  }

?>