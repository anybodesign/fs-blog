<?php if ( !defined('ABSPATH') ) die();

// Content width

if ( ! isset( $content_width ) )
	$content_width = 640;


// FS Blog Theme Setup

if ( ! function_exists( 'fs_blog_setup' ) ) :

function fs_blog_setup() {
	
	
	// I18n
	
	load_theme_textdomain( 'fs-blog', get_template_directory() . '/languages' );
	
	
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
	) );

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
	) );

}
endif;
add_action( 'after_setup_theme', 'fs_blog_setup' );


// Customizer

require get_template_directory() . '/inc/customizer.php';


// Menus

register_nav_menus( array(
	'main_menu' =>  esc_html__( 'Main Menu', 'fs-blog' ),
	'footer_menu' => esc_html__( 'Footer Menu', 'fs-blog' )
));



// Sub-menus Walker

require get_template_directory() . '/inc/subnav-walker.php';


// Enqueue JS & CSS

function fs_blog_scripts_load() {
    if (!is_admin()) {

		// JS 
		
		wp_enqueue_script( 'jquery' );

	    if (is_home() || is_archive() || is_search() ) {
	    	wp_enqueue_script(
		    	'ias', 
		    	get_template_directory_uri() . '/js/jquery-ias-1.1.0.min.js',
		    	array('jquery'), 
		    	'1.1.0', 
		    	true
	    	);
	    	wp_enqueue_script(
		    	'init-ias', 
		    	get_template_directory_uri() . '/js/init-ias.js',
		    	array('ias'), 
		    	false, 
		    	true
	    	);
	    }
		

		wp_enqueue_script(
			'fs-blog-skip-link-focus-fix', 
			get_template_directory_uri() . '/js/skip-link-focus-fix.js', 
			array(), 
			false, 
			true
		);
		
	    wp_enqueue_script( 
	    	'main', 
	    	get_template_directory_uri() . '/js/main.min.js',
	    	array('jquery'), 
	    	'1.0', 
	    	true
	    );
	    
	    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
		
		
		// CSS
		
		wp_enqueue_style( 
			'pridx', 
			get_template_directory_uri() . '/css/pridx.css',
			array(), 
			'1.6', 
			'screen' 
		);
		
		wp_enqueue_style( 'fs-blog-style', get_stylesheet_uri() );

	}
}    
add_action( 'wp_enqueue_scripts', 'fs_blog_scripts_load' );



// Widgets

function fs_blog_widgets_init() {
	register_sidebar(array(
		'name'			=>	esc_html__( 'Sidebar Widgets Area', 'fs-blog' ),
		'id'			=>	'widgets_area1',
		'description' 	=> 	'',
		'before_widget' => 	'<div class="widget-container">',
		'after_widget' 	=> 	'</div>',
		'before_title' 	=> 	'<h3 class="widget-title">',
		'after_title' 	=> 	'</h3>',
	));
	register_sidebar(array(
		'name'			=>	esc_html__( 'Footer Widgets Area #1', 'fs-blog' ),
		'id'			=>	'footer_area1',
		'description' 	=> 	'',
		'before_widget' => 	'',
		'after_widget' 	=> 	'',
		'before_title' 	=> 	'<h3 class="widget-title">',
		'after_title' 	=> 	'</h3>',
	));
	register_sidebar(array(
		'name'			=>	esc_html__( 'Footer Widgets Area #2', 'fs-blog' ),
		'id'			=>	'footer_area2',
		'description' 	=> 	'',
		'before_widget' => 	'',
		'after_widget' 	=> 	'',
		'before_title' 	=> 	'<h3 class="widget-title">',
		'after_title' 	=> 	'</h3>',
	));
	register_sidebar(array(
		'name'			=>	esc_html__( 'Footer Widgets Area #3', 'fs-blog' ),
		'id'			=>	'footer_area3',
		'description' 	=> 	'',
		'before_widget' => 	'',
		'after_widget' 	=> 	'',
		'before_title' 	=> 	'<h3 class="widget-title">',
		'after_title' 	=> 	'</h3>',
	));
}
add_action( 'widgets_init', 'fs_blog_widgets_init' );


// Excerpt

function fs_custom_excerpt( $length ) {
    return 12;
}
add_filter( 'excerpt_length', 'fs_custom_excerpt', 999 );

/*
function fs_excerpt_more( $more ) {
	return '… <a href="'. get_permalink( get_the_ID() ) . '">' . __('Continue reading', 'fs-blog') . '</a>';
}
add_filter( 'excerpt_more', 'fs_excerpt_more' );
*/


// TinyMCE

function my_mce_buttons_2( $buttons ) { 	// Callback function to insert 'styleselect' into the $buttons array
	array_unshift( $buttons, 'styleselect' );
	return $buttons;
}
add_filter('mce_buttons_2', 'my_mce_buttons_2');	// Register our callback to the appropriate filter

function my_mce_before_init_insert_formats( $init_array ) {		// Callback function to filter the MCE settings  
	
	$style_formats = array(  // Define the style_formats array
		
		array(
            'title' => esc_html__( 'Intro Text', 'fs-blog' ),
            'selector' => 'p',
            'classes' => 'text-intro',
            'wrapper' => true,
        ),
        array(
            'title' => esc_html__( 'Mention Text', 'fs-blog' ),
            'selector' => 'p',
            'classes' => 'text-mentions',
            'wrapper' => true,
        ),
        array(
            'title' => esc_html__( 'Action button', 'fs-blog' ),
            'selector' => 'a',
            'classes' => 'action-btn',
        )
		
	);  
	$init_array['style_formats'] = json_encode( $style_formats );  	// Insert the array, JSON ENCODED, into 'style_formats'
	
	return $init_array;  
  
} 
add_filter( 'tiny_mce_before_init', 'my_mce_before_init_insert_formats' );  // Attach callback to 'tiny_mce_before_init'



// Auto-Updater

require 'inc/plugin-update-checker/plugin-update-checker.php';
$myUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
	'https://bitbucket.org/anybodesign/fs-blog',
	__FILE__,
	'fs-blog'
);
$myUpdateChecker->setAuthentication(array(
	'consumer_key' => 'S4YYALTKVXGavp39LZ',
	'consumer_secret' => '3W8D5LuDcjADwAYJ9hPXYg3WUnmGBRp6',
));