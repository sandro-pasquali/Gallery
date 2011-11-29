<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>
	<title>add artist</title>
</head>

<body>
	
<?php

include('head.php');

?>

<br /><br />
	
<form action="addArtistProcess.php" method="post">
 
<table border="0"><tr>
	
<td align="right">First Name:</td><td><input type="text" name="firstName" /><td></tr>
<td align="right">Middle Name:</td><td><input type="text" name="middleName" /><td></tr>
<td align="right">Last name:</td><td><input type="text" name="lastName" /><td></tr>
<td align="right">Bio:</td><td><textarea cols="50" rows="15" name="bio"></textarea><td></tr>

</table>

<input type="submit" value="Add Artist" />
</form>


</body>
</html>
