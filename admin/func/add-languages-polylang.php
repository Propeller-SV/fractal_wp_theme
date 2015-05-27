<?php
require_once ABSPATH . 'wp-admin/includes/template.php';

if ( !function_exists('add_languages_polylang') ) {
	function add_languages_polylang() {
		$options = get_option('polylang');
		$model = new PLL_Admin_Model($options);
		$languages = array(
			array( 'name' => 'Русский', 'slug' => 'ru', 'locale' => 'ru_RU', 'rtl' => 0, 'term_group' => 3),
			array( 'name' => 'Українська', 'slug' => 'uk', 'locale' => 'uk', 'rtl' => 0, 'term_group' => 4),
		);
		foreach ($languages as $language) {
			$model->add_language($language);
		}

	}
}
add_action( 'after_setup_theme', 'add_languages_polylang' );
?>
