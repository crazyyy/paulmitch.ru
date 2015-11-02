
<div id="slider" class="easyslider">
        <ul>



<?php query_posts( array( 'post_type' => 'slider', 'showposts' => '10' ) ); ?>
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>




         <li>
          <?php $znndata = get_post_meta($post->ID, 'znn_slide_link', TRUE); ?>
     <?php if(of_get_option('sldrtxt_checkbox') == "1"){ ?>
         <div class="slider-content">

            <?php the_title( '<h2 class="entry-title"><a href="' . $znndata . '" title="' . the_title_attribute( 'echo=0' ) . '" rel="bookmark">', '</a></h2>' ); ?>
                <?php the_excerpt(); ?>
            </div>
         <?php } ?>

        <a href="<?php echo $znndata; ?>"><?php the_post_thumbnail(); ?></a>
            </li>
<?php endwhile; endif; ?>



<?php wp_reset_query(); ?>


        </ul>
</div>
