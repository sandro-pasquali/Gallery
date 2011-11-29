<html>

<head>
<title>Untitled</title>
<meta http-equiv="Pragma" content="no-cache" />
<meta http-equiv="Expires" content="-1" />
<meta http-equiv="Content-type" content="text/html; charset=iso-8859-1" />
<meta http-equiv="Content-Language" content="en-us" />
<meta name="ROBOTS" content="ALL" />
<meta name="Copyright" content="Copyright (c) www.mothering.com" />
<meta http-equiv="imagetoolbar" content="no" />
<meta name="MSSmartTagsPreventParsing" content="true" />

	<style type="text/css"> body, html {width:100%; height:100%; padding: 0px;} </style>
<link href="GUI/runtime/styles/aqua/aw.css" rel="stylesheet" type="text/css"></link>
	<style type="text/css">
		.aw-grid-control {height: 60%; width: 100%; margin: 0px; border: none; font: menu;}
		.aw-row-selector {text-align: center}

		.aw-column-0 {width: 40px;text-align:center;}
		.aw-column-1 {width: 150px; text-align:center;}
		.aw-column-2 {width: 250px; text-align:center;}
		.aw-column-3 {width: 100px; text-align:center;}
		.aw-column-4 {width: 150px; text-align:center;}
		.aw-column-5 {width: 65px; text-align:center;}
		.aw-column-6 {width: 40px; text-align:center;}
				
		.aw-grid-cell {border-right: 1px solid threedlightshadow;}
		.aw-grid-row {border-bottom: 1px solid threedlightshadow;}
	</style>

<script type="text/javascript" src="GUI/runtime/lib/aw.js"></script>
  
<script type="text/javascript">
	
  

</script>

</head>
<body>	
	
	
<?php

include("head.php");
include("../includes/dbaseConnector.php");

$q = "select * from shows";
$r = mysql_query($q);

print '<script type="text/javascript">var myData = [';

$dOut = '';
$rowCount = 0;

while($inf = mysql_fetch_assoc($r))
  {
  	$showId = $inf['showId'];
    $title = addslashes($inf['title']);
    $date = addslashes($inf['date']);
    $description = addslashes($inf['description']);
    
	  $dOut .= "['$showId', '$title', '$date'],";
	  
	  ++$rowCount;
  }

print $dOut;

print '];';
print '</script>';


?>
		
<script type="text/javascript">
		var myColumns = [
			"id", "title", "date"
		];

	//	create ActiveWidgets Grid javascript object
	var obj = new AW.UI.Grid;

	//	define data formats
	var str = new AW.Formats.String;
	var num = new AW.Formats.Number;

	obj.setCellFormat([num, str, str]);

	//	provide cells and headers text
	obj.setCellText(myData);
	obj.setHeaderText(myColumns);

	//	set number of rows/columns
	obj.setRowCount(<?php print $rowCount; ?>);
	obj.setColumnCount(3);

	//	enable row selectors
	obj.setSelectorVisible(true);
	obj.setSelectorText(function(i){return this.getRowPosition(i)+1});

	//	set headers width/height
	obj.setSelectorWidth(28);
	obj.setHeaderHeight(20);

	//	set row selection
	obj.setSelectionMode("single-row");

	//	set click action handler
	obj.onCellClicked = function(event, col, row)
	  {
	  	//alert(col);
	  	//alert(this.getCellText(col, row));
	  	
	  	var profileID = this.getCellText(0,row);
	  	
	  	document.location.href = 'showInfoInterface.php?showId=' + profileID;
	  		
      return(true);	    
	  };

	//	write grid html to the page
	document.write(obj);

</script>

</body>
</html>
