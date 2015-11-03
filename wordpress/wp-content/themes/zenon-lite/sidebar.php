<div id="sidebar">
  <div id="widgets-cart" class="widgets widgets-cart">

    <h3 class="widgettitle widgettitle-price">В корзине <span id="simpleCart_quantity" class="simpleCart_quantity"></span> товаров <br>на сумму <span class="simpleCart_total"></span></h3>

    <div class="simpleCart_items">
    </div>
    <br />
    Общая сумма: <span id="simpleCart_grandTotal" class="simpleCart_grandTotal"></span> <br /> <br />
    <a href="javascript:;" class="simpleCart_checkout">Оформить</a>

  </div><!-- /.widgets widgets-cart -->
  <div class="widgets">
    <ul>
      <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Right Sidebar') ) : ?>
      <?php endif; ?>
    </ul>
  </div><!-- widgets -->
</div><!-- sidebar -->
