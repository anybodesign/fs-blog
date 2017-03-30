<?php if ( !defined('ABSPATH') ) die();
/**
 * The header for our theme.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage FS_Blog
 * @since FS Blog 1.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php endif; ?>
	<script type="text/javascript">var templateUrl = '<?= get_bloginfo("template_url"); ?>';</script>
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<div id="wrapper">
	
	
	<header role="banner" id="site_head">
		
		<nav class="skiplinks-nav" role="navigation">
			<ul class="skiplinks-menu">
				<li><a href="#site_nav"><?php _e('Go to main menu', 'from-scratch'); ?></a></li>
				<li><a href="#site_content"><?php _e('Go to main content	', 'from-scratch'); ?></a></li>
			</ul>
		</nav>
		
		<div class="row x-middle inner">
	
			<div class="col-3 site-brand">
				<?php if ( is_front_page() ) { ?>
				<h1 class="site-title">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php _e('Go to Home Page', 'from-scratch'); ?>">
						<img class="logo" src="<?php bloginfo( 'stylesheet_directory' ); ?>/img/fromscratch-logo.svg" alt="logo">
						<span><?php bloginfo( 'name' ); ?></span>
					</a>
				</h1>
				<?php } else { ?>
				<p class="site-title">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php _e('Go to Home Page', 'from-scratch'); ?>">
						<img class="logo" src="<?php bloginfo( 'stylesheet_directory' ); ?>/img/fromscratch-logo.svg" alt="logo">						
						<span><?php bloginfo( 'name' ); ?></span>
					</a>
				</p>
				<?php } ?>
	
				<?php 
					$site_desc = get_bloginfo( 'description', 'display' );
					if ( $site_desc || is_customize_preview() ) { ?>
					<p class="site-desc screen-reader-text"><?php echo $site_desc; ?></p>  <?php // if logo —> .screen-reader-text ?>
				<?php } ?>
			</div>
			
			<?php if ( has_nav_menu( 'main_menu' ) ) : ?>
			<nav class="col-9" role="navigation" id="site_nav">
				<button id="menu-toggle" title="<?php _e('Unfold navigation menu', 'from-scratch'); ?>"><?php _e('Menu', 'from-scratch'); ?><span></span></button>
				<?php wp_nav_menu( array(
					'theme_location'	=> 	'main_menu',
					'menu_class'		=>	'main-menu',
					'container'			=>	false,
					'walker'			=>	new from_scratch_subnav_walker()
					));
				?>
			</nav>
			<?php endif; ?>

		</div>

	</header>
	
	
	
		<div id="site_content">