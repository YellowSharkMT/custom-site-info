<?php
if(!defined('ABSPATH')) exit();
/*
Plugin Name: Custom Site Info
Description: Adds site-specific reference information to the Wordpress Admin area.
Author: <a href="http://yellowsharkmt.com">YellowSharkMT</a>
*/

if(!defined('CSINFO_DIR'))
	define('CSINFO_DIR', dirname(__FILE__));
if(!defined('CSINFO_URL'))
	define('CSINFO_URL', WP_PLUGIN_URL . '/custom-site-info');

register_activation_hook(__FILE__, 'csinfo_register_plugin');
register_deactivation_hook(__FILE__, 'csinfo_unregister_plugin');

if(!function_exists('csinfo_register_plugin')):
	function csinfo_register_plugin(){
		global $wpdb;
		require_once(dirname(__FILE__) . '/inc/plugin_activate.php');
	}
endif;

if(!function_exists('csinfo_unregister_plugin')):
	function csinfo_unregister_plugin(){
		global $wpdb;
		require_once(dirname(__FILE__) . '/inc/plugin_deactivate.php');
	}
endif;

require_once(dirname(__FILE__) . '/classes/CSInfo_Loader.class.php');
new CSInfo_Loader();

?>