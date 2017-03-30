<?php if ( !defined('ABSPATH') ) die();

// Content width

if ( ! isset( $content_width ) )
	$content_width = 640;


// From Scratch Theme Setup

if ( ! function_exists( 'from_scratch_setup' ) ) :

function from_scratch_setup() {
	
	
	// I18n
	
	load_theme_textdomain( 'from-scratch', get_template_directory() . '/languages' );
	
	
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
add_action( 'after_setup_theme', 'from_scratch_setup' );



// Menus

register_nav_menus( array(
	'main_menu' =>  esc_html__( 'Main Menu', 'from-scratch' ),
	'footer_menu' => esc_html__( 'Footer Menu', 'from-scratch' )
));



// Sub-menus Walker // http://wordpress.stackexchange.com/questions/88604/bootstrap-drop-down-menu-with-wp-nav-menu

include( dirname( __FILE__ ) . '/inc/subnav-walker.php' );



// Enqueue JS & CSS

function from_scratch_scripts_load() {
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
			'from-scratch-skip-link-focus-fix', 
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
			'1.0', 
			'screen' 
		);
		
		wp_enqueue_style( 'from-scratch-style', get_stylesheet_uri() );

	}
}    
add_action( 'wp_enqueue_scripts', 'from_scratch_scripts_load' );



// Custom settings

include( dirname( __FILE__ ) . '/inc/custom-settings.php' );



// Widgets

function from_scratch_widgets_init() {
	register_sidebar(array(
		'name'			=>	esc_html__( 'Sidebar Widgets Area', 'from-scratch' ),
		'id'			=>	'widgets_area1',
		'description' 	=> 	'',
		'before_widget' => 	'<div class="widget-container">',
		'after_widget' 	=> 	'</div>',
		'before_title' 	=> 	'<h3 class="widget-title">',
		'after_title' 	=> 	'</h3>',
	));
	register_sidebar(array(
		'name'			=>	esc_html__( 'Footer Widgets Area #1', 'from-scratch' ),
		'id'			=>	'footer_area1',
		'description' 	=> 	'',
		'before_widget' => 	'',
		'after_widget' 	=> 	'',
		'before_title' 	=> 	'<h3 class="widget-title">',
		'after_title' 	=> 	'</h3>',
	));
	register_sidebar(array(
		'name'			=>	esc_html__( 'Footer Widgets Area #2', 'from-scratch' ),
		'id'			=>	'footer_area2',
		'description' 	=> 	'',
		'before_widget' => 	'',
		'after_widget' 	=> 	'',
		'before_title' 	=> 	'<h3 class="widget-title">',
		'after_title' 	=> 	'</h3>',
	));
	register_sidebar(array(
		'name'			=>	esc_html__( 'Footer Widgets Area #3', 'from-scratch' ),
		'id'			=>	'footer_area3',
		'description' 	=> 	'',
		'before_widget' => 	'',
		'after_widget' 	=> 	'',
		'before_title' 	=> 	'<h3 class="widget-title">',
		'after_title' 	=> 	'</h3>',
	));
}
add_action( 'widgets_init', 'from_scratch_widgets_init' );


// Excerpt

function fs_custom_excerpt( $length ) {
    return 12;
}
add_filter( 'excerpt_length', 'fs_custom_excerpt', 999 );


// TinyMCE

function my_mce_buttons_2( $buttons ) { 	// Callback function to insert 'styleselect' into the $buttons array
	array_unshift( $buttons, 'styleselect' );
	return $buttons;
}
add_filter('mce_buttons_2', 'my_mce_buttons_2');	// Register our callback to the appropriate filter

function my_mce_before_init_insert_formats( $init_array ) {		// Callback function to filter the MCE settings  
	
	$style_formats = array(  // Define the style_formats array
		
		array(  // Each array child is a format with it's own settings
			'title' => 'Châpo',  
			'inline' => 'span',  
			'classes' => 'chapo',
			'wrapper' => true,
		),
		array(  // Each array child is a format with it's own settings
			'title' => 'Mention',  
			'inline' => 'small',  
			'wrapper' => true,
		)
	);  
	$init_array['style_formats'] = json_encode( $style_formats );  	// Insert the array, JSON ENCODED, into 'style_formats'
	
	return $init_array;  
  
} 
add_filter( 'tiny_mce_before_init', 'my_mce_before_init_insert_formats' );  // Attach callback to 'tiny_mce_before_init' 

