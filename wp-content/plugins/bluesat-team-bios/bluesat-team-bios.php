<?php
/*
Plugin Name: BLUEsat Team Bios
Plugin URI: http://www.bluesat.unsw.edu.au/
Description: A custom post type for creating exec profiles. Based on the cpt-bootstrap carousel plugin by Phil Ewels
Version: 1.9.1
Author: Harry J.E Day (Based on work by Phil Ewels)
Text Domain: bluesat-team-bios
License: GPLv2
*/

// Initialise - load in translations
function bstb_loadtranslations () {
	$plugin_dir = basename(dirname(__FILE__)).'/languages';
	load_plugin_textdomain( 'bluesat-team-bios', false, $plugin_dir );
}
add_action('plugins_loaded', 'bstb_loadtranslations');

////////////////////////////
// Custom Post Type Setup
////////////////////////////
add_action( 'init', 'bstb_post_type' );
function bstb_post_type() {
	$labels = array(
		'name' => __('Team Member Bio', 'bluesat-team-bios'),
		'singular_name' => __('Team Member Bio', 'bluesat-team-bios'),
		'add_new' => __('Add New', 'bluesat-team-bios'),
		'add_new_item' => __('Add New Carousel Bio', 'bluesat-team-bios'),
		'edit_item' => __('Edit Bio', 'bluesat-team-bios'),
		'new_item' => __('New Team Member Bio', 'bluesat-team-bios'),
		'view_item' => __('View Team Member Bio', 'bluesat-team-bios'),
		'search_items' => __('Search Bios', 'bluesat-team-bios'),
		'not_found' => __('No Bio Found', 'bluesat-team-bios'),
		'not_found_in_trash' => __('No Bio found in Trash', 'bluesat-team-bios'),
		'parent_item_colon' => '',
		'menu_name' => __('Team Bio', 'bluesat-team-bios')
	);
	$args = array(
		'labels' => $labels,
		'public' => true,
		'exclude_from_search' => true,
		'publicly_queryable' => false,
		'show_ui' => true, 
		'show_in_menu' => true, 
		'query_var' => true,
		'rewrite' => true,
		'capability_type' => 'page',
		'has_archive' => true, 
		'hierarchical' => false,
		'menu_position' => 21,
		'menu_icon' => 'dashicons-images-alt',
		'supports' => array('title','excerpt','thumbnail', 'page-attributes')
	); 
	register_post_type('bstb', $args);
}
// Create a taxonomy for the carousel post type
function bstb_taxonomies () {
	$args = array('hierarchical' => true);
	register_taxonomy( 'teambio_category', 'bstb', $args );
	register_taxonomy( 'teambio_role', 'bstb', $args );
}
add_action( 'init', 'bstb_taxonomies', 0 );


// Add theme support for featured images if not already present
// http://wordpress.stackexchange.com/questions/23839/using-add-theme-support-inside-a-plugin
function bstb_addFeaturedImageSupport() {
	$supportedTypes = get_theme_support( 'post-thumbnails' );
	if( $supportedTypes === false ) {
		add_theme_support( 'post-thumbnails', array( 'bstb' ) );	  
		add_image_size('featured_preview', 100, 55, true);
	} elseif( is_array( $supportedTypes ) ) {
		$supportedTypes[0][] = 'bstb';
		add_theme_support( 'post-thumbnails', $supportedTypes[0] );
		add_image_size('featured_preview', 100, 55, true);
	}
}
add_action( 'after_setup_theme', 'bstb_addFeaturedImageSupport');

// Load in the pages doing everything else!
require_once('bstb-admin.php');
require_once('bstb-settings.php');
require_once('bstb-frontend.php');

