<?php if ( !defined('ABSPATH') ) die(); ?>
				
				
						<div class="author-info">
							<div class="author-avatar">
								<?php echo get_avatar( get_the_author_meta( 'user_email' ) ); ?>
							</div>
						
							<div class="author-description">
								<h3 class="widget-title"><?php echo get_the_author(); ?></h3>
						
								<p class="author-bio">
									<?php the_author_meta( 'description' ); ?>
								</p>
							</div>
						</div>