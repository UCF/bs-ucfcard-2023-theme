<?php

define( 'UCFCARD_THEME_DIR', trailingslashit( get_stylesheet_directory() ) );


// Theme foundation
include_once UCFCARD_THEME_DIR . 'includes/config.php';
include_once UCFCARD_THEME_DIR . 'includes/meta.php';

// Add other includes to this file as needed.
/**
 * Add CSS classes to category-menu li items
 *
 * @since 0.1.3
 * @author Mike Setzer
 **/

function my_custom_menu_item_classes($classes, $item, $args, $depth) {

	//Array for special nav items
	$special_items = array('Log In');

	//Add custom class to pecial nav items
	if ('header-menu' === $args->theme_location && in_array($item->title, $special_items)) {
		$classes[] = ' knight-cash-menu-button bg-primary-t-2'; // Add custom class
	}

	return $classes;
}
add_filter('nav_menu_css_class', 'my_custom_menu_item_classes', 10, 4);



/**
 * Add CSS classes to category-menu anchor items
 *
 * @since 0.1.3
 * @author Mike Setzer
 **/

function my_custom_menu_link_attributes($atts, $item, $args, $depth) {

	//Check if nav item is General, Finance, or HR, and modify styles
	$special_items = array('Log In');

	if ('header-menu' === $args->theme_location && in_array($item->title, $special_items)) {
		$existing_classes = isset($atts['class']) ? $atts['class'] : '';
		$atts['class'] = $existing_classes . ' text-inverse'; // Add 'text-inverse' class
	}

	return $atts;
}
add_filter('nav_menu_link_attributes', 'my_custom_menu_link_attributes', 10, 4);

/**
 * Add sorting for Knightcash map locations
 *
 * @since 0.1.3
 * @author Mike Setzer
 **/
function aasort ( &$array, $key ) {
	$sorter = array();
	$ret = array();
	reset( $array );

	foreach ( $array as $ii => $va ) {
		$sorter[$ii] = $va[$key];
	}

	asort( $sorter );

	foreach ( $sorter as $ii => $va ) {
		$ret[$ii] = $array[$ii];
	}

	$array = $ret;
}
