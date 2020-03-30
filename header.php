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
		
		<?php get_template_part('template-parts/header', 'skiplinks'); ?>
		
		<div class="row inner">
			
			<div class="site-brand-container">
				<?php get_template_part('template-parts/header', 'brand'); ?>
				<?php get_template_part('template-parts/header', 'nav'); ?>
			</div>

		</div>

	</header>
	
	
		<main id="site_content" class="content-area" role="main">