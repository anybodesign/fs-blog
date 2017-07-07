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
		$wp_customize->add_section('fs_color_section', array(
		'title' 		=> __('Theme Colors', 'fs-blog'),
		'description' 	=> __('Colors customisation', 'fs-blog'),
		'priority'		=> 30,
	));
	$wp_customize->add_section('fs_pictures_section', array(
		'title' 		=> __('Theme Pictures', 'fs-blog'),
		'description' 	=> __('Pictures customisation', 'fs-blog'),
		'priority'		=> 40,
	));
	
	
	// Primary color
	
	$wp_customize->add_setting('primary_color', array(
		'default'			=> '9c0',
		'sanitize_callback'	=> 'sanitize_hex_color',
		'capability'		=> 'edit_theme_options',
		'type'				=> 'theme_mod',
		'transport'			=> 'refresh', 
	));
	$wp_customize->add_control( new WP_Customize_Color_control($wp_customize, 'primary_color_ctrl', array(
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
	$wp_customize->add_control( new WP_Customize_Color_control($wp_customize, 'secondary_color_ctrl', array(
		'label'		=> __('Secondary color', 'fs-blog'),
		'section'	=> 'colors',
		'settings'	=> 'secondary_color',
	)));
	
	
	// Banner Welcome text
	
	$wp_customize->add_setting('welcome_text', array(
		'default'			=> 'Hello :)',
		'sanitize_callback'	=> 'sanitize_text_field',		
	));
	$wp_customize->add_control('welcome_text_ctrl', array(
		'label'			=> __('Custom banner welcome text', 'fs-blog'),
		'description'	=> __('Add a custom text instead of Hello.', 'fs-blog'),
		'section'		=> 'title_tagline',
		'settings'		=> 'welcome_text',
	));

	// Footer text
	
	$wp_customize->add_setting('footer_text', array(
		'default'			=> '',
		'sanitize_callback'	=> 'sanitize_text_field',		
	));
	$wp_customize->add_control('footer_text_ctrl', array(
		'label'			=> __('Custom footer text', 'fs-blog'),
		'description'	=> __('Add a custom text instead of the year and blog name.', 'fs-blog'),
		'section'		=> 'title_tagline',
		'settings'		=> 'footer_text',
	));	
	
	// WP Credits
	
	$wp_customize->add_setting('display_wp', array(
		'default'	=> false,
		'sanitize_callback'	=> 'fs_customizer_sanitize_checkbox',		
	));
	
	$wp_customize->add_control('display_wp_ctrl', array(
		'type'			=> 'checkbox',
		'label'			=> __('Display WordPress Link', 'fs-blog'),
		'section'		=> 'title_tagline',
		'settings'		=> 'display_wp',
	));
	
	// Header default image
	
	$wp_customize->add_setting('bg_banner', array(
		'sanitize_callback'		=> 'esc_url_raw'
	));
	
	$wp_customize->add_control( new WP_Customize_Image_control($wp_customize, 'bg_banner_ctrl', array(
		'label'			=> __('Default Banner', 'fs-blog'),
		'description'	=> __('Choose a default picture for the banner. (2048 x 625 pixels max.)', 'fs-blog'),		
		'section'		=> 'fs_pictures_section',
		'settings'		=> 'bg_banner',
	)));
	
	$wp_customize->add_setting('bg_404', array(
		'sanitize_callback'		=> 'esc_url_raw'
	));
	
	$wp_customize->add_control( new WP_Customize_Image_control($wp_customize, 'bg_404_ctrl', array(
		'label'			=> __('404 error', 'fs-blog'),
		'description'	=> __('Choose a picture for the 404 error page. (2048 x 625 pixels max.)', 'fs-blog'),		
		'section'		=> 'fs_pictures_section',
		'settings'		=> 'bg_404',
	)));
	
	// Site logo
	
	$wp_customize->add_setting('site_logo', array(
		'sanitize_callback'		=> 'esc_url_raw'
	));
	
	$wp_customize->add_control( new WP_Customize_Image_control($wp_customize, 'site_logo_ctrl', array(
		'label'			=> __('Site Logo', 'fs-blog'),
		'section'		=> 'title_tagline',
		'settings'		=> 'site_logo',
	)));
	
	
	
	 
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
		.widget-container ul li.current-cat a,
		.widget-container ul li a:hover,
		.widget-container ul li a:focus,
		.calendar_wrap table td#today,
		.post-figure,
		.post:nth-child(2n) .post-figure,
		.post:nth-child(3n) .post-figure,
		.action-btn, .action-btn-white, button.action-btn-white, input[type=submit].action-btn-white, .action-btn-dark, .search-form input[type=submit], button.action-btn-dark, input[type=submit].action-btn-dark, form input[type="submit"], .comment-reply-link, .comment-form input[type=submit], button.action-btn, button.action-btn-white, button.action-btn-dark, button.comment-reply-link, input[type=submit].action-btn, input[type=submit].action-btn-white, input[type=submit].action-btn-dark, .search-form input[type=submit], form input[type=submit][type="submit"], input[type=submit].comment-reply-link, .comment-form input[type=submit],
		.search-form::after { 
			background-color: <?php echo get_theme_mod('primary_color', '#9c0'); ?> 
		}
		.search-form::before {
			border-color: <?php echo get_theme_mod('primary_color', '#9c0'); ?> 
		}
		
		.main-menu > li > a:hover, 
		.main-menu > li > a:focus,
		.calendar_wrap table td a,
		.ias_trigger a:link,
		.ias_trigger a:visited { 
			color: <?php echo get_theme_mod('primary_color', '#9c0'); ?> 
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
		.site-desc,
		.post-title a:hover, 
		.post-title a:focus,
		.main-menu>li .sub-menu>li>a:hover, 
		.main-menu>li .sub-menu>li>a:focus, 
		.main-menu>li .sub-menu>li.current-menu-item>a,
		.ias_trigger a:hover,
		.ias_trigger a:active,
		.comment-list .comment-meta .comment-metadata a {
			color: <?php echo get_theme_mod('secondary_color', '#606060'); ?>
		}
		
		<?php if(get_theme_mod('bg_banner')) { ?>
		.page-banner {
			background-image: url(<?php echo get_theme_mod('bg_banner', 'none'); ?>);
		}
		<?php } ?>
		<?php if(get_theme_mod('bg_404')) { ?>
		.error404 .page-banner {
			background-image: url(<?php echo get_theme_mod('bg_404', 'none'); ?>);
		}
		<?php } ?>
	</style>
	<?php
}
add_action('wp_head','fs_blog_colors');



