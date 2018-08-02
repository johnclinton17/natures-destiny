<?php
/**
 * The template for displaying the footer
 *
 */

?>
	</div><!-- .container -->

	</div><!-- #content -->

	<footer id="colophon" class="site-footer">

		<div id="bottom-footer">
			<div class="container clearfix">
				<?php retail_powered_by(); ?>
				<?php wp_nav_menu( array( 
                	'theme_location' => 'footer',
                	'container_id' => 'footer-menu',
                	'menu_id' => 'footer-menu', 
                	'menu_class' => 'retail-footer-nav',
                	'depth' => 1,
                	'fallback_cb' => 'retail_footer_menu_fallback',
				) ); ?>

			</div>
		</div>

	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
