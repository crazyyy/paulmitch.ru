!function(t) {
    t.fn.easySlider = function(e) {
        var a = {
            prevId: "prevBtn",
            prevText: "&laquo;",
            nextId: "nextBtn",
            nextText: "&raquo;",
            controlsShow: !0,
            controlsBefore: "",
            controlsAfter: "",
            controlsFade: !0,
            firstId: "firstBtn",
            firstText: "First",
            firstShow: !1,
            lastId: "lastBtn",
            lastText: "Last",
            lastShow: !1,
            vertical: !1,
            speed: 600,
            auto: !1,
            pause: 2e3,
            continuous: !1,
            numeric: !1,
            numericId: "controls"
        }
          , e = t.extend(a, e);
        this.each(function() {
            function a(a) {
                a = parseInt(a) + 1,
                t("li", "#" + e.numericId).removeClass("current"),
                t("li#" + e.numericId + a).addClass("current")
            }
            function i() {
                u > d && (u = 0),
                0 > u && (u = d),
                e.vertical ? t("ul", r).css("margin-left", u * c * -1) : t("ul", r).css("margin-left", u * o * -1),
                l = !0,
                e.numeric && a(u)
            }
            function n(a, s) {
                if (l) {
                    l = !1;
                    var f = u;
                    switch (a) {
                    case "next":
                        u = f >= d ? e.continuous ? u + 1 : d : u + 1;
                        break;
                    case "prev":
                        u = 0 >= u ? e.continuous ? u - 1 : 0 : u - 1;
                        break;
                    case "first":
                        u = 0;
                        break;
                    case "last":
                        u = d;
                        break;
                    default:
                        u = a
                    }
                    var h = Math.abs(f - u)
                      , I = h * e.speed;
                    e.vertical ? (p = u * c * -1,
                    t("ul", r).animate({
                        marginTop: p
                    }, {
                        queue: !1,
                        duration: I,
                        complete: i
                    })) : (p = u * o * -1,
                    t("ul", r).animate({
                        marginLeft: p
                    }, {
                        queue: !1,
                        duration: I,
                        complete: i
                    })),
                    !e.continuous && e.controlsFade && (u == d ? (t("a", "#" + e.nextId).hide(),
                    t("a", "#" + e.lastId).hide()) : (t("a", "#" + e.nextId).show(),
                    t("a", "#" + e.lastId).show()),
                    0 == u ? (t("a", "#" + e.prevId).hide(),
                    t("a", "#" + e.firstId).hide()) : (t("a", "#" + e.prevId).show(),
                    t("a", "#" + e.firstId).show())),
                    s && clearTimeout(v),
                    e.auto && "next" == a && !s && (v = setTimeout(function() {
                        n("next", !1)
                    }
                    , h * e.speed + e.pause))
                }
            }
            var r = t(this)
              , s = t("li", r).length
              , o = t("li", r).width()
              , c = t("li", r).height()
              , l = !0;
            r.width(o),
            r.height(c),
            r.css("overflow", "hidden");
            var d = s - 1
              , u = 0;
            if (t("ul", r).css("width", s * o),
            e.continuous && (t("ul", r).prepend(t("ul li:last-child", r).clone().css("margin-left", "-" + o + "px")),
            t("ul", r).append(t("ul li:nth-child(2)", r).clone()),
            t("ul", r).css("width", (s + 1) * o)),
            e.vertical || t("li", r).css("float", "left"),
            e.controlsShow) {
                var f = e.controlsBefore;
                e.numeric ? f += '<ol id="' + e.numericId + '"></ol>' : (e.firstShow && (f += '<span id="' + e.firstId + '"><a href="javascript:void(0);">' + e.firstText + "</a></span>"),
                f += ' <span id="' + e.prevId + '"><a href="javascript:void(0);">' + e.prevText + "</a></span>",
                f += ' <span id="' + e.nextId + '"><a href="javascript:void(0);">' + e.nextText + "</a></span>",
                e.lastShow && (f += ' <span id="' + e.lastId + '"><a href="javascript:void(0);">' + e.lastText + "</a></span>")),
                f += e.controlsAfter,
                t(r).after(f)
            }
            if (e.numeric)
                for (var h = 0; s > h; h++)
                    t(document.createElement("li")).attr("id", e.numericId + (h + 1)).html("<a rel=" + h + ' href="javascript:void(0);">' + (h + 1) + "</a>").appendTo(t("#" + e.numericId)).click(function() {
                        n(t("a", t(this)).attr("rel"), !0)
                    }
                    );
            else
                t("a", "#" + e.nextId).click(function() {
                    n("next", !0)
                }
                ),
                t("a", "#" + e.prevId).click(function() {
                    n("prev", !0)
                }
                ),
                t("a", "#" + e.firstId).click(function() {
                    n("first", !0)
                }
                ),
                t("a", "#" + e.lastId).click(function() {
                    n("last", !0)
                }
                );
            var v;
            e.auto && (v = setTimeout(function() {
                n("next", !1)
            }
            , e.pause)),
            e.numeric && a(0),
            !e.continuous && e.controlsFade && (t("a", "#" + e.prevId).hide(),
            t("a", "#" + e.firstId).hide())
        }
        )
    }
}
(jQuery);
