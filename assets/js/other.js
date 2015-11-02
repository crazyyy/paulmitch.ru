/**
* hoverIntent r5 // 2007.03.27 // jQuery 1.1.2
* <http://cherne.net/brian/resources/jquery.hoverIntent.html>
*
* @param  f  onMouseOver function || An object with configuration options
* @param  g  onMouseOut function  || Nothing (use configuration options object)
* @return    The object (aka "this") that called hoverIntent, and the event object
* @author    Brian Cherne <brian@cherne.net>
*/
(function($) {
    $.fn.hoverIntent = function(f, g) {
        var cfg = {
            sensitivity: 7,
            interval: 100,
            timeout: 0
        };
        cfg = $.extend(cfg, g ? {
            over: f,
            out: g
        } : f);
        var cX, cY, pX, pY;
        var track = function(ev) {
            cX = ev.pageX;
            cY = ev.pageY;
        }
        ;
        var compare = function(ev, ob) {
            ob.hoverIntent_t = clearTimeout(ob.hoverIntent_t);
            if ((Math.abs(pX - cX) + Math.abs(pY - cY)) < cfg.sensitivity) {
                $(ob).unbind("mousemove", track);
                ob.hoverIntent_s = 1;
                return cfg.over.apply(ob, [ev]);
            } else {
                pX = cX;
                pY = cY;
                ob.hoverIntent_t = setTimeout(function() {
                    compare(ev, ob);
                }
                , cfg.interval);
            }
        }
        ;
        var delay = function(ev, ob) {
            ob.hoverIntent_t = clearTimeout(ob.hoverIntent_t);
            ob.hoverIntent_s = 0;
            return cfg.out.apply(ob, [ev]);
        }
        ;
        var handleHover = function(e) {
            var p = (e.type == "mouseover" ? e.fromElement : e.toElement) || e.relatedTarget;
            while (p && p != this) {
                try {
                    p = p.parentNode;
                } catch (e) {
                    p = this;
                }
            }
            if (p == this) {
                return false;
            }
            var ev = jQuery.extend({}, e);
            var ob = this;
            if (ob.hoverIntent_t) {
                ob.hoverIntent_t = clearTimeout(ob.hoverIntent_t);
            }
            if (e.type == "mouseover") {
                pX = ev.pageX;
                pY = ev.pageY;
                $(ob).bind("mousemove", track);
                if (ob.hoverIntent_s != 1) {
                    ob.hoverIntent_t = setTimeout(function() {
                        compare(ev, ob);
                    }
                    , cfg.interval);
                }
            } else {
                $(ob).unbind("mousemove", track);
                if (ob.hoverIntent_s == 1) {
                    ob.hoverIntent_t = setTimeout(function() {
                        delay(ev, ob);
                    }
                    , cfg.timeout);
                }
            }
        }
        ;
        return this.mouseover(handleHover).mouseout(handleHover);
    }
    ;
}
)(jQuery);


/*
 * FancyBox - jQuery Plugin
 * Simple and fancy lightbox alternative
 *
 * Examples and documentation at: http://fancybox.net
 *
 * Copyright (c) 2008 - 2010 Janis Skarnelis
 * That said, it is hardly a one-person project. Many people have submitted bugs, code, and offered their advice freely. Their support is greatly appreciated.
 *
 * Version: 1.3.3 (04/11/2010)
 * Requires: jQuery v1.3+
 *
 * Dual licensed under the MIT and GPL licenses:
 *   http://www.opensource.org/licenses/mit-license.php
 *   http://www.gnu.org/licenses/gpl.html
 */

;(function(a) {
    var m, t, u, f, D, j, E, n, z, A, q = 0, e = {}, o = [], p = 0, c = {}, l = [], G = null , v = new Image, J = /\.(jpg|gif|png|bmp|jpeg)(.*)?$/i, W = /[^\.]\.(swf)\s*$/i, K, L = 1, y = 0, s = "", r, i, h = false, B = a.extend(a("<div/>")[0], {
        prop: 0
    }), M = a.browser.msie && a.browser.version < 7 && !window.XMLHttpRequest, N = function() {
        t.hide();
        v.onerror = v.onload = null ;
        G && G.abort();
        m.empty()
    }
    , O = function() {
        if (false === e.onError(o, q, e)) {
            t.hide();
            h = false
        } else {
            e.titleShow = false;
            e.width = "auto";
            e.height = "auto";
            m.html('<p id="fancybox-error">The requested content cannot be loaded.<br />Please try again later.</p>');
            F()
        }
    }
    , I = function() {
        var b = o[q], d, g, k, C, P, w;
        N();
        e = a.extend({}, a.fn.fancybox.defaults, typeof a(b).data("fancybox") == "undefined" ? e : a(b).data("fancybox"));
        w = e.onStart(o, q, e);
        if (w === false)
            h = false;
        else {
            if (typeof w == "object")
                e = a.extend(e, w);
            k = e.title || (b.nodeName ? a(b).attr("title") : b.title) || "";
            if (b.nodeName && !e.orig)
                e.orig = a(b).children("img:first").length ? a(b).children("img:first") : a(b);
            if (k === "" && e.orig && e.titleFromAlt)
                k = e.orig.attr("alt");
            d = e.href || (b.nodeName ? a(b).attr("href") : b.href) || null ;
            if (/^(?:javascript)/i.test(d) ||
            d == "#")
                d = null ;
            if (e.type) {
                g = e.type;
                if (!d)
                    d = e.content
            } else if (e.content)
                g = "html";
            else if (d)
                g = d.match(J) ? "image" : d.match(W) ? "swf" : a(b).hasClass("iframe") ? "iframe" : d.indexOf("#") === 0 ? "inline" : "ajax";
            if (g) {
                if (g == "inline") {
                    b = d.substr(d.indexOf("#"));
                    g = a(b).length > 0 ? "inline" : "ajax"
                }
                e.type = g;
                e.href = d;
                e.title = k;
                if (e.autoDimensions && e.type !== "iframe" && e.type !== "swf") {
                    e.width = "auto";
                    e.height = "auto"
                }
                if (e.modal) {
                    e.overlayShow = true;
                    e.hideOnOverlayClick = false;
                    e.hideOnContentClick = false;
                    e.enableEscapeButton = false;
                    e.showCloseButton = false
                }
                e.padding = parseInt(e.padding, 10);
                e.margin = parseInt(e.margin, 10);
                m.css("padding", e.padding + e.margin);
                a(".fancybox-inline-tmp").unbind("fancybox-cancel").bind("fancybox-change", function() {
                    a(this).replaceWith(j.children())
                }
                );
                switch (g) {
                case "html":
                    m.html(e.content);
                    F();
                    break;
                case "inline":
                    if (a(b).parent().is("#fancybox-content") === true) {
                        h = false;
                        break
                    }
                    a('<div class="fancybox-inline-tmp" />').hide().insertBefore(a(b)).bind("fancybox-cleanup", function() {
                        a(this).replaceWith(j.children())
                    }
                    ).bind("fancybox-cancel",
                    function() {
                        a(this).replaceWith(m.children())
                    }
                    );
                    a(b).appendTo(m);
                    F();
                    break;
                case "image":
                    h = false;
                    a.fancybox.showActivity();
                    v = new Image;
                    v.onerror = function() {
                        O()
                    }
                    ;
                    v.onload = function() {
                        h = true;
                        v.onerror = v.onload = null ;
                        e.width = v.width;
                        e.height = v.height;
                        a("<img />").attr({
                            id: "fancybox-img",
                            src: v.src,
                            alt: e.title
                        }).appendTo(m);
                        Q()
                    }
                    ;
                    v.src = d;
                    break;
                case "swf":
                    e.scrolling = "no";
                    e.autoDimensions = false;
                    C = '<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="' + e.width + '" height="' + e.height + '"><param name="movie" value="' +
                    d + '"></param>';
                    P = "";
                    a.each(e.swf, function(x, H) {
                        C += '<param name="' + x + '" value="' + H + '"></param>';
                        P += " " + x + '="' + H + '"'
                    }
                    );
                    C += '<embed src="' + d + '" type="application/x-shockwave-flash" width="' + e.width + '" height="' + e.height + '"' + P + "></embed></object>";
                    m.html(C);
                    F();
                    break;
                case "ajax":
                    h = false;
                    a.fancybox.showActivity();
                    e.ajax.win = e.ajax.success;
                    G = a.ajax(a.extend({}, e.ajax, {
                        url: d,
                        data: e.ajax.data || {},
                        error: function(x) {
                            x.status > 0 && O()
                        },
                        success: function(x, H, R) {
                            if ((typeof R == "object" ? R : G).status == 200) {
                                if (typeof e.ajax.win ==
                                "function") {
                                    w = e.ajax.win(d, x, H, R);
                                    if (w === false) {
                                        t.hide();
                                        return
                                    } else if (typeof w == "string" || typeof w == "object")
                                        x = w
                                }
                                m.html(x);
                                F()
                            }
                        }
                    }));
                    break;
                case "iframe":
                    e.autoDimensions = false;
                    Q()
                }
            } else
                O()
        }
    }
    , F = function() {
        m.wrapInner('<div style="width:' + (e.width == "auto" ? "auto" : e.width + "px") + ";height:" + (e.height == "auto" ? "auto" : e.height + "px") + ";overflow: " + (e.scrolling == "auto" ? "auto" : e.scrolling == "yes" ? "scroll" : "hidden") + '"></div>');
        e.width = m.width();
        e.height = m.height();
        Q()
    }
    , Q = function() {
        var b, d;
        t.hide();
        if (f.is(":visible") &&
        false === c.onCleanup(l, p, c)) {
            a.event.trigger("fancybox-cancel");
            h = false
        } else {
            h = true;
            a(j.add(u)).unbind();
            a(window).unbind("resize.fb scroll.fb");
            a(document).unbind("keydown.fb");
            f.is(":visible") && c.titlePosition !== "outside" && f.css("height", f.height());
            l = o;
            p = q;
            c = e;
            if (c.overlayShow) {
                u.css({
                    "background-color": c.overlayColor,
                    opacity: c.overlayOpacity,
                    cursor: c.hideOnOverlayClick ? "pointer" : "auto",
                    height: a(document).height()
                });
                if (!u.is(":visible")) {
                    M && a("select:not(#fancybox-tmp select)").filter(function() {
                        return this.style.visibility !==
                        "hidden"
                    }
                    ).css({
                        visibility: "hidden"
                    }).one("fancybox-cleanup", function() {
                        this.style.visibility = "inherit"
                    }
                    );
                    u.show()
                }
            } else
                u.hide();
            i = X();
            s = c.title || "";
            y = 0;
            n.empty().removeAttr("style").removeClass();
            if (c.titleShow !== false) {
                if (a.isFunction(c.titleFormat))
                    b = c.titleFormat(s, l, p, c);
                else
                    b = s && s.length ? c.titlePosition == "float" ? '<table id="fancybox-title-float-wrap" cellpadding="0" cellspacing="0"><tr><td id="fancybox-title-float-left"></td><td id="fancybox-title-float-main">' + s + '</td><td id="fancybox-title-float-right"></td></tr></table>' :
                    '<div id="fancybox-title-' + c.titlePosition + '">' + s + "</div>" : false;
                s = b;
                if (!(!s || s === "")) {
                    n.addClass("fancybox-title-" + c.titlePosition).html(s).appendTo("body").show();
                    switch (c.titlePosition) {
                    case "inside":
                        n.css({
                            width: i.width - c.padding * 2,
                            marginLeft: c.padding,
                            marginRight: c.padding
                        });
                        y = n.outerHeight(true);
                        n.appendTo(D);
                        i.height += y;
                        break;
                    case "over":
                        n.css({
                            marginLeft: c.padding,
                            width: i.width - c.padding * 2,
                            bottom: c.padding
                        }).appendTo(D);
                        break;
                    case "float":
                        n.css("left", parseInt((n.width() - i.width - 40) / 2, 10) *
                        -1).appendTo(f);
                        break;
                    default:
                        n.css({
                            width: i.width - c.padding * 2,
                            paddingLeft: c.padding,
                            paddingRight: c.padding
                        }).appendTo(f)
                    }
                }
            }
            n.hide();
            if (f.is(":visible")) {
                a(E.add(z).add(A)).hide();
                b = f.position();
                r = {
                    top: b.top,
                    left: b.left,
                    width: f.width(),
                    height: f.height()
                };
                d = r.width == i.width && r.height == i.height;
                j.fadeTo(c.changeFade, 0.3, function() {
                    var g = function() {
                        j.html(m.contents()).fadeTo(c.changeFade, 1, S)
                    }
                    ;
                    a.event.trigger("fancybox-change");
                    j.empty().removeAttr("filter").css({
                        "border-width": c.padding,
                        width: i.width -
                        c.padding * 2,
                        height: e.autoDimensions ? "auto" : i.height - y - c.padding * 2
                    });
                    if (d)
                        g();
                    else {
                        B.prop = 0;
                        a(B).animate({
                            prop: 1
                        }, {
                            duration: c.changeSpeed,
                            easing: c.easingChange,
                            step: T,
                            complete: g
                        })
                    }
                }
                )
            } else {
                f.removeAttr("style");
                j.css("border-width", c.padding);
                if (c.transitionIn == "elastic") {
                    r = V();
                    j.html(m.contents());
                    f.show();
                    if (c.opacity)
                        i.opacity = 0;
                    B.prop = 0;
                    a(B).animate({
                        prop: 1
                    }, {
                        duration: c.speedIn,
                        easing: c.easingIn,
                        step: T,
                        complete: S
                    })
                } else {
                    c.titlePosition == "inside" && y > 0 && n.show();
                    j.css({
                        width: i.width - c.padding * 2,
                        height: e.autoDimensions ?
                        "auto" : i.height - y - c.padding * 2
                    }).html(m.contents());
                    f.css(i).fadeIn(c.transitionIn == "none" ? 0 : c.speedIn, S)
                }
            }
        }
    }
    , Y = function() {
        if (c.enableEscapeButton || c.enableKeyboardNav)
            a(document).bind("keydown.fb", function(b) {
                if (b.keyCode == 27 && c.enableEscapeButton) {
                    b.preventDefault();
                    a.fancybox.close()
                } else if ((b.keyCode == 37 || b.keyCode == 39) && c.enableKeyboardNav && b.target.tagName !== "INPUT" && b.target.tagName !== "TEXTAREA" && b.target.tagName !== "SELECT") {
                    b.preventDefault();
                    a.fancybox[b.keyCode == 37 ? "prev" : "next"]()
                }
            }
            );
        if (c.showNavArrows) {
            if (c.cyclic &&
            l.length > 1 || p !== 0)
                z.show();
            if (c.cyclic && l.length > 1 || p != l.length - 1)
                A.show()
        } else {
            z.hide();
            A.hide()
        }
    }
    , S = function() {
        if (!a.support.opacity) {
            j.get(0).style.removeAttribute("filter");
            f.get(0).style.removeAttribute("filter")
        }
        if (e.autoDimensions) {
            f.css("height", "auto");
            j.css("height", "auto")
        }
        s && s.length && n.show();
        c.showCloseButton && E.show();
        Y();
        c.hideOnContentClick && j.bind("click", a.fancybox.close);
        c.hideOnOverlayClick && u.bind("click", a.fancybox.close);
        a(window).bind("resize.fb", a.fancybox.resize);
        c.centerOnScroll &&
        a(window).bind("scroll.fb", a.fancybox.center);
        if (c.type == "iframe")
            a('<iframe id="fancybox-frame" name="fancybox-frame' + (new Date).getTime() + '" frameborder="0" hspace="0" ' + (a.browser.msie ? 'allowtransparency="true""' : "") + ' scrolling="' + e.scrolling + '" src="' + c.href + '"></iframe>').appendTo(j);
        f.show();
        h = false;
        a.fancybox.center();
        c.onComplete(l, p, c);
        var b, d;
        if (l.length - 1 > p) {
            b = l[p + 1].href;
            if (typeof b !== "undefined" && b.match(J)) {
                d = new Image;
                d.src = b
            }
        }
        if (p > 0) {
            b = l[p - 1].href;
            if (typeof b !== "undefined" && b.match(J)) {
                d =
                new Image;
                d.src = b
            }
        }
    }
    , T = function(b) {
        var d = {
            width: parseInt(r.width + (i.width - r.width) * b, 10),
            height: parseInt(r.height + (i.height - r.height) * b, 10),
            top: parseInt(r.top + (i.top - r.top) * b, 10),
            left: parseInt(r.left + (i.left - r.left) * b, 10)
        };
        if (typeof i.opacity !== "undefined")
            d.opacity = b < 0.5 ? 0.5 : b;
        f.css(d);
        j.css({
            width: d.width - c.padding * 2,
            height: d.height - y * b - c.padding * 2
        })
    }
    , U = function() {
        return [a(window).width() - c.margin * 2, a(window).height() - c.margin * 2, a(document).scrollLeft() + c.margin, a(document).scrollTop() + c.margin]
    }
    ,
    X = function() {
        var b = U()
          , d = {}
          , g = c.autoScale
          , k = c.padding * 2;
        d.width = c.width.toString().indexOf("%") > -1 ? parseInt(b[0] * parseFloat(c.width) / 100, 10) : c.width + k;
        d.height = c.height.toString().indexOf("%") > -1 ? parseInt(b[1] * parseFloat(c.height) / 100, 10) : c.height + k;
        if (g && (d.width > b[0] || d.height > b[1]))
            if (e.type == "image" || e.type == "swf") {
                g = c.width / c.height;
                if (d.width > b[0]) {
                    d.width = b[0];
                    d.height = parseInt((d.width - k) / g + k, 10)
                }
                if (d.height > b[1]) {
                    d.height = b[1];
                    d.width = parseInt((d.height - k) * g + k, 10)
                }
            } else {
                d.width = Math.min(d.width,
                b[0]);
                d.height = Math.min(d.height, b[1])
            }
        d.top = parseInt(Math.max(b[3] - 20, b[3] + (b[1] - d.height - 40) * 0.5), 10);
        d.left = parseInt(Math.max(b[2] - 20, b[2] + (b[0] - d.width - 40) * 0.5), 10);
        return d
    }
    , V = function() {
        var b = e.orig ? a(e.orig) : false
          , d = {};
        if (b && b.length) {
            d = b.offset();
            d.top += parseInt(b.css("paddingTop"), 10) || 0;
            d.left += parseInt(b.css("paddingLeft"), 10) || 0;
            d.top += parseInt(b.css("border-top-width"), 10) || 0;
            d.left += parseInt(b.css("border-left-width"), 10) || 0;
            d.width = b.width();
            d.height = b.height();
            d = {
                width: d.width + c.padding *
                2,
                height: d.height + c.padding * 2,
                top: d.top - c.padding - 20,
                left: d.left - c.padding - 20
            }
        } else {
            b = U();
            d = {
                width: c.padding * 2,
                height: c.padding * 2,
                top: parseInt(b[3] + b[1] * 0.5, 10),
                left: parseInt(b[2] + b[0] * 0.5, 10)
            }
        }
        return d
    }
    , Z = function() {
        if (t.is(":visible")) {
            a("div", t).css("top", L * -40 + "px");
            L = (L + 1) % 12
        } else
            clearInterval(K)
    }
    ;
    a.fn.fancybox = function(b) {
        if (!a(this).length)
            return this;
        a(this).data("fancybox", a.extend({}, b, a.metadata ? a(this).metadata() : {})).unbind("click.fb").bind("click.fb", function(d) {
            d.preventDefault();
            if (!h) {
                h = true;
                a(this).blur();
                o = [];
                q = 0;
                d = a(this).attr("rel") || "";
                if (!d || d == "" || d === "nofollow")
                    o.push(this);
                else {
                    o = a("a[rel=" + d + "], area[rel=" + d + "]");
                    q = o.index(this)
                }
                I()
            }
        }
        );
        return this
    }
    ;
    a.fancybox = function(b, d) {
        var g;
        if (!h) {
            h = true;
            g = typeof d !== "undefined" ? d : {};
            o = [];
            q = parseInt(g.index, 10) || 0;
            if (a.isArray(b)) {
                for (var k = 0, C = b.length; k < C; k++)
                    if (typeof b[k] == "object")
                        a(b[k]).data("fancybox", a.extend({}, g, b[k]));
                    else
                        b[k] = a({}).data("fancybox", a.extend({
                            content: b[k]
                        }, g));
                o = jQuery.merge(o, b)
            } else {
                if (typeof b ==
                "object")
                    a(b).data("fancybox", a.extend({}, g, b));
                else
                    b = a({}).data("fancybox", a.extend({
                        content: b
                    }, g));
                o.push(b)
            }
            if (q > o.length || q < 0)
                q = 0;
            I()
        }
    }
    ;
    a.fancybox.showActivity = function() {
        clearInterval(K);
        t.show();
        K = setInterval(Z, 66)
    }
    ;
    a.fancybox.hideActivity = function() {
        t.hide()
    }
    ;
    a.fancybox.next = function() {
        return a.fancybox.pos(p + 1)
    }
    ;
    a.fancybox.prev = function() {
        return a.fancybox.pos(p - 1)
    }
    ;
    a.fancybox.pos = function(b) {
        if (!h) {
            b = parseInt(b);
            o = l;
            if (b > -1 && b < l.length) {
                q = b;
                I()
            } else if (c.cyclic && l.length > 1) {
                q = b >= l.length ?
                0 : l.length - 1;
                I()
            }
        }
    }
    ;
    a.fancybox.cancel = function() {
        if (!h) {
            h = true;
            a.event.trigger("fancybox-cancel");
            N();
            e.onCancel(o, q, e);
            h = false
        }
    }
    ;
    a.fancybox.close = function() {
        function b() {
            u.fadeOut("fast");
            n.empty().hide();
            f.hide();
            a.event.trigger("fancybox-cleanup");
            j.empty();
            c.onClosed(l, p, c);
            l = e = [];
            p = q = 0;
            c = e = {};
            h = false
        }
        if (!(h || f.is(":hidden"))) {
            h = true;
            if (c && false === c.onCleanup(l, p, c))
                h = false;
            else {
                N();
                a(E.add(z).add(A)).hide();
                a(j.add(u)).unbind();
                a(window).unbind("resize.fb scroll.fb");
                a(document).unbind("keydown.fb");
                j.find("iframe").attr("src", M && /^https/i.test(window.location.href || "") ? "javascript:void(false)" : "about:blank");
                c.titlePosition !== "inside" && n.empty();
                f.stop();
                if (c.transitionOut == "elastic") {
                    r = V();
                    var d = f.position();
                    i = {
                        top: d.top,
                        left: d.left,
                        width: f.width(),
                        height: f.height()
                    };
                    if (c.opacity)
                        i.opacity = 1;
                    n.empty().hide();
                    B.prop = 1;
                    a(B).animate({
                        prop: 0
                    }, {
                        duration: c.speedOut,
                        easing: c.easingOut,
                        step: T,
                        complete: b
                    })
                } else
                    f.fadeOut(c.transitionOut == "none" ? 0 : c.speedOut, b)
            }
        }
    }
    ;
    a.fancybox.resize = function() {
        u.is(":visible") &&
        u.css("height", a(document).height());
        a.fancybox.center(true)
    }
    ;
    a.fancybox.center = function(b) {
        var d, g;
        if (!h) {
            g = b === true ? 1 : 0;
            d = U();
            !g && (f.width() > d[0] || f.height() > d[1]) || f.stop().animate({
                top: parseInt(Math.max(d[3] - 20, d[3] + (d[1] - j.height() - 40) * 0.5 - c.padding)),
                left: parseInt(Math.max(d[2] - 20, d[2] + (d[0] - j.width() - 40) * 0.5 - c.padding))
            }, typeof b == "number" ? b : 200)
        }
    }
    ;
    a.fancybox.init = function() {
        if (!a("#fancybox-wrap").length) {
            a("body").append(m = a('<div id="fancybox-tmp"></div>'), t = a('<div id="fancybox-loading"><div></div></div>'),
            u = a('<div id="fancybox-overlay"></div>'), f = a('<div id="fancybox-wrap"></div>'));
            D = a('<div id="fancybox-outer"></div>').append('<div class="fancybox-bg" id="fancybox-bg-n"></div><div class="fancybox-bg" id="fancybox-bg-ne"></div><div class="fancybox-bg" id="fancybox-bg-e"></div><div class="fancybox-bg" id="fancybox-bg-se"></div><div class="fancybox-bg" id="fancybox-bg-s"></div><div class="fancybox-bg" id="fancybox-bg-sw"></div><div class="fancybox-bg" id="fancybox-bg-w"></div><div class="fancybox-bg" id="fancybox-bg-nw"></div>').appendTo(f);
            D.append(j = a('<div id="fancybox-content"></div>'), E = a('<a id="fancybox-close"></a>'), n = a('<div id="fancybox-title"></div>'), z = a('<a href="javascript:;" id="fancybox-left"><span class="fancy-ico" id="fancybox-left-ico"></span></a>'), A = a('<a href="javascript:;" id="fancybox-right"><span class="fancy-ico" id="fancybox-right-ico"></span></a>'));
            E.click(a.fancybox.close);
            t.click(a.fancybox.cancel);
            z.click(function(b) {
                b.preventDefault();
                a.fancybox.prev()
            }
            );
            A.click(function(b) {
                b.preventDefault();
                a.fancybox.next()
            }
            );
            a.fn.mousewheel && f.bind("mousewheel.fb", function(b, d) {
                if (h || c.type == "image")
                    b.preventDefault();
                a.fancybox[d > 0 ? "prev" : "next"]()
            }
            );
            a.support.opacity || f.addClass("fancybox-ie");
            if (M) {
                t.addClass("fancybox-ie6");
                f.addClass("fancybox-ie6");
                a('<iframe id="fancybox-hide-sel-frame" src="' + (/^https/i.test(window.location.href || "") ? "javascript:void(false)" : "about:blank") + '" scrolling="no" border="0" frameborder="0" tabindex="-1"></iframe>').prependTo(D)
            }
        }
    }
    ;
    a.fn.fancybox.defaults = {
        padding: 10,
        margin: 40,
        opacity: false,
        modal: false,
        cyclic: false,
        scrolling: "auto",
        width: 560,
        height: 340,
        autoScale: true,
        autoDimensions: true,
        centerOnScroll: false,
        ajax: {},
        swf: {
            wmode: "transparent"
        },
        hideOnOverlayClick: true,
        hideOnContentClick: false,
        overlayShow: true,
        overlayOpacity: 0.7,
        overlayColor: "#777",
        titleShow: true,
        titlePosition: "float",
        titleFormat: null ,
        titleFromAlt: false,
        transitionIn: "fade",
        transitionOut: "fade",
        speedIn: 300,
        speedOut: 300,
        changeSpeed: 300,
        changeFade: "fast",
        easingIn: "swing",
        easingOut: "swing",
        showCloseButton: true,
        showNavArrows: true,
        enableEscapeButton: true,
        enableKeyboardNav: true,
        onStart: function() {},
        onCancel: function() {},
        onComplete: function() {},
        onCleanup: function() {},
        onClosed: function() {},
        onError: function() {}
    };
    a(document).ready(function() {
        a.fancybox.init()
    }
    )
}
)(jQuery);


/*************************************************
**  jQuery Masonry version 1.3.2
**  Copyright David DeSandro, licensed MIT
**  http://desandro.com/resources/jquery-masonry
**************************************************/
(function(e) {
    var n = e.event, o;
    n.special.smartresize = {
        setup: function() {
            e(this).bind("resize", n.special.smartresize.handler)
        },
        teardown: function() {
            e(this).unbind("resize", n.special.smartresize.handler)
        },
        handler: function(j, l) {
            var g = this
              , d = arguments;
            j.type = "smartresize";
            o && clearTimeout(o);
            o = setTimeout(function() {
                jQuery.event.handle.apply(g, d)
            }
            , l === "execAsap" ? 0 : 100)
        }
    };
    e.fn.smartresize = function(j) {
        return j ? this.bind("smartresize", j) : this.trigger("smartresize", ["execAsap"])
    }
    ;
    e.fn.masonry = function(j, l) {
        var g =
        {
            getBricks: function(d, b, a) {
                var c = a.itemSelector === undefined;
                b.$bricks = a.appendedContent === undefined ? c ? d.children() : d.find(a.itemSelector) : c ? a.appendedContent : a.appendedContent.filter(a.itemSelector)
            },
            placeBrick: function(d, b, a, c, h) {
                b = Math.min.apply(Math, a);
                for (var i = b + d.outerHeight(true), f = a.length, k = f, m = c.colCount + 1 - f; f--; )
                    if (a[f] == b)
                        k = f;
                d.applyStyle({
                    left: c.colW * k + c.posLeft,
                    top: b
                }, e.extend(true, {}, h.animationOptions));
                for (f = 0; f < m; f++)
                    c.colY[k + f] = i
            },
            setup: function(d, b, a) {
                g.getBricks(d, a, b);
                if (a.masoned)
                    a.previousData =
                    d.data("masonry");
                a.colW = b.columnWidth === undefined ? a.masoned ? a.previousData.colW : a.$bricks.outerWidth(true) : b.columnWidth;
                a.colCount = Math.floor(d.width() / a.colW);
                a.colCount = Math.max(a.colCount, 1)
            },
            arrange: function(d, b, a) {
                var c;
                if (!a.masoned || b.appendedContent !== undefined)
                    a.$bricks.css("position", "absolute");
                if (a.masoned) {
                    a.posTop = a.previousData.posTop;
                    a.posLeft = a.previousData.posLeft
                } else {
                    d.css("position", "relative");
                    var h = e(document.createElement("div"));
                    d.prepend(h);
                    a.posTop = Math.round(h.position().top);
                    a.posLeft = Math.round(h.position().left);
                    h.remove()
                }
                if (a.masoned && b.appendedContent !== undefined) {
                    a.colY = a.previousData.colY;
                    for (c = a.previousData.colCount; c < a.colCount; c++)
                        a.colY[c] = a.posTop
                } else {
                    a.colY = [];
                    for (c = a.colCount; c--; )
                        a.colY.push(a.posTop)
                }
                e.fn.applyStyle = a.masoned && b.animate ? e.fn.animate : e.fn.css;
                b.singleMode ? a.$bricks.each(function() {
                    var i = e(this);
                    g.placeBrick(i, a.colCount, a.colY, a, b)
                }
                ) : a.$bricks.each(function() {
                    var i = e(this)
                      , f = Math.ceil(i.outerWidth(true) / a.colW);
                    f = Math.min(f, a.colCount);
                    if (f === 1)
                        g.placeBrick(i, a.colCount, a.colY, a, b);
                    else {
                        var k = a.colCount + 1 - f
                          , m = [];
                        for (c = 0; c < k; c++) {
                            var p = a.colY.slice(c, c + f);
                            m[c] = Math.max.apply(Math, p)
                        }
                        g.placeBrick(i, k, m, a, b)
                    }
                }
                );
                a.wallH = Math.max.apply(Math, a.colY);
                d.applyStyle({
                    height: a.wallH - a.posTop
                }, e.extend(true, [], b.animationOptions));
                a.masoned || setTimeout(function() {
                    d.addClass("masoned")
                }
                , 1);
                l.call(a.$bricks);
                d.data("masonry", a)
            },
            resize: function(d, b, a) {
                a.masoned = !!d.data("masonry");
                var c = d.data("masonry").colCount;
                g.setup(d, b, a);
                a.colCount != c &&
                g.arrange(d, b, a)
            }
        };
        return this.each(function() {
            var d = e(this)
              , b = {};
            b.masoned = !!d.data("masonry");
            var a = b.masoned ? d.data("masonry").options : {}
              , c = e.extend({}, e.fn.masonry.defaults, a, j)
              , h = a.resizeable;
            b.options = c.saveOptions ? c : a;
            l = l || function() {}
            ;
            g.getBricks(d, b, c);
            if (!b.$bricks.length)
                return this;
            g.setup(d, c, b);
            g.arrange(d, c, b);
            !h && c.resizeable && e(window).bind("smartresize.masonry", function() {
                g.resize(d, c, b)
            }
            );
            h && !c.resizeable && e(window).unbind("smartresize.masonry")
        }
        )
    }
    ;
    e.fn.masonry.defaults = {
        singleMode: false,
        columnWidth: undefined,
        itemSelector: undefined,
        appendedContent: undefined,
        saveOptions: true,
        resizeable: true,
        animate: false,
        animationOptions: {}
    }
}
)(jQuery);


/*!
 * equalWidths jQuery Plugin
 * Examples and documentation at: http://aloestudios.com/tools/jquery/equalwidths/
 * Copyright (c) 2010 Andy Ford
 * Version: 0.1 (2010-04-13)
 * Dual licensed under the MIT and GPL licenses:
 * http://www.opensource.org/licenses/mit-license.php
 * http://www.gnu.org/licenses/gpl.html
 * Requires: jQuery v1.2.6+
 */
(function($) {
    $.fn.equalWidths = function(options) {
        var opts = $.extend({
            stripPadding: 'none'// options: 'child', 'grand-child', 'both'
        }, options);
        return this.each(function() {
            var child_count = $(this).children().size();
            if (child_count > 0) {
                // only proceed if we've found any children
                var w_parent = $(this).width();
                var w_child = Math.floor(w_parent / child_count);
                var w_child_last = w_parent - (w_child * (child_count - 1));
                $(this).children().css({
                    'width': w_child + 'px'
                });
                $(this).children(':last-child').css({
                    'width': w_child_last + 'px'
                });
                if ((opts.stripPadding == 'child') || (opts.stripPadding == 'both')) {
                    $(this).children().css({
                        'padding-right': '0',
                        'padding-left': '0'
                    });
                }
                if ((opts.stripPadding == 'grand-child') || (opts.stripPadding == 'both')) {
                    $(this).children().children().css({
                        'padding-right': '0',
                        'padding-left': '0'
                    });
                }
            }
        }
        );
    }
    ;
}
)(jQuery);



// Sticky Plugin
// =============
// Author: Anthony Garand
// Improvements by German M. Bravo (Kronuz) and Ruud Kamphuis (ruudk)
// Improvements by Leonardo C. Daronco (daronco)
// Created: 2/14/2011
// Date: 2/12/2012
// Website: http://labs.anthonygarand.com/sticky
// Description: Makes an element on the page stick on the screen as you scroll
//              It will only set the 'top' and 'position' of your element, you
//              might need to adjust the width in some cases.

(function($) {
    var defaults = {
        topSpacing: 0,
        bottomSpacing: 0,
        className: 'is-sticky',
        wrapperClassName: 'sticky-wrapper',
    }
      ,
    $window = $(window)
      ,
    $document = $(document)
      ,
    sticked = []
      ,
    windowHeight = $window.height()
      ,
    scroller = function() {
        var scrollTop = $window.scrollTop()
          ,
        documentHeight = $document.height()
          ,
        dwh = documentHeight - windowHeight
          ,
        extra = (scrollTop > dwh) ? dwh - scrollTop : 0;
        for (var i = 0; i < sticked.length; i++) {
            var s = sticked[i]
              ,
            elementTop = s.stickyWrapper.offset().top
              ,
            etse = elementTop - s.topSpacing - extra;
            if (scrollTop <= etse) {
                if (s.currentTop !== null ) {
                    s.stickyElement
                    .css('position', '')
                    .css('top', '')
                    .removeClass(s.className);
                    s.stickyElement.parent().removeClass(s.className);
                    s.currentTop = null ;
                }
            }
            else {
                var newTop = documentHeight - s.stickyElement.outerHeight()
                - s.topSpacing - s.bottomSpacing - scrollTop - extra;
                if (newTop < 0) {
                    newTop = newTop + s.topSpacing;
                } else {
                    newTop = s.topSpacing;
                }
                if (s.currentTop != newTop) {
                    s.stickyElement
                    .css('position', 'fixed')
                    .css('top', newTop)
                    .addClass(s.className);
                    s.stickyElement.parent().addClass(s.className);
                    s.currentTop = newTop;
                }
            }
        }
    }
      ,
    resizer = function() {
        windowHeight = $window.height();
    }
      ,
    methods = {
        init: function(options) {
            var o = $.extend(defaults, options);
            return this.each(function() {
                var stickyElement = $(this);

                stickyId = stickyElement.attr('id');
                wrapper = $('<div></div>')
                .attr('id', stickyId + '-sticky-wrapper')
                .addClass(o.wrapperClassName);
                stickyElement.wrapAll(wrapper)
                var stickyWrapper = stickyElement.parent();
                stickyWrapper.css('height', stickyElement.outerHeight());
                sticked.push({
                    topSpacing: o.topSpacing,
                    bottomSpacing: o.bottomSpacing,
                    stickyElement: stickyElement,
                    currentTop: null ,
                    stickyWrapper: stickyWrapper,
                    className: o.className
                });
            }
            );
        },
        update: scroller
    };

    // should be more efficient than using $window.scroll(scroller) and $window.resize(resizer):
    if (window.addEventListener) {
        window.addEventListener('scroll', scroller, false);
        window.addEventListener('resize', resizer, false);
    } else if (window.attachEvent) {
        window.attachEvent('onscroll', scroller);
        window.attachEvent('onresize', resizer);
    }

    $.fn.sticky = function(method) {
        if (methods[method]) {
            return methods[method].apply(this, Array.prototype.slice.call(arguments, 1));
        } else if (typeof method === 'object' || !method) {
            return methods.init.apply(this, arguments);
        } else {
            $.error('Method ' + method + ' does not exist on jQuery.sticky');
        }
    }
    ;
    $(function() {
        setTimeout(scroller, 0);
    }
    );
}
)(jQuery);



/*! http://tinynav.viljamis.com v1.03 by @viljamis */
(function(a, i, g) {
    a.fn.tinyNav = function(j) {
        var c = a.extend({
            active: "selected",
            header: !1
        }, j);
        return this.each(function() {
            g++;
            var h = a(this)
              , d = "tinynav" + g
              , e = ".l_" + d
              , b = a("<select/>").addClass("tinynav " + d);
            if (h.is("ul,ol")) {
                c.header && b.append(a("<option/>").text("Navigation"));
                var f = "";
                h.addClass("l_" + d).find("a").each(function() {
                    f += '<option value="' + a(this).attr("href") + '">' + a(this).text() + "</option>"
                }
                );
                b.append(f);
                c.header || b.find(":eq(" + a(e + " li").index(a(e + " li." + c.active)) + ")").attr("selected", !0);
                b.change(function() {
                    i.location.href = a(this).val()
                }
                );
                a(e).after(b)
            }
        }
        )
    }
}
)(jQuery, this, 0);
