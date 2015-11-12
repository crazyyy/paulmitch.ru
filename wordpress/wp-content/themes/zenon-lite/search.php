<?php get_header(); ?>
<div class="lay1">
  <div class="search_term">
    <h2 class="postsearch"><?php printf( __( 'Search Results for: %s', 'zenon' ), '<span>' . esc_html( get_search_query() ) . '</span>'); ?></h2>
    <a class="search_count"><?php _e('Total posts found for', 'zenon'); ?> <?php /* Search Count */ $allsearch = &new WP_Query("s=$s&showposts=-1"); $key = esc_html($s, 1); $count = $allsearch->post_count; _e('', 'zenon'); _e('<span class="search-terms">"', 'zenon'); echo $key; _e('"</span>', 'zenon'); _e(' &mdash; ', 'zenon'); echo $count . ''; wp_reset_query(); ?></a>
            <?php get_search_form(); ?>
  </div><!-- search_term -->



  <?php if (function_exists("znn_paginate")) {znn_paginate();} ?>

  <div class="hidden_nav"><?php paginate_links(); ?></div>
</div><!-- lay1 -->
<?php get_footer(); ?>
