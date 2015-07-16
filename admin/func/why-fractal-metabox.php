<?php
/**
 * ----------------------------------------------------------------------------------------
 * Add metabox for "Why Fractal" section
 * ----------------------------------------------------------------------------------------
 */
add_action( 'add_meta_boxes', 'add_why_fractal' );
add_action( 'save_post', 'update_post_why_fractal', 10, 2 );

function add_why_fractal()
{
  // Verify page template
  global $post;
  if (!empty($post)) {
    $pageTemplate = get_post_meta( $post->ID, '_wp_page_template', true );
    if ($pageTemplate == 'company-template.php') {
      add_meta_box(
        'why_fractal',
        'Why Fractal Soft',
        'why_fractal_options',
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
function why_fractal_options()
{
  global $post;
  $why_fractal_data = get_post_meta( $post->ID, 'why_fractal_data', true );

  // Use nonce for verification
  wp_nonce_field( basename( __FILE__ ), 'why_fractal_nonce' );
?>

<div>
  <div>
    <label>Heading</label>
    <input type="text"
       name="why_fractal[heading][]"
       value="<?php if (isset($why_fractal_data['heading'][0])) echo $why_fractal_data['heading'][0]; else echo '';?>"
    />
  </div>
  <div>
    <label>Reason</label>
    <textarea name="why_fractal[reason][]" cols="30" rows="5"><?php if (isset($why_fractal_data['reason'][0])) echo $why_fractal_data['reason'][0]; else echo ''; ?></textarea>
  </div>
  <div id="point_wrap">
    <?php
    if (isset($why_fractal_data['point'])) {
      for( $i = 0; $i < count( $why_fractal_data['point'] ); $i++ )
        { ?>
        <div>
          <label>Point <?php echo $i+1; ?></label>
          <input type="text"
             class="meta_why_fractal_point"
             name="why_fractal[point][]"
             value="<?php if (isset($why_fractal_data['point'][$i])) echo $why_fractal_data['point'][$i]; else echo ''; ?>"
          />
          <input class="button" type="button" value="Remove Point" onclick="jQuery(this).closest('div').remove();" />
        </div>
      <?php } // endforeach
    }
    ?>
    <div id="points_row">
      <div>
        <label>Point</label>
        <input class="meta_why_fractal_point" value="" type="text" name="why_fractal[point][]" />
      </div>
    </div>
  </div>
</div>

<div style="clear:both">
  <input class="button" type="button" value="Add Point" onclick="jQuery('#point_wrap').append(jQuery('#points_row').html());" />
</div>

<?php
}

/**
 * Save post action, process fields
 */
function update_post_why_fractal( $post_id, $post_object )
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
    if ($pageTemplate !== 'company-template.php') {
      return;
    }
  }

  // Verify authenticity
  if ( isset($_POST['why_fractal_nonce']) && !wp_verify_nonce( $_POST['why_fractal_nonce'], basename( __FILE__ ) ) )
    return;

  // Correct post type
  if ( 'page' != $_POST['post_type'] )
    return;

  if ( isset($_POST['why_fractal']) && $_POST['why_fractal'] )
  {
    // Build array for saving post meta
    $why_fractal_data = array();
        $why_fractal_data['heading'][]  = sanitize_text_field($_POST['why_fractal']['heading'][0]);
        $why_fractal_data['reason'][] = sanitize_text_field($_POST['why_fractal']['reason'][0]);
        for ($i = 0; $i < count( $_POST['why_fractal']['point'] ); $i++ )
        {
          if ( '' != $_POST['why_fractal']['point'][ $i ] )
          {
        $why_fractal_data['point'][] = sanitize_text_field($_POST['why_fractal']['point'][ $i ]);
      }
    }

    if ( $why_fractal_data )
      update_post_meta( $post_id, 'why_fractal_data', $why_fractal_data );
    else
      delete_post_meta( $post_id, 'why_fractal_data' );
  }
  // Nothing received, all fields are empty, delete option
  else
  {
    delete_post_meta( $post_id, 'why_fractal_data' );
  }
}
?>