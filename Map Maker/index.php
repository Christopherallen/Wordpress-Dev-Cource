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
  $mapID = get_option( 'map_custom_id' );

  ?>
     <div id="map"></div>
     <style> #map { height: 250px; } </style>
     <script type="text/javascript">
      var map = L.mapbox.map("map", "<?php echo $mapID ?>")
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
            <?php settings_fields( 'map_custom_id' ); ?>
            <?php do_settings_sections( 'map_options_page' ); ?>
             <script src='http://api.tiles.mapbox.com/mapbox.js/v1.3.1/mapbox.js'></script>
             <link href='http://api.tiles.mapbox.com/mapbox.js/v1.3.1/mapbox.css' rel='stylesheet' />
             <h3>Example of your map:</h3>
             <div id="map"></div>
             <style> #map { height: 250px; width: 50%;} </style>
             <script type="text/javascript">
             <?php $mapID = get_option( 'map_custom_id' ); ?>
                var map = L.mapbox.map("map", "<?php echo $mapID ?>")
             </script>
             <p class="submit">
                <input type="submit" name="submit" id="submit" class="button button-primary" value="<?php _e( 'Save Changes' ); ?>">
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
  register_setting(
    'map_custom_id',
    'map_custom_id'
  );

  add_settings_section(
    'map_main_settings',
    __( 'Customize your map' ),
    'cpa_map_render_main_settings_section',
    'map_options_page'
  );

  add_settings_field(
    'map_custom_id_field',
    __( 'Input your map id'),
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
 * Render the input for customization.
 *
 * @since  1.0.
 *
 * @return void
 */
function cpa_map_render_custom_map_input() {
  $mapID = get_option( 'map_custom_id' );
  echo '<input name="map_custom_id"  type="text" value=" '. $mapID .' " />';
}

