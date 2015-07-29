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
					<?php $icons = ['glyphicon glyphicon-camera', 'glyphicon glyphicon-bullhorn', 'fa fa-gavel']; ?>
					<?php $main_points_data = get_post_meta(get_the_id(), 'main_points_data', true); ?>
					<?php $count = isset($main_points_data['point']) ? count($main_points_data['point']) : count($icons); ?>
					<?php for ($i=0; $i<$count; $i++): ?>
						<div class="blurb col-xs-12 col-sm-4">
							<div class="blurb-text">
								<div class="center">
									<?= (isset($main_points_data['icon'][$i]) && $main_points_data['icon'][$i]) ? '<img src="' . esc_url( $main_points_data['icon'][$i] ) . '" alt="">' : '<i class="' . $icons[$i % 3] . '"></i>'; ?>
								</div>
								<p class="text-center">
									<?= isset($main_points_data['point'][$i]) ? $main_points_data['point'][$i] : 'Print this page to PDF for the complete set of vectors. Or to use on the desktop, install FontAwesome.otf, set it as the font in your application, and copy and paste the icons (notthe unicode) directly from this page into your designs.'; ?>
								</p>
							</div>
						</div><!-- end of blurb -->
					<?php endfor; ?>
				</div>
				<div class="photofit col-xs-12 col-sm-3">
					<img src="<?= IMAGES; ?>/banner-foto.png"/>
				</div>
			</div><!-- end of row -->
			<img src="<?= IMAGES; ?>/banner-background-top.png" class="banner-background-top"/>
		</div><!-- end of career -->
	</div><!-- end of container -->
</section><!-- end of growth -->
<?php get_template_part( 'contactform' ); ?>
<?php get_footer();?>