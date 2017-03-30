<?php if ( !defined('ABSPATH') ) die();
/**
 * The template for displaying the footer.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage FS_Blog
 * @since FS Blog 1.0
 */
?>
		</div> <?php // END content ?>
		

		<footer role="contentinfo" id="site_foot">
			
			<div class="row x-center inner">
				
				<?php if ( is_active_sidebar( 'footer_area1' ) ) { ?> 
					
				<div class="col-4">
					<div class="footer-section">
					<?php dynamic_sidebar( 'footer_area1' ); ?> 
					</div>
				</div>
					
				<?php } else { ?>

				<div class="col-4">
					<div class="footer-section">
						
						<?php get_template_part( 'template-parts/footer', 'biography' ); ?>
						
					</div>
				</div>
				
				<?php } ?>
				
				
				
				<?php if ( is_active_sidebar( 'footer_area2' ) ) { ?> 
					
				<div class="col-4">
					<div class="footer-section">
					<?php dynamic_sidebar( 'footer_area2' ); ?> 
					</div>
				</div>
					
				<?php } else { ?>
				
				
				<?php get_template_part( 'template-parts/footer', 'posts' ); ?>


				<?php } ?>
				


				<?php if ( is_active_sidebar( 'footer_area3' ) ) { ?> 
					
				<div class="col-4">
					<div class="footer-section">
					<?php dynamic_sidebar( 'footer_area3' ); ?> 
					</div>
				</div>
					
				<?php } ?>


				<div class="col-12">				
					
					<div class="footer-mentions">
						<p class="footer-copyright">
							&copy; <?php echo date(' Y '); if (get_option( 'from_scratch_settings' )['from_scratch_copyright']) { echo get_option( 'from_scratch_settings' )['from_scratch_copyright']; } else { echo esc_url( bloginfo( 'name' ) ); } ?>
						</p>
						
						<?php if ( has_nav_menu( 'footer_menu' ) ) : ?>
						<nav class="footer-nav">
						<?php wp_nav_menu( array(
								'theme_location'	=> 	'footer_menu',
								'menu_class'		=>	'footer-menu',
								'container'			=>	false
								));
						?>
						</nav>
						<?php endif; ?>
					</div>	
					
				</div>
			</div>
			
		</footer>

		
</div> <?php // END wrapper ?>

<?php wp_footer(); ?>

</body>
</html>
