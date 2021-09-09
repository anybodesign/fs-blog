<?php if ( !defined('ABSPATH') ) die();

define( 'FS_THEME_VERSION', '1.7.2' );
define( 'FS_THEME_DIR', get_template_directory() );
define( 'FS_THEME_URL', get_template_directory_uri() );

$primary = get_theme_mod('primary_color', '#202020');
$secondary = get_theme_mod('secondary_color', '#404040');
$third = get_theme_mod('third_color', '#f0f0f0');	

// ------------------------
// Theme Setup
// ------------------------

if ( ! isset( $content_width ) )
	$content_width = 2048;


if ( ! function_exists( 'fs_setup' ) ) :

function fs_setup() {
	
	global $primary;
	global $secondary;
	global $third;
	
	// I18n
	
	load_theme_textdomain( 'fs-blog', FS_THEME_DIR . '/languages' );
	
	
	// Theme Support
	
	add_editor_style( array('css/editor-style.css') );
	
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );

	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	));

	add_theme_support( 'customize-selective-refresh-widgets' );

/*
	
	// https://codex.wordpress.org/Theme_Logo

	add_theme_support( 'custom-logo', array(
		'height'      => '',
		'width'       => '',
		'flex-height' => true,
		'flex-width'  => true,
		'header-text' => array( 'site-title', 'site-desc' ),
	));	
	
	// https://codex.wordpress.org/Custom_Backgrounds
	
	add_theme_support( 'custom-background', array(
		'default-color'          => 'ffffff',
		'default-image'          => '',
		'default-repeat'         => 'repeat',
		'default-position-x'     => 'left',
	    'default-position-y'     => 'top',
	    'default-size'           => 'auto',
		'default-attachment'     => 'scroll',
		'wp-head-callback'       => '_custom_background_cb',
		'admin-head-callback'    => '',
		'admin-preview-callback' => ''
	));
	
	// https://codex.wordpress.org/Custom_Headers
	
	add_theme_support( 'custom-header', array(
		'default-image'          => get_template_directory_uri() . '/img/header.jpg',
		'width'                  => 0,
		'height'                 => 0,
		'flex-height'            => false,
		'flex-width'             => true,
		'uploads'                => true,
		'random-default'         => false,
		'header-text'            => true,
		'default-text-color'     => '',
		'wp-head-callback'       => '',
		'admin-head-callback'    => '',
		'admin-preview-callback' => '',
	));

	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
		'gallery',
		'status',
		'audio',
		'chat',
	));
*/



	// Gutenberg support 
	
	add_theme_support( 'align-wide' );
	
	add_theme_support( 'editor-color-palette', array(
	    
	    // Raw colors 
	    
	    array(
	        'name' => esc_html__( 'Black', 'fs-blog' ),
	        'slug' => 'black',
	        'color' => '#303030',
	    ),
	    array(
	        'name' => esc_html__( 'White', 'fs-blog' ),
	        'slug' => 'white',
	        'color' => '#ffffff',
	    ),

	    // Customizer colors
	    
	    array(
	        'name' => esc_html__( 'Primary color', 'fs-blog' ),
	        'slug' => 'primary-color',
	        'color' => $primary,
	    ),
	    array(
	        'name' => esc_html__( 'Secondary color', 'fs-blog' ),
	        'slug' => 'secondary-color',
	        'color' => $secondary,
	    ),
		array(
	        'name' => esc_html__( 'Third color', 'fs-blog' ),
	        'slug' => 'third-color',
	        'color' => $third,
	    ),
	    
	));	
	
	add_theme_support( 'disable-custom-colors' );

	add_theme_support( 'editor-font-sizes', array(
	    array(
	        'name' => __( 'Small', 'fs-blog' ),
	        'shortName' => __( 'S', 'fs-blog' ),
	        'size' => 14,
	        'slug' => 'small'
	    ),
	    array(
	        'name' => __( 'Large', 'fs-blog' ),
	        'shortName' => __( 'L', 'fs-blog' ),
	        'size' => 22,
	        'slug' => 'large'
	    ),
	));
	
	add_theme_support( 'disable-custom-font-sizes' );
	
	add_theme_support( 'responsive-embeds' );

}
endif;
add_action( 'after_setup_theme', 'fs_setup' );


// Gutenberg editor styles

function fs_block_editor_styles() {
    wp_enqueue_style( 
    	'fs_block_editor_styles',
    	FS_THEME_URL .'/css/block-editor-style.css', 
    	false, 
    	FS_THEME_VERSION, 
    	'screen'
    );
}
add_action( 'enqueue_block_editor_assets', 'fs_block_editor_styles' );


add_action('admin_enqueue_scripts', 'fs_acf_admin_css', 11 );
function fs_acf_admin_css() {
	wp_enqueue_style( 'admin-css', FS_THEME_URL . '/css/admin.css' );
}

// ------------------------
// Enqueue JS & CSS
// ------------------------

function fs_scripts_load() {
    if (!is_admin()) {

		// JS 
		
		wp_enqueue_script( 'jquery' );

	    if (is_home() || is_archive() || is_search() ) {
		    	wp_enqueue_script(
			    	'ias', 
			    	FS_THEME_URL . '/js/infinite-ajax-scroll.min.js',
			    	array(), 
			    	'3.0', 
			    	true
		    	);
		    	wp_enqueue_script(
			    	'ias-init', 
			    	FS_THEME_URL . '/js/infinite-ajax-scroll-init.js',
			    	array('ias'), 
			    	false, 
			    	true
		    	);
	    }
		
		wp_register_script(
			'back2top', 
			FS_THEME_URL . '/js/back2top.js', 
			array(), 
			FS_THEME_VERSION, 
			true
		);
		
		wp_enqueue_script(
			'fs-blog-skip-link-focus-fix', 
			FS_THEME_URL . '/js/skip-link-focus-fix.js', 
			array(), 
			false, 
			true
		);
		
	    wp_enqueue_script( 
		    	'main', 
		    	FS_THEME_URL . '/js/main.min.js',
		    	array('jquery'), 
		    false, 
		    	true
	    );
	    
	    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
		
		if ( get_theme_mod('back2top') == true ) {
			wp_enqueue_script( 'back2top' );
		}
		
		
		// CSS
		
		wp_enqueue_style( 'fs-blog-style', get_stylesheet_uri() );

	}
}    
add_action( 'wp_enqueue_scripts', 'fs_scripts_load' );


// ------------------------
// Theme Stuff
// ------------------------

// Customizer

require FS_THEME_DIR . '/inc/customizer.php';


// Menus

function fs_custom_nav_menus() {

	$locations = array(
		'main_menu' =>  esc_html__( 'Main Menu', 'fs-blog' ),
		'footer_menu' => esc_html__( 'Footer Menu', 'fs-blog' )
	);
	register_nav_menus( $locations );

}
add_action( 'init', 'fs_custom_nav_menus' );


// Nav tag for widget menus

function fs_modify_nav_menu_args( $args ) {

	if( empty ( $args['theme_location'] ) ) {
		$args['container'] = 'nav';
	}
	return $args;
}
add_filter( 'wp_nav_menu_args', 'fs_modify_nav_menu_args' );


// Sub-menus Walker

require FS_THEME_DIR . '/inc/subnav-walker.php';


// Archives titles

add_filter( 'get_the_archive_title', function ($title) {

    if ( is_category() ) {

        $title = single_cat_title( '', false );

    } elseif ( is_tag() ) {

        $title = single_tag_title( '', false );

    } elseif ( is_post_type_archive() ) {

        $title = post_type_archive_title( '', false );
    
    } elseif ( is_tax() ) {

        $title = single_term_title( '', false );
    } 

    return $title;

});


// Image Sizes

add_image_size( 'thumbnail-hd', 320, 320, true );
add_image_size( 'medium-hd', 640, 640, false );
add_image_size( 'large-hd', 2048, 2048, false );
add_image_size( 'screen-md', 720, 450, true );
add_image_size( 'screen-hd', 1440, 900, true );
add_image_size( 'video-md', 960, 540, true );
add_image_size( 'video-hd', 1920, 1080, true );

add_image_size( 'blogpost', 640, 320, true );
add_image_size( 'blogpost-hd', 1280, 640, true );

function fs_custom_sizes( $sizes ) {
    return array_merge( $sizes, array(
        'thumbnail-hd'	=> __( 'Thumbnail x2', 'fs-blog' ),
        'medium-hd'		=> __( 'Medium x2', 'fs-blog' ),
        'large-hd'		=> __( 'Large x2', 'fs-blog' ),
        'screen-md'		=> __( 'Screen Medium', 'fs-blog' ),
        'screen-hd'		=> __( 'Screen Full', 'fs-blog' ),
        'video-md'		=> __( 'Video Medium', 'fs-blog' ),
        'video-hd'		=> __( 'Video Full', 'fs-blog' ),
        'blogpost'		=> __( 'Blog post', 'fs-blog' ),
        'blogpost-hd'	=> __( 'Blog post Full', 'fs-blog' ),
    ) );
}
add_filter( 'image_size_names_choose', 'fs_custom_sizes' );


// Background image

function fs_bg_img() {
	
	$img_404 = get_theme_mod('bg_404');
	$img_blog = get_theme_mod('bg_blog');
	$img_banner = get_theme_mod('bg_banner');
	
	if ( is_home() && $img_blog || is_category() && $img_blog ) {
		$bg = ' style="background-image: url('.get_theme_mod('bg_blog', 'none').')"';
	}
	else if ( is_404() && $img_404 ) {
		$bg = ' style="background-image: url('.get_theme_mod('bg_404', 'none').')"';
	}
	else if ( is_page() && $img_banner && '' == get_the_post_thumbnail() || is_search() ) {
		$bg = ' style="background-image: url('.get_theme_mod('bg_banner', 'none').')"';
	}
	else if ( is_front_page() && '' != get_the_post_thumbnail() ) {
		$img_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large-hd' );
		$bg = ' style="background-image: url('.$img_url[0].')"';
	}
	else if ( '' != get_the_post_thumbnail() ) {
		$img_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large-hd' );
		$bg = ' style="background-image: url('.$img_url[0].')"';
	} else {
		$bg = null;	
	}
	
	echo $bg;
}


// Widgets

function fs_blog_widgets_init() {
	
	// Sidebars 
	
	register_sidebar(array(
		'name'			=>	esc_html__( 'Sidebar Widgets Area', 'fs-blog' ),
		'id'			=>	'widgets_area1',
		'description' 	=> 	'',
		'before_widget' => 	'<div class="widget-container">',
		'after_widget' 	=> 	'</div>',
		'before_title' 	=> 	'<p class="widget-title">',
		'after_title' 	=> 	'</p>',
	));
	register_sidebar(array(
		'name'			=>	esc_html__( 'Page widgets Area', 'fs-blog' ),
		'id'			=>	'page_widgets',
		'description' 	=> 	'',
		'before_widget' => 	'<div class="widget-container">',
		'after_widget' 	=> 	'</div>',
		'before_title' 	=> 	'<p class="widget-title">',
		'after_title' 	=> 	'</p>',
	));
	
	// Footer
	
	register_sidebar(array(
		'name'			=>	esc_html__( 'Footer Widgets Area #1', 'fs-blog' ),
		'id'			=>	'footer_area1',
		'description' 	=> 	'',
		'before_widget' => 	'<div class="footer-widget-container">',
		'after_widget' 	=> 	'</div>',
		'before_title' 	=> 	'<p class="widget-title">',
		'after_title' 	=> 	'</p>',
	));
	register_sidebar(array(
		'name'			=>	esc_html__( 'Footer Widgets Area #2', 'fs-blog' ),
		'id'			=>	'footer_area2',
		'description' 	=> 	'',
		'before_widget' => 	'<div class="footer-widget-container">',
		'after_widget' 	=> 	'</div>',
		'before_title' 	=> 	'<p class="widget-title">',
		'after_title' 	=> 	'</p>',
	));
	register_sidebar(array(
		'name'			=>	esc_html__( 'Footer Widgets Area #3', 'fs-blog' ),
		'id'			=>	'footer_area3',
		'description' 	=> 	'',
		'before_widget' => 	'<div class="footer-widget-container">',
		'after_widget' 	=> 	'</div>',
		'before_title' 	=> 	'<p class="widget-title">',
		'after_title' 	=> 	'</p>',
	));

}
add_action( 'widgets_init', 'fs_blog_widgets_init' );


// Excerpt default

function fs_custom_excerpt( $lenght ) {
  return 24;
}
add_filter( 'excerpt_length', 'fs_custom_excerpt', 999 );

// Excerpt lenght custom

function fs_excerpt( $limit ) {
  $excerpt = explode(' ', get_the_excerpt(), $limit);

  if (count($excerpt) >= $limit) {
      array_pop($excerpt);
      $excerpt = implode(" ", $excerpt) . '...';
  } else {
      $excerpt = implode(" ", $excerpt);
  }

  $excerpt = preg_replace('`\[[^\]]*\]`', '', $excerpt);

  return $excerpt;
}

// Excerpt link

function fs_excerpt_more( $more ) {
    return sprintf( '…');
}
add_filter( 'excerpt_more', 'fs_excerpt_more' );


// Tinymce class

function fs_mce_buttons_2($buttons) {
    array_unshift($buttons, 'styleselect');
    return $buttons;
}
add_filter('mce_buttons_2', 'fs_mce_buttons_2');

function fs_tiny_formats($init_array) {

    $style_formats = array(

        array(
            'title' => __( 'Text intro', 'fs-blog' ),
            'selector' => 'p',
            'classes' => 'text-intro',
            'wrapper' => true,
        ),
        array(
            'title' => __( 'Text mentions', 'fs-blog' ),
            'selector' => 'p',
            'classes' => 'text-mentions',
            'wrapper' => true,
        ),
        array(
            'title' => __( 'Action button', 'fs-blog' ),
            'selector' => 'a',
            'classes' => 'action-btn',
        )
    );
    
    // Filter
    $style_formats = apply_filters( 'fs_tiny_formats', $style_formats ); 
    
    $init_array['style_formats'] = json_encode($style_formats);
    return $init_array;

}
add_filter('tiny_mce_before_init', 'fs_tiny_formats');


// Custom search form

function fs_search_form( $form ) {
    $form = '<form role="search" method="get" id="searchform" class="searchform" action="' . home_url( '/' ) . '" >
    <label class="screen-reader-text" for="s">' . __( 'Search for:' ) . '</label>
    <input type="search" placeholder="' . __( 'Keywords' ) . '" value="' . get_search_query() . '" name="s" id="s">
    <input type="submit" class="action-btn" id="searchsubmit" value="'. esc_attr__( 'Search' ) .'">
    </form>';
 
    return $form;
}
add_filter( 'get_search_form', 'fs_search_form' );

// ------------------------
// ACF
// ------------------------


if( class_exists('acf') ) {

	// ACF colors

	add_action('acf/input/admin_footer', 'fs_acf_colors_script');	

	function fs_acf_colors_script() {

		global $primary;
		global $secondary;
		global $third;
				
		$colors = ' "'.$primary.'", "'.$secondary.'", "'.$third.'" ';
	 ?>
	    <script type="text/javascript">
	    (function($){
	        
			acf.add_filter('color_picker_args', function( args, field ){
			
			    args.palettes = [ <?php echo $colors; ?> ]
			
			    return args;
			
			});	
	        
	    })(jQuery);
	    </script>
	    <?php
	}
	
}


// Auto-Updater

require 'inc/plugin-update-checker/plugin-update-checker.php';
$myUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
	'https://github.com/anybodesign/fs-blog',
	__FILE__,
	'fs-blog'
);
$myUpdateChecker->setBranch('master');