<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en" xmlns:v="urn:schemas-microsoft-com:vml">
<head>	

<title></title>

<meta http-equiv="Pragma" content="no-cache" />
<meta http-equiv="Expires" content="-1" />
<meta http-equiv="Content-type" content="text/html; charset=iso-8859-1" />
<meta http-equiv="Content-Language" content="en-us" />
<meta name="ROBOTS" content="ALL" />
<meta name="Copyright" content="Copyright (c) Unified Applications Inc." />
<meta http-equiv="imagetoolbar" content="no" />
<meta name="MSSmartTagsPreventParsing" content="true" />

<script type="text/javascript"></script>

</head>

<body>

<?php

include('head.php');

?>

<br /><br />

<form method="post" action="editArtistInterface.php">

<br />You want to edit photo information for this artist: <select name="artistId">

<?php

include("../includes/dbaseConnector.php");

$q = "select * from artists";
$r = mysql_query($q);

while($inf = mysql_fetch_assoc($r))
  {
  	$id = $inf['artistId'];
  	$firstName = $inf['firstName'];
  	$middleName = $inf['middleName'];
  	$lastName = $inf['lastName'];
  	
  	$vStr = $id;
  	$nStr = "$firstName $middleName $lastName";
  	
  	print '<option value="'.$vStr.'">'.$nStr.'</option>';
  }

?>

</select><input type="submit" value=" GO " style="margin-left:30px" />

</form>

</body>
</html>