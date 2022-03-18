<?php
/**
 * vpTheme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package vpthemes
 * @since 1.0.0
 */

/**
 * Define Constants
 */
define( 'CHILD_THEME_VERSION', '1.0.0' );

/**
 * Enqueue styles
 */
add_action( 'wp_enqueue_scripts', 'child_enqueue_styles', 15 );
function child_enqueue_styles() {
	wp_enqueue_style( 'theme-css', get_stylesheet_directory_uri() . '/style.css', array('astra-theme-css'), CHILD_THEME_VERSION, 'all' );
}

/**
 * Front End Enqueue scripts
 */
add_action( 'wp_enqueue_scripts', 'load_custom_wp_style_script', 99 );
function load_custom_wp_style_script() { 
	wp_register_style( 'bootstrap-grid', get_stylesheet_directory_uri() . '/assets/css/bootstrap-grid.min.css');
	// wp_enqueue_style( 'bootstrap-grid' ); // enable this if you need Boostrap

	wp_enqueue_script( 'header-script', get_stylesheet_directory_uri() . '/assets/js/header-script.js', array('jquery'), null, false );
	wp_enqueue_script( 'footer-script', get_stylesheet_directory_uri() . '/assets/js/footer-script.js', array('jquery'), null, true );

	wp_enqueue_style( 'custom-font-css', get_stylesheet_directory_uri() . '/assets/css/fonts.css');
	wp_enqueue_style( 'dev-style-css', get_stylesheet_directory_uri() . '/assets/css/style.css');
	wp_enqueue_style( 'responsive-css', get_stylesheet_directory_uri() . '/assets/css/responsive.css');
}

/**
 * WP Backend Enqueue scripts
 */
add_action( 'admin_enqueue_scripts', 'load_custom_wp_admin_style' );
function load_custom_wp_admin_style() { 
	$current_user = wp_get_current_user();
	$dev_usernames = array( 
		"vpthemes",
	) ;

	wp_register_style( 'custom_wp_admin_css', get_stylesheet_directory_uri() . '/assets/css/admin-style.css');
	wp_enqueue_style( 'font-css', get_stylesheet_directory_uri() . '/assets/css/fonts.css'); // custom font css

	if( ! in_array( $current_user->user_login, $dev_usernames ) ) {
		wp_enqueue_style( 'custom_wp_admin_css' );
	}
}

/**
 * Place all custom codes that you want to show in <head> tag
 */
add_action('wp_head', 'custom_js_script' );
add_action('admin_head', 'custom_js_script' );
function custom_js_script() { 
	ob_start(); ?>

	<?php
	echo ob_get_clean();
}

/**
 * Custom style that connected in Customizer
 */
add_action('wp_head', 'custom_style' );
function custom_style() { 
	ob_start(); 
	$default_color = astra_get_option('theme-color'); 
	?>
	<style>
	</style>
	<?php 
	echo ob_get_clean();
}

/**
 * Remove Admin option in the sidebar
 */
add_action( 'admin_init', 'custom_menu_page_removing' );
function custom_menu_page_removing() {
	$dev_usernames = array( 
		"vpthemes",
	) ;
	$current_user = wp_get_current_user();

	if( ! in_array( $current_user->user_login, $dev_usernames ) ) {
		//remove_menu_page('elementor_library'); 
		remove_menu_page('toolset-dashboard');
		remove_menu_page('magic-liquidizer-page-lite');  
		remove_menu_page('pa-settings-page'); 
		remove_menu_page('livemesh_el_addons'); 
		remove_menu_page('custom-css-js');
	}
}

/**
* Remove Rev Slider Metabox
*/
add_action( 'do_meta_boxes', 'remove_revolution_slider_meta_boxes' );
function remove_revolution_slider_meta_boxes() {
	remove_meta_box( 'mymetabox_revslider_0', 'page', 'normal' );
	remove_meta_box( 'mymetabox_revslider_0', 'post', 'normal' );
	remove_meta_box( 'mymetabox_revslider_0', 'slider', 'normal' );
}

/**
* Enable SVG in the site
*/
add_filter('upload_mimes', 'cc_mime_types');
function cc_mime_types($mimes) {
	$mimes['svg'] = 'image/svg+xml';
	return $mimes;
}

/**
 * White Label
 */
add_filter('gettext', 'menu_item_text');
add_filter('ngettext', 'menu_item_text');
function menu_item_text( $menu ) {
	$menu = str_ireplace( 'Elementor', 'VPTheme Builder', $menu );
	return $menu;
}

/**
* Includes File
*/
require_once( get_stylesheet_directory(). '/includes/override-mobile-menu.php' );
require_once( get_stylesheet_directory(). '/includes/shortcode-functions.php' );

add_filter( 'define_wrapping_div_id', 'modify_wrapping_div' );

function modify_wrapping_div() {
	return 'another-id';
}

//  
// CUSTOM CODEs
// 
add_action('after_setup_theme', 'remove_admin_bar');
function remove_admin_bar() {
	if (!current_user_can('administrator') && !is_admin()) {
	  show_admin_bar(false);
	}
}