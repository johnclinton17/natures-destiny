<?php
/**
 * The template for displaying the blog home
 */

get_header();

if ( ! is_active_sidebar( 'retail-sidebar' ) ) {
	$page_full_width = ' full-width';
} else {
	$page_full_width = '';
}

$grid_layout = get_theme_mod( 'grid_layout', 'masonry' );
if ( !$grid_layout || $grid_layout == 'masonry' ) {
	$grid_loop_layout = ' class="masonry"';
} else {
	$grid_loop_layout = ' class="layout-'. esc_attr( $grid_layout ) .'"';
}
?>

	<div id="primary" class="content-area<?php echo $page_full_width;?>">
		<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : ?>

			<div id="grid-loop"<?php echo $grid_loop_layout;?>>

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

<?php get_sidebar(); ?>

<?php get_footer(); ?>
