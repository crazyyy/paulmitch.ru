<?php /* Template Name: Home Page */ get_header(); ?>




<?php $terms = get_field('taxonomys'); if( $terms ): ?>
<div class="lay1">

  <div class="lay1_wrap">
    <?php foreach( $terms as $term ): ?>
      <div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
        <div class="post_content">
          <h2 class="postitle"><a href="<?php echo get_term_link( $term ); ?>" title="<?php echo $term->name; ?>"><?php echo $term->name; ?></a></h2>


        <div class="post_image">
          <!--CALL TO POST IMAGE-->
          <a href="<?php echo get_term_link( $term ); ?>">
            <img src="<?php echo get_field('image', $term); ?>" alt="">
          </a>
        </div><!-- post_image -->

        <div class="znn_excerptmore">
          <p><?php echo $term->description; ?></p>
        </div><!-- /.znn_excerptmore -->

        </div><!-- post_content -->

      </div><!-- post_class -->
    <?php endforeach; ?>
  </div><!-- lay1_wrap -->


</div><!-- lay1 -->
<?php endif; ?>



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
