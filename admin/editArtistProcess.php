<?php

include("../includes/dbaseConnector.php");

$artistId = addslashes($_POST['artistId']);
$firstName = addslashes($_POST['firstName']);
$middleName = addslashes($_POST['middleName']);
$lastName = addslashes($_POST['lastName']);
$bio = addslashes($_POST['bio']);

$q = "update artists set firstName = '$firstName', middleName = '$middleName', lastName = '$lastName', bio = '$bio' where artistId = $artistId";

mysql_query($q);

header("Location: editArtistInterface.php?artistId=$artistId");


?>