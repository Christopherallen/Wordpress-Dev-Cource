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

/**
 * Print the necessary script in the footer.
 *
 * @since  1.0.
 *
 * @return void
 */
function cpa_map_maker_enqueue_script() {
    wp_enqueue_script(
        'Map Box API',
        '//api.tiles.mapbox.com/mapbox.js/v1.3.1/mapbox.js',
        array(),
        null,
        true
    );
}

add_action( 'wp_enqueue_scripts', 'cpa_map_maker_enqueue_script' );

/**
 * Print the necessary script in the footer.
 *
 * @since  1.0.
 *
 * @return void
 */
function cpa_map_maker_enqueue_style() {
	wp_enqueue_style(
	    'my-responsiveslides',
	    '//api.tiles.mapbox.com/mapbox.js/v1.3.1/mapbox.css',
	    array(),
	    '1.54',
	    'all'
	);
}

add_action( 'wp_enqueue_scripts', 'cpa_map_maker_enqueue_style' );

/**
 * Add the configuration script to enable the map.
 *
 * @since  1.0.
 *
 * @return void
 */
function cpa_map_add_custon_map( ) {

  ?>
     <div id="map"></div>
     <style> #map { height: 250px; } </style>
     <script type="text/javascript">
      var map = L.mapbox.map("map", "topher253.map-emb9xcho")
     </script>
   <?php  
     $content .= $button_html;
  
  
   echo $content;
}

add_action( 'wp_footer', 'cpa_map_add_custon_map', 20 );
add_shortcode( 'mapbox', 'cpa_map_add_custon_map');

/**
 * Add an options page for the plugin.
 *
 * @since  1.0.
 *
 * @return void
 */

function cpa_map_add_options_page() {
  add_options_page(
    __('Mapbox Options'),
    __('mapbox Options'),
    'manage_options',
    'map_options_page',
    'cpa_map_render_options_page'
  );
}

add_action('admin_menu', 'cpa_map_add_options_page');


/**
 * Render the options page.
 *
 * @since  1.0.
 *
 * @return void
 */
function cpa_map_render_options_page() {
 ?>
    <div class="wrap">
        <?php screen_icon(); ?>
        <h2><?php _e( 'Welcome to Map Maker using <a href="http://www.mapbox.com/" target="_blank">MapBox</a>' ); ?></h2>
        <form action="options.php" method="post">
            <?php settings_fields(  'marker_custom_settings' ); ?>
            <?php do_settings_sections( 'map_options_page' ); ?>
             <script src='http://api.tiles.mapbox.com/mapbox.js/v1.3.1/mapbox.js'></script>
             <link href='http://api.tiles.mapbox.com/mapbox.js/v1.3.1/mapbox.css' rel='stylesheet' />
             <h3>Example of your map:</h3>
             <div id="map"></div>
             <style> #map { height: 150px; width: 50%;} </style>
             <script type="text/javascript">
             <?php $markerlonLocation = get_option( 'marker_custom_lon' ); ?>
             <?php $markerlatLocation = get_option( 'marker_custom_lat' ); ?>
             <?php $mapID = get_option( 'marker_custom_hex' ); ?>
                var map = L.mapbox.map("map", "topher253.map-emb9xcho")

                  .setView([45.52, -122.68], 5);

                var geoJson = [{
                    type: 'Feature',
                    geometry: {
                        type: 'Point',
                        coordinates: [<?php echo $markerlonLocation ?>, <?php echo $markerlatLocation ?>]
                    },
                    properties: {
                        title: 'Portland Fucking Oregon',
                        // http://mapbox.com/developers/simplestyle/
                        'marker-color': '#<?php echo $mapID ?>'
                    }
                }];
                map.markerLayer.setGeoJSON(geoJson);
             </script>
             <p class="submit">
                <input type="submit" name="submit" id="submit" class="button button-primary" value="<?php _e( 'Update Changes' ); ?>">
             </p>
        </form>
    </div>
<?php
}

/**
 * Setup a setting for customizing map.
 *
 * @since  1.0.
 *
 * @return void
 */
function cpa_customize_map_settings() {
  add_settings_section(
    'map_main_settings',
    __( 'Customize your map' ),
    'cpa_map_render_main_settings_section',
    'map_options_page'
  );

  register_setting(
    'marker_custom_settings',
    'marker_custom_lon'
  );

  add_settings_field(
    'marker_custom_location_field',
    __( 'Input marker Location:'),
    'cpa_map_render_custom_marker_input',
    'map_options_page',
    'map_main_settings'
  );

  register_setting(
    'marker_custom_settings',
    'marker_custom_lat'
  );

  add_settings_field(
    'marker_custom_location_lat_field',
    __( ''),
    'cpa_map_render_custom_marker_lat_input',
    'map_options_page',
    'map_main_settings'
  );

  register_setting(
    'marker_custom_settings',
    'marker_custom_hex'
  );

  add_settings_field(
    'marker_custom_hex_field',
    __( 'Input Marker Hex #:'),
    'cpa_map_render_custom_map_input',
    'map_options_page',
    'map_main_settings'
  );
}
add_action ('admin_init', 'cpa_customize_map_settings');

/**
 * Render text instructions for customization.
 *
 * @since  1.0.
 *
 * @return void
 */
function cpa_map_render_main_settings_section() {
  echo "<p>Lets begin customizing your map.</p>";
}

/**
 * Render the input for custom marker location.
 *
 * @since  1.0.
 *
 * @return void
 */
function cpa_map_render_custom_marker_input() {
  $markerlonLocation = get_option( 'marker_custom_lon' );
  echo '<label>Lon</label> <input name="marker_custom_lon"  type="text" value=" '. $markerlonLocation .' " />';
}

/**
 * Render the input for custom marker location.
 *
 * @since  1.0.
 *
 * @return void
 */
function cpa_map_render_custom_marker_lat_input() {
  $markerlatLocation = get_option( 'marker_custom_lat' );
  echo '<label>Lon</label> <input name="marker_custom_lat"  type="text" value=" '. $markerlatLocation .' " />';
}

/**
 * Render the input for custom marker color.
 *
 * @since  1.0.
 *
 * @return void
 */
function cpa_map_render_custom_map_input() {
  $mapID = get_option( 'marker_custom_hex');
  echo '<input name="marker_custom_hex"  type="text" value=" '. $mapID .' " />';
}



