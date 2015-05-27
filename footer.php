<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the "site-content" div and all content after.
 */
?>
<footer>
    <div class="container">
        <div class="row">
            <nav class="hidden-xs footer-navigation col-sm-7">
                <?php
                $currentlang = get_bloginfo('language');
                if ($currentlang !== "de-DE") :
                    // Check if the menu exists
                    $menu_exists = wp_get_nav_menu_object( 'Footer fractal menu' );

                    // If it doesn't exist, let's create it.
                    if( !$menu_exists){
                        $menu_id = wp_create_nav_menu( 'Footer fractal menu' );

                        // Set up default menu items
                        wp_update_nav_menu_item($menu_id, 0, array(
                            'menu-item-title' =>  __('Home'), 
                            'menu-item-object' => 'page',
                            'menu-item-object-id' => get_page_by_title('home')->ID,
                            'menu-item-type' => 'post_type',
                            'menu-item-status' => 'publish'));

                        wp_update_nav_menu_item($menu_id, 0, array(
                            'menu-item-title' =>  __('Software Engineering'), 
                            'menu-item-object' => 'page',
                            'menu-item-object-id' => get_page_by_title('Software Engineering')->ID,
                            'menu-item-type' => 'post_type',
                            'menu-item-status' => 'publish'));

                        wp_update_nav_menu_item($menu_id, 0, array(
                            'menu-item-title' =>  __('Company'),
                            'menu-item-object' => 'page',
                            'menu-item-object-id' => get_page_by_title('company')->ID,
                            'menu-item-type' => 'post_type',
                            'menu-item-status' => 'publish'));

                        wp_update_nav_menu_item($menu_id, 0, array(
                            'menu-item-title' =>  __('Career'), 
                            'menu-item-object' => 'page',
                            'menu-item-object-id' => get_page_by_title('career')->ID,
                            'menu-item-type' => 'post_type',
                            'menu-item-status' => 'publish'));
                    };

                    wp_nav_menu( array(
                        'theme_location'    => 'footer',
                        'menu'              => 'Footer fractal menu',
                        'container'         => '',
                        'menu_class'        => 'nav nav-pills pull-left',
                        'fallback_cb'       => 'default_footer_nav'
                ));
                elseif ($currentlang == "de-DE") :
                    wp_nav_menu( array(
                        'theme_location'    => 'footer',
                        'menu'              => 'Footer fractal menu D',
                        'container'         => '',
                        'menu_class'        => 'nav nav-pills pull-left',
                        'fallback_cb'       => 'default_footer_nav'
                    ));
                endif; ?>
            </nav>
            <div class="menu col-sm-5">
                <?php get_sidebar( 'footer-social' ); ?>
            </div>
        </div><!-- end of row -->
        <div class="row">
            <p>&#169; <?php the_time( 'Y' ); ?> Fractal Soft, <?php _e('All rights reserved', 'fractal'); ?></p>
        </div>
    </div><!-- end of container -->
</footer>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<?php wp_footer(); ?>
</body>
</html>