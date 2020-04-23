<?php
/**
 * FS Blog Customizer functionality
 *
 * @package WordPress
 * @subpackage FS_Blog
 * @since FS Blog 1.0
 */
 

// Customizer JS

add_action( 'customize_preview_init', 'fs_customizer_scripts' );
function fs_customizer_scripts() {
	wp_enqueue_script(
		'fs-customizer',
	    	FS_THEME_URL . '/js/customizer.js',
	    	array( 'customize-preview' ), 
	    	false, 
	    	true
	);
}

// Customizer Settings
 
function fs_blog_customize_register($fs_customize) {

	// Title and Description
	// -
	// + + + + + + + + + + 
	
	$fs_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$fs_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';

	if ( isset( $fs_customize->selective_refresh ) ) {
		$fs_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => array('.site-title', '.site-title a'),
			'render_callback' => 'fs_customize_partial_blogname',
		) );
		$fs_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-desc',
			'render_callback' => 'fs_customize_partial_blogdescription',
		) );
	}	 
	 
	// Create Some Sections
	
	$fs_customize->add_section('fs_pictures_section', array(
		'title' 		=> __('Pictures', 'fs-blog'),
		'description' 	=> __('Pictures customisation', 'fs-blog'),
		'priority'		=> 40,
	));
	$fs_customize->add_section('fs_footer_section', array(
		'title' 		=> __('Footer', 'fs-blog'),
		'description' 	=> __('Customise the footer', 'fs-blog'),
		'priority'		=> 30,
	));
	
	
	//
	// Head Section
	// 
	// /////////////////


		// Site logo
		
		$fs_customize->add_setting('site_logo', array(
			'sanitize_callback'		=> 'esc_url_raw'
		));
		
		$fs_customize->add_control( new WP_Customize_Image_control($fs_customize, 'site_logo', array(
			'label'			=> __('Site Logo', 'fs-blog'),
			'section'		=> 'title_tagline',
			'settings'		=> 'site_logo',
		)));


		// Hide/Show Baseline
		
		$fs_customize->add_setting('wp_baseline', array(
			'default'			=> false,
			'transport'			=> 'postMessage',
			'sanitize_callback'	=> 'fs_customizer_sanitize_checkbox',		
		));
		
		$fs_customize->add_control('wp_baseline', array(
			'type'			=> 'checkbox',
			'label'			=> __('Hide the tagline (in an accessible way)', 'fs-blog'),
			'section'		=> 'title_tagline',
			'settings'		=> 'wp_baseline',
		));
	

		// Banner Welcome title
		
		$fs_customize->add_setting('welcome_title', array(
			'default'			=> __('Hello there :)','fs-blog'),
			'transport'			=> 'postMessage',
			'sanitize_callback'	=> 'sanitize_text_field',		
		));
		$fs_customize->add_control('welcome_title', array(
			'label'			=> __('Front page welcome title', 'fs-blog'),
			'description'	=> __('Add a custom title for the front page banner.', 'fs-blog'),
			'section'		=> 'title_tagline',
			'settings'		=> 'welcome_title',
		));
		
		// Banner Welcome text
		
		$fs_customize->add_setting('welcome_text', array(
			'default'			=> __('Ex: Welcome to my awesome WordPress blog.','fs-blog'),
			'transport'			=> 'postMessage',
			'sanitize_callback'	=> 'sanitize_text_field',		
		));
		$fs_customize->add_control('welcome_text', array(
			'type'			=> 'textarea',
			'label'			=> __('Front page welcome text', 'fs-blog'),
			'description'	=> __('Add a custom text for the front page banner.', 'fs-blog'),
			'section'		=> 'title_tagline',
			'settings'		=> 'welcome_text',
		));


	//
	// Pix & Colors
	// 
	// ////////////////

		// Primary color
		
		$fs_customize->add_setting('primary_color', array(
			'default'			=> '9c0',
			'sanitize_callback'	=> 'sanitize_hex_color',
			'capability'		=> 'edit_theme_options',
			'type'				=> 'theme_mod',
			'transport'			=> 'refresh', 
		));
		$fs_customize->add_control( new WP_Customize_Color_control($fs_customize, 'primary_color', array(
			'label'		=> __('Primary color', 'fs-blog'),
			'section'	=> 'colors',
			'settings'	=> 'primary_color',
		)));
		
		
		// Secondary color
		
		$fs_customize->add_setting('secondary_color', array(
			'default'			=> '606060',
			'sanitize_callback'	=> 'sanitize_hex_color',
			'capability'		=> 'edit_theme_options',
			'type'				=> 'theme_mod',
			'transport'			=> 'refresh', 
		));
		$fs_customize->add_control( new WP_Customize_Color_control($fs_customize, 'secondary_color', array(
			'label'		=> __('Secondary color', 'fs-blog'),
			'section'	=> 'colors',
			'settings'	=> 'secondary_color',
		)));

		
		// Header default image
		
		$fs_customize->add_setting('bg_banner', array(
			'sanitize_callback'		=> 'esc_url_raw'
		));
		
		$fs_customize->add_control( new WP_Customize_Image_control($fs_customize, 'bg_banner', array(
			'label'			=> __('Default Banner', 'fs-blog'),
			'description'	=> __('Choose a default picture for the banner. (2048 x 625 pixels max.)', 'fs-blog'),		
			'section'		=> 'fs_pictures_section',
			'settings'		=> 'bg_banner',
		)));
		
		
		// Blog picture
		
		$fs_customize->add_setting('bg_blog', array(
			'sanitize_callback'		=> 'esc_url_raw'
		));
		
		$fs_customize->add_control( new WP_Customize_Image_control($fs_customize, 'bg_blog', array(
			'label'			=> __('Blog Banner', 'fs-blog'),
			'description'	=> __('Choose a picture for the blog banner. (2048 x 625 pixels max.)', 'fs-blog'),		
			'section'		=> 'fs_pictures_section',
			'settings'		=> 'bg_blog',
		)));
		
		
		// 404 Image
		
		$fs_customize->add_setting('bg_404', array(
			'sanitize_callback'		=> 'esc_url_raw'
		));
		
		$fs_customize->add_control( new WP_Customize_Image_control($fs_customize, 'bg_404', array(
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
		
		$fs_customize->add_setting('author_bio', array(
			'default'			=> true,
			'transport'			=> 'postMessage',
			'sanitize_callback'	=> 'fs_customizer_sanitize_checkbox',		
		));
		
		$fs_customize->add_control('author_bio', array(
			'type'			=> 'checkbox',
			'label'			=> __('Show the author’s Bio', 'fs-blog'),
			'section'		=> 'fs_footer_section',
			'settings'		=> 'author_bio',
		));
		
		// Hide/Show Recent Posts
		
		$fs_customize->add_setting('last_posts', array(
			'default'			=> true,
			'transport'			=> 'postMessage',
			'sanitize_callback'	=> 'fs_customizer_sanitize_checkbox',		
		));
		
		$fs_customize->add_control('last_posts', array(
			'type'			=> 'checkbox',
			'label'			=> __('Show the last posts', 'fs-blog'),
			'section'		=> 'fs_footer_section',
			'settings'		=> 'last_posts',
		));
	
		// Footer text
		
		$fs_customize->add_setting('footer_text', array(
			'default'			=> '',
			'transport'			=> 'postMessage',
			'sanitize_callback'	=> 'sanitize_text_field',		
		));
		$fs_customize->add_control('footer_text', array(
			'label'			=> __('Custom footer text', 'fs-blog'),
			'description'	=> __('Add a custom text instead of the year and blog name.', 'fs-blog'),
			'section'		=> 'fs_footer_section',
			'settings'		=> 'footer_text',
		));	
		
		// WP Credits
		
		$fs_customize->add_setting('display_wp', array(
			'default'			=> false,
			'transport'			=> 'postMessage',
			'sanitize_callback'	=> 'fs_customizer_sanitize_checkbox',		
		));
		
		$fs_customize->add_control('display_wp', array(
			'type'			=> 'checkbox',
			'label'			=> __('Display WordPress Link', 'fs-blog'),
			'section'		=> 'fs_footer_section',
			'settings'		=> 'display_wp',
		));
	
		
	
	
	
	 
}
add_action('customize_register', 'fs_blog_customize_register');


// Callbacks + Sanitize

function fs_customize_partial_blogname() {
	bloginfo( 'name' );
}
function fs_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

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
		.breadcrumbs span a:not([class*="-btn"]),		
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
		.breadcrumbs span a:not([class*="-btn"]):hover,
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
		#site_foot {
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