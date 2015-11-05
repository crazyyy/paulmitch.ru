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
          <span>Мы в соцсетях: </span><a rel="nofollow" href="http://vk.com/pmitchellsell" class="vkgroup"></a><a rel="nofollow" href="https://instagram.com/paul_mitchell_sell/" class="instgroup"></a><a rel="nofollow" href="https://www.facebook.com/pmitchellsell" class="fbgroup"></a>
        </div><!-- sonetlink -->
      </div><!-- footmenu -->
    </div><!-- copyright -->

  </div>

  <?php wp_footer(); ?>

<script>
  $(document).ready(function() {
    var postData = <?php echo json_encode($_POST) ?>;
    if ( postData.itemCount > 0 ) {
      var htmlForm = '';
      for ( i = 0 ; i < postData.itemCount ; i++ ) {
        num = i + 1;

        itemDatas = 'Позиция: ' + postData['item_name_' + num] + '\r\nЦена: ' + postData['item_price_' + num] + 'руб.\r\nКоличество: ' + postData['item_quantity_' + num] + '\r\n------\r\n';
        htmlForm +=  itemDatas;
      }
    }
    $('#your-message').val(htmlForm);
  });
</script>


</body>
</html>
