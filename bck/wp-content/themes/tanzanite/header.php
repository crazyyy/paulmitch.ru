<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 		
    <title><?php wp_title( '|', true, 'right' ); ?></title>
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	
    <?php wp_head(); ?>
  </head>
<body <?php body_class(); ?>>

<div class="clearfix"></div>
<?php get_template_part( 'nav-top' ); ?>

<?php if ( get_theme_mod( 'tanzanite_featured_section_visibility' ) != 1 ) {
if ( get_theme_mod( 'tanzanite_featured_layout' ) != 0 ) : ?>
<div class="container">
<?php
	if ( is_front_page() && tanzanite_has_featured_posts() ) {
		// Include the featured content template.
		get_template_part( 'featured-content' );
	}
?>
</div>
<?php else : 
	if ( is_front_page() && tanzanite_has_featured_posts() ) {
		// Include the featured content template.
		get_template_part( 'featured-content' );
	}
endif; } ?>

<div class="container">
<div id="showcase">
	<?php do_action( 'tanzanite_before_in_showcase' ); ?>
    <?php if ( is_front_page() ) : ?>
        <?php get_sidebar( 'header' ); ?>
	<?php endif; ?>
	<?php do_action( 'tanzanite_after_in_showcase' ); ?>
</div>
<div class="clearfix"></div>