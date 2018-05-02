<?php

function magnus_body_classes( $classes ) {

	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	if ( is_singular() ) {
		$classes[] = 'single';
	}

	if ( has_nav_menu( 'primary' ) ) {
		$classes[] = 'custom-menu';
	}

	if ( is_singular() && has_post_thumbnail() ) {
        $classes[] = 'featured-image';
    }

    if (get_header_image() != '') {
    	$classes[] = 'header-image';
    }

    if (is_home()) {
    	$classes[] = 'fullpage-panels';
    }

	return $classes;
}
add_filter( 'body_class', 'magnus_body_classes' );



if ( version_compare( $GLOBALS['wp_version'], '4.1', '<' ) ) :

	function magnus_wp_title( $title, $sep ) {
		if ( is_feed() ) {
			return $title;
		}

		global $page, $paged;


		$title .= get_bloginfo( 'name', 'display' );

		$site_description = get_bloginfo( 'description', 'display' );
		if ( $site_description && ( is_home() || is_front_page() ) ) {
			$title .= " $sep $site_description";
		}

		if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() ) {
			$title .= " $sep " . sprintf( __( 'Page %s', 'magnus' ), max( $paged, $page ) );
		}

		return $title;
	}
	add_filter( 'wp_title', 'magnus_wp_title', 10, 2 );

	function magnus_render_title() {
		?>
		<title><?php wp_title( '|', true, 'right' ); ?></title>
		<?php
	}
	add_action( 'wp_head', 'magnus_render_title' );
endif;

function magnus_nav_menu_objects( $sorted_menu_items, $args ) {
    if ( $args->theme_location != 'secondary' )
        return $sorted_menu_items;
    $unset_top_level_menu_item_ids = array();
    $array_unset_value = 1;
    $count = 1;

    foreach ( $sorted_menu_items as $sorted_menu_item ) {

        if ( 0 == $sorted_menu_item->menu_item_parent ) {
            if ( $count > 3 ) {
                unset( $sorted_menu_items[$array_unset_value] );
                $unset_top_level_menu_item_ids[] = $sorted_menu_item->ID;
            }
            $count++;
        }

        if ( in_array( $sorted_menu_item->menu_item_parent, $unset_top_level_menu_item_ids ) )
            unset( $sorted_menu_items[$array_unset_value] );

        $array_unset_value++;
    }

    return $sorted_menu_items;
}
add_filter( 'wp_nav_menu_objects', 'magnus_nav_menu_objects', 10, 2 );

?>
