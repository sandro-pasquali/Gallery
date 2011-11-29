<?php

include("../includes/dbaseConnector.php");

$panelId = $_REQUEST['imgId']; 

$q = "select artistId,file from panels where panelId = '$panelId'";
$r = mysql_query($q);

$fI = mysql_fetch_assoc($r);
$artistId = $fI['artistId'];
$fName = $fI['file'];

$absoluteFile = "/usr/local/www/data/gallery/$artistId/$fName"; 
$thumbFile = "/usr/local/www/data/gallery/$artistId/t_$fName";

unlink($absoluteFile);
unlink($thumbFile);
    
$q = "delete from panels where panelId = $panelId";
    
mysql_query($q);
    
header("Location: editPhotoInfoInterface.php?artistId=$artistId");

?>