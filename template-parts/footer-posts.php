<?php if ( !defined('ABSPATH') ) die(); ?>

				<?php 
					
					$nb = get_theme_mod('posts_nb', 3);
					$thumb = get_theme_mod('posts_show_thumb', true);
					$excerpt = get_theme_mod('posts_show_excerpt', true);
					$link = get_theme_mod('posts_show_link', true);
					
					 
					// Recent Posts Loop 
					
					$args = array(
						'posts_per_page' 	=> $nb,
						'post_type' 		=> 'post',
						'order'				=> 'DESC'
					);
					$query = new WP_Query($args);
				?>						
			
				<?php if ($query->have_posts()) : ?>
										
				<div class="footer-posts">
					
					<h3 class="widget-title"><?php _e('Recent Posts', 'fs-blog'); ?></h3>
					<ul class="recentpost-list">
					<?php while ($query->have_posts()) : $query->the_post(); ?>
						<li>
							<?php if ( '' != get_the_post_thumbnail() && $thumb != false ) { ?>
							<div class="recentpost-thumbnail">
								<?php the_post_thumbnail('thumbnail'); ?>
							</div>
							<?php } ?>
							<div class="recentpost-content">
								<p class="h4-like"><?php the_title(); ?></p>
								
								<?php if ($excerpt != false) { ?>
								<p class="recentpost-excerpt"><?php echo fs_excerpt(10); ?></p>
								<?php } ?>
								
								<a href="<?php the_permalink(); ?>" class="read-more recentpost-link"  rel="nofollow">
										<span<?php if ($link != true) { echo ' class="screen-reader-text"'; } ?>><?php _e( 'Read Post', 'fs-blog' ); ?></span>
								</a>
							</div>
						</li>					
					<?php endwhile; ?>
					</ul>
					
				</div>
				
				<?php endif; ?>
				<?php wp_reset_postdata(); ?>				