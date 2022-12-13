<?php

function wltesttheme_frontend_scripts() {
	wp_enqueue_style( 'styles', get_stylesheet_uri() );
}

add_action( 'wp_enqueue_scripts', 'wltesttheme_frontend_scripts' );

function wltesttheme_backend_scripts() {
	wp_enqueue_style( 'wp-color-picker' );

	wp_enqueue_script( 'wp-color-picker' );
	wp_enqueue_script( 'custom-admin', get_template_directory_uri() . '/assets/js/admin/custom.js', array( 'jquery' ), null, true );
}

add_action( 'admin_enqueue_scripts', 'wltesttheme_backend_scripts' );

function wl_theme_name_register_phone_number( $wp_customize ) {

	$wp_customize->add_setting( 'phone_number', array(
		'default' => '',
		'capability' => 'edit_theme_options'
	) );

	$wp_customize->add_control( 'phone_number', array(
		'label' => 'Phone Number',
		'section' => 'title_tagline',
		'type' => 'text'
	) );
}
add_action( 'customize_register', 'wl_theme_name_register_phone_number' );

function cars_list( $atts ) {

	$atts = shortcode_atts( array(
		'cars_num' => 10,
	), $atts);

	$the_query = new WP_Query( array(
		'post_type'      => 'car',
		'posts_per_page' => $atts['cars_num'],
	));

	ob_start();

	if ( $the_query->have_posts() ) :
	  ?>

	  <ul>

	  <?php
	  while ( $the_query->have_posts() ) : $the_query->the_post();

      ?>
		  <li><a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a></li>
	  <?php

	  endwhile;
	  ?>

	  </ul>

	  <?php
	  wp_reset_postdata();

	else :
	?>
	  <p><?php __('No Cars'); ?></p>
	<?php
	endif;

	return ob_get_clean();

}

add_shortcode( 'cars', 'cars_list' );

function wltesttheme_custom_logo_setup() {
	$defaults = array(
		'height'               => 100,
		'width'                => 400,
		'flex-height'          => true,
		'flex-width'           => true,
		'header-text'          => array( 'site-title', 'site-description' ),
		'unlink-homepage-logo' => true,
	);

	add_theme_support( 'custom-logo', $defaults );
}
add_action( 'after_setup_theme', 'wltesttheme_custom_logo_setup' );

require_once get_template_directory() . '/includes/cpt/cars.php';
require_once get_template_directory() . '/includes/cpt/metafields.php';
