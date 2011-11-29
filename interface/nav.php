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

<style type="text/css">
	
HTML
  {
    padding: 0px;
    margin: 0px;
    border: 0px;
	}
	
BODY
  {
    padding: 0px;
    margin: 0px;
    border: 0px;
    background-color: #000000;
  }

#navContainer
  {
    position: absolute;
    width: 100%;
    top: 3000px;
    left: 0px;
    padding-bottom: 5000px;
    
    font-family: Tahoma, Verdana, Arial;
    font-size: 10px;
    color: #f7f7f7;
    font-weight: bold;
  }

#dockbar
  {
    width: 0px;
    height: 96px;
	}

#current_collection
  {
    font-size: 10px;
    font-family: Tahoma, Verdana, Arial;
    color: #ffffff;
    padding-top: 8px;
  }
  
#navContainer #menuControl
  {
    color: #000000;
    font-family: Tahoma, Verdana, Arial;
    font-size: 10px;
    font-weight: bold;
    padding: 2px;
    background-color: #f7f7f7;
    float: left;
    cursor: pointer;
    cursor: hand;
  }
  
#navContainer #artistName
  {
    font-family: Tahoma, Verdana, Arial;
    font-size: 20px;
    font-weight: normal;
    color: #ffffff;
    float: right;
    padding: 6px;
  }
	
#navContainer #artistMenu
  {
    width: 300px;
    font-family: Tahoma, Verdana, Arial;
    font-size: 12px;
    font-weight: bold;
    color: #ffffff;
    padding: 6px;
    padding: 20px;
    cursor: pointer;
    cursor: hand;
  }	
  
#navContainer #current_panel
  {
    color: #ffffff;
    font-family: Tahoma, Verdana, Arial;
    font-size: 12px;
    padding-bottom: 2px;
  }
	
#navContainer #current_panel_info
  {
    color: #ffffff;
    font-family: Tahoma, Verdana, Arial;
    font-size: 10px;
    font-weight: normal;
    padding: 2px;
    padding-bottom: 12px;
  }
	
</style>

<script type="text/javascript" src="FrameController.js"></script>
<script type="text/javascript" src="general.js"></script>
<script type="text/javascript">
	
function set(navTop)
  {  
    var y = 3000 - navTop;	
  	ScreenControl.moveTo(0,y,25,"inout");
  };
	
function sizeDockbar(sz)
  {
  	document.getElementById('dockbar').style.width = sz.toString() + 'px';
  }
	
function registerDockLoad(d)
  {
  	top.dockRef = d;
  	parent.registerNavLoad(this);
  	
    showCurrentArtistName()
  	drawArtistMenu()
  }	
	
function drawArtistMenu()
  {
  	var c = top.currentCollection;
  	for(artistId in c)
  	  {
  	  	var i = c[artistId];
  	  	
  	    var firstName = i['firstName'];
  	    var middleName = i['middleName'];
  	    var lastName = i['lastName'];
  	    var bio = i['bio'];
  	    var imageArray = i['images'];
  	    var showArray = i['shows'];
  	    
  	    
  	    // artist list
        var aM = document.getElementById('artistMenu');
        
  	    var aLink = document.createElement('div');
  	    var aLinkT = document.createTextNode(firstName + ' ' + middleName + ' ' + lastName);
  	    aLink.setAttribute('id',artistId);
  	    aLink.style.paddingBottom = '8px';
  	    
  	    aLink.onclick = function()
  	      {
  	      	top.closeMenu();
  	      	top.currentCollectionIndex = this.getAttribute('id');
  	      	document.location.href="nav.php";
  	      }
  	      
  	    aLink.onmouseover = function()
  	      {
  	      	this.style.color = '#00FFFF';
  	      }
  	      
  	    aLink.onmouseout = function()
  	      {
  	      	this.style.color = '#ffffff';
  	      }
  	      
  	    aLink.appendChild(aLinkT);
  	    
  	    aM.appendChild(aLink);
  	  }
  }	
	
function showCurrentArtistName()
  {
  	var c = top.currentCollection[top.currentCollectionIndex];
  	
    var firstName = c['firstName'];
  	var middleName = c['middleName'];
  	var lastName = c['lastName'];
  	
  	var aName = document.getElementById('artistName');
  	var aNameText = document.createTextNode(firstName + ' ' + middleName + ' ' + lastName);
  	aName.appendChild(aNameText);
  }	
  
function showArtistBio(id)
  {
  	var c = top.currentCollection[id];
  	var bio = top.convertHTMLSpecialChars(c['bio']);
  	
    var abc = document.getElementById('artistBioContainer');
    
    if(abc.firstChild)
      {
        abc.removeChild(abc.firstChild);
  	  }
  	  
    var aBioText = document.createTextNode(bio);
    abc.appendChild(aBioText);
  }	
	
function showCurrentPanelInfo(id)
  {
  	/*
  	 * change this to read from the List
  	 */
  	var c = top.currentCollection;
  	
  	for(p in c)
  	  {
  	  	for(z in c[p]['images'])
  	  	  {
  	  	  	var it = c[p]['images'][z];
  	  	  	
  	  	  	if(it['mainFile'] == id)
  	  	  	  {
  	  	  	  	/*
  	  	  	  	 * add in panel title
  	  	  	  	 */
  	  	  	  	var cp = document.getElementById('current_panel');
  	  	  	  	var cpT = document.createTextNode(it['title']);
  	  	  	  	cp.removeChild(cp.firstChild);
  	  	  	  	cp.appendChild(cpT);
  	  	  	  	
  	  	  	  	/*
  	  	  	  	 * add in panel info
  	  	  	  	 */
  	  	  	  	var cp = document.getElementById('current_panel_info');
  	  	  	  	
  	  	  	  	var hasDate = (it['date'] != '') ? ' / ' + it['date'] : '';	  	  	  	
  	  	  	  	var isSold = (it['sold'] == 'yes') ? ' / SOLD' : '';
  	  	  	  	
  	  	  	  	var tt = it['height'] + ' x ' + it['width'] + ' ' + it['measurement'] + ' / ' + it['medium'] + hasDate + isSold;
  	  	  	  	var cpT = document.createTextNode(tt);
  	  	  	  	cp.removeChild(cp.firstChild);
  	  	  	  	cp.appendChild(cpT);
  	  	  	  	
  	  	  	  	break;
  	  	  	  }
  	  	  	
  	  	  }
  	  	
  	  }
  	
  }	
	
</script>

</head>

<body>


<div id="navContainer">
	
<center>
	
	<div id="menuControl" onclick="top.toggleMenu()">click here for more +</div>
	<div id="artistName"></div><br clear="all" />
	
	<iframe id="dockbar" src="dockbar.php" scrolling="no" allowTransparency="true" frameborder="no"></iframe>
	<div id="current_panel">-</div>
	<div id="current_panel_info">-</div>
	
	<br clear="all" />

	<div id="artistMenu"></div>

</center>

</div>


<pre>
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
</pre>
</body>
</html>