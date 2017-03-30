<?php if ( !defined('ABSPATH') ) die(); ?>
				
				
				<div class="row">

					<?php if ( is_home() || is_search() || is_category() ) { 
							$large_image_url = get_the_post_thumbnail_url( get_option( 'page_for_posts' ) ); 
					?>

					<div class="page-banner" <?php if ( isset($large_image_url)) { echo 'style="background-image: url('.$large_image_url.')"'; } ?>>
						
					<?php } else if ( is_tax() ) { ?>	
					
					<div class="page-banner">
						
					<?php } else { 
						if ( '' != get_the_post_thumbnail() ) {
							$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large' ); 
						}
					?>
					
					<div class="page-banner" <?php if ( '' != get_the_post_thumbnail() ) { echo 'style="background-image: url('.$large_image_url[0].')"'; } ?>>
					
					<?php } ?>

						<?php if ( is_home() && ! is_front_page() ) { ?>
						<h1 class="page-title"><?php single_post_title(); ?></h1>
						<?php } else if (is_search() ) { ?>
						<h1 class="page-title"><?php printf( esc_html__( 'Search Results for: %s', 'from-scratch' ), get_search_query() ); ?></h1>
						<?php } else if (is_archive() ) { ?>
						<h1 class="page-title"><?php the_archive_title(); ?></h1>
						<?php } else { ?>
						<h1 class="page-title"><?php the_title(); ?></h1>
						<?php } ?>
					
					</div>
				</div>