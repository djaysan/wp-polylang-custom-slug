<?php
/**
Plugin Name: WP Polylang Custom Slug
Plugin URI: https://github.com/kishankotharri/wp-polylang-custom-slug/
Description: WP Polylang Custom Slug
Author: Kishan Kothari
Author URI: https://www.linkedin.com/in/kishankothari/
Text Domain: wp-polylang-custom-slug
Domain Path: /languages
Version: 1.0.0
Since: 1.0.0
Requires WordPress Version at least: 5.6
Copyright: 2021 Kishan Kothari
License: GNU General Public License v3.0
License URI: http://www.gnu.org/licenses/gpl-3.0.html
**/

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {	
	exit;
}

add_action( 'admin_notices', 'pre_check_before_installing_polylang' );
include_once(ABSPATH.'wp-admin/includes/plugin.php');
function pre_check_before_installing_polylang() 
{
	if ( !is_plugin_active( 'polylang/polylang.php') ) 
	{
		global $pagenow;
    	if( $pagenow == 'plugins.php' )
    	{
           echo '<div id="error" class="error notice is-dismissible"><p>';
           echo __( 'Polylang is require to use WP Polylang Custom Slug' , 'wp-polylang-custom-slug');
           echo '</p></div>';	
    	}
    	return true;
	}
}

/**
 * WP_Polylang_Custom_Slug class.
 */
class WP_Polylang_Custom_Slug 
{
	/**
	 * The single instance of the class.
	 *
	 * @var self
	 * @since  1.0.0
	 */
	private static $_instance = null;

	/**
	 * Main WP_Polylang_Custom_Slug Instance.
	 *
	 * Ensures only one instance of WP_Polylang_Custom_Slug is loaded or can be loaded.
	 *
	 * @since  1.0.0
	 * @static
	 * @see WP_Polylang_Custom_Slug()
	 * @return self Main instance.
	 */
	public static function instance() 
	{
		if ( is_null( self::$_instance ) ) 
		{
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	/**
	 * Constructor - get the plugin hooked in and ready
	 */
	public function __construct() 
	{
		include_once 'includes/wp-polylang-custom-slug-post.php';
	}
	
}

$GLOBALS['wp-polylang-custom-slug'] =  WP_Polylang_Custom_Slug::instance();
