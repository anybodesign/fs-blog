<?php if ( !defined('ABSPATH') ) die(); ?>
				
					<div class="page-wrap has-sidebar">
						
						<div class="page-content">
							<?php 
								the_content();
								get_template_part('template-parts/post', 'meta');

								if ( comments_open() || get_comments_number() ) :
									comments_template();
								endif;
							?>
						</div>
						
						<?php get_sidebar(); ?>
					
					</div>