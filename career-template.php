<?php
/**
 * Template name: Fractal Soft career
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

    <section class="career-growth">
        <div class="container">
            <div class="career">
                <?php get_sidebar( 'career' ); ?>
            </div><!-- end of career -->
        </div><!-- end of container -->
    </section><!-- end of growth -->
    <?php get_template_part( 'contactform' ); ?>

<?php get_footer();?>