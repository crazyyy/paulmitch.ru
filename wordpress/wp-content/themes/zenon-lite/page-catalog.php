<?php /* Template Name: Catalogue Page */ get_header(); ?>


<div class="lay1">
  <div class="lay1_wrap">

    <?php while( have_rows('quad') ): the_row();

      if( get_sub_field( 'pageornot' ) ) {
        $slug = get_sub_field('slug');

        $idObj = get_category_by_slug( $slug );
        $link = get_term_link( $idObj );
        $title = $idObj->name;
        $image = get_field('image', $idObj);
        $content = $idObj->description;

      } else {

        $slug = get_sub_field('page-slug');

        $post_id = url_to_postid( $slug );
        $link = get_sub_field('page-slug');
        $title = get_post_field( 'post_title', $post_id );
        $image = wp_get_attachment_url( get_post_thumbnail_id( $post_id ) );
        $content = get_post_field( 'post_content', $post_id );
      }
    ?>

      <div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
        <div class="post_content">
          <h2 class="postitle"><a href="<?php echo $link; ?>" title="<?php echo $title; ?>"><?php echo $title; ?></a></h2>

          <div class="post_image">
            <!--CALL TO POST IMAGE-->
            <a href="<?php echo $link; ?>">
              <img src="<?php echo $image; ?>" alt="<?php echo $title; ?>">
            </a>
          </div><!-- post_image -->

        <div class="znn_excerptmore">
          <p><?php echo $content; ?></p>
        </div><!-- /.znn_excerptmore -->

        </div><!-- post_content -->

      </div><!-- post_class -->

    <?php endwhile; ?>

  </div><!-- lay1_wrap -->
</div><!-- lay1 -->

<!--MIDROW STARTS-->
<?php if(of_get_option('blocks_checkbox') == "1"){ ?>
<div class="midrow">

<div class="midrow_wrap">
  <div class="midrow_blocks">
    <div class="skew_top_big"></div>
    <div class="skew_top_right"></div>
    <div class="midrow_blocks_wrap">
      <?php if ( of_get_option('block1_textarea') ) { ?>
      <div class="midrow_block">
        <div class="mid_block_content">
          <h3><?php echo of_get_option('block1_text'); ?></h3>
          <p><?php echo of_get_option('block1_textarea'); ?></p>
        </div>
      </div>
      <?php } ?>
      <?php if ( of_get_option('block2_textarea') ) { ?>
      <div class="midrow_block">
        <div class="mid_block_content">
          <h3><?php echo of_get_option('block2_text'); ?></h3>
          <p><?php echo of_get_option('block2_textarea'); ?></p>
        </div>
      </div>
      <?php } ?>
      <?php if ( of_get_option('block3_textarea') ) { ?>
      <div class="midrow_block">
        <div class="mid_block_content">
          <h3><?php echo of_get_option('block3_text'); ?></h3>
          <p><?php echo of_get_option('block3_textarea'); ?></p>
        </div>
      </div>
      <?php } ?>
      <?php if ( of_get_option('block4_textarea') ) { ?>
      <div class="midrow_block">
        <div class="mid_block_content">
          <h3><?php echo of_get_option('block4_text'); ?></h3>
          <p><?php echo of_get_option('block4_textarea'); ?></p>
        </div>
      </div>
      <?php } ?>
    </div>
  </div>

  <div class="skew_bottom_big"></div>
  <div class="skew_bottom_right"></div>
</div><!-- midrow_wrap -->

</div><!-- midrow -->
<?php }?>
<!--MIDROW END-->

<?php get_footer(); ?>
