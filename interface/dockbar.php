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

<link rel="stylesheet" type="text/css" href="css/body.css" />
<link rel="stylesheet" type="text/css" href="css/dockbar.css" />

<style type="text/css">
	
BODY
  {
    background-image: url('assets/dock_backer.jpg');
    background-position: top right;
    background-repeat: no-repeat;
    background-color: #000000;
  }	
	
#imageInfo
  {
    width: 100%;
    height: 100%;
    color: #000000;
    font-size: 12px;
    text-align: center;
    font-family: Tahoma, Verdana, Arial;
    font-weight: bold;
  }

#Logo
  {
    position: absolute;
    left: 304px;
    top: 48px;
	}
	
</style>

<script type="text/javascript" src="List.js"></script>
<script type="text/javascript" src="dockListDefs.js"></script>
<script type="text/javascript" src="../scripts/phpSerializer.js"></script>

<script type="text/javascript">

<?php

include("fetchCollectionsArray.php");

?>

function setDockbar(cIndex)
  {
  	top.interfaceStarted = false;
  	
  	// cIndex == artistId;
  	
  	var collIndex = cIndex || 0;
  	top.currentCollectionIndex = collIndex;
  	
    $DOCK = new $List(_DOCK);
    
  	var artistInfo = collections[cIndex];
  	
  	var firstName = artistInfo['firstName'];
  	var middleName = artistInfo['middleName'];
  	var lastName = artistInfo['lastName'];
  	var directory = '../gallery/' + cIndex + '/';
  	
  	
  	$totalImages = 0;
  	for(i=0; i < artistInfo.images.length; i++)
		  {
		  	var iRef = directory + artistInfo['images'][i]['thumbFile'];
		    $DOCK.append(iRef,'');
		    ++$totalImages;
		  }
	   
    parent.sizeDockbar((_DOCK.minSize * ($totalImages-1)) + _DOCK.maxSize);
	   
	  $DOCK.draw();
	  
		top.currentCollection = collections;
	  
	  parent.registerDockLoad($DOCK);
  }

function init()
  {
    setDockbar(top.currentCollectionIndex);
  }

</script>

</head>

<body onload="init()">

<div id="imageInfo"></div>


</body>
</html>