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
					<div class="col-md-9">
						<?php $icons = ['glyphicon glyphicon-camera', 'glyphicon glyphicon-bullhorn', 'fa fa-gavel'] ?>
						<?php
						?>
						<?php
						$main_points_data = get_post_meta(get_the_id(), 'main_points_data', true);
						if (isset($main_points_data['point'])) {
							for ($i=0; $i<count($main_points_data['point']); $i++) {
								?>
								<div class="blurb col-xs-12 col-sm-4">
									<div class="blurb-text">
										<?php
										if (isset($main_points_data['icon'][$i]) && $main_points_data['icon'][$i]) {
											echo '<div class="center"><img src="' . esc_url( $main_points_data['icon'][$i] ) . '" alt=""></div>';
										} else {
											echo '<div class="center"><i class="' . $icons[$i % 3] . '"></i></div>';
										}
										?>
										<p class="text-center">
										<?php echo($main_points_data['point'][$i]); ?>
										</p>
									</div>
								</div><!-- end of blurb -->
							<?php }
						} ?>
					</div>
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