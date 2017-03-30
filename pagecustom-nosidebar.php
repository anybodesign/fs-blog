<?php if ( !defined('ABSPATH') ) die();
/**
 * Template Name: Page without Sidebar
 *
 * @package WordPress
 * @subpackage FS_Blog
 * @since FS Blog 1.0
 */
get_header(); ?>

				<main id="primary" class="content-area" role="main">
				
				<?php while ( have_posts() ) : the_post(); ?>
				
					<?php get_template_part( 'template-parts/page', 'banner' ); ?>

					<?php get_template_part( 'template-parts/page', 'content' ); ?>

				<?php endwhile; ?>
					
				</main> <?php // END primary ?>
								
<?php get_footer(); ?>