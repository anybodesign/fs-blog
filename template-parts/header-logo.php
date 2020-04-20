<?php
/**
 * Template part for displaying the site logo.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage FS_Blog
 * @since FS Blog 1.0
 */
?>

					<?php if(get_theme_mod('site_logo')) { ?>
					<img class="logo" src="<?php echo get_theme_mod('site_logo', 'none'); ?>" alt="<?php echo esc_url(bloginfo('name')); ?>">
					<?php } else {
						echo esc_url(bloginfo('name'));
					} ?>