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
    if($zip = zip_open($target))
    {
        while($entry = zip_read($zip))
        {
            $is_file = substr(zip_entry_name($entry), -1) == '/' ? false : true;
            $file_path = $args['path'].zip_entry_name($entry);
            if($is_file)
            {
                if(zip_entry_open($zip,$entry,"r")) 
                {
                    $fstream = zip_entry_read($entry, zip_entry_filesize($entry));
                    file_put_contents($file_path, $fstream );
                    chmod($file_path, 0777);
                }
                zip_entry_close($entry);
            }
            else
            {
                if(zip_entry_name($entry))
                {
                    mkdir($file_path);
                    chmod($file_path, 0777);
                }
            }
        }
        zip_close($zip);
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
    else
        return false;
}


$plugins = array(
    array('name' => 'display-widgets', 'path' => 'https://downloads.wordpress.org/plugin/display-widgets.2.03.zip', 'install' => 'display-widgets/display-widgets.php'),
    array('name' => 'polylang', 'path' => 'https://downloads.wordpress.org/plugin/polylang.1.7.5.zip', 'install' => 'polylang/install/install.php'),
);
if (!is_plugin_active( 'display-widgets/display-widgets.php') && !is_plugin_active( 'polylang/polylang.php' )) {
    mm_get_plugins($plugins);
}
?>