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
		</main> <?php // END content ?>
		
		<?php if ( ! is_page_template( 'pagecustom-maintenance.php' ) ) { ?>
		<footer role="contentinfo" id="site_foot">
			
			<div class="row inner">
				
				<?php if ( is_active_sidebar( 'footer_area1' ) || get_theme_mod('author_bio') != false ) { ?> 
				<div class="footer-section">
					<?php 
						if ( get_theme_mod('author_bio') != false && !is_404() ) {
							get_template_part( 'template-parts/footer', 'biography' );
						} 
						dynamic_sidebar( 'footer_area1' );
					?>
				</div>
				<?php } ?>
				
				<?php if ( is_active_sidebar( 'footer_area2' ) || get_theme_mod('last_posts') != false ) { ?> 
				<div class="footer-section">
					<?php 
						if ( get_theme_mod('last_posts') != false ) {
							get_template_part( 'template-parts/footer', 'posts' );
						} 
						dynamic_sidebar( 'footer_area2' );
					?>
				</div>
				<?php } ?>

				<?php if ( is_active_sidebar( 'footer_area3' ) ) { ?> 
				<div class="footer-section">
					<?php dynamic_sidebar( 'footer_area3' ); ?> 
				</div>
				<?php } ?>


					
				<div class="footer-mentions">
					<p class="footer-copyright">
						
						<?php if(get_theme_mod('footer_text')) {
							echo get_theme_mod('footer_text', ''); 
						} else {
							echo '&copy;'; echo date(' Y '); echo esc_url(bloginfo('name')).'.'; 	
						} ?>
						
						<?php if(get_theme_mod('display_wp') != false) { ?>
						<a href="//wordpress.org" class="wp-love"><?php _e('Powered by WordPress!', 'fs-blog'); ?></a>
						<?php } ?>
						
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
			
		</footer>
		<?php } ?>
		
		<?php if(get_theme_mod('back2top') == true) { ?>
			<button id="back2top" title="<?php esc_html_e('Back to top','fs-blog'); ?>">
				<img src="<?php echo FS_THEME_URL; ?>/img/ui/back-to-top.svg" alt="">
			</button>
		<?php } ?>		
		
</div> <?php // END wrapper ?>

<?php wp_footer(); ?>

</body>
</html>
