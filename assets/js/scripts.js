!function() {
    for (var e, t = function() {}
    , a = ["assert", "clear", "count", "debug", "dir", "dirxml", "error", "exception", "group", "groupCollapsed", "groupEnd", "info", "log", "markTimeline", "profile", "profileEnd", "table", "time", "timeEnd", "timeline", "timelineEnd", "timeStamp", "trace", "warn"], r = a.length, l = window.console = window.console || {}; r--; )
        e = a[r],
        l[e] || (l[e] = t)
}
(),
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
    e > 0 ? console.log("Whoa, the cart total is now at " + simpleCart.toCurrency(simpleCart.grandTotal()) + "! Nice!") : console.log("nothing")
}
);
