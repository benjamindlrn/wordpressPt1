<?php
/*
Plugin Name: Simple List
Plugin URI: http://samplewp.com/
Description: A simple List Plugin
Version: 2.0
Author: Ben
Author URI: http://samplewp.com
License: GPL
*/
/*
* This calls simple_list() function when wordpress initializes.
 Note that the simple_list doesnt have brackets.*/
add_action('init','simple_list');
function simple_list()
{	
	return  "<strong>TASKS</strong><br><textarea rows='10' type='text' readonly>".get_option('simple_list_data')."</textarea>";

}

add_shortcode('tasks','simple_list');

/* Runs when plugin is activated */
register_activation_hook(__FILE__,'simple_list_install'); 

/* Runs on plugin deactivation*/
register_deactivation_hook( __FILE__, 'simple_list_remove' );

function simple_list_install() {
/* Creates new database field */
add_option("simple_list_data", 'Default', '', 'yes');
}

function simple_list_remove() {
/* Deletes the database field */
delete_option('simple_list_data');
}

if ( is_admin() ){

/* Call the html code */
add_action('admin_menu', 'simple_list_admin_menu');

function simple_list_admin_menu() {
add_options_page('Simple List', 'Simple List', 'administrator',
'simple_list', 'simple_list_html_page');
}
}
function simple_list_html_page() {
?>
<div>
<h2>Simple List Options</h2>
<form method="post" action="options.php">
<?php wp_nonce_field('update-options'); ?>
<table width="510">
<tr valign="top">
<th width="92" scope="row">Enter Tasks</th>
<td width="406">
<textarea rows="10" name="simple_list_data" type="text" id="simple_list_data"
 ><?php echo get_option('simple_list_data'); ?></textarea></td>
</tr>
</table>
<input type="hidden" name="action" value="update" />
<input type="hidden" name="page_options" value="simple_list_data" />
<p>
<input type="submit" class='button' value="<?php _e('Save List') ?>" />
</p>
</form>      
<?php
}
?>