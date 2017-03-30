<?php if ( !defined('ABSPATH') ) die();
/**
 * The main template file.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage FS_Blog
 * @since FS Blog 1.0
 */
get_header(); ?>
				<main id="primary" class="content-area" role="main">

					<?php get_template_part( 'template-parts/page', 'banner' ); ?>
					
					<div class="row inner">

						<?php if (is_archive() ) { ?>
							<div class="col-8 left-2 right-2">
								<div class="category-descritpion">
									<?php the_archive_description(); ?>
								</div>
							</div>
						<?php } ?>
						
						<div class="col-6 left-1 right-1">

						<?php if ( have_posts() ) : ?>
							
							<div id="posts_list">
							
							<?php while ( have_posts() ) : the_post(); ?>
				
								<?php get_template_part( 'template-parts/content', 'posts', get_post_format() ); ?>
				
							<?php endwhile; ?>

							</div>
							
							<div id="posts_nav">
								<?php the_posts_pagination(array(
										'prev_text'          => __( 'Previous page', 'from-scratch' ),
										'next_text'          => __( 'Next page', 'from-scratch' ),
										'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'from-scratch' ) . ' </span>',
									)); ?>
							</div>
				
						<?php else : ?>
		
							<?php get_template_part( 'template-parts/content', 'none' ); ?>
							
						<?php endif; ?>	
						
						</div>
						
						<div class="col-3 right-1">
							<?php get_sidebar(); ?>
						</div>
					
					</div>

				</main> <?php // END primary ?>
							
<?php get_footer(); ?>