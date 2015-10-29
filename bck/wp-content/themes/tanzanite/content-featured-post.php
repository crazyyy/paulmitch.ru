<?php
/**
 * The template for displaying featured posts on the front page
 *
 *
 * @package Tanzanite
 * @since Tanzanite 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php if ( has_post_thumbnail() ) : ?>
	<a class="post-thumbnail" href="<?php the_permalink(); ?>">
	<?php
		// Output the featured image.
		
			if ( 'slider' == get_theme_mod( 'featured_content_layout' ) ) {
				the_post_thumbnail( 'tanzanite-full-width' );
			} else {
				the_post_thumbnail( );
			}
		
	?>
	</a>
    <?php endif; ?>
	<header class="entry-header">
		<?php if ( in_array( 'category', get_object_taxonomies( get_post_type() ) ) && tanzanite_categorized_blog() ) : ?>
		<div class="entry-meta">
			<span class="cat-links"><?php echo get_the_category_list( _x( ' | ', 'Used between list items, there is a space before and after the pipe.', 'tanzanite' ) ); ?></span>
		</div><!-- .entry-meta -->
		<?php endif; ?>

		<?php the_title( '<h1 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">','</a></h1>' ); ?>
	</header><!-- .entry-header -->
</article><!-- #post-## -->
