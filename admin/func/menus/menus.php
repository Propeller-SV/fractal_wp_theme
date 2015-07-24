<?php
// Add Your Menu Locations
function register_my_menus() {
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'fractal' ),
		'footer'  => __( 'Footer Menu', 'fractal' )
	));
}
add_action( 'after_setup_theme', 'register_my_menus' );

// define the wp_create_top_nav_menu callback
function action_wp_create_top_nav_menu() {

	$currentlang = get_bloginfo('language');
	if ($currentlang !== "de-DE") :
		// Check if the menu exists
		$menu_exists = wp_get_nav_menu_object( 'Top menu EN' );

		// If it doesn't exist, let's create it.
		if( !$menu_exists ){
			$menu_id = wp_create_nav_menu( 'Top menu EN' );
			// Set up default menu items

			$pages = ['Home', 'Software engineering', 'Company', 'Career'];
			for ($i=0; $i<count($pages); $i++) {
				wp_update_nav_menu_item($menu_id, 0, array(
				'menu-item-title'		=> $pages[$i],
				'menu-item-object'		=> 'page',
				'menu-item-object-id'	=> get_page_by_title($pages[$i])->ID,
				'menu-item-type'		=> 'post_type',
				'menu-item-status'		=> 'publish'));
			}
		};
		wp_nav_menu( array(
			'theme_location'	=> 'primary',
			'menu'				=> 'Top menu EN',
			'container'			=> '',
			'menu_class'		=> 'navbar-main nav text-uppercase',
			'menu_id'			=> 'top-nav-menu'
		));
	elseif ($currentlang == "de-DE") :
		// Check if the menu exists
		$menu_exists = wp_get_nav_menu_object( 'Top menu DE' );

		// If it doesn't exist, let's create it.
		if( !$menu_exists ){
			$menu_id = wp_create_nav_menu( 'Top menu DE' );

			wp_update_nav_menu_item($menu_id, 0, array(
				'menu-item-title'		=> __('Add menu items to Top menu DE here', 'fractal'),
				'menu-item-url' 		=> get_bloginfo('wpurl') . '/wp-admin/nav-menus.php',
				'menu-item-status'		=> 'publish')
			);
		};

		wp_nav_menu( array(
			'theme_location'	=> 'primary',
			'menu'				=> 'Top menu DE',
			'container'			=> '',
			'menu_class'		=> 'navbar-main nav text-uppercase',
			'menu_id'			=> 'top-nav-menu'
		));
	endif;
};
add_action( 'wp_create_top_nav_menu', 'action_wp_create_top_nav_menu' );

// define the wp_create_footer_nav_menu callback
function action_wp_create_footer_nav_menu() {

	$currentlang = get_bloginfo('language');
	if ($currentlang !== "de-DE") :
		// Check if the menu exists
		$menu_exists = wp_get_nav_menu_object( 'Footer menu EN' );

		// If it doesn't exist, let's create it.
		if( !$menu_exists){
			$menu_id = wp_create_nav_menu( 'Footer menu EN' );

			// Set up default menu items
			$pages = ['Home', 'Software engineering', 'Company', 'Career'];
			for ($i=0; $i<count($pages); $i++) {
				wp_update_nav_menu_item($menu_id, 0, array(
				'menu-item-title'		=> $pages[$i],
				'menu-item-object'		=> 'page',
				'menu-item-object-id'	=> get_page_by_title($pages[$i])->ID,
				'menu-item-type'		=> 'post_type',
				'menu-item-status'		=> 'publish'));
			}
		};

		wp_nav_menu( array(
			'theme_location'=> 'footer',
			'menu'			=> 'Footer menu EN',
			'container'		=> '',
			'menu_class'	=> 'nav nav-pills pull-left'
	));
	elseif ($currentlang == "de-DE") :
		// Check if the menu exists
			$menu_exists = wp_get_nav_menu_object( 'Footer menu DE' );

			// If it doesn't exist, let's create it.
			if( !$menu_exists ){
				$menu_id = wp_create_nav_menu( 'Footer menu DE' );

				wp_update_nav_menu_item($menu_id, 0, array(
					'menu-item-title'		=> __('Add menu items to Footer menu DE here', 'fractal'),
					'menu-item-url' 		=> get_bloginfo('wpurl') . '/wp-admin/nav-menus.php',
					'menu-item-status'		=> 'publish')
				);
			};

			wp_nav_menu( array(
				'theme_location'	=> 'footer',
				'menu'				=> 'Footer menu DE',
				'container'			=> '',
				'menu_class'		=> 'nav nav-pills pull-left'
			));
	endif;
};
add_action( 'wp_create_footer_nav_menu', 'action_wp_create_footer_nav_menu' );
