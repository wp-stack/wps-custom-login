<?php
/**
 * Plugin Name:         WPS Custom Login
 * Plugin URI:          https://github.com/wp-stack/wps-custom-login
 * Description:         Customize your wp-login.php page with project logo and title
 * Author:              Pierre Dargham, Matthieu Guerry, Globalis Media Systems
 * Author URI:          https://www.globalis-ms.com
 *
 * Version:             1.0.0
 * Requires at least:   4.0.0
 * Tested up to:        4.4.2
 */

// Block direct requests
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

if ( ! class_exists( 'WPS_CUSTOM_LOGIN' ) ) {

	/**
	 * Main class of the plugin
	 */
	class WPS_CUSTOM_LOGIN {

		const VERSION = '1.0.0';

		/**
		 * Register hooks used by the plugin
		 */
		public static function hooks() {
			add_action( 'init', array( __CLASS__, 'init' ) );
			add_action( 'login_head', array( __CLASS__, 'custom_login_css' ), 10 );
			add_filter( 'login_headerurl', array( __CLASS__, 'custom_login_header_url' ), 10, 1 );
			add_filter( 'login_headertitle', array( __CLASS__, 'custom_login_header_title' ), 10, 1 );
		}

		/**
		 * Custom Login CSS
		 */
		public static function custom_login_css() {
			$logo_url = get_stylesheet_directory_uri() . '/logo.png';
			$logo_path = get_stylesheet_directory() . '/logo.png';

			if( file_exists( $logo_path ) ) {
				$output .= '<style>.login h1 a {
					background-image: url(' . $logo_url . ');
				  	background-position: center top;
				  	background-repeat: no-repeat;
				  	background-size: auto;
				  	color: #999;
				  	font-size: 20px;
				  	font-weight: normal;
				  	line-height: 1.3em;
				  	margin: 0 auto 10px;
				  	padding: 0;
				  	text-decoration: none;
				  	text-indent: -9999px;
				  	outline: none;
				  	overflow: hidden;
				  	display: block;
				  	width: auto;
				  	min-height: 84px;
				}
				</style>';
			}

			echo apply_filters( 'wps_custom_login_css', $output );
		}

		/**
		 * Custom Login Header URL
		 */
		public static function custom_login_header_url( $url ) {
			return esc_url( home_url( '/' ) );
		}

		/**
		 * Custom Login Header Title
		 */
		public static function custom_login_header_title( $title ) {
			return get_bloginfo( 'name' );
		}
	}

	WPS_CUSTOM_LOGIN::hooks();
}