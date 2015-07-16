<?php
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

if (!function_exists('psv_get_plugins')) {

	function psv_get_plugins() {
		$plugins = array(
			array('name' => 'polylang', 'install' => 'polylang/polylang.php'),
			array('name' => 'loco-translate', 'install' => 'loco-translate/loco.php'),
			array('name' => 'display-widgets', 'install' => 'display-widgets/display-widgets.php'),
		);

		$args = array(
			'path'			=> ABSPATH . 'wp-content/plugins/',
			'preserve_zip'	=> true
		);

		foreach($plugins as $plugin)
		{
			psv_plugin_unpack($args, get_template_directory() . '/lib/plugins/' . $plugin['name'].'.zip');
			psv_plugin_activate($plugin['install']);
		}
	}

	function psv_plugin_unpack($args, $target) {
		$zip = new ZipArchive;
		if($zip->open($target) === TRUE)
		{
			$zip->extractTo( $args['path'] );
			$zip->close();
		}
		if($args['preserve_zip'] === false)
		{
			unlink($target);
		}
	}

	function psv_plugin_activate($installer) {
		$current = get_option('active_plugins');
		$plugin = plugin_basename(trim($installer));
		print_r($current);
		echo $plugin . '<br>';

		if(!in_array($plugin, $current))
		{
			activate_plugin($plugin);
		}
	}
}
add_action( 'after_switch_theme', 'psv_get_plugins' );
?>