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

                <div class="col-sm-4">
                    <div class="text-top">
                        <h3 class="text-center"><?php
                        $bar = (unserialize(get_post_meta(get_the_id())['why_fractal_data'][0]));
                        echo(strtoupper($bar['heading'][0]));
                        ?></h3>
                        <p>
                            <?php echo($bar['reason'][0]); ?>
                        </p>
                        <ul class="list">
                            <?php
                            if (isset($bar['point'])) {
                                for ($i=0; $i<count($bar['point']); $i++) {
                                echo "<li><i class='glyphicon glyphicon-ok-sign'></i> " . $bar['point'][$i] . "</li>" ;
                                }
                            }
                            ?>
                        </ul>
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

    <?php
    // insert "team" section if exists
    $meta = get_post_meta(get_the_id());
    if ( isset($meta['employee_data'])) :
        $foo = unserialize($meta['employee_data'][0]);
        $count = count($foo['employee_image']);
    ?>
        <section class="team">
            <div class="container">
                <div class="row">
                    <section class="team">
                        <div class="container">
                            <div class="row">
                                <h1 class="text-center">Our team</h1>
                            </div>
                            <div class="row">
                                <?php
                                for ($i = 0; $i < $count; $i++) { ?>
                                    <div class="post col-sm-6 col-md-6 col-lg-3">
                                        <div class="center">
                                            <img src="<?php echo $foo['employee_image'][$i]; ?>"/>
                                        </div>
                                        <h2 class="text-center"><?php echo $foo['employee_name'][$i]; ?></h2>
                                        <p class="text-center"><?php echo $foo['employee_position'][$i]; ?></p>
                                        <div class="resume">
                                            <p>
                                                <?php echo $foo['employee_about'][$i]; ?>
                                            </p>
                                        </div>
                                    </div><!-- end of post -->
                                <?php } ?>
                            </div><!-- end of row -->
                        </div><!-- end of container -->
                    </section><!-- end of team -->
                </div><!-- end of row -->
            </div><!-- end of container -->
        </section><!-- end of team -->
    <?php endif; ?>
    <?php get_template_part( 'contactform' ); ?>

<?php get_footer();?>