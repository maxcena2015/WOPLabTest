<?php
/**
 * The template for displaying all single posts
 *
 * @package WordPress
 * @subpackage WL_Test_Theme
 * @since WL Test Theme 1.0
 */

get_header();

/* Start the Loop */
while ( have_posts() ) :
	the_post();

	$twentytwentyone_next_label     = esc_html__( 'Next post', 'twentytwentyone' );
	$twentytwentyone_previous_label = esc_html__( 'Previous post', 'twentytwentyone' );

	the_post_navigation(
		array(
			'next_text' => '<p class="meta-nav">' . $twentytwentyone_next_label . '</p><p class="post-title">%title</p>',
			'prev_text' => '<p class="meta-nav">' . $twentytwentyone_previous_label . '</p><p class="post-title">%title</p>',
		)
	);
endwhile; // End of the loop.

get_footer();
