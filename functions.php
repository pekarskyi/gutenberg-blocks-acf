<?php
/**
 * Enqueue child styles.
 */
function child_enqueue_styles() {
	wp_enqueue_style( 'child-theme', get_stylesheet_directory_uri() . '/style.css', array(), 100 );
}

// add_action( 'wp_enqueue_scripts', 'child_enqueue_styles' ); // Remove the // from the beginning of this line if you want the child theme style.css file to load on the front end of your site.

/**
 * Add custom functions here
 */

 //#PHP:Custom category block
 function register_layout_category( $categories ) {
 $categories[] = array(
 'slug' => 'inwebpress',
 'title' => 'InwebPress Blocks'
 );
 return $categories;
 }

 if ( version_compare( get_bloginfo( 'version' ), '5.8', '>=' ) ) {
 add_filter( 'block_categories_all', 'register_layout_category' );
 } else {
 add_filter( 'block_categories', 'register_layout_category' );
 }

//#CODE:Rating_frontend
 require_once ABSPATH .'wp-admin/includes/template.php';
 add_action('wp_enqueue_scripts', function(){ wp_enqueue_style('dashicons'); });

//#CODE:register_acf_blocks
 add_action( 'init', 'register_acf_blocks' );
 function register_acf_blocks() {
 register_block_type( __DIR__ . '/blocks/testimonial' );
 }

//#CODE:wp_enqueue
//  function custom_scripts_and_styles() {
//  wp_enqueue_style( 'custom-style', get_stylesheet_directory_uri() . '/blocks/testimonial/testimonial.css', array());
//  wp_enqueue_script( 'custom-script', get_stylesheet_directory_uri() . '/blocks/testimonial/moretext.js');
//  }
//  add_action( 'wp_enqueue_scripts', 'custom_scripts_and_styles' );

//#CODE:ACF_Field_Unique_ID
 require_once get_stylesheet_directory() . '/inc/ACF_Field_Unique_ID.php';
PhilipNewcomer\ACF_Unique_ID_Field\ACF_Field_Unique_ID::init();