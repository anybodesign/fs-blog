<?php if ( !defined('ABSPATH') ) die(); ?>
				
				
				<div class="row">

					<?php if ( is_front_page() || is_search() || is_category() ) { ?>

					<div class="page-banner">
					
					<?php } else if ( '' != get_the_post_thumbnail() && is_home() ) {
							$large_image_url = get_the_post_thumbnail_url( get_option( 'page_for_posts' ) );
					?>

					<div class="page-banner" <?php if ( '' != get_the_post_thumbnail() ) { echo 'style="background-image: url('.$large_image_url.')"'; } ?>>
					

					<?php } else if ( '' != get_the_post_thumbnail() ) {
							$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large' );
					?>
					
					<div class="page-banner" <?php if ( '' != get_the_post_thumbnail() ) { echo 'style="background-image: url('.$large_image_url[0].')"'; } ?>>
					
					<?php } else { ?>

					<div class="page-banner">
					
					<?php } ?>

						
						<h1 class="page-title">
							<?php if ( is_front_page() ) { ?>
							<?php esc_html_e( 'Hello :)', 'fs-blog' ); ?>
							
							<?php } else if (is_home() ) { ?>
							<?php single_post_title(); ?>

							<?php } else if (is_search() ) { ?>
							<?php printf( esc_html__( 'Search Results for: %s', 'fs-blog' ), get_search_query() ); ?>
							
							<?php } else if (is_archive() ) { ?>
							<?php single_cat_title(); ?>
							
							<?php } else if (is_404() ) { ?>
							<?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'fs-blog' ); ?>
							
							<?php } else { ?>
							<?php the_title(); ?>
							
							<?php } ?>
						</h1>

					
					</div>
				</div>