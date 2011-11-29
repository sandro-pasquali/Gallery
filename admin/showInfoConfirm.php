<?php

include("../includes/dbaseConnector.php");

session_start();

$showId = $_SESSION['showId'];
$title = addslashes($_SESSION['title']);
$date = addslashes($_SESSION['date']);
$description = addslashes($_POST['description']);

/*
 * if a valid id, this is an edit
 */
if($showId!= '')
  {
  	$q = "update shows set title = '$title', date = '$date', description = '$description' where showId = $showId";
  }
else // new entry
  {
$q = "insert into shows (title,date,description) values ('$title','$date','$description')";
  }
mysql_query($q);


print '<a href="javascript:document.location.href=\'showInfoInterface.php\';">show info added.  click here to add more.</a>';


?>