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
<body <?php if (get_post_meta( get_the_id(), '_wp_page_template', true ) == 'company-template.php') echo 'onload="initialize()"'; ?> <?php body_class(); ?>>

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
							<div class="col-sm-12">
								<ul class="nav navbar-nav navbar-right">
									<li><a href="<?php echo esc_url( home_url( '/get-help/' ) ); ?>">Get Help</a></li>
									<?php $blog_page = get_option('page_for_posts'); ?>

									<!-- blog page link -->
									<li>
										<a href="<?php echo $blog_page ? get_permalink( $blog_page ) : bloginfo('url'); ?>" <?php echo is_blog() ? 'class="custom-active"' : ''; ?>>
											<?php echo $blog_page ? get_page($blog_page)->post_title : __('Blog', 'fractal'); ?>
										</a>
									</li>

									<!-- Polylang language switcher -->
									<?php
									// check if plugin is active and languages added
									global $polylang;
									if ( is_plugin_active( 'polylang/polylang.php' && $polylang ) ) { ?>
									<li class="hidden-xs dropdown">
										<?php $switcher = pll_the_languages(array('raw'=>1));
											$lang = array();
											for ($i=0; $i<count($switcher); $i++) {
												$lang[]=$switcher[$i]['classes'];
												if (in_array('current-lang', $lang[$i])) { ?>
													<a href="#" class="dropdown-toggle" data-toggle="dropdown">
														<img src="<?php echo $switcher[$i]['flag']; ?>"/>
														<span><?php echo $switcher[$i]['name']; ?></span><b class="caret"></b>
													</a>
												<?php }
											};
										?>
										<ul class="dropdown-menu">
											<?php for ($i=0; $i<count($switcher); $i++) { ?>
											<li>
												<a href="<?php echo $switcher[$i]['url']; ?>" <?php if (in_array('current-lang', $lang[$i])) echo('class="custom-active"'); ?>>
													<img src="<?php echo $switcher[$i]['flag']; ?>"/> <?php echo $switcher[$i]['name']; ?>
												</a>
											</li>
											<?php } ?>
										</ul>
									</li>
									<?php } ?> <!-- End of language switcher -->
								</ul>
							</div>
							<?php get_search_form(); ?>
						</div><!-- end of navbar-collapse -->
					</div><!-- end of col-xs-12 -->
				</div><!-- end of row -->
			</div><!-- end of container -->
			<div class="header-line">
				<div id="navbar" class="navbar-collapse collapse">

					<!-- Create Top Nav Menu -->
					<?php do_action( 'wp_create_top_nav_menu' ); ?>

					<!-- Mobile language switcher -->
					<?php if ( is_plugin_active( 'polylang/polylang.php' ) ) {
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