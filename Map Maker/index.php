<?php
/*
Plugin Name: Map Maker
Plugin URI: https://github.com/Christopherallen/Wordpress-Dev-Cource
Version: 1.0
Description: Fully customizable maps intergrated into your wordpress theme
Author: Chris Allen
Author URI: http://cpallen.com
License: GNU General Public License v2 or later
*/

function map_maker_enqueue_script() {
	    wp_enqueue_script(
	        'Map Box API',
	        '//api.tiles.mapbox.com/mapbox.js/v1.3.1/mapbox.js',
	        array(),
	        null,
	        true
	    );
}

function map_maker_enqueue_style() {
		wp_enqueue_style(
		    'Map Box Styles',
		    plugins_url( '//api.tiles.mapbox.com/mapbox.js/v1.3.1/mapbox.css', __FILE__ ),
		    array(),
		    'all'
		);
}