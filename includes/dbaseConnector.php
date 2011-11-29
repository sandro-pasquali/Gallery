<?php

$link = mysql_connect("localhost", "root",'password')
   or die("Could not connect : " . mysql_error());

mysql_select_db("gallery",$link) or die("Could not select database");

?>