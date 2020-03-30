<?php if ( !defined('ABSPATH') ) die();
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package WordPress
 * @subpackage FS_Blog
 * @since FS Blog 1.0
 */
get_header(); ?>
				
			<?php 
				get_template_part( 'template-parts/page', 'banner' );
				get_template_part( 'template-parts/page', '404' ); 
			?>

<?php get_footer(); ?>