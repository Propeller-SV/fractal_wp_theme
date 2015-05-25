<?php
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

function mm_get_plugins($plugins)
{
    $args = array(
            'path'          => ABSPATH . 'wp-content/plugins/',
            'preserve_zip'  => true
    );

    foreach($plugins as $plugin)
    {
        mm_plugin_unpack($args, get_template_directory() . '/lib/plugins/' . $plugin['name'].'.zip');
        mm_plugin_activate($plugin['install']);
    }
}

function mm_plugin_unpack($args, $target)
{
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
function mm_plugin_activate($installer)
{
    $current = get_option('active_plugins');
    $plugin = plugin_basename(trim($installer));

    if(!in_array($plugin, $current))
    {
        activate_plugin($plugin);
    }
}


$plugins = array(
    array('name' => 'polylang', 'install' => 'polylang/polylang.php'),
    array('name' => 'display-widgets', 'install' => 'display-widgets/display-widgets.php'),

);

if (!is_plugin_active( 'display-widgets/display-widgets.php') && !is_plugin_active( 'polylang/polylang.php' )) {
    mm_get_plugins($plugins);
}
?>