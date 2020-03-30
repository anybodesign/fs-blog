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
						
						<header class="post-header">

							<?php if ( '' != get_the_post_thumbnail() ) { ?>
							<div class="post-picture">
								<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('blogpost-hd'); ?></a>
							</div>
							<?php } ?>
							
							<?php if ( is_single() ) { ?>
								<h1 class="post-title"><?php the_title(); ?></h1>
							<?php } else { ?>
								<h2 class="post-title"><a href="<?php the_permalink(); ?> "><?php the_title(); ?></a></h2>
							<?php } ?>
							
						</header>
						
						<div class="post-content">
							
							<?php
								the_content(sprintf(
									
									wp_kses( 
										__( 'Continue reading %s', 'fs-blog' ), 
										array( 'span' => array('class' => array()) )
									),
									the_title( 
										'<span class="screen-reader-text">"', '"</span>', false
									)
								));
							?>
							
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