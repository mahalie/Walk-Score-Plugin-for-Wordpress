<?php
/* 
Plugin Name: Walk Score
Plugin URI: http://www.walkscore.com/professional/word-press.php
Description:Provides simple shortcodes to embed <a href="http://www.walkscore.com/professional/neighborhood-map.php?utm_source=wspi"><strong>Walk Score Neighborhood Maps</strong></a> in your posts and pages. To use: 1. Click "Activate" to enable this plugin, 2. <a href="http://www.walkscore.com/professional/sign-up.php?utm_source=wspi">Sign up for a Walk Score ID</a> (free or premium), 3. Get the Walk Score ID from your email and save it in your Settings &gt; <a href="options-general.php?page=walk-score">Walk Score Options</a>, and 4. Use <a href="http://wordpress.org/extend/plugins/walk-score/installation/">the shortcode</a> to embed neighborhood maps in your posts!
Version: 0.5.5
Author: Walk Score
Author URI: http://www.walkscore.com/
License: GPL2
*/

/*  Copyright 2011  Front Seat  (email : mahalie@walkscore.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

/* USAGE
	Shortcodes:
		[walk-score-map]
*/

define('WSPI_PLUGIN_DIR', WP_PLUGIN_DIR."/".dirname(plugin_basename(__FILE__)));
define('WSPI_PLUGIN_URL', WP_PLUGIN_URL."/".dirname(plugin_basename(__FILE__)));
define ('WSID_MINLENGTH', 20);
define('WSPI_VERSION','0.5.4');

require(WSPI_PLUGIN_DIR."/functions.php");

// Secure: doesn't allow to load this file directly
if( ! class_exists('WP') ) 
{
	header( 'Status: 403 Forbidden' );
	header( 'HTTP/1.1 403 Forbidden' );
	exit;
}

/**
 * Default Options
 */
  
function get_wspi_options ($default = false){

/* 
note that add_option does not have to be called if you do not want 
to use the $deprecated or $autoload parameters. */

  $wspi_default = array(
							'ws_id' => '',
							'size' => 'm', // m(medium), s(small), or l(large)
							'orientation' => 'v',	// v(vertical) or h(horizontal)
							'version' => WSPI_VERSION // use for future feature migration
							);
							
	//get user options
	$options = get_option('wspi_op');

  //check if default reset is requested
	if ($default || !isset($options)) {
	update_option('wspi_op', $wspi_default);
	return $wspi_default;
	}
	
	return $options;
}


// [walk-score-map id="ws-id" address="" size="" orientation=""]
add_shortcode( 'walk-score-map', 'walk_score_map_sc' );

function walk_score_map_sc( $atts, $content = null ) {

  //get default options
  $options = get_wspi_options();
  
  //set fallback WordPress ID, but do NOT expose in UI
  $ws_id =  $options['ws_id'];
    
  if ( strlen($ws_id) < WSID_MINLENGTH) {
      		$ws_id = '3237b59f59174541a76291922c4137df';
  } 

	$default_atts = array(
		'wsid' => $ws_id,
		'address' => null,
		'size' => $options['size'],
		'format' => $options['orientation']	
	);
	
  //get shortcode attributes
	extract( shortcode_atts( $default_atts, $atts ) );
	
	$orientation = $format;
	//check shortcode attributes
	
	if (!is_null($content) && is_null($address)) {
		//user entered enclosing tags and no address param so assume address
		$address = $content;
	}

  //possible shortcode values
  $size_opts = array('s','m','l');
  $orientation_opts = array('h','v');
  
  //strip size and orientation attributes to first character
  $size = strtolower($size[0]) ;
  $orientation = strtolower($orientation[0]);

  //make sure input is valid, use defaults if not
  if ( !in_array($size,$size_opts,true) ) {
    $size = $options['size']; 		
  }
  
    if ( !in_array($orientation,$orientation_opts,true) ) {
    $orientation = $options['orientation']; 		
  }
  
  $address = scrub_address($address);

  $map_info = wspi_map_info($orientation,$size);
  $width = $map_info['w'];
  $height = $map_info['h'];
	
	return "<iframe width='$width' height='$height' src=\"".WSPI_PLUGIN_URL."/frame-maker.php?id=$wsid&a=$address&o=$orientation&s=$size\" scrolling='no' style='overflow:hidden' frameborder='0' class='wspi'></iframe>";
}

/**
 * Settings
 */  

add_action('admin_menu', 'walk_score_menu');

function walk_score_menu() {
		$plugin_page = add_options_page('Walk Score', 'Walk Score', 'administrator', 'walk-score', 'wspi_options_page');	 	
	 }
	 
/**
 * Admin Interface
 */

function wspi_options_page() { 
	//user has access?
	if (!current_user_can('manage_options'))  {
		wp_die( __('You do not have sufficient permissions to access this page.') );
	}
	
	// Retreive existing settings 
	
	$options = get_wspi_options(); //load plugin options
	// Add check for form submission by humans
		//if( isset($_POST['ws_submit']) && $_POST['ws_submit'] == 'Y' ) {
	     //non-robot submitted admin form
	
	if(isset($_POST['Restore_Default']))	$options = get_wspi_options(true);
	
  if( isset($_POST['Update']) ){
  	//form was submitted so update options as necessary
   	$newoptions['ws_id'] = isset($_POST['ws_id'])?$_POST['ws_id']:$options['ws_id'];
  	$newoptions['size'] = isset($_POST['size'])?$_POST['size']:$options['size'];
  	$newoptions['orientation'] = isset($_POST['orientation'])?$_POST['orientation']:$options['orientation'];
  	$newoptions['version'] = WSPI_VERSION;
    
    //!compare arrays
  	if ( $options != $newoptions ) {
  		$options = $newoptions;
  		update_option('wspi_op', $options);			
  		$notices[] = "Settings updated.";  // Put an settings updated message on the screen
  	}
 	}

  // Display the settings editing screen
  screen_icon( 'options-general' );	
  echo '<div class="wrap">';
  echo "<h2>" . __( 'Walk Score Options', 'walk-score-plugin' ) . "</h2>";
  if ( isset($notices) ) {
    echo '<div class="updated">';
    foreach ($notices as $note) {
      echo '<p><strong>'._e($note, 'walk-score-plugin').'</strong></p>';
    }
    echo '</div>';
  }
  
  // Get data for form display
	$ws_id = $options['ws_id'];
	$size = $options['size'];
	$orientation = $options['orientation'];
	
  // select options for map size
  $sizes = array(
    "s" => __("Small"),
    "m" => __("Medium"),
    "l" => __("Large")                                                
  );
  
  // select options for map format
  $formats = array(
    "v" => __("Vertical"),
    "h" => __("Horizontal")                                               
  );      
	 ?>
<form method="POST" name="options" target="_self" enctype="multipart/form-data">
<input type="hidden" name="ws_form_check" value="Y" />
<h3><?php _e("Walk Score ID", 'walk-score' ); ?></h3>
<p>Register for a free Walk Score ID at <a href="http://www.walkscore.com/professional/sign-up.php?utm_source=wspi">walkscore.com</a>.<br /><small>This plugin will work with both free (ad-supported) and premium Walk Score IDs.</small></p>
<p><?php _e("Walk Score ID:", 'walk-score' ); ?> 
<input type="text" name="ws_id" value="<?php echo $ws_id; ?>" size="20" /><br />
</p>
<h3><?php _e("Default Map Size", 'walk-score' ); ?></h3>
<p>Select the default size for all of your neighborhood maps.<br />Preview size options on <a href="http://www.walkscore.com/professional/neighborhood-map.php?utm_source=wspi">Walk Score's Neighborhood Map</a> page.</p>
<p><?php _e("Map size:", 'walk-score' ); ?> 
        <select name="size" id="size">
            <?php foreach($sizes  as $size_val => $size_display){ ?>
                <option value="<?php echo $size_val ?>" <?php echo ($size_val == $size ? "selected" : "") ?> ><?php echo $size_display ?></option>
            <?php } ?>
        </select>   
</p>
<p><?php _e("Map orientation:", 'walk-score' ); ?> 
        <?php 

        ?> 
        <select name="orientation" id="orientation">
            <?php foreach($formats  as $format_val => $format_display){ ?>
                <option value="<?php echo $format_val ?>" <?php echo ($format_val == $orientation ? "selected" : "") ?> ><?php echo $format_display ?></option>
            <?php } ?>
        </select>   
</p>
    <p class="submit">
    <input type="submit" name="Update" value="Update" class="button-primary" /><input type="submit" name="Restore_Default" value="<?php _e("Restore Default") ?>" class="button" />
    </p>
</form>
  <h3 style="padding-top:30px; margin-top:20px; border-top:1px solid #CCCCCC;"><?php _e("How to Use") ?></h3>
  <div style="max-width:550px">
    <p><?php _e("To include a Walk Score Neighborhood Map in any post or page simply paste in the following shortcode:") ?></p>   
    <p><code>[walk-score-map address="ANY-ADDRESS-GOES-HERE"]</code></p>
    <p><?php _e("You'll need to replace") ?> <small>ANY-ADDRESS-GOES-HERE</small> <?php _e("with an address of your choosing. Any well-formed address should work. To make sure it will work you can test the address by entering it on Walk Score's ") ?><a href="http://www.walkscore.com/professional/neighborhood-map.php?utm_source=wspi">Neighborhood Map demo</a><?php _e(" page.") ?></p>
    <h4><?php _e("Shortcode Attributes") ?></h4>
    <ul>
      <li><code>address=""</code> - <strong><?php _e("required attribute") ?></strong>, <?php _e("enter a complete address.") ?></li>
      <li><code>size=""</code> - <?php _e("size of map, options") ?>: <code>small</code>, <code>medium</code>, <code>large</code>, <code>s</code>, <code>m</code>, <code>l</code>.</li>
      <li><code>format=""</code> - <?php _e("orientation, options") ?>: <code>vertical</code>, <code>horizontal</code>, <code>v</code>, <code>h</code>.</li>
    </ul>
    <h4><?php _e("Shortcode Examples") ?></h4>
    <p><?php _e("Display a map of the White House, USA:") ?></p>
    <p><code>[walk-score-map address="1450 Pennsylvania Avenue Northwest, Washington DC"]</code></p>
    <p><?php _e("Display a map of the Sydney Opera House in the small horizontal format (overrides default map size):") ?></p>
    <p><code>[walk-score-map address="2 Macquarie Street, Sydney NSW 2000, Australia" size="s" format="h"]</code></p>
    
    <h4><?php _e("Add to Your Theme") ?></h4>
    <p><?php _e("Advanced users can add maps anywhere in the site by customizing your theme using the built-in WordPress do_shortcode() function. Note: this will NOT work in your posts.") ?></p>
    <p><pre>echo do_shortcode('[walk-score-map address = "ANY-ADDRESS-GOES-HERE"]'); </pre></p>
  </div>
  <h3 style="padding-top:30px; margin-top:20px; border-top:1px solid #CCCCCC;"><?php _e("Feedback") ?></h3>
  <div style="max-width:550px">
    <p><?php _e("Please visit the") ?> <a href="http://getsatisfaction.com/walk_score/products/walk_score_walk_score_wordpress_plugin" target="_blank">Walk Score Plugin for WordPress <?php _e("forum") ?></a> <?php _e("on GetSatisfaction. We welcome your feedback, questions, ideas and feature requests!") ?></p>
  </div>
</div><!-- //wrap -->

<?php 
} 

?>