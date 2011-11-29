<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>
	<title>Untitled</title>
</head>

<?php

$_aId = (isset($_GET['artistId'])) ? $_GET['artistId'] : '';


?>

<body>
	
<?php

include('head.php');

?>

<br /><br />	
	
<form enctype="multipart/form-data" action="uploadImageProcess.php" method="post">
 <input type="hidden" name="id" value="<?php print $_aId; ?>">
 <input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
 <input name="userfile" type="file" size="40" />
 
<br />Pick existing artist: <br />
<select name="artistId">

<?php

include("../includes/dbaseConnector.php");

$q = "select * from artists";
$r = mysql_query($q);

while($inf = mysql_fetch_assoc($r))
  {
  	$id = $inf['artistId'];
  	$firstName = addslashes($inf['firstName']);
  	$middleName = addslashes($inf['middleName']);
  	$lastName = addslashes($inf['lastName']);
  	
  	$ckd = ($id == $_aId) ? ' selected ' : '';
  	
  	print '<option value="'.$id.'::'.$firstName.'::'.$middleName.'::'.$lastName.'" '.$ckd.'>'.$firstName.' '.$middleName.' '.$lastName.'</option>';
  }

?>

</select>
<br /><br />

<table border="0"><tr>
	
<td align="right">Title of piece:</td><td><input type="text" name="title" /><td></tr>
<td align="right">Width:</td><td><input type="text" name="width" /> Height: <input type="text" name="height" /><td></tr>
<td align="right">Medium:</td><td><input type="text" name="medium" /><td></tr>
<td align="right">Date:</td><td><input type="text" name="date" /><td></tr>
<td align="right">Sold?</td><td><select name="sold"><option value="no">no</option><option value="yes">yes</option></select><td></tr>
</table>

<input type="hidden" name="notes" value="" />
<input type="hidden" name="measurement" value="inches" />

 <input type="submit" value="Upload Image" />
</form>

<?php

$fName = isset($_GET['fName']) ? $_GET['fName'] : '';
$imgId = isset($_GET['imgId']) ? $_GET['imgId'] : '';


if($_aId && $fName && $imgId)
  {
		$absoluteFile = "/usr/local/www/data/gallery/$_aId/$fName.jpg"; 
		$thumbFile = "/usr/local/www/data/gallery/$_aId/t_$fName.jpg";
		
		
		$relativeFile = "../gallery/$_aId/$fName.jpg";
		
		if($fName != '')
		  {
				if(file_exists($absoluteFile))
				  {
				    print '<img src="'.$relativeFile.'" />';
					  print '<br /><br />';
					  print '<form action="deleteUploadedImage.php" method="post">';
					  print '<input type="hidden" name="imgId" value="'.$imgId.'">';
					  print '<input type="hidden" name="mainImage" value="'.$absoluteFile.'">';
					  print '<input type="hidden" name="thumbImage" value="'.$thumbFile.'">';
					  print '<input type="submit" value="delete image">';
					  print '</form>';
				  }
		  }  
  }
  
?>

</body>
</html>
