<?php
/**
 * The template for displaying pages
 *
 * This is the template that displays all pages by default.
 */
?>

<?php get_header(); ?>
	<section class="banner">
		<div class="container text-uppercase">
			<ol>
				<li><?php the_title(); ?></li>
			</ol>
		</div>
	</section>
	<div class="container">
		<?php while ( have_posts() ) : the_post(); ?>
			<div class="text-center">
				<?php the_post_thumbnail('large'); ?>
			</div>
			<p><?php the_content(); ?></p>
		<?php endwhile; ?>
	</div>
<?php get_footer();?>