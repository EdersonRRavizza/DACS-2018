<?php

get_header(); ?>

		<?php if ( have_posts() ) : ?>

			<div id="main" class="site-main">
			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content-home', get_post_format() ); ?>

			<?php endwhile; ?>
			</div>

			<?php the_posts_navigation(); ?>

		<?php else : ?>

			<div id="primary" class="content-area">
				<main id="main" class="site-main" role="main">
					<?php get_template_part( 'content', 'none' ); ?>
				</main>
			</div>

		<?php endif; ?>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
