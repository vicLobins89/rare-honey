			<footer class="footer corner-bg" role="contentinfo" itemscope itemtype="http://schema.org/WPFooter">

				<div id="inner-footer" class="cf">

					<nav role="navigation">
						<?php wp_nav_menu(array(
    					'container' => 'div',                           // enter '' to remove nav container (just make sure .footer-links in _base.scss isn't wrapping)
    					'container_class' => 'footer-links cf',         // class of container (should you choose to use it)
    					'menu' => __( 'Footer Links', 'bonestheme' ),   // nav name
    					'menu_class' => 'nav footer-nav cf',            // adding custom nav class
    					'theme_location' => 'footer-links',             // where it's located in the theme
    					'before' => '',                                 // before the menu
    					'after' => '',                                  // after the menu
    					'link_before' => '',                            // before each link
    					'link_after' => '',                             // after each link
    					'depth' => 0,                                   // limit the depth of the nav
    					'fallback_cb' => 'bones_footer_links_fallback'  // fallback function
						)); ?>
					</nav>
					
					<?php if ( is_active_sidebar( 'footer_left' ) || is_active_sidebar( 'footer_middle' ) || is_active_sidebar( 'footer_right' ) ) : ?>
					<div class="footer-info cf">
						<div class="m-all t-1of3 d-1of2">
							<?php if ( is_active_sidebar( 'footer_left' ) ) : ?>
								<?php dynamic_sidebar( 'footer_left' ); ?>
							<?php endif; ?>
						</div>

						<div class="m-all t-1of3 d-1of4">
							<?php if ( is_active_sidebar( 'footer_middle' ) ) : ?>
								<?php dynamic_sidebar( 'footer_middle' ); ?>
							<?php endif; ?>
						</div>

						<div class="m-all t-1of3 d-1of4 last-col">
							<?php if ( is_active_sidebar( 'footer_right' ) ) : ?>
								<?php dynamic_sidebar( 'footer_right' ); ?>
							<?php endif; ?>
						</div>
					</div>
					<?php endif; ?><!-- footer widgets -->

					<p class="copyright">
					<?php $options = get_option('rh_settings'); ?>
					<?php
						if( $options['copyright_txt'] ) {
							echo $options['copyright_txt'];
						} else {
							echo '@ Copyright ' . get_bloginfo() . ' ' . date('Y');
						}
					?>
					</p>

				</div>

			</footer>

		</div>

		<?php wp_footer(); ?>

	</body>

</html> <!-- end of site. what a ride! -->
