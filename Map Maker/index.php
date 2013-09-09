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
 * Print the necessary script in the footer.
 *
 * @since  1.0.
 *
 * @return void
 */
/* Map only works when script is inputed in the form
function cpa_admin_map_maker_enqueue_script() {
    wp_enqueue_script(
        'Map Box API',
        '//api.tiles.mapbox.com/mapbox.js/v1.3.1/mapbox.js',
        array(),
        null,
        true
    );
}

add_action( 'admin_enqueue_scripts', 'cpa_admin_map_maker_enqueue_script' );
/*

/**
 * Print the necessary script in the footer.
 *
 * @since  1.0.
 *
 * @return void
 */
function cpa_admin_map_maker_enqueue_style() {
  wp_enqueue_style(
      'admin scripts',
      '//api.tiles.mapbox.com/mapbox.js/v1.3.1/mapbox.css',
      array(),
      '1.54',
      'all'
  );
}

add_action( 'admin_enqueue_scripts', 'cpa_map_maker_enqueue_style' );


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
       <style> #map { height: 150px;} </style>
       <script type="text/javascript">
       <?php $mapStyle = get_option( 'marker_custom_map_temp' ); ?>
       <?php $mapZoom = get_option( 'marker_custom_zoom', 3 ); ?>
       <?php $markerlonLocation = get_option( 'marker_custom_lon' ); ?>
       <?php $markerlatLocation = get_option( 'marker_custom_lat' ); ?>
       <?php $mapID = get_option( 'marker_custom_hex' ); ?>
       <?php $markerTitle = get_option( 'marker_custom_title'); ?>
       <?php $markerDescription = get_option( 'marker_custom_description'); ?>
          var map = L.mapbox.map("map", "<?php echo $mapStyle ?>")

            .setView([<?php echo $markerlatLocation ?>,<?php echo $markerlonLocation ?> ], <?php echo $mapZoom ?>);

          var geoJson = [{
              type: 'Feature',
              geometry: {
                  type: 'Point',
                  coordinates: [<?php echo $markerlonLocation ?>, <?php echo $markerlatLocation ?>]
              },
              properties: {
                  title: '<?php echo $markerTitle ?>',
                  description: '<?php echo $markerDescription ?>',
                  // http://mapbox.com/developers/simplestyle/
                  'marker-color': '#<?php echo $mapID ?>'
              }
          }];
          map.markerLayer.setGeoJSON(geoJson);
       </script>   
  <?php  
   
}

add_action( 'wp_footer', 'cpa_map_add_custon_map', 20 );
add_shortcode( 'Map Maker', 'cpa_map_add_custon_map');

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
    __('Map Maker Editor'),
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
             <h3>Example of your map:</h3>
             <div id="map"></div>
             <style> #map { height: 150px; width: 50%;} </style>
             <script type="text/javascript">
             <?php $mapStyle = get_option( 'marker_custom_map_temp' ); ?>
             <?php $mapZoom = get_option( 'marker_custom_zoom', 3 ); ?>
             <?php $markerlonLocation = get_option( 'marker_custom_lon' ); ?>
             <?php $markerlatLocation = get_option( 'marker_custom_lat' ); ?>
             <?php $mapID = get_option( 'marker_custom_hex'); ?>
             <?php $markerTitle = get_option( 'marker_custom_title'); ?>
             <?php $markerDescription = get_option( 'marker_custom_description'); ?>
                var map = L.mapbox.map("map", "<?php echo $mapStyle ?>")

                  .setView([<?php echo $markerlatLocation ?>,<?php echo $markerlonLocation ?> ], <?php echo $mapZoom ?>);

                var geoJson = [{
                    type: 'Feature',
                    geometry: {
                        type: 'Point',
                        coordinates: [<?php echo $markerlonLocation ?>, <?php echo $markerlatLocation ?>]
                    },
                    properties: {
                        title: '<?php echo $markerTitle ?>',
                        description: '<?php echo $markerDescription ?>',
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
        <h3>Now go use the [Map Maker] shortcode where you would like this map to display</h3>
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
    'marker_custom_map_temp'
  );

  add_settings_field(
    'marker_custom_map_tem_field',
    __( 'Select a map style:'),
    'cpa_map_render_map_temp_input',
    'map_options_page',
    'map_main_settings'
  );

  register_setting(
    'marker_custom_settings',
    'marker_custom_zoom'
  );

  add_settings_field(
    'marker_custom_zoom_field',
    __( 'Select a default zoom:'),
    'cpa_map_render_zoom_input',
    'map_options_page',
    'map_main_settings'
  );

  register_setting(
    'marker_custom_settings',
    'marker_custom_lat'
  );

  add_settings_field(
    'marker_custom_location_lat_field',
    __( 'Marker Location:'),
    'cpa_map_render_custom_marker_lat_input',
    'map_options_page',
    'map_main_settings'
  );

  register_setting(
    'marker_custom_settings',
    'marker_custom_lon'
  );

  add_settings_field(
    'marker_custom_location_field',
    __( ''),
    'cpa_map_render_custom_marker_input',
    'map_options_page',
    'map_main_settings'
  );

  register_setting(
    'marker_custom_settings',
    'marker_custom_hex'
  );

  add_settings_field(
    'marker_custom_hex_field',
    __( 'Marker Hex #:'),
    'cpa_map_render_custom_map_input',
    'map_options_page',
    'map_main_settings'
  );

  register_setting(
    'marker_custom_settings',
    'marker_custom_title'
  );

  add_settings_field(
    'marker_custom_title_field',
    __( 'Marker Title:'),
    'cpa_map_render_marker_title_input',
    'map_options_page',
    'map_main_settings'
  );

  register_setting(
    'marker_custom_settings',
    'marker_custom_description'
  );

  add_settings_field(
    'marker_custom_description_field',
    __( 'Marker description:'),
    'cpa_map_render_marker_description_input',
    'map_options_page',
    'map_main_settings'
  );

}
add_action ('admin_init', 'cpa_customize_map_settings');

function cpa_map_render_map_temp_input() {
  $mapStyle = get_option( 'marker_custom_map_temp' );
?>
  <select name="marker_custom_map_temp">
    <option value="topher253.map-emb9xcho" <?php selected( 'topher253.map-emb9xcho', $mapStyle ); ?>>Landscape</option>
    <option value="topher253.map-im1c3fmw" <?php selected( 'topher253.map-im1c3fmw', $mapStyle ); ?>>Light Grey</option>
    <option value="topher253.map-3ghxnwjd" <?php selected( 'topher253.map-3ghxnwjd', $mapStyle ); ?>>Navy Blue / Yellow</option>
     <option value="topher253.map-r4wmco1s" <?php selected( 'topher253.map-r4wmco1s', $mapStyle ); ?>>Green</option>
  </select>
<?php
}

/**
 * Render text instructions for customization.
 *
 * @since  1.0.
 *
 * @return void
 */
function cpa_map_render_main_settings_section() {
    echo '<p>Need help figuring out your longitude and latitude? Visit <a href="http://www.geo-tag.de/generator/en.html" target="_blank">Geo Tag Generator.</a></p>';
    echo '<hr />';
}


function cpa_map_render_zoom_input() {
  $mapZoom = get_option( 'marker_custom_zoom', 3 );
?>
  <select name="marker_custom_zoom">
    <option value="1" <?php selected( 1, $mapZoom ); ?>>1</option>
    <option value="3" <?php selected( 3, $mapZoom ); ?>>2</option>
    <option value="8" <?php selected( 8, $mapZoom ); ?>>3</option>
    <option value="13" <?php selected( 13, $mapZoom ); ?>>4</option>
    <option value="18" <?php selected( 18, $mapZoom ); ?>>5</option>
  </select>
<?php
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
  echo '<label>Lat.</label> <input name="marker_custom_lon"  type="text" value=" '. $markerlonLocation .' " />';
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
  echo '<label>Lon.</label> <input name="marker_custom_lat"  type="text" value=" '. $markerlatLocation .' " />';
}

/**
 * Render the input for custom marker color.
 *
 * @since  1.0.
 *
 * @return void
 */
function cpa_map_render_custom_map_input() {
  $mapID = get_option( 'marker_custom_hex' );
  echo '<input name="marker_custom_hex"  type="text" value=" '. $mapID .' " />';
}

/**
 * Render the input for custom marker color.
 *
 * @since  1.0.
 *
 * @return void
 */
function cpa_map_render_marker_title_input() {
  $markerTitle = get_option( 'marker_custom_title');
  echo '<input name="marker_custom_title"  type="text" value=" '. $markerTitle .' " />';
}

/**
 * Render the input for custom marker color.
 *
 * @since  1.0.
 *
 * @return void
 */
function cpa_map_render_marker_description_input() {
  $markerDescription = get_option( 'marker_custom_description');
  echo '<input name="marker_custom_description" type="text"   value=" '. $markerDescription .' " >';
}
