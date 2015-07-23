<?php
/**
 * ----------------------------------------------------------------------------------------
 * Add metabox for customers
 * ----------------------------------------------------------------------------------------
 */

function add_fractal_customer() {
	// Verify page template
	global $post;
	if (!empty($post)) {
		$pageTemplate = get_post_meta( $post->ID, '_wp_page_template', true );
		if ($pageTemplate == 'home-template.php') {
			add_meta_box(
				'fractal_customer',
				'Our Customers',
				'fractal_customers_options',
				'page',
				'normal',
				'core'
			);
		}
	}
}

/**
 * Print the Meta Box content
 */
function fractal_customers_options() {
	global $post;
	$our_customers_data = get_post_meta( $post->ID, 'our_customers_data', true );

	// Use nonce for verification
	wp_nonce_field( plugin_basename( __FILE__ ), 'fractal_customers_nonce' );
?>

<div id="dynamic_form">
	<div id="field_wrap">
	<?php
	if ( isset( $our_customers_data['image_url'] ) ) {
		for( $i = 0; $i < count( $our_customers_data['image_url'] ); $i++ ) {
		?>
		<div class="field_row">
			<div class="field_left">
				<div class="form_field">
					<label><?php _e('Logo URL', 'fractal'); ?></label>
					<input type="text"
						class="meta_image_url"
						name="gallery[image_url][]"
						value="<?php esc_html_e( $our_customers_data['image_url'][$i] ); ?>"
					/>
				</div>
				<div class="form_field">
					<label><?php _e('Link', 'fractal'); ?></label>
					<input type="text"
						class="meta_image_desc"
						name="gallery[hyperlink][]"
						value="<?php esc_html_e( $our_customers_data['hyperlink'][$i] ); ?>"
					/>
				</div>
			</div>

			<div class="field_right image_wrap">
				<img src="<?php esc_html_e( $our_customers_data['image_url'][$i] ); ?>" height="48" width="48" />
			</div>

			<div class="field_right">
				<input class="button" type="button" value="<?php _e('Choose File', 'fractal'); ?>" onclick="add_customer_image(this)" /><br />
				<input class="button" type="button" value="<?php _e('Remove Field', 'fractal'); ?>" onclick="remove_field(this)" />
			</div>

			<div class="clear" /></div>
		</div>
		<?php
		} // endforeach
	} // endif
	?>
	</div>

	<div style="display:none" id="master-row">
		<div class="field_row">
			<div class="field_left">
				<div class="form_field">
					<label><?php _e('Logo URL', 'fractal'); ?></label>
					<input class="meta_image_url" value="" type="text" name="gallery[image_url][]" />
				</div>
				<div class="form_field">
					<label><?php _e('Link', 'fractal'); ?></label>
					<input class="meta_image_desc" value="" type="text" name="gallery[hyperlink][]" />
				</div>
			</div>
			<div class="field_right image_wrap">
			</div>
			<div class="field_right">
				<input type="button" class="button" value="<?php _e('Choose File', 'fractal'); ?>" onclick="add_customer_image(this)" />
				<br />
				<input class="button" type="button" value="<?php _e('Remove Field', 'fractal'); ?>" onclick="remove_field(this)" />
			</div>
			<div class="clear"></div>
		</div>
	</div>

	<div id="add_field_row">
		<input class="button" type="button" value="<?php _e('Add Field', 'fractal'); ?>" onclick="add_field_row();" />
	</div>

</div>

	<?php
}

/**
 * Print styles and scripts
 */
function print_scripts() {
	// Check for correct post_type
	global $post;
	if( 'page' != $post->post_type )
		return;
	?>
	<style type="text/css">
		.field_left {
		float:left;
		width: 80%;
		}

		.field_right {
		float:left;
		margin-left:10px;
		}

		.clear {
		clear:both;
		}

		#dynamic_form input[type=text] {
		width:100%;
		}

		#dynamic_form .field_row {
		border:1px solid #999;
		margin-bottom:10px;
		padding:10px;
		}

		#dynamic_form label {
		padding:0 6px;
		}
	</style>

	<script type="text/javascript">
		function add_customer_image(obj) {
			var parent=jQuery(obj).parent().parent('div.field_row');
			var inputField = jQuery(parent).find("input.meta_image_url");

			tb_show('', 'media-upload.php?TB_iframe=true');

			window.send_to_editor = function(html) {
				var url = jQuery(html).find('img').attr('src');
				inputField.val(url);
				jQuery(parent)
				.find("div.image_wrap")
				.html('<img src="'+url+'" height="48" width="48" />');

				tb_remove();
			};

			return false;
		}

		function remove_field(obj) {
			var parent=jQuery(obj).parent().parent();
			parent.remove();
		}

		function add_field_row() {
			var row = jQuery('#master-row').html();
			jQuery(row).appendTo('#field_wrap');
		}
	</script>
	<?php
}

/**
 * Save post action, process fields
 */
function update_post_gallery( $post_id, $post_object )
{
	// Doing revision, exit earlier **can be removed**
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
		return;

	// Doing revision, exit earlier
	if ( 'revision' == $post_object->post_type )
		return;

	// Verify page template
	global $post;
	if (!empty($post)) {
		$pageTemplate = get_post_meta( $post->ID, '_wp_page_template', true );
		if ($pageTemplate !== 'home-template.php') {
			return;
		}
	}

	// Verify authenticity
	if ( isset($_POST['fractal_customers_nonce']) && !wp_verify_nonce( $_POST['fractal_customers_nonce'], plugin_basename( __FILE__ ) ) )
		return;

	// Correct post type
	if ( isset($_POST['post_type']) && 'page' != $_POST['post_type'] )
		return;

	if ( isset($_POST['gallery']) && $_POST['gallery'] ) {
		// Build array for saving post meta
		$our_customers_data = array();
		for ($i = 0; $i < count( $_POST['gallery']['image_url'] ); $i++ ) {
			if ( '' != $_POST['gallery']['image_url'][ $i ] ) {
				$our_customers_data['image_url'][]  = esc_url($_POST['gallery']['image_url'][ $i ]);
				$our_customers_data['hyperlink'][] = esc_url($_POST['gallery']['hyperlink'][ $i ]);
			}
		}

		if ( $our_customers_data )
			update_post_meta( $post_id, 'our_customers_data', $our_customers_data );
		else
			delete_post_meta( $post_id, 'our_customers_data' );
	}
	// Nothing received, all fields are empty, delete option
	else {
		delete_post_meta( $post_id, 'our_customers_data' );
	}
}

add_action( 'add_meta_boxes', 'add_fractal_customer' );
add_action( 'admin_head-post.php', 'print_scripts' );
add_action( 'admin_head-post-new.php', 'print_scripts' );
add_action( 'save_post', 'update_post_gallery', 10, 2 );
