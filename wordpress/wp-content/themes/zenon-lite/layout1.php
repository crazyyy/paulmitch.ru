<div class="lay1">

  <div class="lay1_wrap">
    <?php if(have_posts()): ?><?php while(have_posts()): ?><?php the_post(); ?>
      <div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
        <div class="post_content">
          <h2 class="postitle"><a href="<?php the_permalink();?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>


        <div class="post_image">
          <!--CALL TO POST IMAGE-->

          <div class="date_meta"><?php the_time('d.n.y'); ?></div>
          <div class="block_comm">
            <?php if (!empty($post->post_password)) { ?>
            <?php } else { ?>
            <div class="comments"><?php comments_popup_link( __('0</br>Comment', 'zenon'), __('1</br>Comment', 'zenon'), __('%</br>Comments', 'zenon'), '', __('Off' , 'zenon')); ?></div>
            <?php } ?>
          </div><!-- block_comm -->

          <?php if ( has_post_thumbnail() ) : ?>

            <a href="<?php the_permalink();?>"><?php the_post_thumbnail('medium'); ?></a>

          <?php elseif($photo = znn_get_images('numberposts=1', true)): ?>

            <a href="<?php the_permalink();?>"><?php echo wp_get_attachment_image($photo[0]->ID ,'medium'); ?></a>

          <?php else : ?>

            <a href="<?php the_permalink();?>"><img src="<?php echo get_template_directory_uri(); ?>/images/blank_img.png" alt="<?php the_title_attribute(); ?>" class="znn_thumbnail"/></a>

          <?php endif; ?>
        </div><!-- post_image -->

        <div class="znn_excerptmore">
          <?php znn_excerpt('znn_excerptlength_index', 'znn_excerptmore'); ?>
        </div><!-- /.znn_excerptmore -->

        </div><!-- post_content -->

      </div><!-- post_class -->
    <?php endwhile ?>

    <?php endif ?>
  </div><!-- lay1_wrap -->

  <?php if (function_exists("znn_paginate")) {znn_paginate();} ?>

  <div class="hidden_nav">
    <?php paginate_links(); ?>
  </div><!-- hidden_nav -->

</div><!-- lay1 -->
