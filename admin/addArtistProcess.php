<?php

include("../includes/dbaseConnector.php");

$firstName = addslashes($_POST['firstName']);
$middleName = addslashes($_POST['middleName']);
$lastName = addslashes($_POST['lastName']);
$bio = addslashes($_POST['bio']);

if(($firstName != '') && ($lastName != ''))
  {
  	/*
  	 * check for existing artist
  	 */
  	$cq = "select firstName from artists where firstName = '$firstName' and middleName = '$middleName' and lastName = '$lastName'";
  	$r = mysql_query($cq);
  	
  	if(mysql_num_rows($r) > 0)
  	  {
  	  	// artist exists...
  	  	print "<a href=\"javascript:history.go(-1)\">the artist > <b>$firstName $middleName $lastName</b> < is already in the database.  click here to go back</a>";
  	  }
  	else
  	  {
				$q = "insert into artists (firstName, middleName, lastName, bio) values ('$firstName','$middleName','$lastName','$bio')";
				
				mysql_query($q);  	
			}
  }
else
  {
  	print "<a href=\"javascript:history.go(-1)\">data missing.  click here to go back</a>";
  }

header("Location: addArtist.php");
?>