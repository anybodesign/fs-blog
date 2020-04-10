<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage FS_Blog
 * @since FS Blog 1.0
 */
?>
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						
						<header class="post-header<?php if ( '' == get_the_post_thumbnail() ) { echo ' no-picture'; }?>">

							<div class="post-picture">
								<a href="<?php the_permalink(); ?>">
								<?php if ( '' != get_the_post_thumbnail() ) {
									$img_id = get_post_thumbnail_id();
									$img_url = wp_get_attachment_image_src( $img_id, 'blogpost' );
									$img_alt = get_post_meta($img_id, '_wp_attachment_image_alt', true);
								?>
									<img src="<?php echo $img_url[0]; ?>" alt="<?php echo $img_alt; ?>">
								<?php } else { ?>
									<img src="<?php echo FS_THEME_URL; ?>/img/fallback.png" alt="">
								<?php } ?>
								</a>
							</div>
							
							<h2 class="post-title">
								<a href="<?php the_permalink(); ?>">
									<?php the_title(); ?>
								</a>
							</h2>

						</header>
						
						<div class="post-content">
							<div class="post-excerpt">
							<?php the_excerpt(); ?>
							</div>
							<p><a href="<?php the_permalink(); ?>" class="read-more"  rel="nofollow"><?php _e( 'Read More', 'fs-blog' ); ?></a></p>
						</div>
						
						<footer class="post-footer">

							<?php get_template_part('template-parts/post', 'meta'); ?>							
							
							<?php if (! is_search() ) { ?>
								<?php $posttags = get_the_tags(); if ($posttags) { ?>
							  	<div class="tag-links">
									<p><?php _e( 'Tagged with:', 'fs-blog' ); ?></p>
									<?php the_tags('<ul><li>', '</li><li>', '</li></ul>'); ?>
							  	</div>
							  	<?php } ?>					
							<?php } ?>
							
							<?php 
								wp_link_pages(array(
									'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'fs-blog' ),
									'after'  => '</div>',
								));
							?>
						</footer>
																		
					</article>