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

			<?php get_template_part( 'template-parts/page', 'banner' ); ?>
			
			<div class="page-wrap has-sidebar">

				<?php if (is_archive() ) { ?>
				<div class="category-description">
					<?php the_archive_description(); ?>
				</div>
				<?php } ?>
				
				<div class="page-content">

				<?php if ( have_posts() ) : ?>
					
					<div id="posts_list">
					<?php while ( have_posts() ) : the_post(); ?>
						<?php get_template_part( 'template-parts/content', 'posts', get_post_format() ); ?>
					<?php endwhile; ?>
					</div>
					
					<div class="spinner">
						<img src="<?php echo FS_THEME_URL; ?>/img/ajax-loader.gif" alt="">
					</div>
					<div class="trigger">
						<button id="post_trigger" class="action-btn"><?php _e('Load more', 'fs-blog'); ?></button>
					</div>
					<div class="no-more">
						<p class="text-intro">
							<?php _e('No more posts', 'fs-blog'); ?>
						</p>
					</div>
					
					<div id="posts_nav">
					<?php the_posts_pagination(array(
							'prev_text'          => __( 'Previous page', 'fs-blog' ),
							'next_text'          => __( 'Next page', 'fs-blog' ),
							'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'fs-blog' ) . ' </span>',
						)); ?>
					</div>
		
				<?php else : ?>

					<?php get_template_part( 'template-parts/content', 'none' ); ?>
					
				<?php endif; ?>	
				
				</div>
				
				<?php get_sidebar(); ?>
			
			</div>

<?php get_footer(); ?>