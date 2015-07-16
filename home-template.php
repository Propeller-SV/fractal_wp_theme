<?php
/**
 * Template name: Fractal Soft homepage
 */
?>

<?php get_header(); ?>

	<section id="carousel-slides">
		<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">

			<!-- Indicators -->
			<ul class="carousel-indicators">
				<li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
				<li data-target="#carousel-example-generic" data-slide-to="1"></li>
				<li data-target="#carousel-example-generic" data-slide-to="2"></li>
			</ul>

			<!-- Wrapper for slides -->
			<div class="carousel-inner" role="listbox">
				<div class="item active">
					<img class="img-responsive" src="<?php echo IMAGES; ?>/slide-1.png" alt="...">
					<div class="carousel-caption">
						<h1 class="text-left">How Well Do<br>Know Your Partner?</h1>
						<p class="text-left">JUST ONE CLICKAWAY</p>
						<p><a href="#" role="button" class="pull-left">Check</a></p>
					</div>
				</div>
				<div class="item">
					<img class="img-responsive" src="<?php echo IMAGES; ?>/slide-2.png" alt="...">
					<div class="carousel-caption">
						<h1 class="text-left">How Well Do<br>Know Your Partner?</h1>
						<p class="text-left">JUST ONE CLICKAWAY</p>
						<p><a href="#" role="button" class="pull-left">Check</a></p>
					</div>
				</div>
				<div class="item">
					<img class="img-responsive" src="<?php echo IMAGES; ?>/slide-3.png" alt="...">
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
				<?php $currentlang = substr(get_bloginfo('language'), 0, 2); ?>
				<?php $loop = new WP_Query(array('post_type' => 'page', 'lang' => $currentlang, 'posts_per_page' => 3, 'orderby' => 'menu_order', 'order'=>'ASC')); ?>
				<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
					<div class="col-sm-4">
						<div class="about">
							<?php the_post_thumbnail(); ?>
							<h2><?php the_title(); ?></h2>
							<?php the_excerpt(); ?>
							<p class="learn-more-link"><a href="<?php the_permalink(); ?>"><?php _e('Learn More', 'fractal'); ?></a></p>
						</div><!-- end of about -->
					</div><!-- end of col-sm-4 -->
				<?php endwhile; ?>
				<?php wp_reset_postdata(); ?>
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

	<!-- Insert "Our Customers" section if at least one member is set -->
	<?php
	if (get_post_meta(get_the_id(), 'our_customers_data', true)) {
		$our_customers_data = get_post_meta(get_the_id(), 'our_customers_data', true);
	}
	if ( isset($our_customers_data['image_url']) ) {
        $count = count($our_customers_data['image_url']);
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
							echo "<li class='col-sm-6 col-md-3 text-center'><a href='" . esc_url($our_customers_data['hyperlink'][$i]) . "'><img src='" . esc_url($our_customers_data['image_url'][$i]) . "' alt='Customer'></a></li>";
						}
						?>
					</ul>
				</div><!-- end of row -->
			</div><!-- end of container -->
		</section><!-- end of content -->

	<!-- Insert DEFAULT "Our team" section if NO MEMBERS -->
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