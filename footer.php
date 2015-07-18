<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the "site-content" div and all content after.
 */
?>
<footer>
	<div class="container">
		<div class="row">
			<nav class="hidden-xs footer-navigation col-sm-7">

				<!-- Create Footer Nav Menu -->
				<?php do_action( 'wp_create_footer_nav_menu' ); ?>

			</nav>
			<div class="menu col-sm-5">
				<div class="col-sm-4 col-md-6">
					<h3><?php _e('Follow us:', 'fractal'); ?></h3>
				</div>
				<div class="col-sm-8 col-md-6">
					<ul class="nav nav-pills">
						<?php $options = (array)get_option('social_links');
						$icons = ['/facebook.png', '/twitter.png', '/linkedin.png', '/google.png'];
						for ($i=0; $i<count($icons); $i++) {
							?>
							<li><a href="<?php if ($options) echo esc_url(array_values($options)[$i]); else echo '#'; ?>"><img src="<?php echo IMAGES . $icons[$i]; ?>"></a></li>
							<?php
						}
						?>
						<!-- <li><a href="<?php echo esc_url($options['facebook']); ?>"><img src="<?php echo IMAGES; ?>/facebook.png"></a></li>
						<li><a href="<?php echo esc_url($options['twitter']); ?>"><img src="<?php echo IMAGES; ?>/twitter.png"></a></li>
						<li><a href="<?php echo esc_url($options['linked_in']); ?>"><img src="<?php echo IMAGES; ?>/linkedin.png"></a></li>
						<li><a href="<?php echo esc_url($options['google_plus']); ?>"><img src="<?php echo IMAGES; ?>/google.png"></a></li> -->
					</ul>
				</div>
			</div>
		</div><!-- end of row -->
		<div class="row">
			<p>&#169; <?php the_time( 'Y' ); ?> Fractal Soft, <?php _e('All rights reserved', 'fractal'); ?></p>
		</div>
	</div><!-- end of container -->
</footer>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<?php wp_footer(); ?>
</body>
</html>