<?php if ( !defined('ABSPATH') ) die(); ?>
				
					<?php
						$parent = $post->post_parent;
						
						if ($parent)
						$children = wp_list_pages("title_li=&child_of=".$parent."&echo=0");
						else
						$children = wp_list_pages("title_li=&child_of=".$post->ID."&echo=0");
						
						if ($children && ! is_page_template('pagecustom-nosidebar.php') ) {
					?>


					<div class="row inner">
						
						<div class="col-6 left-1 right-1">

							<div class="page-content">
								<?php the_content(); ?>
							</div>

							<?php if ( comments_open() || get_comments_number() ) : ?>
								<?php comments_template(); ?>
							<?php endif;?>
						</div>
						
						<div class="col-3 right-1">
							<?php get_sidebar(); ?>
						</div>
					
					</div>
					
					<?php } else { ?>
					
					
					<div class="row inner">
						<div class="col-8 left-2 right-2">
							
						<?php if (is_archive() ) { ?>
							<div class="category-description">
								<?php the_archive_description(); ?>
							</div>
						<?php } ?>
							
							<div class="page-content">
								<?php the_content(); ?>
							</div>
							
						<?php if ( is_singular('post') ) { 
							
							get_template_part('template-parts/post', 'meta');
													
						} ?>
							
						</div>					
					</div>
					
					
					<?php } ?>