<?php if ( !defined('ABSPATH') ) die();
/**
 * The sidebar containing the main widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 * 
 * @package WordPress
 * @subpackage FS_Blog
 * @since FS Blog 1.0
 */
?>
				<aside class="page-sidebar" role="complementary">
				
					<?php if ( is_active_sidebar( 'widgets_area1' ) ) { 
						dynamic_sidebar( 'widgets_area1' ); 
					} ?>
							
				</aside>