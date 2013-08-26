<?php
/*
Plugin Name: Bye Bye Bye Lines
Plugin URI:  http://www.nsync.com/
Description: Display a byline at the end of a post, making it a Bye bye bye line.
Version:     1.0
Author:      'N Sync
Author URI:  http://www.nsync.com/
License:     GPLv2 or later
*/

/**
 * Set up the metabox.
 *
 * @param  string    $post_type    The post type.
 * @param  object    $post         The current post object.
 * @return void
 */
function nsync_call_meta_box( $post_type, $post ) {
    add_meta_box(
        'byebyebye_line',
        __( 'Bye Bye Bye Line', 'byebyebye_lines' ),
        'nsync_display_meta_box',
        'post',
        'side',
        'high'
    );
}

add_action( 'add_meta_boxes', 'nsync_call_meta_box', 10, 2 );

/**
 * Display the HTML for the metabox.
 *
 * @param  object    $post    The current post object
 * @param  array     $args    Additional arguments for the metabox.
 * @return void
 */
function nsync_display_meta_box( $post, $args ) {
    wp_nonce_field( plugins_url( __FILE__ ), 'nsync_plugin_noncename' );
?>
    <p>
        <label for="byeline">
            <?php _e( 'Bye Bye Bye Line', 'byebyebye_lines' ); ?>:&nbsp;
        </label>
        <input type="text" class="widefat" name="byeline" value="<?php echo get_post_meta( $post->ID, 'byebyebye-line', true ); ?>" />
        <em>
            <?php _e( 'HTML is not allowed', 'byebyebye_lines' ); ?>
        </em>
    </p>
<?php
}

/**
 * Save the metabox.
 *
 * @param  int       $post_id    The ID for the current post.
 * @param  object    $post       The current post object.
 */
function nsync_save_meta_box( $post_id, $post ) {
    
    // Check the nonce to secure against CSRF
    if ( isset( $_POST[ 'nsync_plugin_noncename' ] ) && wp_verify_nonce( $_POST[ 'nsync_plugin_noncename' ], plugins_url( __FILE__ ) ) ) {
        if ( is_numeric( $_POST[ 'byeline' ] ) ) {
            update_post_meta( $post_id, 'byeline', absint( $_POST[ 'byeline' ] ) );
        } else {
            $byeline = $_POST['byeline'];
            update_post_meta( $post_id, 'byebyebye-line', $byeline );
        }
    }

    return;
}

add_action( 'save_post', 'nsync_save_meta_box', 10, 2 );

/**
 * Append the Bye Bye Bye Line to the content.
 *
 * @param  string    $content    The original content.
 * @return string                The altered content.
 */
function nsync_display_byebyebye_line( $content ) {
    $byebyebye_line = get_post_meta( get_the_ID(), 'byebyebye-line', true );
    return $content . $byebyebye_line;
}

add_filter( 'the_content', 'nsync_display_byebyebye_line', 40, 1 );