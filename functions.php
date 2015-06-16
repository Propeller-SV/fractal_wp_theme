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
 * Load custom menu locations
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
			'name'          => __( 'Right Widget Area', 'fractal' ),
			'id'            => 'sidebar-1',
			'description'   => __( 'Add widgets here to appear in your sidebar.', 'fractal' ),
			'before_widget' => '',
			'after_widget'  => '',
			'before_title'  => '<h3 class="text-center text-uppercase">',
			'after_title'   => '</h3>',
			) );

		// register_sidebar( array(
		// 	'name' 			=> __( 'Footer Social Widget Area', 'fractal' ),
		// 	'id' 			=> 'sidebar-2',
		// 	'description' 	=> __( 'Add the list of social links to appear on the footer.', 'fractal' ),
		// 	'before_widget' => '<div class="col-sm-4 col-md-6">',
		// 	'after_widget' 	=> '</ul></div>',
		// 	'before_title' 	=> '<h3>',
		// 	'after_title' 	=> '</h3></div><div class="col-sm-8 col-md-6"><ul class="nav nav-pills">',
		// 	) );

		// register_sidebar( array(
		// 	'name' 			=> __( 'Customers Widget Area', 'fractal' ),
		// 	'id' 			=> 'sidebar-3',
		// 	'description' 	=> __( 'List of customers', 'fractal' ),
		// 	'before_widget' => '<section class="customer"><div class="heading"><div class="container">',
		// 	'after_widget' 	=> '</ul></div><!-- end of row --></div><!-- end of container --></section>',
		// 	'before_title' 	=> '<h2 class="text-center text-uppercase">',
		// 	'after_title' 	=> '<br><span>&#9830;</span></h2></div></div><div class="container"><div class="row"><ul class="list-unstyled">',
		// 	) );

		// register_sidebar( array(
		// 	'name' 			=> __( 'Company Main Widget Area', 'fractal' ),
		// 	'id' 			=> 'sidebar-4',
		// 	'description' 	=> __( 'List of articles', 'fractal' ),
		// 	'before_widget' => '',
		// 	'after_widget' 	=> '',
		// 	'before_title'  => '<h3 class="text-center text-uppercase">',
		// 	'after_title'   => '</h3>'
		// 	) );

		// register_sidebar( array(
		// 	'name' 			=> __( 'Company Team Widget Area', 'fractal' ),
		// 	'id' 			=> 'sidebar-5',
		// 	'description' 	=> __( 'List of employees', 'fractal' ),
		// 	'before_widget' => '',
		// 	'after_widget' 	=> '',
		// 	'before_title' 	=> '<h1 class="text-center">',
		// 	'after_title' 	=> '</h1>',
		// 	) );

		// register_sidebar( array(
		// 	'name' 			=> __( 'Career Widget Area', 'fractal' ),
		// 	'id' 			=> 'sidebar-6',
		// 	'description' 	=> __( 'Some information', 'fractal' ),
		// 	'before_widget' => '',
		// 	'after_widget' 	=> '',
		// 	'before_title'  => '<h3 class="text-center text-uppercase">',
		// 	'after_title'   => '</h3>'
		// 	) );
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

/**
 * ----------------------------------------------------------------------------------------
 * Blog pagination
 * ----------------------------------------------------------------------------------------
 */
function numeric_posts_nav() {

	if( is_singular() )
		return;

	global $wp_query;

	/** Stop execution if there's only 1 page */
	if( $wp_query->max_num_pages <= 1 )
		return;

	$paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
	$max   = intval( $wp_query->max_num_pages );

	/**	Add current page to the array */
	if ( $paged >= 1 )
		$links[] = $paged;

	/**	Add the pages around the current page to the array */
	if ( $paged >= 3 ) {
		$links[] = $paged - 1;
		$links[] = $paged - 2;
	}

	if ( ( $paged + 2 ) <= $max ) {
		$links[] = $paged + 2;
		$links[] = $paged + 1;
	}

	// echo '<div class="list-pagination text-center"><ul class="pagination pagination-lg">' . "\n";

	/**	Previous Post Link */
	// if ( get_previous_posts_link() )
	// 	printf( '<li>%s</li>' . "\n", get_previous_posts_link( '&laquo;' ) );
	?>
	<li><?php if (get_previous_posts_link()) echo previous_posts_link('&laquo;'); else echo '<a href="' . esc_url( get_pagenum_link( $max ) ) . '">&laquo;</a>' ?>
	</li>
	<?php

	/**	Link to first page, plus ellipses if necessary */
	if ( ! in_array( 1, $links ) ) {
		$class = 1 == $paged ? ' class="active"' : '';

		printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( 1 ) ), '1' );

		if ( ! in_array( 2, $links ) )
			echo '<li>…</li>' . "\n";
	}

	/**	Link to current page, plus 2 pages in either direction if necessary */
	sort( $links );
	foreach ( (array) $links as $link ) {
		$class = $paged == $link ? ' class="active"' : '';
		printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $link ) ), $link );
	}

	/**	Link to last page, plus ellipses if necessary */
	if ( ! in_array( $max, $links ) ) {
		if ( ! in_array( $max - 1, $links ) )
			echo '<li>…</li>' . "\n";

		$class = $paged == $max ? ' class="active"' : '';
		printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $max ) ), $max );
	}

	/**	Next Post Link */
	// if ( get_next_posts_link() )
	// 	printf( '<li>%s</li>' . "\n", get_next_posts_link( '&raquo;' ) );
	?>
	<li><?php if (get_next_posts_link()) echo next_posts_link('&raquo;'); else echo '<a href="' . esc_url( get_pagenum_link( 1 ) ) . '">&raquo;</a>' ?>
	</li>
	<?php

	// echo '</ul></div>' . "\n";

}

// detect the blog page
function is_blog () {
	global  $post;
	$posttype = get_post_type($post);
	return ( ((is_archive()) || (is_author()) || (is_category()) || (is_home()) || (is_single()) || (is_tag())) && ( $posttype == 'post')  ) ? true : false ;
}
?>