<?php if ( !defined('ABSPATH') ) die();
/**
 * The template for displaying comments
 *
 * @package WordPress
 * @subpackage FS_Blog
 * @since FS Blog 1.0
 */

if ( post_password_required() ) {
	return;
}
?>

					<div id="comments" class="comments-area">

					<?php if ( have_comments() ) : ?>
						<h3 class="comments-title"><?php _e('They talk about it','fs-blog'); ?></h3>
				
						<ol class="comment-list">
							<?php
								wp_list_comments( 
									array(
										'avatar_size' => 128,
									)
								);
							?>
						</ol>
						
						<div>
							<?php paginate_comments_links(); ?>
						</div>
				
					<?php endif;?>
				
					<?php if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>
						<p class="no-comments"><?php _e( 'Comments are closed.', 'fs-blog' ); ?></p>
					<?php endif; ?>
					
					<?php
					$comments_args = array(
				       	//'comment_notes_after' => 'fs-blog',
				        //'logged_in_as' => 'fs-blog',
				        'title_reply' => __('Do we talk about it?', 'fs-blog'),
				        'label_submit' => __('Add my comment!', 'fs-blog')
					);
					
					comment_form($comments_args);
					?>
				
				</div>