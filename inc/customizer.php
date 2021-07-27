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
	
	$fs_customize->add_section(
		'fs_options_section',
		array(
			'title'			=> __('Theme Options', 'fs-blog'),
			'priority'		=> 50,
		)
	);
	$fs_customize->add_section(
		'fs_pictures_section', 
		array(
			'title' 		=> __('Pictures', 'fs-blog'),
			//'description' 	=> __('Custom banners', 'fs-blog'),
			'priority'		=> 40,
	));
	$fs_customize->add_section(
		'fs_footer_section', 
		array(
			'title' 		=> __('Footer', 'fs-blog'),
			//'description' 	=> __('Customise the footer', 'fs-blog'),
			'priority'		=> 30,
	));
	$fs_customize->add_section(
		'fs_blog_section',
		array(
			'title'			=> __('Blog Options', 'fs-blog'),
			'priority'		=> 50,
		)
	);
	
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
		
		// Logo in banner
		
		$fs_customize->add_setting('show_banner_logo', array(
			'default'			=> false,
			'sanitize_callback'	=> 'fs_customizer_sanitize_checkbox',		
		));
		$fs_customize->add_control('show_banner_logo', array(
			'type'			=> 'checkbox',
			'label'			=> __('Display logo in the banner', 'fs-blog'),
			'section'		=> 'title_tagline',
			'settings'		=> 'show_banner_logo',
		));
		
		$fs_customize->add_setting('banner_logo', array(
			'sanitize_callback'		=> 'esc_url_raw'
		));
		$fs_customize->add_control( new WP_Customize_Image_control($fs_customize, 'banner_logo', array(
			'label'			=> __('Logo version for the banner', 'fs-blog'),
			'description'	=> __('Will be used instead the site logo.', 'fs-blog'),
			'section'		=> 'title_tagline',
			'settings'		=> 'banner_logo',
		)));
		
		$fs_customize->add_setting('banner_logo_height', array(
			//'transport'			=> 'postMessage',
			'sanitize_callback'	=> 'sanitize_text_field',		
		));
		$fs_customize->add_control('banner_logo_height', array(
			'type'			=> 'number',
			'label'			=> __('Banner logo height', 'fs-blog'),
			'description'	=> __('Set a maximum height in pixels.', 'fs-blog'),
			'section'		=> 'title_tagline',
			'settings'		=> 'banner_logo_height',
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
			'default'			=> '#99cc00',
			'sanitize_callback'	=> 'sanitize_hex_color',
			'capability'		=> 'edit_theme_options',
			'type'				=> 'theme_mod',
			'transport'			=> 'postMessage', 
		));
		$fs_customize->add_control( new WP_Customize_Color_control($fs_customize, 'primary_color', array(
			'label'		=> __('Primary color', 'fs-blog'),
			'section'	=> 'colors',
			'settings'	=> 'primary_color',
		)));
		
		
		// Secondary color
		
		$fs_customize->add_setting('secondary_color', array(
			'default'			=> '#606060',
			'sanitize_callback'	=> 'sanitize_hex_color',
			'capability'		=> 'edit_theme_options',
			'type'				=> 'theme_mod',
			'transport'			=> 'postMessage', 
		));
		$fs_customize->add_control( new WP_Customize_Color_control($fs_customize, 'secondary_color', array(
			'label'		=> __('Secondary color', 'fs-blog'),
			'section'	=> 'colors',
			'settings'	=> 'secondary_color',
		)));
		
		// Third color
		
		$fs_customize->add_setting('third_color', array(
			'default'			=> '#707070',
			'sanitize_callback'	=> 'sanitize_hex_color',
			'capability'		=> 'edit_theme_options',
			'type'				=> 'theme_mod',
			'transport'			=> 'postMessage', 
		));
		$fs_customize->add_control( new WP_Customize_Color_control($fs_customize, 'third_color', array(
			'label'		=> __('Third color', 'fs-blog'),
			'section'	=> 'colors',
			'settings'	=> 'third_color',
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
		
		
		
	// Blog options
	// -
	// + + + + + + + + + + 		
		
		// Post metas
		
		$fs_customize->add_setting(
			'meta_date', 
			array(
				'default'			=> true,
				'sanitize_callback'	=> 'fs_customizer_sanitize_checkbox',		
			)
		);
		$fs_customize->add_control(
			'meta_date', 
			array(
				'type'			=> 'checkbox',
				'label'			=> __('Show the publication date in post meta', 'fs-blog'),
				'section'		=> 'fs_blog_section',
				'settings'		=> 'meta_date',
			)
		);
		$fs_customize->add_setting(
			'meta_author', 
			array(
				'default'			=> true,
				'sanitize_callback'	=> 'fs_customizer_sanitize_checkbox',		
			)
		);
		$fs_customize->add_control(
			'meta_author', 
			array(
				'type'			=> 'checkbox',
				'label'			=> __('Show the author in post meta', 'fs-blog'),
				'section'		=> 'fs_blog_section',
				'settings'		=> 'meta_author',
			)
		);
		$fs_customize->add_setting(
			'meta_category', 
			array(
				'default'			=> true,
				'sanitize_callback'	=> 'fs_customizer_sanitize_checkbox',		
			)
		);
		$fs_customize->add_control(
			'meta_category', 
			array(
				'type'			=> 'checkbox',
				'label'			=> __('Show the category in post meta', 'fs-blog'),
				'section'		=> 'fs_blog_section',
				'settings'		=> 'meta_category',
			)
		);
		

	// Theme Options
	// -
	// + + + + + + + + + + 
		
		// Back to top
	
		$fs_customize->add_setting(
			'back2top', 
			array(
				'default'			=> false,
				'sanitize_callback'	=> 'fs_customizer_sanitize_checkbox',		
			)
		);
		$fs_customize->add_control(
			'back2top', 
			array(
				'type'			=> 'checkbox',
				'label'			=> __('Display a Back to top button', 'fs-blog'),
				'section'		=> 'fs_options_section',
				'settings'		=> 'back2top',
			)
		);
		
			
	//
	// Footer Section
	// 
	// ////////////////


		// Hide/Show Author’s Bio
		
		$fs_customize->add_setting('author_bio', array(
			'default'			=> true,
			'sanitize_callback'	=> 'fs_customizer_sanitize_checkbox',		
		));
		
		$fs_customize->add_control('author_bio', array(
			'type'			=> 'checkbox',
			'label'			=> __('Display the author’s Bio', 'fs-blog'),
			'section'		=> 'fs_footer_section',
			'settings'		=> 'author_bio',
		));
		
		// Hide/Show Recent Posts
		
		$fs_customize->add_setting('last_posts', array(
			'default'			=> true,
			'sanitize_callback'	=> 'fs_customizer_sanitize_checkbox',		
		));
		
		$fs_customize->add_control('last_posts', array(
			'type'			=> 'checkbox',
			'label'			=> __('Display the last posts', 'fs-blog'),
			'section'		=> 'fs_footer_section',
			'settings'		=> 'last_posts',
		));
		
		// Number of posts
		
		$fs_customize->add_setting('posts_nb', array(
			'default'				=> 3,
			'sanitize_callback'		=> 'sanitize_text_field'
		));
		$fs_customize->add_control('posts_nb', array(
			'type'			=> 'number',
			'label'			=> __('Number of posts to display in the footer', 'fs-blog'),
			'section'		=> 'fs_footer_section',
			'settings'		=> 'posts_nb',
		));
		
		$fs_customize->add_setting('posts_show_thumb', array(
			'default'			=> true,
			'sanitize_callback'	=> 'fs_customizer_sanitize_checkbox',		
		));
		
		$fs_customize->add_control('posts_show_thumb', array(
			'type'			=> 'checkbox',
			'label'			=> __('Display the posts thumbnails', 'fs-blog'),
			'section'		=> 'fs_footer_section',
			'settings'		=> 'posts_show_thumb',
		));
		$fs_customize->add_setting('posts_show_excerpt', array(
			'default'			=> true,
			'sanitize_callback'	=> 'fs_customizer_sanitize_checkbox',		
		));
		
		$fs_customize->add_control('posts_show_excerpt', array(
			'type'			=> 'checkbox',
			'label'			=> __('Display the posts excerpt', 'fs-blog'),
			'section'		=> 'fs_footer_section',
			'settings'		=> 'posts_show_excerpt',
		));
		$fs_customize->add_setting('posts_show_link', array(
			'default'			=> true,
			'sanitize_callback'	=> 'fs_customizer_sanitize_checkbox',		
		));
		
		$fs_customize->add_control('posts_show_link', array(
			'type'			=> 'checkbox',
			'label'			=> __('Display the posts permalinks', 'fs-blog'),
			'section'		=> 'fs_footer_section',
			'settings'		=> 'posts_show_link',
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
		:root {
			--primary_color: <?php echo esc_attr(get_theme_mod('primary_color', '#9c0')); ?>; 
			--secondary_color: <?php echo esc_attr(get_theme_mod('secondary_color', '#606060')); ?>;
			--third_color: <?php echo esc_attr(get_theme_mod('third_color', '#707070')); ?>;
		}
		
		<?php if ( get_theme_mod('banner_logo_height') ) { ?>
		.page-banner-title img.logo {
			max-height: <?php echo esc_attr(get_theme_mod('banner_logo_height')); ?>px;	
		}
		<?php } ?>
		
	</style>
	<?php
}
add_action('wp_head','fs_blog_colors');