// Avoid `console` errors in browsers that lack a console.
(function () {
  var method;
  var noop = function () {};
  var methods = ['assert', 'clear', 'count', 'debug', 'dir', 'dirxml', 'error', 'exception', 'group', 'groupCollapsed', 'groupEnd', 'info', 'log', 'markTimeline', 'profile', 'profileEnd', 'table', 'time', 'timeEnd', 'timeline', 'timelineEnd', 'timeStamp', 'trace', 'warn'];
  var length = methods.length;
  var console = (window.console = window.console || {});

  while (length--) {
    method = methods[length];

    // Only stub undefined methods.
    if (!console[method]) {
        console[method] = noop;
    }
}
}());

// Place any jQuery/helper plugins in here.
//
var widgetsCart = document.getElementById("widgets-cart");

simpleCart.currency({
    code: "RUB",
    name: "рубли",
    symbol: "<i class='fa fa-rub'></i>",
    delimiter: " ",
    decimal: ",",
    after: !0,
    accuracy: 0
}),
simpleCart({
    cartColumns: [{
        attr: "name",
        label: "Название"
    }, {
        attr: "price",
        label: "Цена",
        view: "currency"
    }, {
        view: "decrement",
        label: !1,
        text: "-"
    }, {
        attr: "quantity",
        label: "Кол-во"
    }, {
        view: "increment",
        label: !1,
        text: "+"
    }, {
        attr: "total",
        label: "Итого",
        view: "currency"
    }, {
        view: "remove",
        text: "Удалить",
        label: !1
    }]
}),
simpleCart.bind("update", function() {
    var e = simpleCart.grandTotal();
    if ( e > 0 ) {
      widgetsCart.style.display = "block";
    } else {
      widgetsCart.style.display = "none";
    }
  }
);
