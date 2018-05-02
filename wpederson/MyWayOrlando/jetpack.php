<?php

function magnus_jetpack_setup() {

	add_theme_support( 'infinite-scroll', array(
		'container' => 'main',
		'render'    => 'magnus_infinite_scroll_render',
		'footer'    => 'page',
	) );

	add_theme_support( 'jetpack-responsive-videos' );
}

function magnus_infinite_scroll_render() {
	while ( have_posts() ) {
		the_post();
		if ( is_search() ) :
		    get_template_part( 'content', 'search' );
		else :
		    get_template_part( 'content', get_post_format() );
		endif;
	}
}
