<?php
/**
 * Template part for displaying the post meta.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage FS_Blog
 * @since FS Blog 1.0
 */
	$date = get_theme_mod('meta_date', true);
	$author = get_theme_mod('meta_author', true);
	$cat = get_theme_mod('meta_category', true);
?>
							<div class="post-meta">
								
								<?php if ( $date != false || $author != false || $cat != false ) { ?>
								<p class="meta-infos">
									<?php esc_html_e( 'Posted ', 'fs-blog' ); ?>
									<?php if ( $date != false ) { 
										esc_html_e( 'on&nbsp;', 'fs-blog' ); 
										echo the_time( get_option('date_format') ); 
									} ?>
									<?php if ( $author != false ) {
										esc_html_e( 'by&nbsp;', 'fs-blog' ); the_author(); 
									} ?>
									<?php if ( $cat != false ) {
										esc_html_e( 'in&nbsp;', 'fs-blog' ); the_category(', '); 
									} ?>
								</p>
								<?php } ?>
									
								<?php if ( ! get_comments_number()==0 ) : ?>
								<p class="meta-comments">
									<a href="<?php the_permalink() ?>#comments"><?php comments_number('0', '1', '%'); ?> <?php _e( 'Comment(s)', 'fs-blog' ); ?></a>
								</p>
		    					<?php endif; ?>
							</div>