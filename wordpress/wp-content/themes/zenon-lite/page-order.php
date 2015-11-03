<?php /* Template Name: Order Page */ get_header(); ?>

<!--Content-->
<div id="content">
  <div class="single_wrap">
    <div class="single_post">

    <?php if(have_posts()): ?><?php while(have_posts()): ?><?php the_post(); ?>
      <div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
        <div class="post_content">
          <h2 class="postitle"><?php the_title(); ?></h2>
          <?php the_content(); ?>

          <div style="clear:both"></div>
          <?php wp_link_pages('<p class="pages"><strong>'.__('Pages:').'</strong> ', '</p>', 'number'); ?>
          <div class="edit"><?php edit_post_link(); ?></div>
        </div><!-- post_content -->
      </div><!-- post_class -->

    <?php endwhile ?>

      <div class="single_skew">
        <div class="skew_bottom_big"></div>
        <div class="skew_bottom_right"></div>
      </div><!-- single_skew -->
    </div><!-- single_wrap -->

    <div class="comments_template">
      <?php comments_template('',true); ?>
    </div>
    <?php endif ?>
  </div><!-- single_wrap -->
  <!--PAGE END-->

  <?php get_sidebar();?>

</div><!-- content -->
<?php get_footer(); ?>
