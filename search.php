<?php
/**
 * The template for displaying search results pages.
 */
?>

<?php get_header(); ?>
	<section class="banner">
		<div class="container">
			<h2><?php _e('Search results for: ', 'fractal'); ?><?php the_search_query(); ?></h2>
		</div>
	</section>
	<div class="container">
		<?php if ( have_posts() ) : ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<h2><a href="<?php the_permalink();?>"><?php the_title(); ?></a></h2>
				<p><?php the_excerpt(); ?></p>
			<?php endwhile; else: ?>
				<p><?php _e( 'Sorry, no posts found.', 'fractal' ); ?></p>
		<?php endif; ?>
	</div>
<?php get_footer();?>