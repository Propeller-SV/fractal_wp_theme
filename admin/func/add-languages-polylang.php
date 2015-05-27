<?php

if ( !function_exists('add_languages_polylang') ) {
	function add_languages_polylang() {
		$options = get_option('polylang');
		$model = new PLL_Admin_Model($options);
		$args = array(
			'name'		=> 'Українська',
			'slug'		=> 'uk',
			'locale'	=> 'uk',
			'rtl'		=> 0,
			'term_group'=> 3
		);
		$model->add_language($args);
	}
}
add_action( 'plugins_loaded', 'add_languages_polylang' );
?>