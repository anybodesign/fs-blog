<?php
/**
 * Template part for displaying the main nav.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage FS_Blog
 * @since FS Blog 1.0
 */
?>

			<?php if ( has_nav_menu( 'main_menu' ) ) : ?>
			<nav class="col-7 right-1" role="navigation" id="site_nav">
				<button id="menu-toggle" title="<?php _e('Unfold navigation menu', 'fs-blog'); ?>"><?php _e('Menu', 'fs-blog'); ?><span></span></button>
				<?php wp_nav_menu( array(
					'theme_location'	=> 	'main_menu',
					'menu_class'		=>	'main-menu',
					'container'			=>	false,
					'walker'			=>	new fs_blog_subnav_walker()
					));
				?>
			</nav>
			<?php endif; ?>