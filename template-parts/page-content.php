<?php if ( !defined('ABSPATH') ) die(); ?>

					<?php
						$parent = $post->post_parent;
						
						if ($post->post_parent)
							$children = wp_list_pages("title_li=&child_of=".$post->post_parent."&echo=0");
						else
							$children = wp_list_pages("title_li=&child_of=".$post->ID."&echo=0");
					?>
				
					<div class="page-wrap<?php if ( $children || is_page_template( 'pagecustom-sidebar.php' ) ) { echo ' has-sidebar'; } ?>">
						
						<div class="page-content">
							<?php 
								the_content();
									
								if ( comments_open() || get_comments_number() ) :
									comments_template();
								endif;
							?>
						</div>

						
						<?php if ( $children || is_page_template( 'pagecustom-sidebar.php' ) ) { ?>
						<aside class="page-sidebar" role="complementary">
							
							<?php if ( $children ) { ?>
							<div class="widget-container">
								<ul class="subpages-list">
									<?php echo $children; ?>
								</ul>
							</div>
							<?php } ?>
							
							<?php if ( is_active_sidebar( 'page_widgets' ) ) { 
								dynamic_sidebar( 'page_widgets' );
							} ?>
							
						</aside>
						<?php } ?>
					
					</div>