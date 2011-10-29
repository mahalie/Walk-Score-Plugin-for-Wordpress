<?php
/*****************
 * Builds Walk Score Neighborhood Map based on querystring params
   which allows us to isolate each map in its own iframe so we can
   display more than one map on a page. 
*/

require("functions.php");

echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US"><head><link href="walk-score.css" media="all" type="text/css" rel="stylesheet" /></head><body id="map-frame">';
//parse query strings
/*
if ( isset($_GET['id'])) {
		//!make sure input is valid
} */

$ws_id = $_GET['id'];
$address = $_GET['a'];
$orientation = $_GET['o'];
$size = $_GET['s'];

$map_info = wspi_map_info($orientation,$size);
$embed_code = wspi_filter_map($map_info['embed'],$address,$ws_id);  

echo $embed_code;

echo '</body></html>';
?>