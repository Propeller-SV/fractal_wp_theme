<?php
/**
 * Theme functions and definitions
 */

/**
 * ----------------------------------------------------------------------------------------
 * Define constants.
 * ----------------------------------------------------------------------------------------
 */
define( 'THEMEROOT', get_stylesheet_directory_uri() );
define( 'IMAGES', THEMEROOT . '/img' );
define( 'SCRIPTS', THEMEROOT . '/js' );
define( 'THEMEADMIN', TEMPLATEPATH . '/admin' );
define( 'THEMEFUNC', TEMPLATEPATH . '/admin/func' );

/**
 * ----------------------------------------------------------------------------------------
 * Load custom menu locations
 * ----------------------------------------------------------------------------------------
 */
require_once(THEMEFUNC . '/menus/menus.php');

/**
 * ----------------------------------------------------------------------------------------
 * Create default pages and posts
 * ----------------------------------------------------------------------------------------
 */
require_once(THEMEFUNC . '/default_posts_and_pages.php');

/**
 * ----------------------------------------------------------------------------------------
 * Include the Plugin Activation function.
 * ----------------------------------------------------------------------------------------
 */
require_once THEMEFUNC . '/psv-install-plugins.php';

/**
 * ----------------------------------------------------------------------------------------
 * Include the function to add languges to Polylang plugin.
 * ----------------------------------------------------------------------------------------
 */
require_once THEMEFUNC . '/add-languages-polylang.php';

/**
 * ----------------------------------------------------------------------------------------
 * Include the functions for metaboxes.
 * ----------------------------------------------------------------------------------------
 */
require_once THEMEFUNC . '/add-customer-metabox.php';
require_once THEMEFUNC . '/our-team-metabox.php';
require_once THEMEFUNC . '/why-fractal-metabox.php';
require_once THEMEFUNC . '/company-career-main-metabox.php';

/**
 * ----------------------------------------------------------------------------------------
 * Set the content width based on the theme's design and stylesheet.
 * ----------------------------------------------------------------------------------------
 */
if ( ! isset( $content_width ) ) {
	$content_width = 800;
}

/**
 * ----------------------------------------------------------------------------------------
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 * ----------------------------------------------------------------------------------------
 */
if ( ! function_exists( 'fractalsoft_theme_setup' ) ) :
	function fractalsoft_theme_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 */
		// $lang_dir = THEMEROOT . '/languages/';
		// load_theme_textdomain( 'fractal', $lang_dir );
		load_theme_textdomain( 'fractal', get_template_directory() . '/languages' );

		/*
		 *Enable support for Post Thumbnails on posts and pages.
		 */
		add_theme_support( 'post-thumbnails' );

	}
endif; // fractalsoft_theme_setup
add_action( 'after_setup_theme', 'fractalsoft_theme_setup' );

/**
 * ----------------------------------------------------------------------------------------
 * Register the widget area.
 * ----------------------------------------------------------------------------------------
 */
if ( ! function_exists( 'fractal_widgets_init' ) ) {
	function fractal_widgets_init() {
		register_sidebar( array(
			'name'			=> __( 'Right Widget Area', 'fractal' ),
			'id'			=> 'sidebar-1',
			'description'	=> __( 'Add widgets here to appear in your sidebar.', 'fractal' ),
			'before_widget'	=> '',
			'after_widget'	=> '',
			'before_title'	=> '<h3 class="text-center text-uppercase">',
			'after_title'	=> '</h3>',
			) );
	}
	add_action( 'widgets_init', 'fractal_widgets_init' );
}

/**
 * ----------------------------------------------------------------------------------------
 * Load styles and scripts
 * ----------------------------------------------------------------------------------------
 */
function current_theme_resources()
{
	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css' );
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/font-awesome-4.3.0/css/font-awesome.min.css' );
	wp_enqueue_style( 'style', get_stylesheet_uri() );

	wp_enqueue_script( 'custom-script', SCRIPTS . '/bootstrap.min.js', array( 'jquery' ) );
	wp_enqueue_script( 'bootstrap-jquery', SCRIPTS . '/jquery.min.js' );

	wp_register_script( 'common-fractal', SCRIPTS . '/common.js' );
	wp_localize_script( 'common-fractal', 'WPDATA', array( 'templateUrl' => get_bloginfo( 'template_url' ), 'address' => get_option('fractal_options')['address'], 'how_to_get' => get_option('fractal_options')['how_to_get'] ) );
	wp_enqueue_script( 'common-fractal' );
	wp_enqueue_script('google-maps', 'http://maps.google.com/maps/api/js?sensor=false', NULL, NULL);
}

add_action( 'wp_enqueue_scripts', 'current_theme_resources' );

/**
 * ----------------------------------------------------------------------------------------
 * Contact form
 * ----------------------------------------------------------------------------------------
 */
function deliver_mail() {

	// if the submit button is clicked, send the email
	if ( isset( $_POST['cf-submitted'] ) ) {

		// sanitize form values
		$name		= sanitize_text_field( $_POST["cf-name"] );
		$email		= sanitize_email( $_POST["cf-email"] );
		$phone		= preg_replace('/[^0-9]/', '', $_POST["cf-phone"] );
		$subject	= 'Fractal Soft response';
		$message	= "From: $name <$email>, $phone" . "\r\n" . esc_textarea( $_POST["cf-message"] );

		// get the blog administrator's email address
		$to = get_option( 'admin_email' );

		$headers = "From: $name <$email>, $phone" . "\r\n";

		// If email has been process for sending, display a success message
		if ( wp_mail( $to, $subject, $message, $headers ) ) {

			echo "<script type='text/javascript'>alert('Thanks for contacting us, expect a response soon.')</script>";

		} else {
			echo "<script type='text/javascript'>alert('An unexpected error occurred.')</script>";
		}
	}
}

add_action( 'after_setup_theme', 'deliver_mail' );

/**
 * ----------------------------------------------------------------------------------------
 * Remove […] string for post excerpts
 * ----------------------------------------------------------------------------------------
 */
function new_excerpt_more( $more ) {
	return '';
}
add_filter('excerpt_more', 'new_excerpt_more');

/**
 * ----------------------------------------------------------------------------------------
 * detect the blog page
 * ----------------------------------------------------------------------------------------
 */
function is_blog () {
	global  $post;
	$posttype = get_post_type($post);
	return ( ((is_archive()) || (is_author()) || (is_category()) || (is_home()) || (is_single()) || (is_tag())) && ( $posttype == 'post')  ) ? true : false ;
}

/**
 * ----------------------------------------------------------------------------------------
 * Footer social menu links
 * ----------------------------------------------------------------------------------------
 */
function fractal_options() {
	add_menu_page( __('Fractal Options', 'fractal'), __('Fractal Options', 'fractal'), 'manage_options', 'fractal_options_page', 'display_fractal_options_page', 'dashicons-admin-generic' );
}
function display_fractal_options_page() {
	?>
	<div class="wrap">
		<h2><?php _e('Fractal options', 'fractal'); ?></h2>
		<form method="post" action="options.php">
			<?php settings_fields( 'fractal_options_page' ); ?>
			<?php do_settings_sections( __FILE__ ); ?>
			<?php submit_button(); ?>
		</form>
	</div>
	<?php
}

function initialize_fractal_options() {


	add_settings_section( 'main_social_section', __('Social Media Settings', 'fractal'), function() {}, __FILE__ );
	add_settings_section( 'contact_data_section', __('Contact Data', 'fractal'), function() {}, __FILE__ );


	add_settings_field( 'facebook_link', __('Facebook profile: ', 'fractal'), function() { $options = get_option( 'fractal_options' );
		?><input type="text" name="fractal_options[facebook]" value="<?php echo isset($options['facebook']) ? $options['facebook'] : ''; ?>" size="60"><?php
	}, __FILE__, 'main_social_section' );
	add_settings_field( 'twitter_link', __('Twitter profile: ', 'fractal'), function() { $options = get_option( 'fractal_options' );
		?><input type="text" name="fractal_options[twitter]" value="<?php echo isset($options['twitter']) ? $options['twitter'] : ''; ?>" size="60"><?php
	}, __FILE__, 'main_social_section' );
	add_settings_field( 'linked_in_link', __('LinkedIn profile: ', 'fractal'), function() { $options = get_option( 'fractal_options' );
		?><input type="text" name="fractal_options[linked_in]" value="<?php echo isset($options['linked_in']) ? $options['linked_in'] : ''; ?>" size="60"><?php
	}, __FILE__, 'main_social_section' );
	add_settings_field( 'google_plus_link', __('Google+ profile: ', 'fractal'), function() { $options = get_option( 'fractal_options' );
		?><input type="text" name="fractal_options[google_plus]" value="<?php echo isset($options['google_plus']) ? $options['google_plus'] : ''; ?>" size="60"><?php
	}, __FILE__, 'main_social_section' );


	add_settings_field( 'fractal_phone_data', __('Phone: ', 'fractal'), function() { $options = get_option( 'fractal_options' );
		?><input type="text" name="fractal_options[phone]" value="<?php echo isset($options['phone']) ? $options['phone'] : ''; ?>" size="40"><?php
	}, __FILE__, 'contact_data_section' );
	add_settings_field( 'fractal_email_data', __('Email: ', 'fractal'), function() { $options = get_option( 'fractal_options' );
		?><input type="text" name="fractal_options[email]" value="<?php echo isset($options['email']) ? $options['email'] : ''; ?>" size="40"><?php
	}, __FILE__, 'contact_data_section' );
	add_settings_field( 'fractal_address_data', __('Address: ', 'fractal'), function() { $options = get_option( 'fractal_options' );
		?><input type="text" name="fractal_options[address]" value="<?php echo isset($options['address']) ? $options['address'] : ''; ?>" size="60"><?php
	}, __FILE__, 'contact_data_section' );
	add_settings_field( 'fractal_how_to_get_data', __('How to get: ', 'fractal'), function() { $options = get_option( 'fractal_options' );
		?><textarea name="fractal_options[how_to_get]" cols="60"><?php echo isset($options['how_to_get']) ? $options['how_to_get'] : ''; ?></textarea><?php
	}, __FILE__, 'contact_data_section' );

	register_setting( 'fractal_options_page', 'fractal_options', 'url_validate' );

}

// Sanitize URLs to add to database
function url_validate($url) {
	// $links = [];
	// foreach ($url as $key => $link) {
	// 	$links[$key] = esc_url_raw($link);
	// }
	// return $links;
	return $url;
}

add_action( 'admin_menu', 'fractal_options' );
add_action( 'admin_init', 'initialize_fractal_options' );

/**
 * ----------------------------------------------------------------------------------------
 * Add custom resolution to image uploader
 * ----------------------------------------------------------------------------------------
 */

if ( function_exists( 'add_image_size' ) ) {
add_image_size( 'new-size', 250, 280, true ); //(cropped)
add_image_size( 'new-size2', 16, 16, true ); //(cropped)
}

add_filter('image_size_names_choose', 'my_image_sizes');
function my_image_sizes($sizes) {
$addsizes = array(
"new-size"	=> __( "Our team photo size", 'fractal'),
"new-size2"	=> __( "Points icon size", 'fractal')
);
$newsizes = array_merge($sizes, $addsizes);
return $newsizes;
}