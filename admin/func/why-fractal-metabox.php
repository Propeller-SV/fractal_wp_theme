<?php
/**
 * ----------------------------------------------------------------------------------------
 * Add metabox for "Why Fractal" section
 * ----------------------------------------------------------------------------------------
 */
add_action( 'add_meta_boxes', 'add_why_fractal' );
add_action( 'admin_head-post.php', 'print_scripts_why_fractal' );
add_action( 'admin_head-post-new.php', 'print_scripts_why_fractal' );
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
  wp_nonce_field( plugin_basename( __FILE__ ), 'why_fractal_nonce' );
?>

<div id="dynamic_form">
  <div id="why_fractal_wrap">
  <?php
  if ( isset( $why_fractal_data['heading'] ) )
  { ?>
    <div class="field_row">
      <div class="field_left">
        <div class="form_field">
          <label>Heading</label>
          <input type="text"
             class="meta_why_fractal_heading"
             name="why_fractal[heading][]"
             value="<?php esc_html_e( $why_fractal_data['heading'][0] ); ?>"
          />
        </div>
        <div class="form_field">
          <label>Reason</label>
          <textarea class="meta_why_fractal_reason" name="why_fractal[reason][]" cols="40" rows="5"><?php esc_html_e( $why_fractal_data['reason'][0] ); ?></textarea>
        </div>
        <div id="point_wrap">
          <?php
          if (isset($why_fractal_data['point'])) {
            for( $i = 0; $i < count( $why_fractal_data['point'] ); $i++ )
              { ?>
              <div class="form_field">
                <label>Point <?php echo $i+1; ?></label>
                <input type="text"
                   class="meta_why_fractal_point"
                   name="why_fractal[point][]"
                   value="<?php esc_html_e( $why_fractal_data['point'][$i] ); ?>"
                />
              </div>
            <?php } // endforeach
          }
          ?>
        </div>
      </div>

      <div class="field_right">
        <input class="button" type="button" value="Add Point" onclick="add_point_row();" /><br>
        <input class="button" type="button" value="Remove Point" onclick="remove_point_field()" />
      </div>

      <div class="clear" /></div>
    </div>
    <?php
  } // endif
  ?>
  </div>

  <div style="display:none" id="why_fractal_row">
    <div class="field_row">
      <div class="field_left">
        <div class="form_field">
          <label>Heading</label>
          <input class="meta_why_fractal_heading" value="" type="text" name="why_fractal[heading][]" />
        </div>
        <div class="form_field">
          <label>Reason</label>
          <textarea class="meta_why_fractal_reason" name="why_fractal[reason][]" id="" cols="40" rows="5"></textarea>
        </div>
        <div id="point_row">
          <div class="form_field">
            <label>Point</label>
            <input class="meta_why_fractal_point" value="" type="text" name="why_fractal[point][]" />
          </div>
        </div>
      </div>
      <div class="field_right">
        <input class="button" type="button" value="Add Point" onclick="add_point_row();" /><br>
        <input class="button" type="button" value="Remove Point" onclick="remove_point_field()" />
      </div>
      <div class="clear"></div>
    </div>
  </div>

  <div id="add_why_fractal_row">
    <input class="button" type="button" value="Add Field" onclick="add_why_fractal_row();" />
    <input class="button" type="button" value="Remove Field" onclick="remove_why_fractal_row();" />
  </div>

</div>

  <?php
}

/**
 * Print styles and scripts
 */
function print_scripts_why_fractal()
{
  // Check for correct post_type
  global $post;
  if( 'page' != $post->post_type )
    return;
  ?>
  <style type="text/css">
    .field_left {
    float:left;
    }

    .field_right {
    float:left;
    margin-left:10px;
    }

    .clear {
    clear:both;
    }

    #dynamic_form {
    width:580px;
    }

    #dynamic_form input[type=text] {
    width:300px;
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

    function remove_point_field() {
      var point=jQuery('#point_wrap').children(":last");
      point.remove();
    }

    function add_point_row() {
      var point = jQuery('#point_row').html();
      jQuery(point).appendTo('#point_wrap');
    }

    function add_why_fractal_row() {
      var row = jQuery('#why_fractal_row').html();
      jQuery(row).appendTo('#why_fractal_wrap');
    }

    function remove_why_fractal_row() {
      var row = jQuery('#why_fractal_wrap').children(":last");
      row.remove();
    }
  </script>
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
  if ( !wp_verify_nonce( $_POST['why_fractal_nonce'], plugin_basename( __FILE__ ) ) )
    return;

  // Correct post type
  if ( 'page' != $_POST['post_type'] )
    return;

  if ( $_POST['why_fractal'] )
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