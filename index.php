<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * e.g., it puts together the home page when no home.php file exists.
 *
 * Learn more: {@link https://codex.wordpress.org/Template_Hierarchy}
 */
?>

<?php get_header(); ?>

	<div class="container" style="margin-top:145px">
		<div class="row">
			<div class="col-sm-8">
				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

				<h2><a href="<?php the_permalink();?>"><?php the_title(); ?></a></h2>
				<p><?php the_content(); ?></p>

				<?php endwhile; else: ?>
					<p><?php _e( 'Sorry, no posts found.', 'fractal' ); ?></p>
				<?php endif; ?>
			</div>
			<div class="widget-area col-sm-4">
				<?php get_sidebar(); ?>
			</div>
		</div> <!-- end row -->		
	</div> <!-- end container -->

<?php get_footer();?>
