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
                <div class="row">
                    <div class="blurb col-xs-12 col-sm-3">
                        <div class="blurb-text">
                            <div class="center">
                                <i class="glyphicon glyphicon-camera"></i>
                            </div>
                            <p class="text-center">
                                <?php
                                $points_data = get_post_meta(get_the_id(), 'main_company_points_data', true);
                                if (isset ($points_data)) {
                                    $main_point = ($points_data);
                                }
                                if (isset($main_point['point'][0])) {
                                    echo($main_point['point'][0]);
                                } else {
                                    echo "Print this page to PDF for the complete set of vectors.  Or to use on the desktop, install FontAwesome.otf, set it as the font in your application, and copy and paste the icons (notthe unicode) directly from this page into your designs.";
                                }
                                ?>
                            </p>
                        </div>
                    </div><!-- end of blurb -->
                    <div class="blurb col-xs-12 col-sm-3">
                        <div class="blurb-text">
                            <div class="center">
                                <i class="glyphicon glyphicon-bullhorn"></i>
                            </div>
                            <p class="text-center">
                                <?php if (isset($main_point['point'][1])) {
                                    echo($main_point['point'][1]);
                                } else {
                                    echo "Print this page to PDF for the complete set of vectors.  Or to use on the desktop, install FontAwesome.otf, set it as the font in your application, and copy and paste the icons (notthe unicode) directly from this page into your designs.";
                                } ?>
                            </p>
                        </div>
                    </div><!-- end of blurb -->
                    <div class="blurb col-xs-12 col-sm-3">
                        <div class="blurb-text">
                            <div class="center">
                                <i class="fa fa-gavel"></i>
                            </div>
                            <p class="text-center">
                                <?php if (isset($main_point['point'][2])) {
                                    echo($main_point['point'][2]);
                                } else {
                                    echo "Print this page to PDF for the complete set of vectors.  Or to use on the desktop, install FontAwesome.otf, set it as the font in your application, and copy and paste the icons (notthe unicode) directly from this page into your designs.";
                                } ?>
                            </p>
                        </div>
                    </div><!-- end of blurb -->
                    <div class="photofit col-xs-12 col-sm-3">
                        <img src="<?php echo IMAGES; ?>/banner-foto.png"/>
                    </div>
                </div><!-- end of row -->
                <img src="<?php echo IMAGES; ?>/banner-background-top.png" class="banner-background-top"/>
            </div><!-- end of career -->
        </div><!-- end of container -->
    </section><!-- end of growth -->
    <?php get_template_part( 'contactform' ); ?>

<?php get_footer();?>