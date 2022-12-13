<?php
/**
 * The template for displaying archive pages
 *
 * @package WordPress
 * @subpackage Wl_Test_Theme
 * @since Wl Test Theme 1.0
 */

get_header();

$description = get_the_archive_description();
?>

<?php if ( have_posts() ) : ?>

	<header class="page-header alignwide">
		<?php the_archive_title( '<h1 class="page-title">', '</h1>' ); ?>
	</header><!-- .page-header -->

	<?php while ( have_posts() ) : ?>
		<?php the_post(); ?>
	<?php endwhile; ?>

<?php else : ?>
<?php endif; ?>

<?php
get_footer();
