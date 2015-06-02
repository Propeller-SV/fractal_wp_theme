<?php
/**
 * single.php
 *
 * The template for displaying single posts.
 */
?>

<?php get_header(); ?>

	<section class="banner">
		<div class="container">
			<ul class="pull-left">
				<li><?php
				if ( get_option('page_for_posts') ) {
					$blog_page_id = get_option('page_for_posts');
					echo '<a href="' . get_permalink( $blog_page_id ) . '">' . get_page($blog_page_id)->post_title . '</a>';
				} else {
					echo '<a href=' . get_bloginfo( 'url' ) . '>BLOG</a>';
				}
				?></li>
			</ul>
			<ul class="pull-right">
				<li><a href="#">Blog>><?php the_title(); ?></a></li>
			</ul>
		</div>
	</section>
	<section class="human">
		<div class="container">
			<div class="row">
				<div class="col-xs-12 ">
					<div class="human-1">
						<div class="fragment-human">
							<?php while (have_posts()) : the_post(); ?>
								<?php
								$thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );
								$url = $thumb['0'];
								?>
								<?php if ($url) : ?>
								<img src="<?php echo $url; ?>" class="human-img" />
								<?php endif; ?>
								<h1 class="text-center"><?php the_title(); ?></h1>
								<ul class="list-top">
									<li><img src="<?php echo IMAGES; ?>/icon-user.png" /> <?php the_author(); ?> /</li>
									<li><img src="<?php echo IMAGES; ?>/icon-clock.png" /><?php the_time( ' F d.m.Y /' ); ?></li>
									<li><img src="<?php echo IMAGES; ?>/icon-folder.png" /> <?php echo get_the_category_list( ', ' ); ?></li>
								</ul>
								<p><?php the_content(); ?></p>
								<ul class="list-bottom">
									<li><a href="#"><img src="<?php echo IMAGES; ?>/icon-comments.png" /></a></li>
									<li><a href="#"><img src="<?php echo IMAGES; ?>/icon-oy.png" /></a></li>
									<li class="dropdown">
										<a href="#" class="dropdown-toggle" data-toggle="dropdown">
											<img src="<?php echo IMAGES; ?>/icon-forward.png" />
										</a>
										<ul class="dropdown-menu">
											<li><a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php the_permalink();?>"><img src="<?php echo IMAGES; ?>/linkedin-color.png" /></a></li>
											<li><a href="http://www.facebook.com/sharer.php?u=<?php the_permalink();?>&t=<?php the_title(); ?>" target="blank"><img src="<?php echo IMAGES; ?>/facebook-color.png" /></a></li>
											<li><a href="https://twitter.com/intent/tweet?text=<?php the_permalink();?>"><img src="<?php echo IMAGES; ?>/twitter-color.png" /></a></li>
											<li><a href="https://plus.google.com/share?url=<?php the_permalink();?>"><img src="<?php echo IMAGES; ?>/google-color.png" /></a></li>
										</ul>
									</li>
								</ul>
							<?php endwhile; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="like">
		<div class="container">
			<div class="row">
				<div class="col-xs-12">
					<h1 class="text-center">You May Also Like</h1>
				</div>
				<?php
					$args = array( 'numberposts' => '3', 'exclude' => get_the_id() );
					$recent_posts = wp_get_recent_posts( $args );
					foreach( $recent_posts as $recent ) {
						echo '<div class="col-xs-12 col-sm-4">' . get_the_post_thumbnail( $recent["ID"], 'medium', array('class' => 'human-img') ) . '<a href="' . get_permalink( $recent["ID"] ) . '"><h3 class="text-center">' . $recent["post_title"] . '</h3></a></div>';
					}
				?>
				<div class="teg col-xs-12">
				    <h4>You may use these HTML tags and attributes:</h4>
				    <p>
				        &#60;a href=" " title=" "&#62; &#60;abbr title=" "&#62; &#60;acronym title=" "&#62; &#60;b&#62; &#60;blockquote cite=" "&#62; &#60;cite&#62; &#60;code&#62; &#60;del datetime=" "&#62; &#60;em&#62; &#60;i&#62; &#60;q cite=" "&#62; &#60;strike&#60; &#60;strong&#62;
				    </p>
				</div>
			</div>
		</div>
	</section>
	<?php get_template_part( 'contactform' ); ?>

<?php get_footer(); ?>