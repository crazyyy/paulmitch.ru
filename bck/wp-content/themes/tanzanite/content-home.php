<?php
/**
 * @package tanzanite
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">','</a></h1>' ); ?>
	</header><!-- .entry-header -->
	<div class="entry-summary">
	<div class="summary-thumbnail">
		<a href="<?php the_permalink(); ?>">
		   <?php the_post_thumbnail( 'tanzanite-post-feature' ); ?>
		</a>	
	</div>
		<?php the_excerpt(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages: ', 'tanzanite' ),
				'after'  => '</div>',
			) );
		?>
		<div class="read-more button">
		    <?php _e( '<a href="' . esc_url( get_permalink() ) . '">Read The Full Article &raquo;</a>', 'tanzanite') ?>
		</div>
		
	</div><!-- .entry-summary -->
	<div class="clearfix"></div>    
				
</article><!-- #post-## -->