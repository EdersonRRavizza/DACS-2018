<?php
if ( ! function_exists( 'magnus_setup' ) ) :

function magnus_setup() {

	add_theme_support( 'automatic-feed-links' );

	add_theme_support( 'title-tag' );

	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 256, 256, true );
	add_image_size( 'magnus-large', 2000, 1500, true  );

	register_nav_menus( array(
        'primary' => __( 'Primary Sidebar Navigation', 'magnus' ),
        'secondary' => __( 'Header Quick Navigation', 'magnus' ),
	) );

	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );
}
endif;
add_action( 'after_setup_theme', 'magnus_setup' );

function magnus_content_width() {
    $GLOBALS['content_width'] = apply_filters( 'magnus_content_width', 1088 );
}
add_action( 'after_setup_theme', 'magnus_content_width', 0 );

function magnus_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'magnus' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Add widgets here to appear in your sidebar.', 'magnus' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'magnus_widgets_init' );

function magnus_javascript_detection() {
	echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}
add_action( 'wp_head', 'magnus_javascript_detection', 0 );

function magnus_fonts_url() {
    $fonts_url = '';

    $montserrat = _x( 'on', 'Montserrat font: on or off', 'magnus' );

    $karla = _x( 'on', 'Karla font: on or off', 'magnus' );

    if ( 'off' !== $montserrat || 'off' !== $karla ) {
        $font_families = array();

        if ( 'off' !== $montserrat ) {
            $font_families[] = 'Montserrat:400,700';
        }

        if ( 'off' !== $karla ) {
            $font_families[] = 'Karla:400,700,400italic,700italic';
        }

        $query_args = array(
            'family' => urlencode( implode( '|', $font_families ) ),
            'subset' => urlencode( 'latin,latin-ext' ),
        );

        $fonts_url = add_query_arg( $query_args, '//fonts.googleapis.com/css' );
    }

    return $fonts_url;
}

function magnus_scripts() {
	wp_enqueue_style( 'magnus-fonts', magnus_fonts_url(), array(), null );

	wp_enqueue_style( 'magnus-style', get_stylesheet_uri() );

	wp_enqueue_script( 'magnus-navigation', get_template_directory_uri() . '/js/navigation.js', array('jquery'), '20120206', true );

	wp_enqueue_script( 'magnus-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'magnus-keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20150302' );
	}

	wp_enqueue_script( 'magnus-script', get_template_directory_uri() . '/js/functions.js', array( 'jquery' ), '20150302', true );

}
add_action( 'wp_enqueue_scripts', 'magnus_scripts' );


require get_template_directory() . '/custom-header.php';

require get_template_directory() . '/template-tags.php';

require get_template_directory() . '/extras.php';

require get_template_directory() . '/customizer.php';

require get_template_directory() . '/jetpack.php';
