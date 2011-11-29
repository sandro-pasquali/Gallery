<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">	

  <style type="text/css">
  	
  HTML
    {
      width: 100%;
      margin: 0px;
      padding: 0px;
      border: 0px;
    }  	
  	
  BODY
    {
      margin: 0px;
      padding: 0px;
      border: 0px;
      overflow: hidden;
    }
  	
  </style>

	<!-- STEP 1: Include the Editor js file -->
	<script language=JavaScript src='richText/scripts/innovaeditor.js'></script>
	<script language=JavaScript src='datePicker.js'></script>
	
<script type="text/javascript">
	
var pickADate = null;
	
function init()
  {
		pickADate = new calendar1(document.forms['Form1'].elements['date']);
		pickADate.year_scroll = false;
    pickADate.time_comp = false;
  }	

</script>	
	
</head>
<body onload="init()">

<?php

include("head.php");
include("../includes/dbaseConnector.php");

?>

<form name="Form1" method="post" action="showInfoProcess.php" id="Form1">

	<textarea id="txtContent" name="txtContent" rows="4" cols="30">
		
<?php

if(isset($_GET['showId']))
  {
  	$showId = $_GET['showId'];
  	$q = "select * from shows where showId = $showId";
  	$s = mysql_query($q);
  	$r = mysql_fetch_assoc($s);
  	
  	if($r)
  	  {
        $title = $r['title'];  
        $date = $r['date'];    
        $description = $r['description']; 
  	  }
  	else
  	  {
  	  	print "strange request, unknown content pointer. quitting.";
  	  	exit;
  	  }
  	  
  	print $description;
  }
else
  {
  	$showId = '';
    $title = '';  
    $date = '';    
    $description = ''; 
    
    print "Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Mauris elit sapien, molestie et, semper tincidunt, auctor ut, est. Pellentesque iaculis metus. Vestibulum eget ligula a lorem dapibus rhoncus. In cursus hendrerit libero. Ut ligula lectus, feugiat vitae, aliquet lacinia, pretium convallis, nulla. Quisque sed lorem. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Aenean risus. Duis vitae ligula. Aenean ullamcorper placerat purus. Proin justo elit, iaculis vehicula, faucibus eu, viverra in, tellus. Nam vehicula, ante vitae molestie lobortis, urna dolor rhoncus quam, sed condimentum eros diam tincidunt felis. Donec turpis.";
  }
?>

	
</textarea>

<table cellpadding="4" cellspacing="0" border="0">

<tr><td align="right">Title:</td><td><input type="text" name="title" size="20" value="<?php print $title; ?>" /></td><td align="right">Date:</td><td><input type="text" name="date" size="20" value="<?php print $date; ?>" ><a href="javascript:pickADate.popup();"><img src="images/cal.gif" width="16" height="16" border="0" alt="click for start date"></a></td></tr>

</table>

	<script>
		var oEdit1 = new InnovaEditor("oEdit1");
	
		
		/***************************************************
			SETTING EDITOR DIMENSION (WIDTH x HEIGHT)
		***************************************************/
		
		oEdit1.width='100%';
		oEdit1.height='80%';


		/***************************************************
			SHOWING DISABLED BUTTONS
		***************************************************/

		oEdit1.btnSave = true;
	  oEdit1.btnFullScreen = false;
	  oEdit1.btnPreview = true;
	  oEdit1.btnPrint = true;
	  oEdit1.btnSearch = true;
	  oEdit1.btnSpellCheck = false;
	  
	  oEdit1.btnTextFormatting = true;
	  oEdit1.btnBoxFormatting = true;
	  oEdit1.btnParagraphFormatting = true;
	  oEdit1.btnCssText = true;

	  oEdit1.btnParagraphFormatting = true;
	  oEdit1.btnListFormatting = true;
	  oEdit1.btnBoxFormatting = true;

    oEdit1.btnCut = true;
	  oEdit1.btnCopy = true;
	  oEdit1.btnPaste = true;
	  oEdit1.btnPasteWord = true;
	  oEdit1.btnPasteText = true;
	  oEdit1.btnUndo = true;
	  oEdit1.btnRedo = true;
	  oEdit1.btnForeColor = true;
	  oEdit1.btnBackColor = true;
	  oEdit1.btnBookmark = false;
	  oEdit1.btnHyperlink = true;
 
 	  oEdit1.btnImage = true;
	  oEdit1.btnFlash = false;
	  oEdit1.btnMedia = false;
 
 	  oEdit1.btnTable = true;
 
	  oEdit1.btnGuidelines = true;
	  oEdit1.btnAbsolute = false;
	  oEdit1.btnCharacters = true;
	  oEdit1.btnLine = true;
	  oEdit1.btnForm = false;
	  oEdit1.btnRemoveFormat = true;


	  oEdit1.btnClearAll = true;
	  oEdit1.btnStyles = true;
	  oEdit1.btnParagraph = true;
	  oEdit1.btnFontName = true;
	  oEdit1.btnFontSize = true;
	  oEdit1.btnBold = true;
	  oEdit1.btnItalic = true;
	  oEdit1.btnUnderline = true;
	  oEdit1.btnStrikethrough = true;
	  oEdit1.btnSuperscript = true;
	  oEdit1.btnSubscript = true;
	  oEdit1.btnJustifyLeft = true;
	  oEdit1.btnJustifyCenter = true;
	  oEdit1.btnJustifyRight = true;
	  oEdit1.btnJustifyFull = true;
	  oEdit1.btnNumbering = true;
	  oEdit1.btnBullets = true;
	  oEdit1.btnIndent = true;
	  oEdit1.btnOutdent = true;
	  oEdit1.btnLTR = false;
	  oEdit1.btnRTL = false;

		/***************************************************
			APPLYING STYLESHEET 
			(Using external css file)
		***************************************************/
		
		//oEdit1.css="style/test.css"; 
		oEdit1.css="showInfoStyle.css";


		/***************************************************
			ENABLE ASSET MANAGER ADD-ON
		***************************************************/

		//oEdit1.cmdAssetManager = "modalDialogShow('/Editor/assetmanager/assetmanager.php',640,465)"; //Command to open the Asset Manager add-on.
		//Use relative to root path (starts with "/")
		
		/***************************************************
			ADDING YOUR CUSTOM LINK LOOKUP
		***************************************************/
		
		//oEdit1.cmdInternalLink = "modelessDialogShow('links.htm',365,270)"; //Command to open your custom link lookup page.

		/***************************************************
			ADDING YOUR CUSTOM CONTENT LOOKUP
		***************************************************/
		
		//oEdit1.cmdCustomObject = "modelessDialogShow('objects.htm',365,270)"; //Command to open your custom content lookup page.

		/***************************************************
			USING CUSTOM TAG INSERTION FEATURE
		***************************************************/
/*
		oEdit1.arrCustomTag=[["First Name","{%first_name%}"],
				["Last Name","{%last_name%}"],
				["Email","{%email%}"]];//Define custom tag selection
*/
		/***************************************************
			SETTING COLOR PICKER's CUSTOM COLOR SELECTION
		***************************************************/
		
		//oEdit1.customColors=["#ff4500","#ffa500","#808000","#4682b4","#1e90ff","#9400d3","#ff1493","#a9a9a9"];//predefined custom colors

		/***************************************************
			SETTING EDITING MODE
			
			Possible values: 
				- "HTMLBody" (default) 
				- "XHTMLBody" 
				- "HTML" 
				- "XHTML"
		***************************************************/
		
    oEdit1.mode="XHTMLBody";
    
    oEdit1.useTagSelector=false;
    
		oEdit1.REPLACE("txtContent");

	</script>


<?php

print '<input type="hidden" name="showId" value="'.$showId.'" />';


?>

</form>
<pre>
	
	
	
	
</pre>
</body>
</html>