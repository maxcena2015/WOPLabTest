<?php
/**
 * The header.
 *
 * @package WordPress
 * @subpackage Wl_Test_Theme
 * @since Wl Test Theme 1.0
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
    <header>
        <div class="site-logo">
            <?php echo get_custom_logo(); ?>
        </div>
        <a class="phone-number" href="tel: <?php echo get_theme_mod( 'phone_number' ); ?>">
            <?php echo get_theme_mod( 'phone_number' ); ?>
        </a>
    </header>

	<div id="content" class="site-content">
		<div id="primary" class="content-area">
			<main id="main" class="site-main">
