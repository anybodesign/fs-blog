<?php if ( !defined('ABSPATH') ) die();
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package WordPress
 * @subpackage FS_Blog
 * @since FS Blog 1.0
 */

get_header(); ?>

				<main id="primary" class="content-area" role="main">

					<?php get_template_part( 'template-parts/page', 'banner' ); ?>
					
					<div class="row inner">

						<div class="col-6 left-1 right-1">

							<section class="error-404 not-found">
								<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try a search?', 'fs-blog' ); ?></p>
								<?php get_search_form(); ?>		
							</section>	

						</div>
						
						<div class="col-3 right-1">
							<?php get_sidebar(); ?>
						</div>
					
					</div>

				</main> <?php // END primary ?>


<?php get_footer(); ?>