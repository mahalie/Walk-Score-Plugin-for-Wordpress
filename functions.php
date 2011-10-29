<?php
/*****************
 * Outputs Walk Score Neighborhood Map details
   such as width, height and embed code. 
*/
function wspi_map_info($orientation='h', $size='m') {

$map_code = $orientation.$size;

$wspi_map_options = array(
    "vs" => array(
      "w" => 500,
      "h" => 500,
      "embed" => "<script type='text/javascript'>
var ws_wsid = '%ws_id%';
var ws_address = \"%address%\";var ws_width = '500';var ws_height = '500';var ws_layout = 'vertical';var ws_transit_score = 'true';
var ws_commute = 'true';
var ws_map_modules = 'all';
</script><style type='text/css'>#ws-walkscore-tile{position:relative;text-align:left}#ws-walkscore-tile *{float:none;}#ws-footer a,#ws-footer a:link{font:11px/14px Verdana,Arial,Helvetica,sans-serif;margin-right:6px;white-space:nowrap;padding:0;color:#000;font-weight:bold;text-decoration:none}#ws-footer a:hover{color:#777;text-decoration:none}#ws-footer a:active{color:#b14900}</style><div id='ws-walkscore-tile'><div id='ws-footer' style='position:absolute;top:482px;left:3px;width:494px'><form id='ws-form'><a id='ws-a' href='http://www.walkscore.com/' target='_blank'>What's Your Walk Score?</a><input type='text' id='ws-street' style='position:absolute;top:0px;left:170px;width:292px' /><input type='image' id='ws-go' src='http://cdn.walkscore.com/images/tile/go-button.gif' height='15' width='22' border='0' alt='get my Walk Score' style='position:absolute;top:0px;right:0px' /></form></div></div><script type='text/javascript' src='http://www.walkscore.com/tile/show-walkscore-tile.php'></script>"),
    "vm" => array(
      "w" => 600,
      "h" => 600,
      "embed" => "<script type='text/javascript'>
var ws_wsid = '%ws_id%';
var ws_address = \"%address%\";var ws_width = '600';var ws_height = '600';var ws_layout = 'vertical';var ws_transit_score = 'true';
var ws_commute = 'true';
var ws_map_modules = 'all';
</script><style type='text/css'>#ws-walkscore-tile{position:relative;text-align:left}#ws-walkscore-tile *{float:none;}#ws-footer a,#ws-footer a:link{font:11px/14px Verdana,Arial,Helvetica,sans-serif;margin-right:6px;white-space:nowrap;padding:0;color:#000;font-weight:bold;text-decoration:none}#ws-footer a:hover{color:#777;text-decoration:none}#ws-footer a:active{color:#b14900}</style><div id='ws-walkscore-tile'><div id='ws-footer' style='position:absolute;top:582px;left:3px;width:594px'><form id='ws-form'><a id='ws-a' href='http://www.walkscore.com/' target='_blank'>What's Your Walk Score?</a><input type='text' id='ws-street' style='position:absolute;top:0px;left:170px;width:392px' /><input type='image' id='ws-go' src='http://cdn.walkscore.com/images/tile/go-button.gif' height='15' width='22' border='0' alt='get my Walk Score' style='position:absolute;top:0px;right:0px' /></form></div></div><script type='text/javascript' src='http://www.walkscore.com/tile/show-walkscore-tile.php'></script>"),
    "vl" => array(
      "w" => 700,
      "h" => 700,
      "embed" => "<script type='text/javascript'>
var ws_wsid = '%ws_id%';
var ws_address = \"%address%\";var ws_width = '700';var ws_height = '700';var ws_layout = 'vertical';var ws_transit_score = 'true';
var ws_commute = 'true';
var ws_map_modules = 'all';
</script><style type='text/css'>#ws-walkscore-tile{position:relative;text-align:left}#ws-walkscore-tile *{float:none;}#ws-footer a,#ws-footer a:link{font:11px/14px Verdana,Arial,Helvetica,sans-serif;margin-right:6px;white-space:nowrap;padding:0;color:#000;font-weight:bold;text-decoration:none}#ws-footer a:hover{color:#777;text-decoration:none}#ws-footer a:active{color:#b14900}</style><div id='ws-walkscore-tile'><div id='ws-footer' style='position:absolute;top:682px;left:3px;width:694px'><form id='ws-form'><a id='ws-a' href='http://www.walkscore.com/' target='_blank'>What's Your Walk Score?</a><input type='text' id='ws-street' style='position:absolute;top:0px;left:170px;width:492px' /><input type='image' id='ws-go' src='http://cdn.walkscore.com/images/tile/go-button.gif' height='15' width='22' border='0' alt='get my Walk Score' style='position:absolute;top:0px;right:0px' /></form></div></div><script type='text/javascript' src='http://www.walkscore.com/tile/show-walkscore-tile.php'></script>"),
    "hs" => array(
      "w" => 500,
      "h" => 300,
      "embed" => "<script type='text/javascript'>
var ws_wsid = '%ws_id%';
var ws_address = \"%address%\";var ws_width = '500';var ws_height = '300';var ws_layout = 'horizontal';var ws_transit_score = 'true';
var ws_commute = 'true';
var ws_map_modules = 'all';
</script><style type='text/css'>#ws-walkscore-tile{position:relative;text-align:left}#ws-walkscore-tile *{float:none;}#ws-footer a,#ws-footer a:link{font:11px/14px Verdana,Arial,Helvetica,sans-serif;margin-right:6px;white-space:nowrap;padding:0;color:#000;font-weight:bold;text-decoration:none}#ws-footer a:hover{color:#777;text-decoration:none}#ws-footer a:active{color:#b14900}</style><div id='ws-walkscore-tile'><div id='ws-footer' style='position:absolute;top:282px;left:8px;width:488px'><form id='ws-form'><a id='ws-a' href='http://www.walkscore.com/' target='_blank'>What's Your Walk Score?</a><input type='text' id='ws-street' style='position:absolute;top:0px;left:170px;width:286px' /><input type='image' id='ws-go' src='http://cdn.walkscore.com/images/tile/go-button.gif' height='15' width='22' border='0' alt='get my Walk Score' style='position:absolute;top:0px;right:0px' /></form></div></div><script type='text/javascript' src='http://www.walkscore.com/tile/show-walkscore-tile.php'></script>"),     
    "hm" => array(
      "w" => 600,
      "h" => 460,
      "embed" => "<script type='text/javascript'>
var ws_wsid = '%ws_id%';
var ws_address = \"%address%\";var ws_width = '600';var ws_height = '460';var ws_layout = 'horizontal';var ws_transit_score = 'true';
var ws_commute = 'true';
var ws_map_modules = 'all';
</script><style type='text/css'>#ws-walkscore-tile{position:relative;text-align:left}#ws-walkscore-tile *{float:none;}#ws-footer a,#ws-footer a:link{font:11px/14px Verdana,Arial,Helvetica,sans-serif;margin-right:6px;white-space:nowrap;padding:0;color:#000;font-weight:bold;text-decoration:none}#ws-footer a:hover{color:#777;text-decoration:none}#ws-footer a:active{color:#b14900}</style><div id='ws-walkscore-tile'><div id='ws-footer' style='position:absolute;top:442px;left:8px;width:588px'><form id='ws-form'><a id='ws-a' href='http://www.walkscore.com/' target='_blank'>What's Your Walk Score?</a><input type='text' id='ws-street' style='position:absolute;top:0px;left:170px;width:386px' /><input type='image' id='ws-go' src='http://cdn.walkscore.com/images/tile/go-button.gif' height='15' width='22' border='0' alt='get my Walk Score' style='position:absolute;top:0px;right:0px' /></form></div></div><script type='text/javascript' src='http://www.walkscore.com/tile/show-walkscore-tile.php'></script>"), 
    "hl" => array(
      "w" => 700,
      "h" => 540,
      "embed" => "<script type='text/javascript'>
var ws_wsid = '%ws_id%';
var ws_address = \"%address%\";var ws_width = '700';var ws_height = '540';var ws_layout = 'horizontal';var ws_transit_score = 'true';
var ws_commute = 'true';
var ws_map_modules = 'all';
</script><style type='text/css'>#ws-walkscore-tile{position:relative;text-align:left}#ws-walkscore-tile *{float:none;}#ws-footer a,#ws-footer a:link{font:11px/14px Verdana,Arial,Helvetica,sans-serif;margin-right:6px;white-space:nowrap;padding:0;color:#000;font-weight:bold;text-decoration:none}#ws-footer a:hover{color:#777;text-decoration:none}#ws-footer a:active{color:#b14900}</style><div id='ws-walkscore-tile'><div id='ws-footer' style='position:absolute;top:522px;left:8px;width:688px'><form id='ws-form'><a id='ws-a' href='http://www.walkscore.com/' target='_blank'>What's Your Walk Score?</a><input type='text' id='ws-street' style='position:absolute;top:0px;left:170px;width:486px' /><input type='image' id='ws-go' src='http://cdn.walkscore.com/images/tile/go-button.gif' height='15' width='22' border='0' alt='get my Walk Score' style='position:absolute;top:0px;right:0px' /></form></div></div><script type='text/javascript' src='http://www.walkscore.com/tile/show-walkscore-tile.php'></script>")        
  );
  
  return $wspi_map_options[$map_code];
}
  
function wspi_filter_map($map_embed_code, $address, $ws_id) {
  //
	$find = array("%ws_id%","%address%");
	$replace  = array($ws_id,$address);
	
	$output = str_replace( $find,$replace, $map_embed_code);

  return $output;
}

function scrub_address($some_string) {
//only allow alphanumeric plus a few characters
//as would be found in addresses 
//(disallows $, %, ", and other dangerous stuff)

$pattern = "/[^a-zA-Z0-9\.\,\-\'\.\ ]/";
$scrubbed = preg_replace($pattern,'',$some_string);

	return $scrubbed;	

}

?>