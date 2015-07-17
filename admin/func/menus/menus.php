<?php
// Add Your Menu Locations
function register_my_menus() {
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'fractal' ),
		'footer'  => __( 'Footer Menu', 'fractal' )
	));
}
add_action( 'after_setup_theme', 'register_my_menus' );

function default_top_nav() { // link to the default menu markup
	require_once (THEMEFUNC . '/menus/default_top_nav.php');
}

function default_primary_nav() {
	require_once (THEMEFUNC . '/menus/default_primary_nav.php');
}

function default_footer_nav() {
	require_once (THEMEFUNC . '/menus/default_footer_nav.php');
}
?>