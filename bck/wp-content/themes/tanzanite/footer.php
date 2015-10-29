</div>

<footer id="colophon" class="site-footer" role="contentinfo">
	<div class="container">
		<div class="site-info">
			<?php do_action( 'tanzanite_credits' ); ?>
		    <?php echo 'Copyright &copy; ' . date( 'Y' ); ?> <?php bloginfo( 'name' ); ?>
			<?php if ( get_theme_mod( 'tanzanite_credits_visibility' ) != 1 ) { ?>
			<span class="sep"> | </span>
			<?php printf( __( 'Proudly Powered By', 'itek' ) ); ?><a target="_Blank" href="<?php echo esc_url( __( 'http://wordpress.org/', 'itek' ) ); ?>" title="<?php esc_attr_e( 'Semantic Personal Publishing Platform', 'itek' ); ?>"><?php printf( __( ' %s', 'itek' ), 'WordPress' ); ?></a>
			<span class="sep"> | </span>
			<?php printf( __( 'Theme', 'tanzanite' ) ); ?><a target="_blank" href="<?php echo esc_url( __( 'http://www.wpstrapcode.com/blog/tanzanite-theme', 'tanzanite' ) ); ?>"><?php printf( __( ' %s', 'itek' ), 'Tanzanite' ); ?></a><?php printf( __( ' By %s', 'tanzanite' ), 'WP Strap Code' ); ?>
			<?php } ?>
		</div><!-- .site-info -->
	</div>
</footer><!-- #colophon -->
	
	<?php wp_footer(); ?>
	</body>
</html>