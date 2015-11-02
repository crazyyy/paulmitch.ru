<div id="sidebar">
  <div class="widgets widgets-cart">

    <h3 class="widgettitle widgettitle-price">В корзине: <span class="simpleCart_total"></span> (<span id="simpleCart_quantity" class="simpleCart_quantity"></span>)</h3>


    <br />




  <div class="simpleCart_items" >
  </div>


  <br />
  SubTotal: <span id="simpleCart_total" class="simpleCart_total"></span> <br />
  -----------------------------<br />
  Final Total: <span id="simpleCart_grandTotal" class="simpleCart_grandTotal"></span> <br />

  <a href="javascript:;" class="simpleCart_checkout">checkout</a>
  <a href="javascript:;" class="simpleCart_empty">x</a>

  </div><!-- /.widgets widgets-cart -->
  <div class="widgets">
    <ul>
      <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Right Sidebar') ) : ?>
      <?php endif; ?>
    </ul>
  </div><!-- widgets -->
</div><!-- sidebar -->
