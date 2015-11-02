<!--FOOTER SIDEBAR-->
<!-- <div id="footer">
  <div class="widgets">
    <ul>
      <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer Widgets') ) : ?><?php endif; ?>
    </ul>
  </div>
</div>footer -->

<!--COPYRIGHT TEXT-->
<div id="copyright">
  <div class="copytext">
    <?php echo of_get_option('footer_textarea'); ?>
    <?php _e('Theme by', 'zenon');?> <a class="towfiq" rel="nofollow" target="_blank" href="http://vk.com/pmitchellsell">Ilya Batler</a>
  </div>
  <!--FOOTER MENU-->
  <div id="footmenu">
    <?php wp_nav_menu( array( 'container_class' => 'menu-footer', 'theme_location' => 'footer', 'depth' => 0, 'fallback_cb' =>false) ); ?>
    <div class="sonetlink">
      <span>Мы в соцсетях: </span><a href="http://vk.com/pmitchellsell" class="vkgroup"></a><a href="https://instagram.com/paul_mitchell_sell/" class="instgroup"></a><a href="https://www.facebook.com/pmitchellsell" class="fbgroup"></a>
    </div><!-- sonetlink -->
  </div><!-- footmenu -->
</div><!-- copyright -->


</div>
<?php wp_footer(); ?>
</body>
</html>
