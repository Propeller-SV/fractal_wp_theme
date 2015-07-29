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
						<?php $options = get_option( 'fractal_options' ); ?>
						<?php $accounts = ['facebook', 'twitter', 'linkedin', 'google']; ?>
						<?php for ($i=0; $i<count($accounts); $i++): ?>
							<li><a href="<?= isset($options[$accounts[$i]]) ? esc_url($options[$accounts[$i]]) : ''; ?>"><img src="<?= (isset($options[$accounts[$i] . '_icon']) && $options[$accounts[$i] . '_icon']) ? esc_url($options[$accounts[$i] . '_icon']) : IMAGES . '/' . $accounts[$i] . '.png'; ?>"></a></li>
						<?php endfor; ?>
					</ul>
				</div>
			</div>
		</div><!-- end of row -->
		<div class="row">
			<p>&#169; <?php the_time( 'Y' ); ?> Fractal Soft, <?php _e('All rights reserved', 'fractal'); ?></p>
		</div>
	</div><!-- end of container -->
</footer>
<?php wp_footer(); ?>
</body>
</html>