<?php if ( !defined('ABSPATH') ) die(); ?>

				<?php 
					
					// Recent Posts Loop 
					
					$args = array(
						'posts_per_page' 	=> 3,
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
							<?php if ( '' != get_the_post_thumbnail() ) { ?>
							<div class="recentpost-thumbnail">
								<?php the_post_thumbnail('thumbnail'); ?>
							</div>
							<?php } ?>
							<div class="recentpost-content">
								<p class="h4-like"><?php the_title(); ?></p>
								<?php echo fs_excerpt(10); ?>
								<p><a href="<?php the_permalink(); ?>" class="read-more"  rel="nofollow"><?php _e( 'Read Post', 'fs-blog' ); ?></a></p>
							</div>
						</li>					
					<?php endwhile; ?>
					</ul>

				</div>

				<?php endif; ?>
				<?php wp_reset_postdata(); ?>				