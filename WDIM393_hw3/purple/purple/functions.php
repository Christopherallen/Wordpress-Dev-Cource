<?php

/**
 * Add "I Am Awesome" to be the constant title
 *
 * @since  1.0.
 *
 * @return void
 */

function change_title_I_Am_Awesome($title) {
	$title = "I Am Awesome";
	return $title;
}

add_filter('wp_title', 'change_title_I_Am_Awesome', 20);