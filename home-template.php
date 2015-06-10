<?php
/**
 * Template name: Fractal Soft homepage
 */
?>

<?php get_header(); ?>

	<section id="carousel-slides">
		<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">

			<!-- Indicators -->
			<ol class="carousel-indicators">
				<li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
				<li data-target="#carousel-example-generic" data-slide-to="1"></li>
				<li data-target="#carousel-example-generic" data-slide-to="2"></li>
			</ol>

			<!-- Wrapper for slides -->
			<div class="carousel-inner" role="listbox">
				<div class="item active">
					<img class="img-responsive" src="<?php bloginfo( 'template_url' ); ?>/img/slide-1.png" alt="...">
					<div class="carousel-caption">
						<h1 class="text-left">How Well Do<br>Know Your Partner?</h1>
						<p class="text-left">JUST ONE CLICKAWAY</p>
						<p><a href="#" role="button" class="pull-left">Check</a></p>
					</div>
				</div>
				<div class="item">
					<img class="img-responsive" src="<?php bloginfo( 'template_url' ); ?>/img/slide-2.png" alt="...">
					<div class="carousel-caption">
						<h1 class="text-left">How Well Do<br>Know Your Partner?</h1>
						<p class="text-left">JUST ONE CLICKAWAY</p>
						<p><a href="#" role="button" class="pull-left">Check</a></p>
					</div>
				</div>
				<div class="item">
					<img class="img-responsive" src="<?php bloginfo( 'template_url' ); ?>/img/slide-3.png" alt="...">
					<div class="carousel-caption">
						<h1 class="text-left">How Well Do<br>Know Your Partner?</h1>
						<p class="text-left">JUST ONE CLICKAWAY</p>
						<p><a href="#" role="button" class="pull-left">Check</a></p>
					</div>
				</div>
			</div>

			<!-- Controls -->
			<a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
				<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
				<span class="sr-only">Previous</span>
			</a>
			<a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
				<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
				<span class="sr-only">Next</span>
			</a>

		</div><!-- end of carousel-example-generic -->
		</section><!-- end of carousel-slides -->
		<section class="fragment">
			<div class="container">
				<div class="row heading">
					<h1 class="text-center"><?php _e('About Us', 'fractal'); ?><br>&#8212;&#8212;</h1>
				</div>
				<div class="row">
					<div class="col-sm-4">
						<div class="about">
							<?php
							$softEngin = new WP_Query('pagename=software-engineering');
							if ($softEngin->have_posts()) : while ($softEngin->have_posts()) : $softEngin->the_post();?>
								<?php the_post_thumbnail(); ?>
								<h2><?php the_title(); ?></h2>
								<p><?php the_excerpt(); ?></p>
								<p class="learn-more-link"><a href="<?php the_permalink(); ?>"><?php _e('Learn More', 'fractal'); ?></a></p>
								<?php endwhile; else: ?>
								<h2><?php _e('Sorry, this page does not exist.', 'fractal'); ?></h2>
							<?php endif; ?>
							<?php wp_reset_postdata(); ?>
						</div><!-- end of about -->
					</div><!-- end of col-sm-4 -->
					<div class="col-sm-4">
						<div class="about">
							<?php
							$company = new WP_Query('pagename=company');
							if ($company->have_posts()) : while ($company->have_posts()) : $company->the_post();?>
								<?php the_post_thumbnail(); ?>
								<h2><?php the_title(); ?></h2>
								<p><?php the_excerpt(); ?></p>
								<p class="learn-more-link"><a href="<?php the_permalink(); ?>"><?php _e('Learn More', 'fractal'); ?></a></p>
								<?php endwhile; else: ?>
								<h2><?php _e('Sorry, this page does not exist.', 'fractal'); ?></h2>
							<?php endif; ?>
							<?php wp_reset_postdata(); ?>
						</div><!-- end of about -->
					</div><!-- end of col-sm-4 -->
					<div class="col-sm-4">
						<div class="about">
							<?php
							$career = new WP_Query('pagename=career');
							if ($career->have_posts()) : while ($career->have_posts()) : $career->the_post();?>
								<?php the_post_thumbnail(); ?>
								<h2><?php the_title(); ?></h2>
								<p><?php the_excerpt(); ?></p>
								<p class="learn-more-link"><a href="<?php the_permalink(); ?>"><?php _e('Learn More', 'fractal'); ?></a></p>
								<?php endwhile; else: ?>
								<h2><?php _e('Sorry, this page does not exist.', 'fractal'); ?></h2>
							<?php endif; ?>
							<?php wp_reset_postdata(); ?>
						</div><!-- end of about -->
					</div><!-- end of col-sm-4 -->
				</div><!-- end of row -->
			</div><!-- end of container -->
		</section><!-- end of fragment -->

		<section class="content">
			<div class="container">
				<h3>SPECIAL OFFER!</h3>
				<h2>SAVE 30% this week!</h2>
				<p>
					This is Photoshop's version of Lorem Ipsum.
					Proin gravida nibn vel velit auctor aliquet. Aenean sollicitudin,
					lorem quis.
				</p>
				<p><a href="" role="button">View</a></p>
			</div><!-- end of container -->
		</section><!-- end of content -->
		<?php
		// insert "customer" section if exists
		$meta = get_post_meta(get_the_id());
		if ( isset($meta['gallery_data'])) {
			$foo = unserialize($meta['gallery_data'][0]);
			$count = count($foo['image_url']);
		?>
			<section class="customer">
				<div class="heading">
					<div class="container">
						<h2 class="text-center">CUSTOMERS<br><span>&#9830;</span></h2>
					</div>
				</div>
				<div class="container">
					<div class="row">
						<ul class="list-unstyled">
							<?php
							for ($i = 0; $i < $count; $i++) {
								echo "<li class='col-sm-6 col-md-" . 12/$count . " text-center'><a href='" . esc_url($foo['image_desc'][$i]) . "'><img src='" . esc_url($foo['image_url'][$i]) . "' alt='Customer'></a></li>";
							}
							?>
						</ul>
					</div><!-- end of row -->
				</div><!-- end of container -->
			</section><!-- end of content -->
		<?php } else { ?>
			<section class="customer">
			    <div class="heading">
			        <div class="container">
			            <h2 class="text-center">CUSTOMERS<br><span>&#9830;</span></h2>
			        </div>
			    </div>
			    <div class="container">
			        <div class="row">
			            <ul class="list-unstyled">
							<?php for ($i=1; $i<5; $i++) {
							echo "<li class='col-sm-6 col-md-3 text-center'><a href='#'><img src='" . IMAGES . "/layer-" . $i . ".png'></a></li>";
							} ?>
			            </ul>
			        </div><!-- end of row -->
			    </div><!-- end of container -->
			</section><!-- end of content -->
		<?php } ?>
		<?php get_template_part( 'contactform' ); ?>
<?php get_footer();?>