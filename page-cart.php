<?php
/**
 * Template Name: cart-template
 */

get_header();


?>

	<div id="primary" class="content-area<?php echo $page_full_width;?>">
		<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : ?>

			<div id="grid-loop">

				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'template-parts/content' ); ?>					

				<?php endwhile; ?>

			</div><!-- #grid-loop -->
		
			<?php the_posts_pagination( array(
						'prev_text' => '<span class="icon-chevron-left"></span>',
						'next_text' => '<span class="icon-chevron-right"></span>',
					) ); ?>

		<?php else : ?>

			<?php get_template_part( 'template-parts/content', 'none' ); ?>

		<?php endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->


<?php get_footer(); ?>
