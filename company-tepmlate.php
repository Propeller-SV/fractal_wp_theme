<?php
/**
 * Template name: Fractal Soft company
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

    <section class="about-us">
        <div class="container">
            <div class="row">
                <div class="col-sm-8">
                    <div class="text-top">
                        <?php

                        while ( have_posts() ) : the_post();

                            the_content();

                        endwhile;
                        ?>
                    </div><!-- end of text-top -->
                </div><!-- end of col-sm-8 -->

                <div class="col-sm-4 pull-right">
                    <div class="text-top">
                        <?php get_sidebar(); ?>
                    </div><!-- end of text-top -->
                </div><!-- end of col-sm-4 -->

                <div class="text-bottom col-sm-8 pull-left">
                    <?php get_sidebar( 'company' ); ?>
                </div> <!-- end of text-bottom -->

                <div class="text-bottom col-sm-4 pull-right">
                    <div class="text-bottom-tabs">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#">Ukraine</a></li>
                            <li><a href="#">England</a></li>
                        </ul>
                        <div class="info">
                            <p>
                                Phone: +38 (050) 353 88 42
                            </p>
                            <p>
                                Email: <a href="mailto:fractalsoft@gmail.com">fractalsoft@gmail.com</a>
                            </p>
                            <p class="paragraph">
                                Address: <span>Ukraine, Kyiv, Yasna, 5 St.</span>
                            </p>
                        </div> <!-- end of info -->
                        <div id="map_canvas" style="width:100%; min-height: 200px"></div>
                    </div>
                </div><!-- end of text-bottom -->
            </div><!-- end of row -->
        </div><!-- end of container -->
    </section><!-- end of about-us -->

    <section class="team">
        <div class="container">
            <div class="row">
                <?php get_sidebar( 'our_team' ); ?>
            </div><!-- end of row -->
        </div><!-- end of container -->
    </section><!-- end of team -->

    <?php get_template_part( 'contactform' ); ?>

<?php get_footer();?>