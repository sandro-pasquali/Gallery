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

<table cellpadding="6" cellspacing="0" border="1">


<?php

include('head.php');
include("../includes/dbaseConnector.php");

print '<br /><br />';

$artistId = (isset($_POST['artistId'])) ? $_POST['artistId'] : $_GET['artistId'];

if(!$artistId)
  {
  	print 'no artist id sent';
  	exit;
  }

$q = "select * from artists where artistId = $artistId";
$r = mysql_query($q);

while($inf = mysql_fetch_assoc($r))
  {
    $firstName = $inf['firstName'];
    $middleName = $inf['middleName'];
    $lastName = $inf['lastName'];
    $bio = $inf['bio'];

    
    print '<form method="post" action="editArtistProcess.php"><input type="hidden" name="artistId" value="'.$artistId.'" />';
    
    print '<tr><td align="right" valign="top"> First Name:</td><td><input type="text" name="firstName" value="'.$firstName.'" /></td></tr>';
    print '<tr><td align="right" valign="top"> Middle Name:</td><td><input type="text" name="middleName" value="'.$middleName.'" /></td></tr>';
    print '<tr><td align="right" valign="top"> Last Name:</td><td><input type="text" name="lastName" value="'.$lastName.'" /></td></tr>';
    print '<tr><td align="right" valign="top"> Bio:</td><td><textarea style="width: 400px; height: 300px;" name="bio">'.$bio.'</textarea></td></tr>';
    
    print '<tr><td colspan="2" style="height:10px; background-color:#a0a0a0;"><input type="submit" value="change artist info" /></td></tr></form>';
  }

?>


</table>

</body>
</html>