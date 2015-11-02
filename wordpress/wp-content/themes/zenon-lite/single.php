<?php get_header(); ?>
<!--Content-->
<div id="content">
  <div class="single_wrap">

    <div class="single_post">
    <?php if(have_posts()): ?><?php while(have_posts()): ?><?php the_post(); ?>

      <div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
        <div class="post_content">
        <h2 class="postitle"><?php the_title(); ?></h2>
        <div class="single_metainfo">
          <?php if(of_get_option('dissauth_checkbox') == "0"){ ?> by <?php the_author(); ?><?php } ?>
        </div><!-- single_metainfo -->
        <div class="zn_post_wrap"><?php the_content(); ?> </div>
        <div style="clear:both"></div>

        <?php wp_link_pages('<p class="pages"><strong>'.__('Pages:').'</strong> ', '</p>', 'number'); ?>

        <!--Post Footer-->
        <div class="post_foot">
          <?php if(of_get_option('disscats_checkbox') == "0"){ ?>
          <div class="post_meta">
          <?php if( has_category() ) { ?>
            <div class="post_cat">
              <?php _e('Рубрика' , 'zenon'); ?> : <div class="catag_list"><?php the_category(', '); ?></div>
            </div><?php } ?>

            <?php if( has_tag() ) { ?>
            <div class="post_tag">
              <?php _e('Метки' , 'zenon'); ?> : <div class="catag_list"><?php the_tags(' '); ?></div>
            </div><?php } ?>
          </div><!-- post_meta -->
          <?php } ?>
        </div><!-- post_foot -->

        <div class="edit"><?php edit_post_link(); ?></div>
      </div><!-- post_content -->

      <?php if(of_get_option('dissshare_checkbox') == "0"){ ?><?php get_template_part('share_this');?><?php } ?>
      </div><!-- single_post -->
    <?php endwhile ?>

      <div class="single_skew">
        <div class="skew_bottom_big"></div>
        <div class="skew_bottom_right"></div>
      </div><!-- single_skew -->
    </div><!-- single_wrap -->

    <div class="comments_template"><?php comments_template('',true); ?></div>
    <?php endif ?>

  </div>
  <!--POST END-->

  <?php get_sidebar();?>
</div>
<?php get_footer(); ?>
