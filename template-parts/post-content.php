<?php if ( !defined('ABSPATH') ) die(); ?>
				
					<div class="row inner">
						
						<div class="col-8">

							<?php if (is_archive() ) { ?>
							<div class="category-description">
								<?php the_archive_description(); ?>
							</div>
							<?php } ?>

							<div class="page-content">
								<?php the_content(); ?>
							</div>
							<?php get_template_part('template-parts/post', 'meta'); ?>

							<?php if ( comments_open() || get_comments_number() ) : ?>
								<?php comments_template(); ?>
							<?php endif;?>
						</div>
						
						<div class="col-3 left-1">
							<?php get_sidebar(); ?>
						</div>
					
					</div>