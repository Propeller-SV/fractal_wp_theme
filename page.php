<?php
/**
 * The template for displaying pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other "pages" on your WordPress site will use a different template.
 */
?>

<?php get_header(); ?>

	<div class="container" style="margin-top:145px">

		<?php while ( have_posts() ) : the_post(); ?>

		<?php the_post_thumbnail('thumbnail'); ?>
		<h1><?php the_title(); ?></h1>
		<p><?php the_content(); ?></p>

		<?php endwhile; ?>

	</div>


<?php get_footer();?>