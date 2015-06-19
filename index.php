<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * e.g., it puts together the home page when no home.php file exists.
 *
 * Learn more: {@link https://codex.wordpress.org/Template_Hierarchy}
 */
?>

<?php get_header(); ?>

	<section class="banner">
		<div class="container">
			<ul>
				<li><?php
				if ( get_option('page_for_posts') ) {
					$blog_page_id = get_option('page_for_posts');
					echo '<a href="' . get_permalink( $blog_page_id ) . '">' . get_page($blog_page_id)->post_title . '</a>';
				} else {
					echo '<a href="' . get_bloginfo( 'url' ) . '">BLOG</a>';
				}
				?></li>
			</ul>
		</div>
	</section>

	<section class="human">
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-sm-9">
					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
						<div class="fragment-human">
							<?php
							$thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );
							$url = $thumb['0'];
							?>
							<?php if ($url) : ?>
							<img src="<?php echo $url; ?>" class="human-img" />
							<?php endif; ?>

							<h1 class="text-center"><?php the_title(); ?></h1>

							<ul class="list-top text-center">
								<li><a href="<?php echo get_author_posts_url( get_the_author_meta('ID') ); ?>"><img src="<?php echo IMAGES; ?>/icon-user.png" /> <?php the_author(); ?> /</a></li>
								<li><a href="#"><img src="<?php echo IMAGES; ?>/icon-clock.png" /><?php the_time( ' F d.m.Y /' ); ?></a></li>
								<li style="color:#aaa; font-size:10px"><img src="<?php echo IMAGES; ?>/icon-folder.png" /> <?php echo get_the_category_list( ', ' ); ?></li>
							</ul>

							<?php the_excerpt(); ?>

							<p class="continue-read-link text-center"><a href="<?php the_permalink(); ?>">Continue Read</a></p>

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
						</div>
					<?php endwhile; ?>
					<div class="list-pagination">
						<!-- <ul class="pagination pagination-lg">
							<li><a href="<?php get_previous_posts_link( ); ?>">&laquo;</a></li>
							<li><a href="#">1</a></li>
							<li><a href="#">2</a></li>
							<li><a href="#">3</a></li>
							<li><?php echo next_posts_link( '&raquo;' ); ?></li>
						</ul> -->
					</div><!-- end of list-pagination -->
					<div class="list-pagination text-center">
						<ul class="pagination pagination-lg">
						<?php numeric_posts_nav(); ?>
						</ul>
					</div>
					<!-- <div class="text-center" style="font-size:200%"> --> <!-- default WP pagination -->
						<!-- the_posts_pagination( array( -->
							<!-- 'mid_size'			=> '2',
							'prev_text' 		=> '&larr;',
							'next_text' 		=> '&rarr;',
							'screen_reader_text'=> ' ' -->
						<!-- ) ); -->
					<!-- </div> -->
					<div class="list-pagination text-center" style="font-size:200%">
						<ul class="pagination pagination-lg">
							<?php
							$args = array(
								'prev_text'	=> '&laquo;',
								'next_text'	=> '&raquo;',
								'type'		=> 'array',
								'mid_size'	=> '1'
								);
							for ($i=0; $i<count(paginate_links($args)); $i++) {
								$blog_page = paginate_links( $args );
								echo '<li>' . $blog_page[$i] . '</li>';
							}
							?>
						</ul>
					</div>
					<?php else : ?>
					<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
					<?php endif; ?>
				</div><!-- end of col-sm-9 -->
				<div class="col-xs-12 col-sm-3">
					<div class="fragment-human">
						<div class="heading">
							<h3 class="text-center"><span>A</span>rchives</h3>
						</div>
						<div class="archives">
							<p>
							<?php wp_get_archives( array(
								'type'            => 'monthly',
								'limit'           => '',
								'format'          => 'custom',
								'before'          => '',
								'after'           => '<br>',
								'show_post_count' => true,
								'echo'            => 1,
								'order'           => 'DESC'
							)); ?>
							</p>
						</div>
					</div><!-- end of fragment-human -->
					<div class="fragment-human">
						<div class="heading-post">
							<h3 class="text-center"><span>R</span>ecent <span>P</span>osts</h3>
						</div>
						<?php
							$args = array( 'numberposts' => '3' );
							$recent_posts = wp_get_recent_posts( $args );
							foreach( $recent_posts as $recent ) {
								echo '<div class="popular-post"><a href="' . get_permalink( $recent["ID"] )
								. '"><h4 class="text-center">' . $recent["post_title"]
								. '</h4></a><p class="text-center"><i>'
								. get_the_time( 'F d, Y', $recent['ID'] ) . '</i></p>'
								. get_the_post_thumbnail( $recent["ID"], array(130,130), array('class' => 'human-img') )
								. '</div>';
							}
						?>
					</div><!-- end of fragment-human -->
					<div class="fragment-human">
					    <div class="heading-subscribe">
					        <h3 class="text-center"><span>S</span>ubscribe</h3>
					    </div>
					    <div class="subscribe">
					        <h3><span>S</span>ubscribe now if you want to recieve updates and news via email.</h3>
					        <div class="paper-plane">
					            <h3><span>E</span>nter your email...</h3>
					            <img src="<?php echo IMAGES; ?>/paper-plane.png" class="pull-right" />
					        </div>
					    </div>
					</div><!-- end of fragment-human -->
					<div class="fragment-human">
					    <div class="heading-post">
					        <h3 class="text-center"><span>P</span>opular <span>P</span>osts</h3>
					    </div>
						<?php
		                    $most_viewed_posts = new WP_Query( array('v_sortby' => 'views', 'v_orderby' => 'DESC', 'showposts' => 3) );
							if ($most_viewed_posts->have_posts()) : while ($most_viewed_posts->have_posts()) : $most_viewed_posts->the_post();
							$thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), array(130,130) );
							$url = $thumb['0']; ?>
							<div class="popular-post">
								<a href="<?php the_permalink(); ?>"><h4 class="text-center"><?php the_title(); ?></h4></a>
								<p class="text-center"><i><?php the_time( 'F d, Y'); ?></i></p>
							    <?php if ($url) { ?>
							    	<img src="<?php echo $url; ?>" class="human-img" />
								<?php } ?>
							</div>
							<?php
							endwhile; endif;
							wp_reset_postdata();
						?>
					</div><!-- end of fragment-human -->
				</div><!-- end of col-xs-12 col-sm-3 -->
			</div><!-- end of row -->
		</div><!-- end of container -->
	</section>

<?php get_footer();?>
