<?php

include("../includes/dbaseConnector.php");

$artistId = $_POST['artistId'];

$panelId = $_POST['panelId'];
$measurement = $_POST['measurement'];
$width = addslashes($_POST['width']);
$height = addslashes($_POST['height']);
$medium = addslashes($_POST['medium']);
$notes = addslashes($_POST['notes']);
$title = addslashes($_POST['title']);
$date = addslashes($_POST['date']);
$sold = addslashes($_POST['sold']);

$q = "update panels set measurement = '$measurement', width = '$width', height = '$height', medium = '$medium', notes = '$notes', title = '$title', date = '$date', sold = '$sold' where panelId = $panelId";

mysql_query($q);

header("Location: editPhotoInfoInterface.php?artistId=$artistId");


?>