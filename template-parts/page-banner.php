<?php if ( !defined('ABSPATH') ) die(); ?>
				
				<div class="page-banner"<?php fs_bg_img(); ?>>
					
					<div class="page-banner-title">
						<h1 class="page-title">
							<?php if ( is_front_page() ) { ?>
	
							<?php if ( get_theme_mod('welcome_title') ) {
								echo get_theme_mod( 'welcome_title', '' ); 
							} ?>
							
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
	
						<?php if ( is_front_page() || is_home() ) { ?>
							<?php if ( get_theme_mod( 'welcome_text' ) ) { ?>
								<p class="text-intro"><?php echo get_theme_mod('welcome_text', ''); ?></p>
							<?php } ?>
						<?php } ?>
					</div>

				</div>

			<?php if ( ! is_page_template( 'pagecustom-maintenance.php' ) ) { ?>
			
				<?php if ( function_exists( 'bcn_display' ) && ! is_front_page() ) { ?>
			    <div class="breadcrumbs" typeof="BreadcrumbList" vocab="https://schema.org/">
				    <div class="inner">
						<?php bcn_display(); ?>
				    </div>
				</div>
				<?php } ?>
			
			<?php } ?>