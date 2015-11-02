<?php
/*
  Template Name Posts: Product Page
*/
?>
<?php get_header(); ?>
<!--Content-->
<div id="content">
  <div class="single_wrap">

    <div class="single_post">
    <?php if(have_posts()): ?><?php while(have_posts()): ?><?php the_post(); ?>

      <div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
        <div class="post_content">
        <h2 class="postitle"><?php the_title(); ?></h2>

        <div class="product-block">
          <div class="product-img">
            <?php if ( has_post_thumbnail()) :
              the_post_thumbnail('medium');
            else: ?>
              <img src="<?php echo catchFirstImage(); ?>" title="<?php the_title(); ?>" alt="<?php the_title(); ?>" />
            <?php endif; ?>
          </div><!-- product-img -->

          <div class="post_cat">
            <?php _e('Серия' , 'zenon'); ?> : <div class="catag_list"><?php the_category(', '); ?></div>
          </div>


          <?php if( have_rows('catalog') ): ?>
          <ul class="list-var">
          <?php while( have_rows('catalog') ): the_row();
            $size = get_sub_field('weight');
            $price = get_sub_field('price');
          ?>
            <li><span class="size"><?php echo $size; ?><?php the_field('measure'); ?></span> - <span class="price"><?php echo $price; ?></span>р.  <a href="javascript:;" onclick="simpleCart.add({name:'<?php the_title(); ?>',size:'<?php echo $size; ?>',price: <?php echo $price; ?>});" >В корзину</a></li>

          <?php endwhile; ?>
          </ul>
          <?php endif; ?>

        </div>
        <!-- /.product-block -->

        <div class="zn_post_wrap"><?php the_content(); ?> </div>
        <div style="clear:both"></div>

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
