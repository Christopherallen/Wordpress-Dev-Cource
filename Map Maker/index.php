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
?>

<style>
	#map { height: 250px; }
</style>

<?php

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

function map_maker_generate_map() {
    $button_html .= '<div id="map"></div>';
	$button_html .= '<script type="text/javascript">';
	$button_html .= 'var map = L.mapbox.map("map", "topher253.map-28tnkux4");';
	$button_html .= '</script>';

	echo $button_html;
}

add_filter( 'wp_head', 'map_maker_generate_map', 20 );