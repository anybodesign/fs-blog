<?php if ( !defined('ABSPATH') ) die();
/**
 * Template Name: Page without Sidebar
 *
 * @package WordPress
 * @subpackage FS_Blog
 * @since FS Blog 1.0
 */
__( 'Page without Sidebar', 'fs-blog' );
get_header(); ?>
				
			<?php while ( have_posts() ) : the_post(); ?>
			
				<?php get_template_part( 'template-parts/page', 'banner' ); ?>

				<?php get_template_part( 'template-parts/page', 'content' ); ?>

			<?php endwhile; ?>
													
<?php get_footer(); ?>