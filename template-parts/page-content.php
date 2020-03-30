<?php if ( !defined('ABSPATH') ) die(); ?>

					<?php
						$parent = $post->post_parent;
						
						if ($post->post_parent)
							$children = wp_list_pages("title_li=&child_of=".$post->post_parent."&echo=0");
						else
							$children = wp_list_pages("title_li=&child_of=".$post->ID."&echo=0");
					?>
				
					<div class="page-wrap<?php if ( $children ) { echo ' has-sidebar'; } ?>">
						
						<div class="page-content">
							<?php the_content(); ?>
						</div>

						<?php if ( comments_open() || get_comments_number() ) : ?>
							<?php comments_template(); ?>
						<?php endif;?>
						
						<?php if ( $children ) { ?>
						<aside class="page-sidebar" role="complementary">
						
							<div class="widget-container">
								<ul class="subpages-list">
									<?php echo $children; ?>
								</ul>
							</div>
							
						</aside>
						<?php } ?>
					
					</div>