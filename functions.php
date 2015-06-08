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
 * Include the Plugin Activation function.
 * ----------------------------------------------------------------------------------------
 */
// require_once dirname( __FILE__ ) . '/admin/dependencies.php';
require_once THEMEFUNC . '/psv-install-plugins.php';

/**
 * ----------------------------------------------------------------------------------------
 * Include the function to add languges to Polylang plugin.
 * ----------------------------------------------------------------------------------------
 */
require_once THEMEFUNC . '/add-languages-polylang.php';
/**
 * ----------------------------------------------------------------------------------------
 * Include the function to add Customers metabox.
 * ----------------------------------------------------------------------------------------
 */
require_once THEMEFUNC . '/add-customer-metabox.php';

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
			'name'          => __( 'Right Widget Area', 'fractal' ),
			'id'            => 'sidebar-1',
			'description'   => __( 'Add widgets here to appear in your sidebar.', 'fractal' ),
			'before_widget' => '',
			'after_widget'  => '',
			'before_title'  => '<h3 class="text-center text-uppercase">',
			'after_title'   => '</h3>',
			) );

		register_sidebar( array(
			'name' 			=> __( 'Footer Social Widget Area', 'fractal' ),
			'id' 			=> 'sidebar-2',
			'description' 	=> __( 'Add the list of social links to appear on the footer.', 'fractal' ),
			'before_widget' => '<div class="col-sm-4 col-md-6">',
			'after_widget' 	=> '</ul></div>',
			'before_title' 	=> '<h3>',
			'after_title' 	=> '</h3></div><div class="col-sm-8 col-md-6"><ul class="nav nav-pills">',
			) );

		register_sidebar( array(
			'name' 			=> __( 'Customers Widget Area', 'fractal' ),
			'id' 			=> 'sidebar-3',
			'description' 	=> __( 'List of customers', 'fractal' ),
			'before_widget' => '<section class="customer"><div class="heading"><div class="container">',
			'after_widget' 	=> '</ul></div><!-- end of row --></div><!-- end of container --></section>',
			'before_title' 	=> '<h2 class="text-center text-uppercase">',
			'after_title' 	=> '<br><span>&#9830;</span></h2></div></div><div class="container"><div class="row"><ul class="list-unstyled">',
			) );

		register_sidebar( array(
			'name' 			=> __( 'Company Main Widget Area', 'fractal' ),
			'id' 			=> 'sidebar-4',
			'description' 	=> __( 'List of articles', 'fractal' ),
			'before_widget' => '',
			'after_widget' 	=> '',
			'before_title'  => '<h3 class="text-center text-uppercase">',
			'after_title'   => '</h3>'
			) );

		register_sidebar( array(
			'name' 			=> __( 'Company Team Widget Area', 'fractal' ),
			'id' 			=> 'sidebar-5',
			'description' 	=> __( 'List of employees', 'fractal' ),
			'before_widget' => '',
			'after_widget' 	=> '',
			'before_title' 	=> '<h1 class="text-center">',
			'after_title' 	=> '</h1>',
			) );

		register_sidebar( array(
			'name' 			=> __( 'Career Widget Area', 'fractal' ),
			'id' 			=> 'sidebar-6',
			'description' 	=> __( 'Some information', 'fractal' ),
			'before_widget' => '',
			'after_widget' 	=> '',
			'before_title'  => '<h3 class="text-center text-uppercase">',
			'after_title'   => '</h3>'
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

	wp_register_script( 'common-map', SCRIPTS . '/common.js' );
	wp_localize_script( 'common-map', 'WPURLS', array( 'templateUrl' => get_bloginfo( 'template_url' ) ) );
	wp_enqueue_script( 'common-map' );
}

add_action( 'wp_enqueue_scripts', 'current_theme_resources' );

/**
 * ----------------------------------------------------------------------------------------
 * Create pages and insert into database
 * ----------------------------------------------------------------------------------------
 */
function addThisPage() {

	// add home page
	$page_home = array(
		'post_title'	=> 'Home',
		'post_status'	=> 'publish',
		'post_type'		=> 'page',
		'post_content'	=> 'Some default content'
		);
	$page_home_exists = get_page_by_title( $page_home['post_title'] );

	if( ! $page_home_exists) {
		$insert_home_id = wp_insert_post( $page_home );
		if( $insert_home_id ) {
			update_post_meta( $insert_home_id, '_wp_page_template', 'home-tepmlate.php' );

			// Set "static page" as the option
			update_option( 'show_on_front', 'page' );

			// Set the front page ID
			update_option( 'page_on_front', $insert_home_id );
		}
	}

	// add blog page
	$page_blog = array(
		'post_title'	=> 'Blog',
		'post_status'	=> 'publish',
		'post_type'		=> 'page',
		'post_content'	=> ''
		);
	$page_blog_exists = get_page_by_title( $page_blog['post_title'] );

	if( ! $page_blog_exists) {
		$insert_blog_id = wp_insert_post( $page_blog );
		if( $insert_blog_id ) {

			// Set the front page ID
			update_option( 'page_for_posts', $insert_blog_id );
		}
	}

	// add software egineering page
	$page_softEngin = array(
		'post_title'	=> 'Software Engineering',
		'post_status'	=> 'publish',
		'post_type'		=> 'page',
		'post_content'	=> 'Some default content'
		);
	$page_softEngin_exists = get_page_by_title( $page_softEngin['post_title'] );

	if( ! $page_softEngin_exists) {
		$insert_softEngin_id = wp_insert_post( $page_softEngin );
		if( $insert_softEngin_id ) {
			update_post_meta( $insert_softEngin_id, '_wp_page_template', 'softEngin-tepmlate.php' );

			// upload and set up the post thumbnail
			$image_url = IMAGES . '/software.png';
			$upload_dir = wp_upload_dir();
			$image_data = file_get_contents($image_url);
			$filename = basename($image_url);
			if(wp_mkdir_p($upload_dir['path']))
			    $file = $upload_dir['path'] . '/' . $filename;
			else
			    $file = $upload_dir['basedir'] . '/' . $filename;
			file_put_contents($file, $image_data);

			$wp_filetype = wp_check_filetype($filename, null );
			$attachment = array(
			    'post_mime_type' => $wp_filetype['type'],
			    'post_title' => sanitize_file_name($filename),
			    'post_content' => '',
			    'post_status' => 'inherit'
			);
			$attach_id = wp_insert_attachment( $attachment, $file, $insert_softEngin_id );
			require_once(ABSPATH . 'wp-admin/includes/image.php');
			$attach_data = wp_generate_attachment_metadata( $attach_id, $file );
			wp_update_attachment_metadata( $attach_id, $attach_data );

			set_post_thumbnail( $insert_softEngin_id, $attach_id );
		}
	}

	// add company page
	$page_company = array(
		'post_title'	=> 'Company',
		'post_status'	=> 'publish',
		'post_type'		=> 'page',
		'post_content'	=> 'Some default content'
		);
	$page_company_exists = get_page_by_title( $page_company['post_title'] );

	if( ! $page_company_exists) {
		$insert_company_id = wp_insert_post( $page_company );
		if( $insert_company_id ) {
			update_post_meta( $insert_company_id, '_wp_page_template', 'company-tepmlate.php' );

			// upload and set up the post thumbnail
			$image_url = IMAGES . '/company.png';
			$upload_dir = wp_upload_dir();
			$image_data = file_get_contents($image_url);
			$filename = basename($image_url);
			if(wp_mkdir_p($upload_dir['path']))
			    $file = $upload_dir['path'] . '/' . $filename;
			else
			    $file = $upload_dir['basedir'] . '/' . $filename;
			file_put_contents($file, $image_data);

			$wp_filetype = wp_check_filetype($filename, null );
			$attachment = array(
			    'post_mime_type' => $wp_filetype['type'],
			    'post_title' => sanitize_file_name($filename),
			    'post_content' => '',
			    'post_status' => 'inherit'
			);
			$attach_id = wp_insert_attachment( $attachment, $file, $insert_company_id );
			require_once(ABSPATH . 'wp-admin/includes/image.php');
			$attach_data = wp_generate_attachment_metadata( $attach_id, $file );
			wp_update_attachment_metadata( $attach_id, $attach_data );

			set_post_thumbnail( $insert_company_id, $attach_id );
		}
	}

	// add career page
	$page_career = array(
		'post_title'	=> 'Career',
		'post_status'	=> 'publish',
		'post_type'		=> 'page',
		'post_content'	=> 'Some default content'
		);
	$page_career_exists = get_page_by_title( $page_career['post_title'] );

	if( ! $page_career_exists) {
		$insert_career_id = wp_insert_post( $page_career );
		if( $insert_career_id ) {
			update_post_meta( $insert_career_id, '_wp_page_template', 'career-tepmlate.php' );

			// upload and set up the post thumbnail
			$image_url = IMAGES . '/career.png';
			$upload_dir = wp_upload_dir();
			$image_data = file_get_contents($image_url);
			$filename = basename($image_url);
			if(wp_mkdir_p($upload_dir['path']))
			    $file = $upload_dir['path'] . '/' . $filename;
			else
			    $file = $upload_dir['basedir'] . '/' . $filename;
			file_put_contents($file, $image_data);

			$wp_filetype = wp_check_filetype($filename, null );
			$attachment = array(
			    'post_mime_type' => $wp_filetype['type'],
			    'post_title' => sanitize_file_name($filename),
			    'post_content' => '',
			    'post_status' => 'inherit'
			);
			$attach_id = wp_insert_attachment( $attachment, $file, $insert_career_id );
			require_once(ABSPATH . 'wp-admin/includes/image.php');
			$attach_data = wp_generate_attachment_metadata( $attach_id, $file );
			wp_update_attachment_metadata( $attach_id, $attach_data );

			set_post_thumbnail( $insert_career_id, $attach_id );
		}
	}
}

add_action( 'after_setup_theme', 'addThisPage' );

/**
 * ----------------------------------------------------------------------------------------
 * Contact form
 * ----------------------------------------------------------------------------------------
 */
function deliver_mail() {

    // if the submit button is clicked, send the email
    if ( isset( $_POST['cf-submitted'] ) ) {

        // sanitize form values
        $name    = sanitize_text_field( $_POST["cf-name"] );
        $email   = sanitize_email( $_POST["cf-email"] );
        $phone	 = sanitize_text_field( $_POST["cf-phone"] );
        $subject = 'Fractal Soft response';
        $message = esc_textarea( $_POST["cf-message"] );

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

// Remove […] string for post excerpts
function new_excerpt_more( $more ) {
	return '';
}
add_filter('excerpt_more', 'new_excerpt_more');


?>