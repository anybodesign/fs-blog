<?php
/**
 * FS Blog Customizer functionality
 *
 * @package WordPress
 * @subpackage FS_Blog
 * @since FS Blog 1.0
 */
 

// Customizer Settings
 
function fs_blog_customize_register($wp_customize) {
	 
	// Create Some Sections
	
	$wp_customize->add_section('fs_pictures_section', array(
		'title' 		=> __('Pictures', 'fs-blog'),
		'description' 	=> __('Pictures customisation', 'fs-blog'),
		'priority'		=> 40,
	));
	$wp_customize->add_section('fs_footer_section', array(
		'title' 		=> __('Footer', 'fs-blog'),
		'description' 	=> __('Customise the footer', 'fs-blog'),
		'priority'		=> 30,
	));
	
	
	//
	// Head Section
	// 
	// /////////////////


		// Site logo
		
		$wp_customize->add_setting('site_logo', array(
			'sanitize_callback'		=> 'esc_url_raw'
		));
		
		$wp_customize->add_control( new WP_Customize_Image_control($wp_customize, 'site_logo', array(
			'label'			=> __('Site Logo', 'fs-blog'),
			'section'		=> 'title_tagline',
			'settings'		=> 'site_logo',
		)));


		// Hide/Show Baseline
		
		$wp_customize->add_setting('wp_baseline', array(
			'default'	=> false,
			'sanitize_callback'	=> 'fs_customizer_sanitize_checkbox',		
		));
		
		$wp_customize->add_control('wp_baseline', array(
			'type'			=> 'checkbox',
			'label'			=> __('Hide the tagline (in an accessible way)', 'fs-blog'),
			'section'		=> 'title_tagline',
			'settings'		=> 'wp_baseline',
		));
	

		// Banner Welcome title
		
		$wp_customize->add_setting('welcome_title', array(
			'default'			=> __('Hello there :)','fs-blog'),
			'sanitize_callback'	=> 'sanitize_text_field',		
		));
		$wp_customize->add_control('welcome_title', array(
			'label'			=> __('Front page welcome title', 'fs-blog'),
			'description'	=> __('Add a custom text instead of Hello.', 'fs-blog'),
			'section'		=> 'title_tagline',
			'settings'		=> 'welcome_title',
		));
		
		// Banner Welcome text
		
		$wp_customize->add_setting('welcome_text', array(
			'default'			=> __('Ex: Welcome to my awesome WordPress blog.','fs-blog'),
			'sanitize_callback'	=> 'sanitize_text_field',		
		));
		$wp_customize->add_control('welcome_text', array(
			'type'			=> 'textarea',
			'label'			=> __('Front page welcome text', 'fs-blog'),
			'description'	=> __('Add a custom text instead of Hello.', 'fs-blog'),
			'section'		=> 'title_tagline',
			'settings'		=> 'welcome_text',
		));


	//
	// Pix & Colors
	// 
	// ////////////////

		// Primary color
		
		$wp_customize->add_setting('primary_color', array(
			'default'			=> '9c0',
			'sanitize_callback'	=> 'sanitize_hex_color',
			'capability'		=> 'edit_theme_options',
			'type'				=> 'theme_mod',
			'transport'			=> 'refresh', 
		));
		$wp_customize->add_control( new WP_Customize_Color_control($wp_customize, 'primary_color', array(
			'label'		=> __('Primary color', 'fs-blog'),
			'section'	=> 'colors',
			'settings'	=> 'primary_color',
		)));
		
		
		// Secondary color
		
		$wp_customize->add_setting('secondary_color', array(
			'default'			=> '606060',
			'sanitize_callback'	=> 'sanitize_hex_color',
			'capability'		=> 'edit_theme_options',
			'type'				=> 'theme_mod',
			'transport'			=> 'refresh', 
		));
		$wp_customize->add_control( new WP_Customize_Color_control($wp_customize, 'secondary_color', array(
			'label'		=> __('Secondary color', 'fs-blog'),
			'section'	=> 'colors',
			'settings'	=> 'secondary_color',
		)));

		
		// Header default image
		
		$wp_customize->add_setting('bg_banner', array(
			'sanitize_callback'		=> 'esc_url_raw'
		));
		
		$wp_customize->add_control( new WP_Customize_Image_control($wp_customize, 'bg_banner', array(
			'label'			=> __('Default Banner', 'fs-blog'),
			'description'	=> __('Choose a default picture for the banner. (2048 x 625 pixels max.)', 'fs-blog'),		
			'section'		=> 'fs_pictures_section',
			'settings'		=> 'bg_banner',
		)));
		
		
		// Blog picture
		
		$wp_customize->add_setting('bg_blog', array(
			'sanitize_callback'		=> 'esc_url_raw'
		));
		
		$wp_customize->add_control( new WP_Customize_Image_control($wp_customize, 'bg_blog', array(
			'label'			=> __('Blog Banner', 'fs-blog'),
			'description'	=> __('Choose a picture for the blog banner. (2048 x 625 pixels max.)', 'fs-blog'),		
			'section'		=> 'fs_pictures_section',
			'settings'		=> 'bg_blog',
		)));
		
		
		// 404 Image
		
		$wp_customize->add_setting('bg_404', array(
			'sanitize_callback'		=> 'esc_url_raw'
		));
		
		$wp_customize->add_control( new WP_Customize_Image_control($wp_customize, 'bg_404', array(
			'label'			=> __('404 error', 'fs-blog'),
			'description'	=> __('Choose a picture for the 404 error page. (2048 x 625 pixels max.)', 'fs-blog'),		
			'section'		=> 'fs_pictures_section',
			'settings'		=> 'bg_404',
		)));
		

	
	//
	// Footer Section
	// 
	// ////////////////


		// Hide/Show Author’s Bio
		
		$wp_customize->add_setting('author_bio', array(
			'default'	=> true,
			'sanitize_callback'	=> 'fs_customizer_sanitize_checkbox',		
		));
		
		$wp_customize->add_control('author_bio', array(
			'type'			=> 'checkbox',
			'label'			=> __('Show the author’s Bio', 'fs-blog'),
			'section'		=> 'fs_footer_section',
			'settings'		=> 'author_bio',
		));
		
		// Hide/Show Recent Posts
		
		$wp_customize->add_setting('last_posts', array(
			'default'	=> true,
			'sanitize_callback'	=> 'fs_customizer_sanitize_checkbox',		
		));
		
		$wp_customize->add_control('last_posts', array(
			'type'			=> 'checkbox',
			'label'			=> __('Show the last posts', 'fs-blog'),
			'section'		=> 'fs_footer_section',
			'settings'		=> 'last_posts',
		));
	
		// Footer text
		
		$wp_customize->add_setting('footer_text', array(
			'default'			=> '',
			'sanitize_callback'	=> 'sanitize_text_field',		
		));
		$wp_customize->add_control('footer_text', array(
			'label'			=> __('Custom footer text', 'fs-blog'),
			'description'	=> __('Add a custom text instead of the year and blog name.', 'fs-blog'),
			'section'		=> 'fs_footer_section',
			'settings'		=> 'footer_text',
		));	
		
		// WP Credits
		
		$wp_customize->add_setting('display_wp', array(
			'default'	=> false,
			'sanitize_callback'	=> 'fs_customizer_sanitize_checkbox',		
		));
		
		$wp_customize->add_control('display_wp', array(
			'type'			=> 'checkbox',
			'label'			=> __('Display WordPress Link', 'fs-blog'),
			'section'		=> 'fs_footer_section',
			'settings'		=> 'display_wp',
		));
	
		
	
	
	
	 
}
add_action('customize_register', 'fs_blog_customize_register');


// Sanitize

// Checkbox
function fs_customizer_sanitize_checkbox( $input ) {
	if ( $input === true || $input === '1' ) {
		return '1';
	}
	return '';
}


// Customizer Colors Output

function fs_blog_colors() {
	?>
	<style>
		.page-banner,
		.widget-container ul li.current_page_item a,
		.widget-container ul li.current-cat a,
		.widget-container ul li a:hover,
		.widget-container ul li a:focus,
		.calendar_wrap table td#today,
		.post-figure,
		.post:nth-child(2n) .post-figure,
		.post:nth-child(3n) .post-figure,
		.action-btn, .action-btn-white, button.action-btn-white, input[type=submit].action-btn-white, .action-btn-dark, .search-form input[type=submit], button.action-btn-dark, input[type=submit].action-btn-dark, form input[type="submit"], .comment-reply-link, .comment-form input[type=submit], button.action-btn, button.action-btn-white, button.action-btn-dark, button.comment-reply-link, input[type=submit].action-btn, input[type=submit].action-btn-white, input[type=submit].action-btn-dark, .search-form input[type=submit], form input[type=submit][type="submit"], input[type=submit].comment-reply-link, .comment-form input[type=submit],
		.search-form::after,
		.ias_trigger a:link,
		.ias_trigger a:visited,
		.formfield-radio input[type="radio"] + label::after,
		.formfield-radio input[type="radio"] + span::after,
		.sub-menu > li a:hover, 
		.sub-menu > li a:focus, 
		.sub-menu > li.current-menu-item a,
		.post-picture,
		.wp-block-file a.wp-block-file__button { 
			background-color: <?php echo get_theme_mod('primary_color', '#9c0'); ?> 
		}
		*.has-primary-color-background-color { 
			background-color: <?php echo get_theme_mod('primary_color', '#9c0'); ?> !important;
		}
		.search-form::before {
			border-color: <?php echo get_theme_mod('primary_color', '#9c0'); ?> 
		}
		.formfield-checkbox input[type="checkbox"] + label::after,
		.formfield-checkbox input[type="checkbox"] + span::after {
			border-left-color: <?php echo get_theme_mod('primary_color', '#9c0'); ?>; 
			border-bottom-color: <?php echo get_theme_mod('primary_color', '#9c0'); ?> 
		}
		.formfield-select--container::after,
		.comment-list .comment {
			border-top-color: <?php echo get_theme_mod('primary_color', '#9c0'); ?>;
		}
		.content-area p a:not([class*="-btn"]),
		.content-area .wp-block-file a:first-child {
			border-bottom-color: <?php echo get_theme_mod('primary_color', '#9c0'); ?>;
		}		
		.main-menu > li > a:hover, 
		.main-menu > li > a:focus,
		.post-title a:hover,
		.post-title a:focus,
		.post-header:hover .post-title a,
		.calendar_wrap table td a,
		.acf-block-list-item .list-featured,
		.acf-block-post-title a:hover,
		.acf-block-post-title a:focus,
		.content-area p a:not([class*="-btn"]):hover,
		.content-area .wp-block-file a:first-child:hover { 
			color: <?php echo get_theme_mod('primary_color', '#9c0'); ?> 
		}
		*.has-text-color.has-primary-color-color { 
			color: <?php echo get_theme_mod('primary_color', '#9c0'); ?> !important !
		}

		#menu-toggle.menu-opened span::before,
		#menu-toggle.menu-opened span::after,
		.tag-links ul li a,
		.action-btn-dark,
		button.action-btn-dark,
		input[type=submit].action-btn-dark,
		#site_foot,
		.ias_trigger a:hover,
		.ias_trigger a:active {
			background-color: <?php echo get_theme_mod('secondary_color', '#606060'); ?>
		}
		*.has-secondary-color-background-color {
			background-color: <?php echo get_theme_mod('secondary_color', '#606060'); ?> !important;
		}
		.site-desc,
		.comment-list .comment-meta .comment-metadata a {
			color: <?php echo get_theme_mod('secondary_color', '#606060'); ?>
		}
		*.has-text-color.has-secondary-color-color {
			color: <?php echo get_theme_mod('secondary_color', '#606060'); ?> !important;
		}
	</style>
	<?php
}
add_action('wp_head','fs_blog_colors');