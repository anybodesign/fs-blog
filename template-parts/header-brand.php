<?php
/**
 * Template part for displaying the site brand.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage FS_Blog
 * @since FS Blog 1.0
 */
?>

			<div class="col-3 site-brand">
				
				<?php if ( is_front_page() ) { ?>
				<h1 class="site-title">
				<?php } else { ?>
				<p class="site-title">
				<?php } ?>
					
					<?php get_template_part('template-parts/header', 'logo'); ?>

				<?php if ( is_front_page() ) { ?>
				</h1>
				<?php } else { ?>
				</p>
				<?php } ?>
	
				<?php 
					$site_desc = get_bloginfo( 'description', 'display' );
					if ( $site_desc || is_customize_preview() ) { ?>
					<p class="site-desc <?php if(get_theme_mod('site_logo')) { echo'screen-reader-text'; } ?>"><?php echo $site_desc; ?></p>
				<?php } ?>
				
			</div>

