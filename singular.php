<?php if ( !defined('ABSPATH') ) die();
/**
 * The template for displaying all pages and posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
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

					<?php if ( comments_open() || get_comments_number() ) : ?>
					
					<div class="row inner">
						<div class="col-8 left-2 right-2">
				  		<?php comments_template(); ?>
						
						</div>
					</div>
					
					<?php endif;?>

				<?php endwhile; ?>
					
				</main> <?php // END primary ?>

<?php get_footer(); ?>