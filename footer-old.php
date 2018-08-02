<?php
/**
 * The template for displaying the footer
 *
 */

?>
	</div><!-- .container -->

	</div><!-- #content -->

	<footer id="colophon" class="site-footer">

		<!-- <?php if(is_active_sidebar( 'retail-above-footer' )): ?>
		<div id="above-footer">
			<div class="container">
				<?php dynamic_sidebar( 'retail-above-footer' ); ?>
			</div>
		</div>
		<?php endif; ?> -->

		<!-- <?php if(is_active_sidebar( 'retail-footer1' ) || is_active_sidebar( 'retail-footer2' ) || is_active_sidebar( 'retail-footer3' ) ): ?>
		<div id="top-footer">
			<div class="container">
				<div class="top-footer clearfix">
					<div class="footer footer1">
						<?php if(is_active_sidebar( 'retail-footer1' )): 
							dynamic_sidebar( 'retail-footer1' );
						endif;
						?>	
					</div>

					<div class="footer footer2">
						<?php if(is_active_sidebar( 'retail-footer2' )): 
							dynamic_sidebar( 'retail-footer2' );
						endif;
						?>	
					</div>

					<div class="footer footer3">
						<?php if(is_active_sidebar( 'retail-footer3' )): 
							dynamic_sidebar( 'retail-footer3' );
						endif;
						?>	
					</div>
				</div>
			</div>
		</div>
		<?php endif; ?> -->

		<div id="bottom-footer">
			<div class="container clearfix">
				<?php retail_powered_by(); ?>
				<ul class="social-foot">
	              <li class="facebook"><a href="#" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
	              <li class="twitter"><a href="#" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
	              <li class="linkedin"><a href="#" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
	              </ul>
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
