<?php
/**
 * ----------------------------------------------------------------------------------------
 * Add metabox for Main Points Company page
 * ----------------------------------------------------------------------------------------
 */
add_action( 'add_meta_boxes', 'add_main_company_points' );
add_action( 'admin_head-post.php', 'print_scripts_main_company_points' );
add_action( 'admin_head-post-new.php', 'print_scripts_main_company_points' );
add_action( 'save_post', 'update_post_main_company_points', 10, 2 );

function add_main_company_points()
{
  // Verify page template
  global $post;
  if (!empty($post)) {
    $pageTemplate = get_post_meta( $post->ID, '_wp_page_template', true );
    if ($pageTemplate == 'company-template.php' || $pageTemplate == 'career-template.php' ) {
      add_meta_box(
        'main_company_points',
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
function main_company_points_options()
{
  global $post;
  $main_company_points_data = get_post_meta( $post->ID, 'main_company_points_data', true );

  // Use nonce for verification
  wp_nonce_field( plugin_basename( __FILE__ ), 'main_company_points_nonce' );
?>

<div id="dynamic_main_company_points_form">
  <div id="main_company_points">
  <?php
  if ( isset( $main_company_points_data['point'] ) )
  { ?>
    <div class="field_row">
      <div class="field_left">
        <div id="main_point_wrap">
          <?php
          if (isset($main_company_points_data['point'])) {
            for( $i = 0; $i < count( $main_company_points_data['point'] ); $i++ )
              { ?>
              <div class="form_field">
                <label>Point <?php echo $i+1; ?></label>
                <textarea class="meta_main_company_points" name="main_company_points[point][]" cols="50" rows="2"><?php esc_html_e( $main_company_points_data['point'][$i] ); ?></textarea><br>
              </div>
            <?php } // endforeach
          }
          ?>
        </div>
      </div>

      <div class="field_right">
        <input class="button" type="button" value="Add Point" onclick="add_main_point_row();" /><br>
        <input class="button" type="button" value="Remove Point" onclick="remove_main_point_field()" />
      </div>

      <div class="clear" /></div>
    </div>
    <?php
  } // endif
  ?>
  </div>

  <div style="display:none" id="main_company_points_row">
    <div class="field_row">
      <div class="field_left">
        <div id="main_point_row">
          <div class="form_field">
            <label>Point</label>
            <textarea class="meta_main_company_points" name="main_company_points[point][]" cols="50" rows="2"></textarea>
          </div>
        </div>
      </div>
      <div class="clear"></div>
    </div>
  </div>

  <div id="add_main_company_points_row">
    <input class="button" type="button" value="Add Field" onclick="add_main_company_points_row();" />
    <input class="button" type="button" value="Remove Field" onclick="remove_main_company_points_row();" />
  </div>

</div>

  <?php
}

/**
 * Print styles and scripts
 */
function print_scripts_main_company_points()
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

    #dynamic_main_company_points_form {
    width:580px;
    }

    #dynamic_main_company_points_form input[type=text] {
    width:300px;
    }

    #dynamic_main_company_points_form .field_row {
    border:1px solid #999;
    margin-bottom:10px;
    padding:10px;
    }

    #dynamic_main_company_points_form label {
    padding:0 6px;
    }
  </style>

  <script type="text/javascript">

    function remove_main_point_field() {
      var point=jQuery('#main_point_wrap').children(":last");
      point.remove();
    }

    function add_main_point_row() {
      var point = jQuery('#main_point_row').html();
      jQuery(point).appendTo('#main_point_wrap');
    }

    function add_main_company_points_row() {
      var row = jQuery('#main_company_points_row').html();
      jQuery(row).appendTo('#main_company_points');
    }

    function remove_main_company_points_row() {
      var row = jQuery('#main_company_points').children(":last");
      row.remove();
    }
  </script>
  <?php
}

/**
 * Save post action, process fields
 */
function update_post_main_company_points( $post_id, $post_object )
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
    if ($pageTemplate !== 'company-template.php' && $pageTemplate !== 'career-template.php' ) {
      return;
    }
  }

  // Verify authenticity
  if ( !wp_verify_nonce( $_POST['main_company_points_nonce'], plugin_basename( __FILE__ ) ) )
    return;

  // Correct post type
  if ( 'page' != $_POST['post_type'] )
    return;

  if ( $_POST['main_company_points'] )
  {
    // Build array for saving post meta
    $main_company_points_data = array();
    for ($i = 0; $i < count( $_POST['main_company_points']['point'] ); $i++ )
    {
      if ( '' != $_POST['main_company_points']['point'][ $i ] )
      {
      $main_company_points_data['point'][] = sanitize_text_field($_POST['main_company_points']['point'][ $i ]);
      }
    }

    if ( $main_company_points_data )
      update_post_meta( $post_id, 'main_company_points_data', $main_company_points_data );
    else
      delete_post_meta( $post_id, 'main_company_points_data' );
  }
  // Nothing received, all fields are empty, delete option
  else
  {
    delete_post_meta( $post_id, 'main_company_points_data' );
  }
}
?>