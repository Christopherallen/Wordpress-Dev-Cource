<?php
/*
Plugin Name: Sharkquake AddThis Buttons
Plugin URI: https://github.com/Christopherallen/WDIM393_hw2
Version: 1.0
Description: AddThis social media icons 
Author: Chris Allen
Author URI: 
License: GNU General Public License v2 or later
*/



/* Credit: Zack Tollman Pimpletrest plugin code */

function AddThis_enqueue_script($content) {
    // Load the AddThis script in the footer
    if ( is_single() && 0 == get_option( 'AddThis_disable_button', 0) ) {
	    wp_enqueue_script(
	        'AddThis',
	        '//s7.addthis.com/js/300/addthis_widget.js#pubid=xa-51f5903a227e68e0',
	        array(),
	        null,
	        true

	    );
	}
}

add_action( 'wp_enqueue_scripts', 'AddThis_enqueue_script' );

function AddThis_add_button() {
	/* Received help from kay to get the Javascript to load properly */

    if ( is_single() && 0 == get_option( 'AddThis_disable_button', 0) ) {
        

    	$button_html .= '<script type="text/javascript">';
        $button_html .= 'addthis.layers({';
        $button_html .= '"theme" : "gray",';
        $button_html .= '"share" : {';
        $button_html .= '"position" : "right",';
        $button_html .= '"numPreferredServices" : 5';
        $button_html .= '},';
        $button_html .= '"whatsnext" : {},';
        $button_html .= '"recommended" : {';
        $button_html .= '"title": "Recommended for you:"';
        $button_html .= '}';
        $button_html .= '});';
        $button_html .= '</script>';   
    
   
    }

      echo $button_html;

}


add_action( 'wp_footer', 'AddThis_add_button', 20);

function AddThis_add_options_page() {
	add_options_page(
		__('AddThis'),
		__('AddThis'),
		'manage_options',
		'AddThis_options_page',
		'AddThis_render_options_page'
	);
}

add_action('admin_menu', 'AddThis_add_options_page');

function AddThis_render_options_page() {
 ?>
    <div class="wrap">
        <?php screen_icon(); ?>
        <h2><?php _e( 'The AddThis Options' ); ?></h2>
        <form action="options.php" method="post">
            <?php settings_fields( 'AddThis_disable_button' ); ?>
            <?php do_settings_sections( 'AddThis_options_page' ); ?>
            <p class="submit">
                <input type="submit" name="submit" id="submit" class="button button-primary" value="<?php _e( 'Save Changes' ); ?>">
            </p>
        </form>
    </div>
<?php
}

// Options page
function AddThis_add_disable_button_settings() {
	register_setting(
		'AddThis_disable_button',
		'AddThis_disable_button',
		'absint'
	);

	register_setting(
		'AddThis_position',
		'AddThis_position',
		'absint'
	);
	
	register_setting(
		'AddThis_num_preferred',
		'AddThis_num_preferred',
		'absint'
	);


	add_settings_section(
		'AddThis_main_settings',
		__( 'AddThis Controls' ),
		'AddThis_render_main_settings_section',
		'AddThis_options_page'
	);

	add_settings_field(
		'AddThis_disable_button_field',
		__( 'Disable AddThis Buttons'),
		'AddThis_render_disable_button_input',
		'AddThis_options_page',
		'AddThis_main_settings'
	);

	add_settings_field(
		'AddThis_position_field',
		__( 'Choose a side for it to display:'),
		'AddThis_render_position_input',
		'AddThis_options_page',
		'AddThis_main_settings'
	);
	add_settings_field(
		'AddThis_numb_preferred_field',
		__( 'Choose number of buttons to be displayed:'),
		'AddThis_render_num_preferred_input',
		'AddThis_options_page',
		'AddThis_main_settings'
	);
}
add_action ('admin_init', 'AddThis_add_disable_button_settings');

function AddThis_render_main_settings_section() {
	echo "<p>Main settings for the AddThis plugin.</p>";
}

function AddThis_render_disable_button_input() {
	$current = get_option( 'AddThis_disable_button', 0);
	echo '<input name="AddThis_disable_button" '. checked( $current, 1, false) .'  type="checkbox" value="1" />';
}

function AddThis_render_position_input() {
	$current = get_option( 'AddThis_position_button', 0);
	echo '<select>';
	echo '<option value="left" style="left">Left</option>';
	echo '<option value="right" style="right">Right</option>';
	echo '</select>';
}

function AddThis_render_num_preferred_input() {
	$current = get_option( 'AddThis_num_preferred', 2);
	echo '<label><input name="AddThis_AddThis_num_preferred" '. checked( $current, 1, false) .'  type="radio" value="1" /> 1 </lable>';
	echo '<label><input name="AddThis_AddThis_num_preferred" '. checked( $current, 2, false) .'  type="radio" value="2" /> 2 </lable>';
	echo '<label><input name="AddThis_AddThis_num_preferred" '. checked( $current, 3, false) .'  type="radio" value="3" /> 3 </lable>';
	echo '<label><input name="AddThis_AddThis_num_preferred" '. checked( $current, 4, false) .'  type="radio" value="4" /> 4 </lable>';
	echo '<label><input name="AddThis_AddThis_num_preferred" '. checked( $current, 5, false) .'  type="radio" value="5" /> 5 </lable>';
	echo '<label><input name="AddThis_AddThis_num_preferred" '. checked( $current, 6, false) .'  type="radio" value="6" /> 6 </lable>';
}