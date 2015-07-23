<?php $background = get_option( 'fractal_options' )['contactform_background_image']; ?>
<section class="contact" <?php echo (isset($background) && $background) ? 'style="background-image: url(' . $background . ')"' : ''; ?>>
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-12">
				<h2 class="text-center"><?php _e( 'Contact Us', 'fractal' );?></h2>
			</div>
			<form class="contact-form" action="<?php echo esc_url( $_SERVER['REQUEST_URI'] ); ?>" method="post">
				<div class="col-xs-12 col-sm-4 input-group-lg">
					<input type="text" class="form-control" name="cf-name" pattern="[a-zA-Z0-9 ]+" value="<?php echo ( isset( $_POST["cf-name"] ) ? esc_attr( $_POST["cf-name"] ) : '' ); ?>" placeholder="<?php _e('Your Name', 'fractal'); ?>" required>
				</div>
				<div class="col-xs-12 col-sm-4 input-group-lg">
					<input type="email" class="form-control" name="cf-email" value="<?php echo ( isset( $_POST["cf-email"] ) ? esc_attr( $_POST["cf-email"] ) : '' ); ?>" placeholder="<?php _e('Email', 'fractal'); ?>" required>
				</div>
				<div class="col-xs-12 col-sm-4 input-group-lg">
					<input type="tel" class="form-control" name="cf-phone" pattern="^[ 0-9]+$" value="<?php echo ( isset( $_POST["cf-phone"] ) ? esc_attr( $_POST["cf-phone"] ) : '' ); ?>" placeholder="<?php _e('Phone', 'fractal'); ?>" />
				</div>
				<div class="col-xs-12 col-sm-12 comments">
					<textarea type="text" class="main_input_height form-control" placeholder="<?php _e('Your Message', 'fractal'); ?>" name="cf-message"><?php echo ( isset( $_POST["cf-message"] ) ? esc_attr( $_POST["cf-message"] ) : '' ); ?></textarea>
				</div>
				<div class="pin col-xs-12 col-sm-12">
					<p class="text-center">
						<input class="text-uppercase" type="submit" name="cf-submitted" value="<?php _e('send', 'fractal');?>"/>
					</p>

					<!-- Modal -->
					<div>
						<button type="button" class="btn btn-primary success hidden" data-toggle="modal" data-target=".bs-example-modal-md">Small modal</button>

						<div class="modal fade bs-example-modal-md" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
							<div class="modal-dialog modal-sm">
								<div class="modal-content" style="color: black">
									<p><?php _e('Thanks for contacting us, expect a response soon.', 'fractal'); ?></p>
								</div>
							</div>
						</div>
					</div>
					<div>
						<button type="button" class="btn btn-primary error hidden" data-toggle="modal" data-target=".bs-example-modal-sm">Small modal</button>

						<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
							<div class="modal-dialog modal-sm">
								<div class="modal-content" style="color: black">
									<p><?php _e('An unexpected error occurred.', 'fractal'); ?></p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</form>
		</div><!-- end of row -->
	</div><!-- end of container -->
</section><!-- end of contact -->