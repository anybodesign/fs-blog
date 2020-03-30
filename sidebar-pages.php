<?php if ( !defined('ABSPATH') ) die();
/**
 * The sidebar containing the main widget area for pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 * 
 * @package WordPress
 * @subpackage FS_Blog
 * @since FS Blog 1.0
 */
?>
				<aside class="page-sidebar" role="complementary">
				
					<?php
						$parent = $post->post_parent;
						
						if ($post->post_parent)
						$children = wp_list_pages("title_li=&child_of=".$post->post_parent."&echo=0");
						else
						$children = wp_list_pages("title_li=&child_of=".$post->ID."&echo=0");
						if ($children) {
					?>
					<div class="widget-container">
						<ul class="subpages-list">
							<?php echo $children; ?>
						</ul>
					</div>

					<?php } ?>
					
				</aside>