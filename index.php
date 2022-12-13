<?php
/**
 * The main template file
 *
 * @package WordPress
 * @subpackage Wl_Test_theme
 * @since Wl Test Theme 1.0
 */

get_header(); ?>

<?php
if ( have_posts() ) {

	// Load posts loop.
	while ( have_posts() ) {
		the_post();
	}

}

get_footer();
