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

<script type="text/javascript">
	
function deleteImage(id)
  {
  	var confirmDelete = confirm ("Are you sure that you want to delete this image?")
    if(confirmDelete)
      {
  	    document.location.href = 'editPhotoInfoDeleteImage.php?imgId=' + id;
  	  }
  }	
	
</script>

</head>

<body>

<?php

include('head.php');

?>

<br /><br />

<table cellpadding="6" cellspacing="0" border="1">


<?php

include("../includes/dbaseConnector.php");

$artistId = (isset($_POST['artistId'])) ? $_POST['artistId'] : $_GET['artistId'];

$artistDir = $artistId;

if(!$artistId)
  {
  	print 'no artist id sent';
  	exit;
  }

$q = "select * from panels where artistId = $artistId";
$r = mysql_query($q);

if($r && (mysql_num_rows($r) > 0))
  {
		while($inf = mysql_fetch_assoc($r))
		  {
		    $panelId = $inf['panelId'];
		    $showId = $inf['showId'];
		    $measurement = $inf['measurement'];
		    $width = $inf['width'];
		    $height = $inf['height'];
		    $medium = $inf['medium'];
		    $notes = $inf['notes'];
		    $file = $inf['file'];
		    $title = $inf['title'];
		    $date = $inf['date'];
		    $sold = $inf['sold'];
		    
		    $soldYes = ($sold == 'yes') ? ' selected ' : '';
		    $soldNo = ($sold == 'no') ? ' selected ' : '';
		    
		    print '<form method="post" action="editPhotoInfoProcess.php"><input type="hidden" name="panelId" value="'.$panelId.'" /><input type="hidden" name="artistId" value="'.$artistId.'" /><tr><td style="background-color:#c0c0c0;" valign="top" align="center"><img src="../gallery/'.$artistDir.'/t_'.$file.'" style="border: 2px white solid;" /></td><td style="background-color:#c0c0c0;" valign="top" align="right"><input type="submit" value="change info for `'.$title.'`" /><br /><input type="button" value="DELETE `'.$title.'`"  onclick="deleteImage('.$panelId.')" /></td></tr>';    
		    
		    print '<tr><td align="right" valign="top"> Title:</td><td><input type="text" name="title" value="'.$title.'" /></td></tr>';
		    print '<tr><td align="right" valign="top"> Height:</td><td><input type="text" name="height" value="'.$height.'" /></td></tr>';
		    print '<tr><td align="right" valign="top"> Width:</td><td><input type="text" name="width" value="'.$width.'" /></td></tr>';
		
		    print '<tr><td align="right" valign="top"> Medium:</td><td><input type="text" name="medium" value="'.$medium.'" /></td></tr>';
		    print '<tr><td align="right" valign="top"> Date:</td><td><input type="text" name="date" value="'.$date.'" /></td></tr>';
		    print '<tr><td align="right" valign="top"> Sold</td><td><select name="sold"><option value="no" '.$soldNo.'>no</option><option value="yes" '.$soldYes.'>yes</option></select></td></tr>';
		    print '<tr><td colspan="2" style="height:10px; background-color:#a0a0a0;"></td></tr>';
		    
		    print '<input type="hidden" name="measurement" value="'.$measurement.'" />';
		    print '<input type="hidden" name="notes" value="'.$notes.'" />';
		    
		    print '</form>';
		  }
  }
else
  {
    print "there are no photos for this artist.";	
  }
  
?>


</table>

</body>
</html>