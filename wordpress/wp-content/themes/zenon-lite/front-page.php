<?php /* Template Name: Home Page */ get_header(); ?>

<!--SLIDER END-->

<div class="slider_wrap">
    <div id="zn_slider">
      <?php get_template_part(''.$zn_slides = of_get_option('slider_select', 'easyslider').''); ?>
    </div>
    <div class="skew_bottom_big"></div>
    <div class="skew_bottom_right"></div>
</div>
<!--SLIDER END-->

<hr>
<?php the_field("test"); ?>


<?php
echo "<hr>
<hr><br><br>";
$terms = get_field('taxonomys');

if( $terms ): ?>

    <ul>

    <?php foreach( $terms as $term ): ?>

        <h2><?php echo $term->name; ?></h2>
        <p><?php echo $term->description; ?></p>
        <a href="<?php echo get_term_link( $term ); ?>">View all '<?php echo $term->name; ?>' posts</a>

    <?php endforeach; ?>

    </ul>



<?php endif;

echo " <br>
<hr>";?>

<?php

$term = get_field('taxonomys');

if( $term ): ?>

    <h2><?php echo $term->name; ?></h2>
    <p><?php echo $term->description; ?></p>

<?php endif;
echo "<hr><br><br>
<hr>";

?>





<!--LATEST POSTS-->
<?php if ( is_home() ) { ?>
  <?php if(of_get_option('latstpst_checkbox') == "1"){ ?><?php get_template_part(''.$zn_lays = of_get_option('layout_images', 'layout1').''); ?><?php } else { ?><?php } ?>
<?php } else { ?>
  <?php get_template_part(''.$zn_lays = of_get_option('layout_images', 'layout1').''); ?>
<?php } ?>
<!--LATEST POSTS END-->

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
