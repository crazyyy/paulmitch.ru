<?php get_header(); ?>


<div class="insselect">
  <div class="widgets">
    <ul><?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer Widgets') ) : ?><?php endif; ?></ul>
  </div>
</div>

  <?php get_template_part(''.$zn_lays = of_get_option('layout_images', 'layout1').''); ?>

<?php get_footer(); ?>
