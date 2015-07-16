<?php
/**
 * ----------------------------------------------------------------------------------------
 * Add metabox for Our Team
 * ----------------------------------------------------------------------------------------
 */
add_action( 'add_meta_boxes', 'add_fractal_employee' );
add_action( 'admin_head-post.php', 'print_scripts_team' );
add_action( 'admin_head-post-new.php', 'print_scripts_team' );
add_action( 'save_post', 'update_post_team', 10, 2 );

function add_fractal_employee()
{
  // Verify page template
  global $post;
  if (!empty($post)) {
    $pageTemplate = get_post_meta( $post->ID, '_wp_page_template', true );
    if ($pageTemplate == 'company-template.php') {
      add_meta_box(
        'fractal_employee',
        'Our Team',
        'fractal_employee_options',
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
function fractal_employee_options()
{
  global $post;
  $employee_data = get_post_meta( $post->ID, 'employee_data', true );

  // Use nonce for verification
  wp_nonce_field( plugin_basename( __FILE__ ), 'fractal_team_nonce' );
?>

<div id="team_dynamic_form">
  <div id="employee_wrap">
  <?php
  if ( isset( $employee_data['employee_image'] ) )
  {
    for( $i = 0; $i < count( $employee_data['employee_image'] ); $i++ )
    {
    ?>
    <div class="field_row">
      <div class="team_field_left">
        <div class="form_field">
          <label>Employee's photo</label>
          <input type="text"
             class="meta_employee_image"
             name="team[employee_image][]"
             value="<?php esc_html_e( $employee_data['employee_image'][$i] ); ?>"
          />
        </div>
        <div class="form_field">
          <label>Employee's Name</label>
          <input type="text"
             class="meta_employee_name"
             name="team[employee_name][]"
             value="<?php esc_html_e( $employee_data['employee_name'][$i] ); ?>"
          />
        </div>
        <div class="form_field">
          <label>Employee's Position</label>
          <input type="text"
             class="meta_employee_position"
             name="team[employee_position][]"
             value="<?php esc_html_e( $employee_data['employee_position'][$i] ); ?>"
          />
        </div>
        <div class="form_field">
          <label>About Employee</label>
          <textarea class="meta_employee_about" cols="28" rows="5" name="team[employee_about][]"><?php esc_html_e( $employee_data['employee_about'][$i] ); ?></textarea>
        </div>
      </div>

      <div class="team_field_right image_wrap">
      <img src="<?php esc_html_e( $employee_data['employee_image'][$i] ); ?>" height="48" width="48" />
      </div>

      <div class="team_field_right">
      <input class="button" type="button" value="Choose File" onclick="add_employee_image(this)" /><br />
      <input class="button" type="button" value="Remove" onclick="remove_employee_field(this)" />
      </div>

      <div class="team_clear" /></div>
    </div>
    <?php
    } // endforeach
  } // endif
  ?>
  </div>

  <div style="display:none" id="employee-row">
    <div class="field_row">
      <div class="team_field_left">
        <div class="form_field">
          <label>Employee's photo</label>
          <input class="meta_employee_image" value="" type="text" name="team[employee_image][]" />
        </div>
        <div class="form_field">
          <label>Employee's Name</label>
          <input class="meta_employee_name" value="" type="text" name="team[employee_name][]" />
        </div>
      <div class="form_field">
          <label>Employee's Position</label>
          <input class="meta_employee_position" value="" type="text" name="team[employee_position][]" />
        </div>
      <div class="form_field">
          <label>About Employee</label>
          <textarea class="meta_employee_about" cols="28" rows="5" name="team[employee_about][]"></textarea>
        </div>
      </div>
      <div class="team_field_right image_wrap">
      </div>
      <div class="team_field_right">
        <input type="button" class="button" value="Choose File" onclick="add_employee_image(this)" />
        <br />
        <input class="button" type="button" value="Remove" onclick="remove_employee_field(this)" />
      </div>
      <div class="team_clear"></div>
    </div>
  </div>

  <div id="add_employee_row">
    <input class="button" type="button" value="Add Field" onclick="add_employee_row();" />
  </div>

</div>

  <?php
}

/**
 * Print styles and scripts
 */
function print_scripts_team()
{
  // Check for correct post_type
  global $post;
  if( 'page' != $post->post_type )
    return;
  ?>
  <style type="text/css">
    .team_field_left {
    float:left;
    width: 80%;
    }

    .team_field_right {
    float:left;
    margin-left:10px;
    }

    .team_clear {
    clear:both;
    }

    /*#team_dynamic_form {
    width:280px;
    }*/

    #team_dynamic_form input[type=text] {
    width:100%;
    }

    #team_dynamic_form .field_row {
    border:1px solid #999;
    margin-bottom:10px;
    padding:10px;
    }

    #team_dynamic_form label {
    padding:0 6px;
    }
  </style>

  <script type="text/javascript">
    function add_employee_image(obj) {
      var parent=jQuery(obj).parent().parent('div.field_row');
      var inputField = jQuery(parent).find("input.meta_employee_image");

      tb_show('', 'media-upload.php?TB_iframe=true');

      window.send_to_editor = function(html) {
        var url = jQuery(html).find('img').attr('src');
        inputField.val(url);
        jQuery(parent)
        .find("div.image_wrap")
        .html('<img src="'+url+'" height="48" width="48" />');

        // inputField.closest('p').prev('.awdMetaImage').html('<img height=120 width=120 src="'+url+'"/><p>URL: '+ url + '</p>');

        tb_remove();
      };

      return false;
    }

    function remove_employee_field(obj) {
      var parent=jQuery(obj).parent().parent();
      parent.remove();
    }

    function add_employee_row() {
      var row = jQuery('#employee-row').html();
      jQuery(row).appendTo('#employee_wrap');
    }
  </script>
  <?php
}

/**
 * Save post action, process fields
 */
function update_post_team( $post_id, $post_object )
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
  if ( isset($_POST['fractal_team_nonce']) && !wp_verify_nonce( $_POST['fractal_team_nonce'], plugin_basename( __FILE__ ) ) )
    return;

  // Correct post type
  if ( 'page' != $_POST['post_type'] )
    return;

  if ( isset($_POST['team']) && $_POST['team'] )
  {
    // Build array for saving post meta
    $employee_data = array();
    for ($i = 0; $i < count( $_POST['team']['employee_image'] ); $i++ )
    {
      if ( '' != $_POST['team']['employee_image'][ $i ] )
      {
        $employee_data['employee_image'][]  = esc_url($_POST['team']['employee_image'][ $i ]);
        $employee_data['employee_name'][] = sanitize_text_field($_POST['team']['employee_name'][ $i ]);
        $employee_data['employee_position'][] = sanitize_text_field($_POST['team']['employee_position'][ $i ]);
        $employee_data['employee_about'][] = sanitize_text_field($_POST['team']['employee_about'][ $i ]);
      }
    }

    if ( $employee_data )
      update_post_meta( $post_id, 'employee_data', $employee_data );
    else
      delete_post_meta( $post_id, 'employee_data' );
  }
  // Nothing received, all fields are empty, delete option
  else
  {
    delete_post_meta( $post_id, 'employee_data' );
  }
}
?>