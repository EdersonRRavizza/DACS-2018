<?php
 
?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'magnus' ); ?></a>

	<header id="masthead" class="site-header" role="banner">

		<div class="site-branding">

			<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>

			<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
		</div>

		<nav id="site-navigation" class="header-navigation" role="navigation">
			<div class="menu-header-container">
			<?php wp_nav_menu(
			array(
				'theme_location' => 'secondary',
				'container' => 'false',
				'menu_id' => 'header-menu',
				'fallback_cb' => 'false',
				'depth' => '1'
			) ); ?>
			</div>
			
		</nav>

	</header>


	<?php if (is_home()) : ?>

	<section id="content" class="blog-home-content">

	<?php else : ?>
	<section class="site-header-image">
		<?php
		if ( is_singular() && has_post_thumbnail(  get_the_ID() ) ) :

			$image_id = get_post_thumbnail_id();
			$url = wp_get_attachment_image_src( $image_id, 'magnus-large' ); ?>

			<div class="section-image" style="background-image: url(<?php echo esc_attr( $url[0] ); ?>);">
			</div><!-- .section-image -->

		<?php elseif ( get_header_image() ) : ?>
			<img src="<?php header_image(); ?>" width="<?php echo HEADER_IMAGE_WIDTH; ?>" height="<?php echo HEADER_IMAGE_HEIGHT; ?>" alt="" />
		<?php endif;?>
	</section>

	<section id="content" class="site-content">
	<?php endif;?>
