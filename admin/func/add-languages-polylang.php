<?php
require_once ABSPATH . 'wp-admin/includes/template.php';

if ( !function_exists('add_languages_polylang') ) {
	function add_languages_polylang() {
		$options = get_option('polylang');
		$model = new PLL_Admin_Model($options);
		$languages = array(
			array( 'name' => 'English', 'slug' => 'en', 'locale' => 'en_GB', 'rtl' => 0, 'term_group' => 1),
			array( 'name' => 'Deutsch', 'slug' => 'de', 'locale' => 'de_DE', 'rtl' => 0, 'term_group' => 2),
		);
		foreach ($languages as $language) {
			$language_installed = pll_is_language_installed($language['slug']);
			if (!$language_installed) {
				$model->add_language($language);
			}
		}
	}
}

function pll_is_language_installed($language_code) {
	global $polylang;
	$languages = $polylang->model->get_languages_list();
	foreach ($languages as $language) {
		if ($language->slug == $language_code) {
			return true;
		}
	}
	return false;
}

add_action( 'after_setup_theme', 'add_languages_polylang' );
?>
