(function($){
    
	// Site title and description
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a', '.site-title' ).text( to );
		});
	});
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-desc' ).text( to );
		});
	});

	// Tagline
    wp.customize('wp_baseline', function( value ) {
        value.bind( function( to ) {
            if( to ) {
                $( '.site-desc' ).hide();
            }
            else {
                $( '.site-desc' ).show().removeClass('screen-reader-text');
            }
        });
    });
 
    // Banner text
    wp.customize('welcome_title', function(value) {
        value.bind( function( text ) {
            $('.welcome-title').text( text );
        });
    });
    wp.customize('welcome_text', function(value) {
        value.bind( function( text ) {
            $('.welcome-text').text( text );
        });
    });
    
    // WP Credits
    wp.customize('display_wp', function( value ) {
        value.bind( function( to ) {
            if( to ) {
                $( '.wp-love' ).show();
            }
            else {
                $( '.wp-love' ).hide();
            }
        });
    });
    
    
})(jQuery);