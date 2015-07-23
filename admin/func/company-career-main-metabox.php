<?php
/**
 * ----------------------------------------------------------------------------------------
 * Add metabox for Main Points Company page
 * ----------------------------------------------------------------------------------------
 */

function add_main_points() {
	// Verify page template
	global $post;
	if (!empty($post)) {
	$pageTemplate = get_post_meta( $post->ID, '_wp_page_template', true );
		if ($pageTemplate == 'company-template.php' || $pageTemplate == 'career-template.php' ) {
			add_meta_box(
			'main_points_area',
			'Main Company & Career Points',
			'main_company_points_options',
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
function main_company_points_options() {
	global $post;
	$main_points_data = get_post_meta( $post->ID, 'main_points_data', true );

	// Use nonce for verification
	wp_nonce_field( basename( __FILE__ ), 'main_company_points_nonce' );
	?>

	<div>
		<div id="main_points">
		<?php
		if (isset($main_points_data['point'])) {
			for( $i = 0; $i < count( $main_points_data['point'] ); $i++ )
				{ ?>
				<div class="main_point" style="border : 1px solid">
					<label for="point-<?php echo $i+1 ?>">Point <?php echo $i+1; ?>:</label>
					<textarea id="point-<?php echo $i+1 ?>" name="main_points[point][]" cols="30" rows="2"><?php esc_html_e( $main_points_data['point'][$i] ); ?></textarea>
					<input class="button" type="button" value="<?php _e('Remove Point', 'fractal'); ?>" onclick="jQuery(this).closest('div').remove();" />
					<input type="text" class="main_point_icon" name="main_points[icon][]" value="<?php echo isset($main_points_data['icon'][$i]) ? esc_url( $main_points_data['icon'][$i] ) : ''; ?>" placeholder="<?php _e('Select icon', 'fractal'); ?>" size="80" />
					<input class="button" type="button" value="<?php _e('Add icon', 'fractal'); ?>" onclick="add_point_icon(this)" />
					<div class="point_icon_wrap"><img src="<?php echo isset($main_points_data['icon'][$i]) ? esc_url( $main_points_data['icon'][$i] ) : ''; ?>" height="32" width="32" /></div>
				</div>
			<?php } // endforeach
		} ?> <!-- endif -->
		</div> <!-- end #main_points -->

		<div id="main_points_row" style="clear:both; display:none">
			<div class="main_point" style="border : 1px solid">
				<label><?php _e('Point', 'fractal'); ?></label>
				<textarea name="main_points[point][]" cols="30" rows="2"></textarea>
				<input class="button" type="button" value="<?php _e('Remove Point', 'fractal'); ?>" onclick="jQuery(this).closest('div').remove();" />
				<input type="text" class="main_point_icon" name="main_points[icon][]" value="" placeholder="<?php _e('Select icon', 'fractal'); ?>" size="80" />
				<input class="button" type="button" value="<?php _e('Add icon', 'fractal'); ?>" onclick="add_point_icon(this)" />
				<div class="point_icon_wrap"></div>
			</div>
		</div>

		<div>
			<input class="button" type="button" value="<?php _e('Add Point', 'fractal'); ?>" onclick="jQuery('#main_points').append(jQuery('#main_points_row').html());" />
		</div>
	</div>

	<?php
}

/**
 * Print the Meta Box scripts
 */

function print_main_metabox_scripts() {

// Check for correct post_type
global $post;
if( 'page' != $post->post_type )
	return;
?>
<script type="text/javascript">
	function add_point_icon(obj) {
		var parent=jQuery(obj).parent('div.main_point');
		var inputField = jQuery(parent).find("input.main_point_icon");

		tb_show('', 'media-upload.php?TB_iframe=true');

		window.send_to_editor = function(html) {
			var url = jQuery(html).find('img').attr('src');
			inputField.val(url);
			jQuery(parent)
			.find("div.point_icon_wrap")
			.html('<img src="'+url+'" height="48" width="48" />');

			tb_remove();
		};
	return false;
	}
</script>
<?php
}

/**
 * Save post action, process fields
 */
function update_post_main_points( $post_id, $post_object ) {
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
		if ($pageTemplate !== 'company-template.php' && $pageTemplate !== 'career-template.php' ) {
		  return;
		}
	}

	// Verify authenticity
	if ( isset($_POST['main_company_points_nonce']) && !wp_verify_nonce( $_POST['main_company_points_nonce'], basename( __FILE__ ) ) )
		return;

	// Correct post type
	if ( isset($_POST['post_type']) && 'page' != $_POST['post_type'] )
		return;

	if ( isset($_POST['main_points']) && $_POST['main_points'] ) {
		// Build array for saving post meta
		$main_points_data = array();
		for ($i = 0; $i < count( $_POST['main_points']['point'] ); $i++ ) {
			if ( '' != $_POST['main_points']['point'][ $i ] ) {
				$main_points_data['point'][] = sanitize_text_field($_POST['main_points']['point'][ $i ]);
				$main_points_data['icon'][] = esc_url_raw($_POST['main_points']['icon'][ $i ]);
			}
		}

		if ( $main_points_data )
			update_post_meta( $post_id, 'main_points_data', $main_points_data );
		else
			delete_post_meta( $post_id, 'main_points_data' );
	}
	// Nothing received, all fields are empty, delete option
	else {
		delete_post_meta( $post_id, 'main_points_data' );
	}
}

add_action( 'add_meta_boxes', 'add_main_points' );
add_action( 'admin_head-post.php', 'print_main_metabox_scripts' );
add_action( 'save_post', 'update_post_main_points', 10, 2 );
