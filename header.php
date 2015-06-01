<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "site-content" div.
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="<?php bloginfo( 'description' ); ?>">
    <meta name="author" content="">

    <title><?php wp_title( '' ); ?></title>

    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <?php wp_head(); ?>
</head>
<body <?php if (is_page( 'company' ) || is_page( 'firma' )) echo 'onload="initialize()"'; ?> <?php body_class(); ?>>

    <header>
        <div class="navbar navbar-inverse navbar-header-custom navbar-fixed-top" role="navigation">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-8">
                        <div class="navbar-header">
                            <div class="col-xs-2">
                                <button type="button" class="navbar-toggle pull-left" data-toggle="collapse" data-target="#navbar">
                                    <span class="sr-only">Toggle navigation</span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>
                            </div>
                            <div class="brand col-xs-8">
                                <div class="center">
                                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo"></a>
                                </div>
                            </div>
                            <div class="col-xs-2">
                                <button type="button" class="navbar-toggle pull-right" data-toggle="collapse" data-target="#navbar-1">
                                    <i class="glyphicon glyphicon-search"></i>
                                </button>
                            </div>
                        </div><!-- end of navbar-header -->
                    </div><!-- end of col-xs-12 -->
                    <div class="col-xs-12 col-sm-4">
                        <div id="navbar-1" class="navbar-collapse collapse">
                            <?php
                            // Check if the menu exists
                            // $menu_exists = wp_get_nav_menu_object( 'Top Menu' );

                            // If it doesn't exist, let's create it.
                            // if( !$menu_exists ){
                            //     $menu_id = wp_create_nav_menu( 'Top Menu' );

                            //     wp_update_nav_menu_item($menu_id, 0, array(
                            //         'menu-item-title'   =>  __('Get help', 'fractal'),
                            //         'menu-item-classes' => 'get-help',
                            //         'menu-item-url'     => home_url( '/get-help/' ),
                            //         'menu-item-status'  => 'publish'
                            //     ));

                            //     wp_update_nav_menu_item($menu_id, 0, array(
                            //         'menu-item-title'   =>  __('Blog', 'fractal'),
                            //         'menu-item-classes' => 'blog',
                            //         'menu-item-url'     => home_url( '/blog/' ),
                            //         'menu-item-status'  => 'publish'
                            //     ));
                            // };

                            // wp_nav_menu( array(
                            //    'theme_location' => 'top',
                            //    'menu'           => 'Top Menu',
                            //    'container'      => '',
                            //    'menu_class'     => 'nav navbar-nav navbar-right',
                            //    'fallback_cb'    => 'default_top_nav'
                            // )); ?>
                            <div class="col-sm-12">
                                <ul class="nav navbar-nav navbar-right">
                                    <li><a href="<?php echo esc_url( home_url( '/get-help/' ) ); ?>">Get Help</a></li>
                                    <li><a href="<?php
                                        if( get_option( 'show_on_front' ) == 'page' )
                                        echo get_permalink( get_option('page_for_posts' ) );
                                        else echo bloginfo('url');
                                    ?>">Blog</a></li>
                                    <li class="hidden-xs">
                                        <ul>
                                            <?php
                                                include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
                                                // check for plugin using plugin name
                                                if ( is_plugin_active( 'polylang/polylang.php' ) ) {
                                                  //plugin is activated
                                                  pll_the_languages(array('show_flags'=>1,'show_names'=>1, 'hide_current'=>1));
                                                } else {
                                                    echo "<a href='" . home_url() . "/wp-admin/plugins.php'>{Activate Polylang Plugin}</a>";
                                                }
                                            ?>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                            <?php get_search_form(); ?>
                        </div><!-- end of navbar-collapse -->
                    </div><!-- end of col-xs-12 -->
                </div><!-- end of row -->
            </div><!-- end of container -->
            <div class="header-line">
                <div id="navbar" class="navbar-collapse collapse">
                    <?php
                    $currentlang = get_bloginfo('language');
                    if ($currentlang !== "de-DE") :
                            // Check if the menu exists
                            $menu_exists = wp_get_nav_menu_object( 'Primary fractal menu' );

                            // If it doesn't exist, let's create it.
                            if( !$menu_exists ){
                                $menu_id = wp_create_nav_menu( 'Primary fractal menu' );

                                // Set up default menu items
                                wp_update_nav_menu_item($menu_id, 0, array(
                                    'menu-item-title'       =>  __('Home', 'fractal'),
                                    'menu-item-object'      => 'page',
                                    'menu-item-object-id'   => get_page_by_title('home')->ID,
                                    'menu-item-type'        => 'post_type',
                                    'menu-item-status'      => 'publish'));

                                wp_update_nav_menu_item($menu_id, 0, array(
                                    'menu-item-title'       =>  __('Software Engineering', 'fractal'),
                                    'menu-item-object'      => 'page',
                                    'menu-item-object-id'   => get_page_by_title('Software Engineering')->ID,
                                    'menu-item-type'        => 'post_type',
                                    'menu-item-status'      => 'publish'));

                                wp_update_nav_menu_item($menu_id, 0, array(
                                    'menu-item-title'       =>  __('Company', 'fractal'),
                                    'menu-item-object'      => 'page',
                                    'menu-item-object-id'   => get_page_by_title('company')->ID,
                                    'menu-item-type'        => 'post_type',
                                    'menu-item-status'      => 'publish'));

                                wp_update_nav_menu_item($menu_id, 0, array(
                                    'menu-item-title'       =>  __('Career', 'fractal'),
                                    'menu-item-object'      => 'page',
                                    'menu-item-object-id'   => get_page_by_title('career')->ID,
                                    'menu-item-type'        => 'post_type',
                                    'menu-item-status'      => 'publish'));
                            };
                        wp_nav_menu( array(
                           'theme_location'    => 'primary',
                           'menu'              => 'Primary fractal menu',
                           'container'         => '',
                           'menu_class'        => 'navbar-main nav text-uppercase',
                           'fallback_cb'       => 'default_primary_nav'
                        ));
                    elseif ($currentlang == "de-DE") :
                        wp_nav_menu( array(
                           'theme_location'    => 'primary',
                           'menu'              => 'Primary fractal menu D',
                           'container'         => '',
                           'menu_class'        => 'navbar-main nav text-uppercase',
                           'fallback_cb'       => 'default_primary_nav'
                        ));
                    endif; ?>
                       <?php
                           // check for plugin using plugin name
                           if ( is_plugin_active( 'polylang/polylang.php' ) ) {
                             //plugin is activated
                             ?>
                             <ul class='colour hidden-sm hidden-md hidden-lg'>
                                <?php pll_the_languages(array('show_flags'=>1,'show_names'=>0))?>
                             </ul>
                             <?php
                           };
                       ?>
                </div><!-- end of navbar-collapse -->
            </div><!-- end of header-line -->
        </div><!-- end of navbar-fixed-top -->
    </header>