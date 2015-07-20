<?php
/**
 * Template name: Fractal Soft company
 */
?>

<?php get_header(); ?>

	<section class="banner">
		<div class="container text-uppercase">
			<ul>
				<li><?php the_title(); ?></li>
			</ul>
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

				<!-- if "why_fractal" heading is set - display this -->
				<?php
				if (get_post_meta(get_the_id(), 'why_fractal_data', true)) {
					$why_fractal_data = get_post_meta(get_the_id(), 'why_fractal_data', true);
				}
				if (isset($why_fractal_data['heading'][0])) {
					?>
					<div class="col-sm-4">
						<div class="text-top">
							<h3 class="text-center"><?php
							echo(strtoupper($why_fractal_data['heading'][0]));
							?></h3>
							<p>
								<?php if (isset($why_fractal_data['reason'][0]))
									echo($why_fractal_data['reason'][0]); ?>
							</p>
							<ul class="list">
								<?php
								if (isset($why_fractal_data['point'])) {
									for ($i=0; $i<count($why_fractal_data['point']); $i++) {
									echo "<li><i class='glyphicon glyphicon-ok-sign'></i> " . $why_fractal_data['point'][$i] . "</li>" ;
									}
								}
								?>
							</ul>
						</div><!-- end of text-top -->
					</div><!-- end of col-sm-4 -->
				<?php } else { ?>
				<!-- if "why_fractal" heading is NOT set - display this -->
					<div class="col-sm-4">
						<div class="text-top">
							<h3 class="text-center">WHY FRACTAL SOFT?</h3>
							<p>
								In today's tutorial I'am going to introduce you to Avocode, developed by the "eleven brave men and onebrave woman" of
								Source and recently released in the form of version 1.0.Avocode is an application which allows you:
							</p>
							<ul class="list">
								<li><i class="glyphicon glyphicon-ok-sign"></i> Psd and .sketch files</li>
								<li><i class="glyphicon glyphicon-ok-sign"></i> Wthout even opening Photoshop or Sketch</li>
								<li><i class="glyphicon glyphicon-ok-sign"></i> Developed by the "eleven brave</li>
								<li><i class="glyphicon glyphicon-ok-sign"></i> Going to introduce you to Avocode</li>
								<li><i class="glyphicon glyphicon-ok-sign"></i> Allows yoy to work with</li>
								<li><i class="glyphicon glyphicon-ok-sign"></i> Loday's tutorial I'm going to</li>
							</ul>
						</div><!-- end of text-top -->
					</div><!-- end of col-sm-4 -->
				<?php } ?>

				<!-- Main Company Points -->
				<div class="text-bottom col-sm-8">
					<?php
					$icons = ['fa fa-briefcase', 'fa fa-th-large', 'fa fa-truck', 'fa fa-trophy'];
					$main_points_data = get_post_meta( get_the_id(), 'main_points_data', true );
					$count = isset($main_points_data['point']) ? count($main_points_data['point']) : count($icons);
					for ($i=0; $i < $count ; $i++) {
						?>
						<div class="col-sm-12">
							<div class="col-sm-1">
								<?php
								if (isset($main_points_data['icon'][$i]) && $main_points_data['icon'][$i]) {
									echo '<img src="' . esc_url( $main_points_data['icon'][$i] ) . '" alt="">';
								} else {
									echo '<i class="' . $icons[$i % 4] . '"></i>';
								}
								?>
							</div>
							<div class="col-sm-11">
								<p>
									<?php
									if (isset($main_points_data['point'][$i])) {
										echo($main_points_data['point'][$i]);
									} else {
										echo "In today's tutorial I'am going to introduce you to Avocode, developed by the eleven brave men and onebrave.In today's tutorial I'am going to introduce you to Avocode, developed by the eleven brave men and onebrave.";
									}
									?>
								</p>
							</div>
						</div><!-- end of col-xs-12 -->
						<?php
					}
					?>
				</div><!-- end of Main Company Points -->

				<!-- Map Widget -->
				<div class="text-bottom col-sm-4">
					<div class="text-bottom-tabs">
						<ul class="nav nav-tabs">
							<li class="active"><a href="#">Ukraine</a></li>
							<li><a href="#">England</a></li>
						</ul>
						<div class="info">
							<p>
								<?php _e('Phone', 'fractal'); ?>: +38 (050) 353 88 42
							</p>
							<p>
								<?php _e('Email', 'fractal'); ?>: <a href="mailto:fractalsoft@gmail.com">fractalsoft@gmail.com</a>
							</p>
							<p class="paragraph">
								<?php _e('Address', 'fractal'); ?>: <span>Ukraine, Kyiv, Yasna, 5 St.</span>
							</p>
						</div> <!-- end of info -->
						<div id="map_canvas" style="width:100%; min-height: 200px"></div>
					</div>
				</div><!-- end of Map Widget -->
			</div><!-- end of row -->
		</div><!-- end of container -->
	</section><!-- end of about-us -->

	<!-- Insert "Our team" section if at least one member is set -->
	<?php
	if (get_post_meta(get_the_id(), 'employee_data', true)) {
		$employee_data = get_post_meta(get_the_id(), 'employee_data', true);
	}
	if ( isset($employee_data['employee_image']) ) {
		$count = count($employee_data['employee_image']);
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
										<div class="text-center">
											<img src="<?php echo $employee_data['employee_image'][$i]; ?>"/>
										</div>
										<?php if ($employee_data['employee_name'][$i])
											echo "<h2 class='text-center'>" . $employee_data['employee_name'][$i] . "</h2>" ; ?>
										<?php if ($employee_data['employee_position'][$i])
											echo "<p class='text-center'>" . $employee_data['employee_position'][$i] ."</p>" ; ?>
										<?php if ($employee_data['employee_about'][$i])
											echo "<div class='text-center resume'><p>" . $employee_data['employee_about'][$i] . "</p>" ; ?>
										</div>
									</div><!-- end of post -->
								<?php } ?>
							</div><!-- end of row -->
						</div><!-- end of container -->
					</section><!-- end of team -->
				</div><!-- end of row -->
			</div><!-- end of container -->
		</section><!-- end of team -->

	<!-- Insert DEFAULT "Our team" section if NO MEMBERS -->
	<?php } else { ?>
		<section class="team">
			<div class="container">
				<div class="row">
					<h1 class="text-center">Our team</h1>
				</div>
				<div class="row">
					<?php for ($i=1; $i<5; $i++) {
						?>
						<div class="post col-sm-6 col-md-6 col-lg-3">
							<div class="center">
								<img src="<?php echo IMAGES; ?>/foto.png"/>
							</div>
							<h2 class="text-center">Sem Con</h2>
							<p class="text-center">Director</p>
							<div class="resume">
								<p>
									Ently released in the form of version 1.0. Avocode is an application which allows you to  Photoshop or Sketch.
								</p>
							</div>
						</div><!-- end of post -->
						<?php
					} ?>
				</div><!-- end of row -->
			</div><!-- end of container -->
		</section><!-- end of team -->
	<?php } ?>

<?php get_template_part( 'contactform' ); ?>
<?php get_footer();?>