<?php if ( !defined('ABSPATH') ) die(); ?>

					<?php
						$parent = $post->post_parent;
						
						if ($post->post_parent)
						$children = wp_list_pages("title_li=&child_of=".$post->post_parent."&echo=0");
						else
						$children = wp_list_pages("title_li=&child_of=".$post->ID."&echo=0");
						
						if ($children) { $col = 'col-8'; } else { $col = 'col-10 left-1 right-1'; }
					?>
				
					<div class="row inner">
						
						<div class="<?php echo $col; ?>">

							<div class="page-content">
								<?php the_content(); ?>
							</div>

							<?php if ( comments_open() || get_comments_number() ) : ?>
								<?php comments_template(); ?>
							<?php endif;?>
						</div>
						
						<?php if ($children) { ?>
						<div class="col-3 left-1">
							<aside class="widget-area" role="complementary">
							
								<div class="widget-container">
									<ul class="subpages-list">
										<?php echo $children; ?>
									</ul>
								</div>
								
							</aside>
						</div>
						<?php } ?>
						
					
					</div>