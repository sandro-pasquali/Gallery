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

<link rel="stylesheet" type="text/css" href="../css/editStyle.css" />

<script type="text/javascript"></script>

</head>

<body>

<div style="width: 468px; margin-left:auto; margin-right:auto;">
	
<?

session_start();

if($_POST['title'] && $_POST['date'] && $_POST['txtContent'])
  {
  	$_SESSION['showId'] = $_POST['showId'];
		$_SESSION['title'] = $_POST['title'];
		$_SESSION['date'] = $_POST['date'];
		$_SESSION['description'] = $_POST['txtContent'];
  }
else
  {
  	print '<a href="javascript:history.go(-1)">information missing. click here to go back.</a>';
  	exit;
  }

print "Title: <b>".$_SESSION['title']."</b><BR>";
print "Date: <b>".$_SESSION['date']."</b><BR>";

print '<br /><hr noshade width="100%" /><br />';

if(isset($_POST["txtContent"])) 
	{
	$sContent=stripslashes($_POST['txtContent']); /*** remove (/) slashes ***/		
	echo $sContent;
	}
?>

</div>

<form method="post" action="showInfoConfirm.php">
	
<textarea name="description" style="position:absolute; width:0px; height:0px; border:0px; margin:0px; padding:0px;">

<?php

	$sContent=stripslashes($_POST['txtContent']); /*** remove (/) slashes ***/		
	echo $sContent;

?>

</textarea>	
	
<input type="submit" value="confirm changes" />	&nbsp;&nbsp; <input type="button" onclick="history.go(-1);" value="no good ... go back" />
	
</form>

</body>
</html>