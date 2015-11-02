<?php if( have_rows('slider') ): ?>
<div id="slider" class="easyslider">
  <ul>
  <?php while( have_rows('slider') ): the_row();

    // vars
    $image = get_sub_field('image');
    $title = get_sub_field('title');
    $content = get_sub_field('description');
    $link = get_sub_field('link');

    ?>

    <li>
      <div class="slider-content">
        <h2 class="entry-title">
          <a href="<?php echo $link; ?>" title="<?php echo $title; ?>" rel="bookmark"><?php echo $title; ?></a>
        </h2>
        <p><?php echo $content; ?></p>
      </div><!-- slider-content -->
      <a href="<?php echo $link; ?>"><img src="<?php echo $image; ?>" alt="<?php echo $title; ?>" /></a>
    </li>

  <?php endwhile; ?>
  </ul>
</div><!-- slider -->
<?php endif; ?>
