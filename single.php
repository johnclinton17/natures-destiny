<?php
/**
 * The template for displaying all single posts
 *
 */

get_header();

if ( ! is_active_sidebar( 'retail-sidebar' ) ) {
	$page_full_width = ' full-width';
} else {
	$page_full_width = '';
}
?>

	<div id="primary" class="content-area<?php echo $page_full_width;?>">
		<main id="main" class="site-main" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'template-parts/content', 'single' ); ?>

				<?php
					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;

					get_template_part( 'template-parts/content', 'related' );

					the_post_navigation( array(
						'prev_text' => '<span class="nav-title"><span class="icon-chevron-left"></span> %title</span>',
						'next_text' => '<span class="nav-title">%title <span class="icon-chevron-right"></span></span>',
					) );
				?>

			<?php endwhile; // End of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>
