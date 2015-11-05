


// zenon
jQuery(window).load(function(e) {
    jQuery("#topmenu ul.menu").tinyNav(),
    jQuery("#footer:has(.widgets ul:empty)").hide(),
    jQuery("#related #output li:eq(3), .lay1 .hentry:eq(2), .lay1 .hentry:eq(5), .lay1 .hentry:eq(8), .lay1 .hentry:eq(11), .lay1 .hentry:eq(14), .lay1 .hentry:eq(17), .lay2 .hentry:eq(2), .lay2 .hentry:eq(5), .lay2 .hentry:eq(8), .lay2 .hentry:eq(11), .lay2 .hentry:eq(14), .lay2 .hentry:eq(17), .ads-125x125 a:eq(1) img, .ads-125x125 a:eq(3) img").css({
        "margin-Right": "0px"
    }),
    jQuery(".midrow_block:last-child .mid_block_content, #sidebar .widgets .widget li:last-child").css({
        border: "none"
    }),
    jQuery(".skew_bottom_big").transform({
        rotate: "1deg"
    }),
    jQuery(".skew_bottom_right").transform({
        rotate: "51deg"
    }),
    jQuery(".skew_top_big").transform({
        rotate: "1deg"
    }),
    jQuery(".skew_top_right").transform({
        rotate: "-35deg"
    }),
    jQuery(".midrow_blocks_wrap").equalWidths(),
    jQuery.support.opacity && (jQuery(".social li").css({
        opacity: "0.3"
    }),
    jQuery(".social li").hoverIntent(function() {
        jQuery(this).animate({
            opacity: "1"
        }, 200)
    }
    , function() {
        jQuery(this).animate({
            opacity: "0.3"
        }, 100)
    }
    )),
    jQuery("#topmenu ul > li").hoverIntent(function() {
        jQuery(this).find(".sub-menu:first, ul.children:first").slideDown({
            duration: 200
        })
    }
    , function() {
        jQuery(this).find(".sub-menu:first, ul.children:first").slideUp({
            duration: 200
        })
    }
    ),
    jQuery("#topmenu ul li").not("#topmenu ul li ul li").hover(function() {
        jQuery(this).addClass("menu_hover")
    }
    , function() {
        jQuery(this).removeClass("menu_hover")
    }
    ),
    jQuery("#topmenu li").has("ul").addClass("zn_parent_menu"),
    jQuery(".zn_parent_menu > a").append("<span></span>");
    for (var t = jQuery(".lay1 .hentry"), r = 0; r < t.length; r += 3)
        t.slice(r, r + 3).wrapAll("<div class='zn_row'></div>");
    jQuery(".lay1 .hentry, .lay2 .hentry ").hover(function() {
        jQuery(this).find(".date_meta").stop().animate({
            right: "0px"
        }, 300),
        jQuery(this).find(".block_comm").stop().animate({
            left: "0px"
        }, 300)
    }
    , function() {
        jQuery(this).find(".date_meta").stop().animate({
            right: "-300px"
        }, 300),
        jQuery(this).find(".block_comm").stop().animate({
            left: "-200px"
        }, 300)
    }
    ),
    jQuery(".comment-form-author, .comment-form-email, .comment-form-url").wrapAll('<div class="field_wrap" />'),
    jQuery(".comment-reply-link").click(function() {
        jQuery("#respond_wrap .single_skew_comm, #respond_wrap .single_skew").hide()
    }
    ),
    jQuery("#cancel-comment-reply-link").click(function() {
        jQuery("#respond_wrap .single_skew_comm, #respond_wrap .single_skew").show()
    }
    )
}
),
jQuery(window).load(function(e) {
    jQuery("#footer").masonry({
        itemSelector: ".widget"
    })
}
);

// other.js

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

//Sticky MENU
jQuery(window).load(function($) {
if (jQuery("body").hasClass('logged-in')) {
  jQuery("#topmenu").sticky({topSpacing:27});
}
else {
  $("#topmenu").sticky({topSpacing:0});
}
jQuery("#topmenu").css({"z-index":"11"});
});
//JQUERY Site title Animation
jQuery(window).scroll(function() {
if (jQuery(this).scrollTop() < 150) {
  jQuery(".scroll_title").hide();
}
else {
  jQuery(".scroll_title").show('fast');
}
});



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

/*
 * jQuery 2d Transform v0.9.3
 * http://wiki.github.com/heygrady/transform/
 *
 * Copyright 2010, Grady Kuhnline
 * Dual licensed under the MIT or GPL Version 2 licenses.
 * http://jquery.org/license
 *
 * Date: Sat Dec 4 15:46:09 2010 -0800
 */
(function(f, g, j, b) {
    var h = /progid:DXImageTransform\.Microsoft\.Matrix\(.*?\)/
      , c = /^([\+\-]=)?([\d+.\-]+)(.*)$/
      , q = /%/;
    var d = j.createElement("modernizr")
      , e = d.style;
    function n(s) {
        return parseFloat(s)
    }
    function l() {
        var s = {
            transformProperty: "",
            MozTransform: "-moz-",
            WebkitTransform: "-webkit-",
            OTransform: "-o-",
            msTransform: "-ms-"
        };
        for (var t in s) {
            if (typeof e[t] != "undefined") {
                return s[t]
            }
        }
        return null
    }
    function r() {
        if (typeof (g.Modernizr) !== "undefined") {
            return Modernizr.csstransforms
        }
        var t = ["transformProperty", "WebkitTransform", "MozTransform", "OTransform", "msTransform"];
        for (var s in t) {
            if (e[t[s]] !== b) {
                return true
            }
        }
    }
    var a = l()
      , i = a !== null  ? a + "transform" : false
      , k = a !== null  ? a + "transform-origin" : false;
    f.support.csstransforms = r();
    if (a == "-ms-") {
        i = "msTransform";
        k = "msTransformOrigin"
    }
    f.extend({
        transform: function(s) {
            s.transform = this;
            this.$elem = f(s);
            this.applyingMatrix = false;
            this.matrix = null ;
            this.height = null ;
            this.width = null ;
            this.outerHeight = null ;
            this.outerWidth = null ;
            this.boxSizingValue = null ;
            this.boxSizingProperty = null ;
            this.attr = null ;
            this.transformProperty = i;
            this.transformOriginProperty = k
        }
    });
    f.extend(f.transform, {
        funcs: ["matrix", "origin", "reflect", "reflectX", "reflectXY", "reflectY", "rotate", "scale", "scaleX", "scaleY", "skew", "skewX", "skewY", "translate", "translateX", "translateY"]
    });
    f.fn.transform = function(s, t) {
        return this.each(function() {
            var u = this.transform || new f.transform(this);
            if (s) {
                u.exec(s, t)
            }
        }
        )
    }
    ;
    f.transform.prototype = {
        exec: function(s, t) {
            t = f.extend(true, {
                forceMatrix: false,
                preserve: false
            }, t);
            this.attr = null ;
            if (t.preserve) {
                s = f.extend(true, this.getAttrs(true, true), s)
            } else {
                s = f.extend(true, {}, s)
            }
            this.setAttrs(s);
            if (f.support.csstransforms && !t.forceMatrix) {
                return this.execFuncs(s)
            } else {
                if (f.browser.msie || (f.support.csstransforms && t.forceMatrix)) {
                    return this.execMatrix(s)
                }
            }
            return false
        },
        execFuncs: function(t) {
            var s = [];
            for (var u in t) {
                if (u == "origin") {
                    this[u].apply(this, f.isArray(t[u]) ? t[u] : [t[u]])
                } else {
                    if (f.inArray(u, f.transform.funcs) !== -1) {
                        s.push(this.createTransformFunc(u, t[u]))
                    }
                }
            }
            this.$elem.css(i, s.join(" "));
            return true
        },
        execMatrix: function(z) {
            var C, x, t;
            var F = this.$elem[0]
              , B = this;
            function A(N, M) {
                if (q.test(N)) {
                    return parseFloat(N) / 100 * B["safeOuter" + (M ? "Height" : "Width")]()
                }
                return o(F, N)
            }
            var s = /translate[X|Y]?/
              , u = [];
            for (var v in z) {
                switch (f.type(z[v])) {
                case "array":
                    t = z[v];
                    break;
                case "string":
                    t = f.map(z[v].split(","), f.trim);
                    break;
                default:
                    t = [z[v]]
                }
                if (f.matrix[v]) {
                    if (f.cssAngle[v]) {
                        t = f.map(t, f.angle.toDegree)
                    } else {
                        if (!f.cssNumber[v]) {
                            t = f.map(t, A)
                        } else {
                            t = f.map(t, n)
                        }
                    }
                    x = f.matrix[v].apply(this, t);
                    if (s.test(v)) {
                        u.push(x)
                    } else {
                        C = C ? C.x(x) : x
                    }
                } else {
                    if (v == "origin") {
                        this[v].apply(this, t)
                    }
                }
            }
            C = C || f.matrix.identity();
            f.each(u, function(M, N) {
                C = C.x(N)
            }
            );
            var K = parseFloat(C.e(1, 1).toFixed(6))
              , I = parseFloat(C.e(2, 1).toFixed(6))
              , H = parseFloat(C.e(1, 2).toFixed(6))
              , G = parseFloat(C.e(2, 2).toFixed(6))
              , L = C.rows === 3 ? parseFloat(C.e(1, 3).toFixed(6)) : 0
              , J = C.rows === 3 ? parseFloat(C.e(2, 3).toFixed(6)) : 0;
            if (f.support.csstransforms && a === "-moz-") {
                this.$elem.css(i, "matrix(" + K + ", " + I + ", " + H + ", " + G + ", " + L + "px, " + J + "px)")
            } else {
                if (f.support.csstransforms) {
                    this.$elem.css(i, "matrix(" + K + ", " + I + ", " + H + ", " + G + ", " + L + ", " + J + ")")
                } else {
                    if (f.browser.msie) {
                        var w = ", FilterType='nearest neighbor'";
                        var D = this.$elem[0].style;
                        var E = "progid:DXImageTransform.Microsoft.Matrix(M11=" + K + ", M12=" + H + ", M21=" + I + ", M22=" + G + ", sizingMethod='auto expand'" + w + ")";
                        var y = D.filter || f.curCSS(this.$elem[0], "filter") || "";
                        D.filter = h.test(y) ? y.replace(h, E) : y ? y + " " + E : E;
                        this.applyingMatrix = true;
                        this.matrix = C;
                        this.fixPosition(C, L, J);
                        this.applyingMatrix = false;
                        this.matrix = null
                    }
                }
            }
            return true
        },
        origin: function(s, t) {
            if (f.support.csstransforms) {
                if (typeof t === "undefined") {
                    this.$elem.css(k, s)
                } else {
                    this.$elem.css(k, s + " " + t)
                }
                return true
            }
            switch (s) {
            case "left":
                s = "0";
                break;
            case "right":
                s = "100%";
                break;
            case "center":
            case b:
                s = "50%"
            }
            switch (t) {
            case "top":
                t = "0";
                break;
            case "bottom":
                t = "100%";
                break;
            case "center":
            case b:
                t = "50%"
            }
            this.setAttr("origin", [q.test(s) ? s : o(this.$elem[0], s) + "px", q.test(t) ? t : o(this.$elem[0], t) + "px"]);
            return true
        },
        createTransformFunc: function(t, u) {
            if (t.substr(0, 7) === "reflect") {
                var s = u ? f.matrix[t]() : f.matrix.identity();
                return "matrix(" + s.e(1, 1) + ", " + s.e(2, 1) + ", " + s.e(1, 2) + ", " + s.e(2, 2) + ", 0, 0)"
            }
            if (t == "matrix") {
                if (a === "-moz-") {
                    u[4] = u[4] ? u[4] + "px" : 0;
                    u[5] = u[5] ? u[5] + "px" : 0
                }
            }
            return t + "(" + (f.isArray(u) ? u.join(", ") : u) + ")"
        },
        fixPosition: function(B, y, x, D, s) {
            var w = new f.matrix.calc(B,this.safeOuterHeight(),this.safeOuterWidth())
              , C = this.getAttr("origin");
            var v = w.originOffset(new f.matrix.V2(q.test(C[0]) ? parseFloat(C[0]) / 100 * w.outerWidth : parseFloat(C[0]),q.test(C[1]) ? parseFloat(C[1]) / 100 * w.outerHeight : parseFloat(C[1])));
            var t = w.sides();
            var u = this.$elem.css("position");
            if (u == "static") {
                u = "relative"
            }
            var A = {
                top: 0,
                left: 0
            };
            var z = {
                position: u,
                top: (v.top + x + t.top + A.top) + "px",
                left: (v.left + y + t.left + A.left) + "px",
                zoom: 1
            };
            this.$elem.css(z)
        }
    };
    function o(s, u) {
        var t = c.exec(f.trim(u));
        if (t[3] && t[3] !== "px") {
            var w = "paddingBottom"
              , v = f.style(s, w);
            f.style(s, w, u);
            u = p(s, w);
            f.style(s, w, v);
            return u
        }
        return parseFloat(u)
    }
    function p(t, u) {
        if (t[u] != null  && (!t.style || t.style[u] == null )) {
            return t[u]
        }
        var s = parseFloat(f.css(t, u));
        return s && s > -10000 ? s : 0
    }
}
)(jQuery, this, this.document);
(function(d, c, a, f) {
    d.extend(d.transform.prototype, {
        safeOuterHeight: function() {
            return this.safeOuterLength("height")
        },
        safeOuterWidth: function() {
            return this.safeOuterLength("width")
        },
        safeOuterLength: function(l) {
            var p = "outer" + (l == "width" ? "Width" : "Height");
            if (!d.support.csstransforms && d.browser.msie) {
                l = l == "width" ? "width" : "height";
                if (this.applyingMatrix && !this[p] && this.matrix) {
                    var k = new d.matrix.calc(this.matrix,1,1)
                      , n = k.offset()
                      , g = this.$elem[p]() / n[l];
                    this[p] = g;
                    return g
                } else {
                    if (this.applyingMatrix && this[p]) {
                        return this[p]
                    }
                }
                var o = {
                    height: ["top", "bottom"],
                    width: ["left", "right"]
                };
                var h = this.$elem[0]
                  , j = parseFloat(d.curCSS(h, l, true))
                  , q = this.boxSizingProperty
                  , i = this.boxSizingValue;
                if (!this.boxSizingProperty) {
                    q = this.boxSizingProperty = e() || "box-sizing";
                    i = this.boxSizingValue = this.$elem.css(q) || "content-box"
                }
                if (this[p] && this[l] == j) {
                    return this[p]
                } else {
                    this[l] = j
                }
                if (q && (i == "padding-box" || i == "content-box")) {
                    j += parseFloat(d.curCSS(h, "padding-" + o[l][0], true)) || 0 + parseFloat(d.curCSS(h, "padding-" + o[l][1], true)) || 0
                }
                if (q && i == "content-box") {
                    j += parseFloat(d.curCSS(h, "border-" + o[l][0] + "-width", true)) || 0 + parseFloat(d.curCSS(h, "border-" + o[l][1] + "-width", true)) || 0
                }
                this[p] = j;
                return j
            }
            return this.$elem[p]()
        }
    });
    var b = null ;
    function e() {
        if (b) {
            return b
        }
        var h = {
            boxSizing: "box-sizing",
            MozBoxSizing: "-moz-box-sizing",
            WebkitBoxSizing: "-webkit-box-sizing",
            OBoxSizing: "-o-box-sizing"
        }
          , g = a.body;
        for (var i in h) {
            if (typeof g.style[i] != "undefined") {
                b = h[i];
                return b
            }
        }
        return null
    }
}
)(jQuery, this, this.document);
(function(g, f, b, h) {
    var d = /([\w\-]*?)\((.*?)\)/g
      , a = "data-transform"
      , e = /\s/
      , c = /,\s?/;
    g.extend(g.transform.prototype, {
        setAttrs: function(i) {
            var j = "", l;
            for (var k in i) {
                l = i[k];
                if (g.isArray(l)) {
                    l = l.join(", ")
                }
                j += " " + k + "(" + l + ")"
            }
            this.attr = g.trim(j);
            this.$elem.attr(a, this.attr)
        },
        setAttr: function(k, l) {
            if (g.isArray(l)) {
                l = l.join(", ")
            }
            var j = this.attr || this.$elem.attr(a);
            if (!j || j.indexOf(k) == -1) {
                this.attr = g.trim(j + " " + k + "(" + l + ")");
                this.$elem.attr(a, this.attr)
            } else {
                var i = [], n;
                d.lastIndex = 0;
                while (n = d.exec(j)) {
                    if (k == n[1]) {
                        i.push(k + "(" + l + ")")
                    } else {
                        i.push(n[0])
                    }
                }
                this.attr = i.join(" ");
                this.$elem.attr(a, this.attr)
            }
        },
        getAttrs: function() {
            var j = this.attr || this.$elem.attr(a);
            if (!j) {
                return {}
            }
            var i = {}, l, k;
            d.lastIndex = 0;
            while ((l = d.exec(j)) !== null ) {
                if (l) {
                    k = l[2].split(c);
                    i[l[1]] = k.length == 1 ? k[0] : k
                }
            }
            return i
        },
        getAttr: function(j) {
            var i = this.getAttrs();
            if (typeof i[j] !== "undefined") {
                return i[j]
            }
            if (j === "origin" && g.support.csstransforms) {
                return this.$elem.css(this.transformOriginProperty).split(e)
            } else {
                if (j === "origin") {
                    return ["50%", "50%"]
                }
            }
            return g.cssDefault[j] || 0
        }
    });
    if (typeof (g.cssAngle) == "undefined") {
        g.cssAngle = {}
    }
    g.extend(g.cssAngle, {
        rotate: true,
        skew: true,
        skewX: true,
        skewY: true
    });
    if (typeof (g.cssDefault) == "undefined") {
        g.cssDefault = {}
    }
    g.extend(g.cssDefault, {
        scale: [1, 1],
        scaleX: 1,
        scaleY: 1,
        matrix: [1, 0, 0, 1, 0, 0],
        origin: ["50%", "50%"],
        reflect: [1, 0, 0, 1, 0, 0],
        reflectX: [1, 0, 0, 1, 0, 0],
        reflectXY: [1, 0, 0, 1, 0, 0],
        reflectY: [1, 0, 0, 1, 0, 0]
    });
    if (typeof (g.cssMultipleValues) == "undefined") {
        g.cssMultipleValues = {}
    }
    g.extend(g.cssMultipleValues, {
        matrix: 6,
        origin: {
            length: 2,
            duplicate: true
        },
        reflect: 6,
        reflectX: 6,
        reflectXY: 6,
        reflectY: 6,
        scale: {
            length: 2,
            duplicate: true
        },
        skew: 2,
        translate: 2
    });
    g.extend(g.cssNumber, {
        matrix: true,
        reflect: true,
        reflectX: true,
        reflectXY: true,
        reflectY: true,
        scale: true,
        scaleX: true,
        scaleY: true
    });
    g.each(g.transform.funcs, function(j, k) {
        g.cssHooks[k] = {
            set: function(n, o) {
                var l = n.transform || new g.transform(n)
                  , i = {};
                i[k] = o;
                l.exec(i, {
                    preserve: true
                })
            },
            get: function(n, l) {
                var i = n.transform || new g.transform(n);
                return i.getAttr(k)
            }
        }
    }
    );
    g.each(["reflect", "reflectX", "reflectXY", "reflectY"], function(j, k) {
        g.cssHooks[k].get = function(n, l) {
            var i = n.transform || new g.transform(n);
            return i.getAttr("matrix") || g.cssDefault[k]
        }
    }
    )
}
)(jQuery, this, this.document);
(function(e, g, h, c) {
    var d = /^([+\-]=)?([\d+.\-]+)(.*)$/;
    var a = e.fn.animate;
    e.fn.animate = function(p, l, o, n) {
        var k = e.speed(l, o, n)
          , j = e.cssMultipleValues;
        k.complete = k.old;
        if (!e.isEmptyObject(p)) {
            if (typeof k.original === "undefined") {
                k.original = {}
            }
            e.each(p, function(s, u) {
                if (j[s] || e.cssAngle[s] || (!e.cssNumber[s] && e.inArray(s, e.transform.funcs) !== -1)) {
                    var t = null ;
                    if (jQuery.isArray(p[s])) {
                        var r = 1
                          , q = u.length;
                        if (j[s]) {
                            r = (typeof j[s].length === "undefined" ? j[s] : j[s].length)
                        }
                        if (q > r || (q < r && q == 2) || (q == 2 && r == 2 && isNaN(parseFloat(u[q - 1])))) {
                            t = u[q - 1];
                            u.splice(q - 1, 1)
                        }
                    }
                    k.original[s] = u.toString();
                    p[s] = parseFloat(u)
                }
            }
            )
        }
        return a.apply(this, [arguments[0], k])
    }
    ;
    var b = "paddingBottom";
    function i(k, l) {
        if (k[l] != null  && (!k.style || k.style[l] == null )) {}
        var j = parseFloat(e.css(k, l));
        return j && j > -10000 ? j : 0
    }
    var f = e.fx.prototype.custom;
    e.fx.prototype.custom = function(u, v, w) {
        var y = e.cssMultipleValues[this.prop]
          , p = e.cssAngle[this.prop];
        if (y || (!e.cssNumber[this.prop] && e.inArray(this.prop, e.transform.funcs) !== -1)) {
            this.values = [];
            if (!y) {
                y = 1
            }
            var x = this.options.original[this.prop]
              , t = e(this.elem).css(this.prop)
              , j = e.cssDefault[this.prop] || 0;
            if (!e.isArray(t)) {
                t = [t]
            }
            if (!e.isArray(x)) {
                if (e.type(x) === "string") {
                    x = x.split(",")
                } else {
                    x = [x]
                }
            }
            var l = y.length || y
              , s = 0;
            while (x.length < l) {
                x.push(y.duplicate ? x[0] : j[s] || 0);
                s++
            }
            var k, r, q, o = this, n = o.elem.transform;
            orig = e.style(o.elem, b);
            e.each(x, function(z, A) {
                if (t[z]) {
                    k = t[z]
                } else {
                    if (j[z] && !y.duplicate) {
                        k = j[z]
                    } else {
                        if (y.duplicate) {
                            k = t[0]
                        } else {
                            k = 0
                        }
                    }
                }
                if (p) {
                    k = e.angle.toDegree(k)
                } else {
                    if (!e.cssNumber[o.prop]) {
                        r = d.exec(e.trim(k));
                        if (r[3] && r[3] !== "px") {
                            if (r[3] === "%") {
                                k = parseFloat(r[2]) / 100 * n["safeOuter" + (z ? "Height" : "Width")]()
                            } else {
                                e.style(o.elem, b, k);
                                k = i(o.elem, b);
                                e.style(o.elem, b, orig)
                            }
                        }
                    }
                }
                k = parseFloat(k);
                r = d.exec(e.trim(A));
                if (r) {
                    q = parseFloat(r[2]);
                    w = r[3] || "px";
                    if (p) {
                        q = e.angle.toDegree(q + w);
                        w = "deg"
                    } else {
                        if (!e.cssNumber[o.prop] && w === "%") {
                            k = (k / n["safeOuter" + (z ? "Height" : "Width")]()) * 100
                        } else {
                            if (!e.cssNumber[o.prop] && w !== "px") {
                                e.style(o.elem, b, (q || 1) + w);
                                k = ((q || 1) / i(o.elem, b)) * k;
                                e.style(o.elem, b, orig)
                            }
                        }
                    }
                    if (r[1]) {
                        q = ((r[1] === "-=" ? -1 : 1) * q) + k
                    }
                } else {
                    q = A;
                    w = ""
                }
                o.values.push({
                    start: k,
                    end: q,
                    unit: w
                })
            }
            )
        }
        return f.apply(this, arguments)
    }
    ;
    e.fx.multipleValueStep = {
        _default: function(j) {
            e.each(j.values, function(k, l) {
                j.values[k].now = l.start + ((l.end - l.start) * j.pos)
            }
            )
        }
    };
    e.each(["matrix", "reflect", "reflectX", "reflectXY", "reflectY"], function(j, k) {
        e.fx.multipleValueStep[k] = function(n) {
            var p = n.decomposed
              , l = e.matrix;
            m = l.identity();
            p.now = {};
            e.each(p.start, function(q) {
                p.now[q] = parseFloat(p.start[q]) + ((parseFloat(p.end[q]) - parseFloat(p.start[q])) * n.pos);
                if (((q === "scaleX" || q === "scaleY") && p.now[q] === 1) || (q !== "scaleX" && q !== "scaleY" && p.now[q] === 0)) {
                    return true
                }
                m = m.x(l[q](p.now[q]))
            }
            );
            var o;
            e.each(n.values, function(q) {
                switch (q) {
                case 0:
                    o = parseFloat(m.e(1, 1).toFixed(6));
                    break;
                case 1:
                    o = parseFloat(m.e(2, 1).toFixed(6));
                    break;
                case 2:
                    o = parseFloat(m.e(1, 2).toFixed(6));
                    break;
                case 3:
                    o = parseFloat(m.e(2, 2).toFixed(6));
                    break;
                case 4:
                    o = parseFloat(m.e(1, 3).toFixed(6));
                    break;
                case 5:
                    o = parseFloat(m.e(2, 3).toFixed(6));
                    break
                }
                n.values[q].now = o
            }
            )
        }
    }
    );
    e.each(e.transform.funcs, function(j, k) {
        e.fx.step[k] = function(o) {
            var n = o.elem.transform || new e.transform(o.elem)
              , l = {};
            if (e.cssMultipleValues[k] || (!e.cssNumber[k] && e.inArray(k, e.transform.funcs) !== -1)) {
                (e.fx.multipleValueStep[o.prop] || e.fx.multipleValueStep._default)(o);
                l[o.prop] = [];
                e.each(o.values, function(p, q) {
                    l[o.prop].push(q.now + (e.cssNumber[o.prop] ? "" : q.unit))
                }
                )
            } else {
                l[o.prop] = o.now + (e.cssNumber[o.prop] ? "" : o.unit)
            }
            n.exec(l, {
                preserve: true
            })
        }
    }
    );
    e.each(["matrix", "reflect", "reflectX", "reflectXY", "reflectY"], function(j, k) {
        e.fx.step[k] = function(q) {
            var p = q.elem.transform || new e.transform(q.elem)
              , o = {};
            if (!q.initialized) {
                q.initialized = true;
                if (k !== "matrix") {
                    var n = e.matrix[k]().elements;
                    var r;
                    e.each(q.values, function(s) {
                        switch (s) {
                        case 0:
                            r = n[0];
                            break;
                        case 1:
                            r = n[2];
                            break;
                        case 2:
                            r = n[1];
                            break;
                        case 3:
                            r = n[3];
                            break;
                        default:
                            r = 0
                        }
                        q.values[s].end = r
                    }
                    )
                }
                q.decomposed = {};
                var l = q.values;
                q.decomposed.start = e.matrix.matrix(l[0].start, l[1].start, l[2].start, l[3].start, l[4].start, l[5].start).decompose();
                q.decomposed.end = e.matrix.matrix(l[0].end, l[1].end, l[2].end, l[3].end, l[4].end, l[5].end).decompose()
            }
            (e.fx.multipleValueStep[q.prop] || e.fx.multipleValueStep._default)(q);
            o.matrix = [];
            e.each(q.values, function(s, t) {
                o.matrix.push(t.now)
            }
            );
            p.exec(o, {
                preserve: true
            })
        }
    }
    )
}
)(jQuery, this, this.document);
(function(g, h, j, c) {
    var d = 180 / Math.PI;
    var k = 200 / Math.PI;
    var f = Math.PI / 180;
    var e = 2 / 1.8;
    var i = 0.9;
    var a = Math.PI / 200;
    var b = /^([+\-]=)?([\d+.\-]+)(.*)$/;
    g.extend({
        angle: {
            runit: /(deg|g?rad)/,
            radianToDegree: function(l) {
                return l * d
            },
            radianToGrad: function(l) {
                return l * k
            },
            degreeToRadian: function(l) {
                return l * f
            },
            degreeToGrad: function(l) {
                return l * e
            },
            gradToDegree: function(l) {
                return l * i
            },
            gradToRadian: function(l) {
                return l * a
            },
            toDegree: function(n) {
                var l = b.exec(n);
                if (l) {
                    n = parseFloat(l[2]);
                    switch (l[3] || "deg") {
                    case "grad":
                        n = g.angle.gradToDegree(n);
                        break;
                    case "rad":
                        n = g.angle.radianToDegree(n);
                        break
                    }
                    return n
                }
                return 0
            }
        }
    })
}
)(jQuery, this, this.document);
(function(f, e, b, g) {
    if (typeof (f.matrix) == "undefined") {
        f.extend({
            matrix: {}
        })
    }
    var d = f.matrix;
    f.extend(d, {
        V2: function(h, i) {
            if (f.isArray(arguments[0])) {
                this.elements = arguments[0].slice(0, 2)
            } else {
                this.elements = [h, i]
            }
            this.length = 2
        },
        V3: function(h, j, i) {
            if (f.isArray(arguments[0])) {
                this.elements = arguments[0].slice(0, 3)
            } else {
                this.elements = [h, j, i]
            }
            this.length = 3
        },
        M2x2: function(i, h, k, j) {
            if (f.isArray(arguments[0])) {
                this.elements = arguments[0].slice(0, 4)
            } else {
                this.elements = Array.prototype.slice.call(arguments).slice(0, 4)
            }
            this.rows = 2;
            this.cols = 2
        },
        M3x3: function(n, l, k, j, i, h, q, p, o) {
            if (f.isArray(arguments[0])) {
                this.elements = arguments[0].slice(0, 9)
            } else {
                this.elements = Array.prototype.slice.call(arguments).slice(0, 9)
            }
            this.rows = 3;
            this.cols = 3
        }
    });
    var c = {
        e: function(k, h) {
            var i = this.rows
              , j = this.cols;
            if (k > i || h > i || k < 1 || h < 1) {
                return 0
            }
            return this.elements[(k - 1) * j + h - 1]
        },
        decompose: function() {
            var v = this.e(1, 1)
              , t = this.e(2, 1)
              , q = this.e(1, 2)
              , p = this.e(2, 2)
              , o = this.e(1, 3)
              , n = this.e(2, 3);
            if (Math.abs(v * p - t * q) < 0.01) {
                return {
                    rotate: 0 + "deg",
                    skewX: 0 + "deg",
                    scaleX: 1,
                    scaleY: 1,
                    translateX: 0 + "px",
                    translateY: 0 + "px"
                }
            }
            var l = o
              , j = n;
            var u = Math.sqrt(v * v + t * t);
            v = v / u;
            t = t / u;
            var i = v * q + t * p;
            q -= v * i;
            p -= t * i;
            var s = Math.sqrt(q * q + p * p);
            q = q / s;
            p = p / s;
            i = i / s;
            if ((v * p - t * q) < 0) {
                v = -v;
                t = -t;
                u = -u
            }
            var w = f.angle.radianToDegree;
            var h = w(Math.atan2(t, v));
            i = w(Math.atan(i));
            return {
                rotate: h + "deg",
                skewX: i + "deg",
                scaleX: u,
                scaleY: s,
                translateX: l + "px",
                translateY: j + "px"
            }
        }
    };
    f.extend(d.M2x2.prototype, c, {
        toM3x3: function() {
            var h = this.elements;
            return new d.M3x3(h[0],h[1],0,h[2],h[3],0,0,0,1)
        },
        x: function(j) {
            var k = typeof (j.rows) === "undefined";
            if (!k && j.rows == 3) {
                return this.toM3x3().x(j)
            }
            var i = this.elements
              , h = j.elements;
            if (k && h.length == 2) {
                return new d.V2(i[0] * h[0] + i[1] * h[1],i[2] * h[0] + i[3] * h[1])
            } else {
                if (h.length == i.length) {
                    return new d.M2x2(i[0] * h[0] + i[1] * h[2],i[0] * h[1] + i[1] * h[3],i[2] * h[0] + i[3] * h[2],i[2] * h[1] + i[3] * h[3])
                }
            }
            return false
        },
        inverse: function() {
            var i = 1 / this.determinant()
              , h = this.elements;
            return new d.M2x2(i * h[3],i * -h[1],i * -h[2],i * h[0])
        },
        determinant: function() {
            var h = this.elements;
            return h[0] * h[3] - h[1] * h[2]
        }
    });
    f.extend(d.M3x3.prototype, c, {
        x: function(j) {
            var k = typeof (j.rows) === "undefined";
            if (!k && j.rows < 3) {
                j = j.toM3x3()
            }
            var i = this.elements
              , h = j.elements;
            if (k && h.length == 3) {
                return new d.V3(i[0] * h[0] + i[1] * h[1] + i[2] * h[2],i[3] * h[0] + i[4] * h[1] + i[5] * h[2],i[6] * h[0] + i[7] * h[1] + i[8] * h[2])
            } else {
                if (h.length == i.length) {
                    return new d.M3x3(i[0] * h[0] + i[1] * h[3] + i[2] * h[6],i[0] * h[1] + i[1] * h[4] + i[2] * h[7],i[0] * h[2] + i[1] * h[5] + i[2] * h[8],i[3] * h[0] + i[4] * h[3] + i[5] * h[6],i[3] * h[1] + i[4] * h[4] + i[5] * h[7],i[3] * h[2] + i[4] * h[5] + i[5] * h[8],i[6] * h[0] + i[7] * h[3] + i[8] * h[6],i[6] * h[1] + i[7] * h[4] + i[8] * h[7],i[6] * h[2] + i[7] * h[5] + i[8] * h[8])
                }
            }
            return false
        },
        inverse: function() {
            var i = 1 / this.determinant()
              , h = this.elements;
            return new d.M3x3(i * (h[8] * h[4] - h[7] * h[5]),i * (-(h[8] * h[1] - h[7] * h[2])),i * (h[5] * h[1] - h[4] * h[2]),i * (-(h[8] * h[3] - h[6] * h[5])),i * (h[8] * h[0] - h[6] * h[2]),i * (-(h[5] * h[0] - h[3] * h[2])),i * (h[7] * h[3] - h[6] * h[4]),i * (-(h[7] * h[0] - h[6] * h[1])),i * (h[4] * h[0] - h[3] * h[1]))
        },
        determinant: function() {
            var h = this.elements;
            return h[0] * (h[8] * h[4] - h[7] * h[5]) - h[3] * (h[8] * h[1] - h[7] * h[2]) + h[6] * (h[5] * h[1] - h[4] * h[2])
        }
    });
    var a = {
        e: function(h) {
            return this.elements[h - 1]
        }
    };
    f.extend(d.V2.prototype, a);
    f.extend(d.V3.prototype, a)
}
)(jQuery, this, this.document);
(function(c, b, a, d) {
    if (typeof (c.matrix) == "undefined") {
        c.extend({
            matrix: {}
        })
    }
    c.extend(c.matrix, {
        calc: function(e, f, g) {
            this.matrix = e;
            this.outerHeight = f;
            this.outerWidth = g
        }
    });
    c.matrix.calc.prototype = {
        coord: function(e, i, h) {
            h = typeof (h) !== "undefined" ? h : 0;
            var g = this.matrix, f;
            switch (g.rows) {
            case 2:
                f = g.x(new c.matrix.V2(e,i));
                break;
            case 3:
                f = g.x(new c.matrix.V3(e,i,h));
                break
            }
            return f
        },
        corners: function(e, h) {
            var f = !(typeof (e) !== "undefined" || typeof (h) !== "undefined"), g;
            if (!this.c || !f) {
                h = h || this.outerHeight;
                e = e || this.outerWidth;
                g = {
                    tl: this.coord(0, 0),
                    bl: this.coord(0, h),
                    tr: this.coord(e, 0),
                    br: this.coord(e, h)
                }
            } else {
                g = this.c
            }
            if (f) {
                this.c = g
            }
            return g
        },
        sides: function(e) {
            var f = e || this.corners();
            return {
                top: Math.min(f.tl.e(2), f.tr.e(2), f.br.e(2), f.bl.e(2)),
                bottom: Math.max(f.tl.e(2), f.tr.e(2), f.br.e(2), f.bl.e(2)),
                left: Math.min(f.tl.e(1), f.tr.e(1), f.br.e(1), f.bl.e(1)),
                right: Math.max(f.tl.e(1), f.tr.e(1), f.br.e(1), f.bl.e(1))
            }
        },
        offset: function(e) {
            var f = this.sides(e);
            return {
                height: Math.abs(f.bottom - f.top),
                width: Math.abs(f.right - f.left)
            }
        },
        area: function(e) {
            var h = e || this.corners();
            var g = {
                x: h.tr.e(1) - h.tl.e(1) + h.br.e(1) - h.bl.e(1),
                y: h.tr.e(2) - h.tl.e(2) + h.br.e(2) - h.bl.e(2)
            }
              , f = {
                x: h.bl.e(1) - h.tl.e(1) + h.br.e(1) - h.tr.e(1),
                y: h.bl.e(2) - h.tl.e(2) + h.br.e(2) - h.tr.e(2)
            };
            return 0.25 * Math.abs(g.e(1) * f.e(2) - g.e(2) * f.e(1))
        },
        nonAffinity: function() {
            var f = this.sides()
              , g = f.top - f.bottom
              , e = f.left - f.right;
            return parseFloat(parseFloat(Math.abs((Math.pow(g, 2) + Math.pow(e, 2)) / (f.top * f.bottom + f.left * f.right))).toFixed(8))
        },
        originOffset: function(h, g) {
            h = h ? h : new c.matrix.V2(this.outerWidth * 0.5,this.outerHeight * 0.5);
            g = g ? g : new c.matrix.V2(0,0);
            var e = this.coord(h.e(1), h.e(2));
            var f = this.coord(g.e(1), g.e(2));
            return {
                top: (f.e(2) - g.e(2)) - (e.e(2) - h.e(2)),
                left: (f.e(1) - g.e(1)) - (e.e(1) - h.e(1))
            }
        }
    }
}
)(jQuery, this, this.document);
(function(e, d, a, f) {
    if (typeof (e.matrix) == "undefined") {
        e.extend({
            matrix: {}
        })
    }
    var c = e.matrix
      , g = c.M2x2
      , b = c.M3x3;
    e.extend(c, {
        identity: function(k) {
            k = k || 2;
            var l = k * k
              , n = new Array(l)
              , j = k + 1;
            for (var h = 0; h < l; h++) {
                n[h] = (h % j) === 0 ? 1 : 0
            }
            return new c["M" + k + "x" + k](n)
        },
        matrix: function() {
            var h = Array.prototype.slice.call(arguments);
            switch (arguments.length) {
            case 4:
                return new g(h[0],h[2],h[1],h[3]);
            case 6:
                return new b(h[0],h[2],h[4],h[1],h[3],h[5],0,0,1)
            }
        },
        reflect: function() {
            return new g(-1,0,0,-1)
        },
        reflectX: function() {
            return new g(1,0,0,-1)
        },
        reflectXY: function() {
            return new g(0,1,1,0)
        },
        reflectY: function() {
            return new g(-1,0,0,1)
        },
        rotate: function(l) {
            var i = e.angle.degreeToRadian(l)
              , k = Math.cos(i)
              , n = Math.sin(i);
            var j = k
              , h = n
              , p = -n
              , o = k;
            return new g(j,p,h,o)
        },
        scale: function(i, h) {
            i = i || i === 0 ? i : 1;
            h = h || h === 0 ? h : i;
            return new g(i,0,0,h)
        },
        scaleX: function(h) {
            return c.scale(h, 1)
        },
        scaleY: function(h) {
            return c.scale(1, h)
        },
        skew: function(k, i) {
            k = k || 0;
            i = i || 0;
            var l = e.angle.degreeToRadian(k)
              , j = e.angle.degreeToRadian(i)
              , h = Math.tan(l)
              , n = Math.tan(j);
            return new g(1,h,n,1)
        },
        skewX: function(h) {
            return c.skew(h)
        },
        skewY: function(h) {
            return c.skew(0, h)
        },
        translate: function(i, h) {
            i = i || 0;
            h = h || 0;
            return new b(1,0,i,0,1,h,0,0,1)
        },
        translateX: function(h) {
            return c.translate(h)
        },
        translateY: function(h) {
            return c.translate(0, h)
        }
    })
}
)(jQuery, this, this.document);

// easyslider
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

$(function(){
$("#slider").easySlider({
  auto: true,
  continuous: true,
  numeric: true,
  pause: 3000    });
});


// fancybox
!function(t) {
    var e, i, n, a, o, d, c, s, r, h, l, f, p, g = 0, b = {}, y = [], u = 0, w = {}, m = [], x = null , v = new Image, I = /\.(jpg|gif|png|bmp|jpeg)(.*)?$/i, C = /[^\.]\.(swf)\s*$/i, k = 1, j = 0, O = "", S = !1, T = t.extend(t("<div/>")[0], {
        prop: 0
    }), A = t.browser.msie && t.browser.version < 7 && !window.XMLHttpRequest, D = function() {
        i.hide(),
        v.onerror = v.onload = null ,
        x && x.abort(),
        e.empty()
    }
    , F = function() {
        !1 === b.onError(y, g, b) ? (i.hide(),
        S = !1) : (b.titleShow = !1,
        b.width = "auto",
        b.height = "auto",
        e.html('<p id="fancybox-error">The requested content cannot be loaded.<br />Please try again later.</p>'),
        N())
    }
    , E = function() {
        var n, a, o, c, s, r, h = y[g];
        if (D(),
        b = t.extend({}, t.fn.fancybox.defaults, "undefined" == typeof t(h).data("fancybox") ? b : t(h).data("fancybox")),
        r = b.onStart(y, g, b),
        r === !1)
            S = !1;
        else if ("object" == typeof r && (b = t.extend(b, r)),
        o = b.title || (h.nodeName ? t(h).attr("title") : h.title) || "",
        h.nodeName && !b.orig && (b.orig = t(h).children("img:first").length ? t(h).children("img:first") : t(h)),
        "" === o && b.orig && b.titleFromAlt && (o = b.orig.attr("alt")),
        n = b.href || (h.nodeName ? t(h).attr("href") : h.href) || null ,
        (/^(?:javascript)/i.test(n) || "#" == n) && (n = null ),
        b.type ? (a = b.type,
        n || (n = b.content)) : b.content ? a = "html" : n && (a = n.match(I) ? "image" : n.match(C) ? "swf" : t(h).hasClass("iframe") ? "iframe" : 0 === n.indexOf("#") ? "inline" : "ajax"),
        a)
            switch ("inline" == a && (h = n.substr(n.indexOf("#")),
            a = t(h).length > 0 ? "inline" : "ajax"),
            b.type = a,
            b.href = n,
            b.title = o,
            b.autoDimensions && ("html" == b.type || "inline" == b.type || "ajax" == b.type ? (b.width = "auto",
            b.height = "auto") : b.autoDimensions = !1),
            b.modal && (b.overlayShow = !0,
            b.hideOnOverlayClick = !1,
            b.hideOnContentClick = !1,
            b.enableEscapeButton = !1,
            b.showCloseButton = !1),
            b.padding = parseInt(b.padding, 10),
            b.margin = parseInt(b.margin, 10),
            e.css("padding", b.padding + b.margin),
            t(".fancybox-inline-tmp").unbind("fancybox-cancel").bind("fancybox-change", function() {
                t(this).replaceWith(d.children())
            }
            ),
            a) {
            case "html":
                e.html(b.content),
                N();
                break;
            case "inline":
                if (t(h).parent().is("#fancybox-content") === !0) {
                    S = !1;
                    break
                }
                t('<div class="fancybox-inline-tmp" />').hide().insertBefore(t(h)).bind("fancybox-cleanup", function() {
                    t(this).replaceWith(d.children())
                }
                ).bind("fancybox-cancel", function() {
                    t(this).replaceWith(e.children())
                }
                ),
                t(h).appendTo(e),
                N();
                break;
            case "image":
                S = !1,
                t.fancybox.showActivity(),
                v = new Image,
                v.onerror = function() {
                    F()
                }
                ,
                v.onload = function() {
                    S = !0,
                    v.onerror = v.onload = null ,
                    b.width = v.width,
                    b.height = v.height,
                    t("<img />").attr({
                        id: "fancybox-img",
                        src: v.src,
                        alt: b.title
                    }).appendTo(e),
                    B()
                }
                ,
                v.src = n;
                break;
            case "swf":
                b.scrolling = "no",
                c = '<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="' + b.width + '" height="' + b.height + '"><param name="movie" value="' + n + '"></param>',
                s = "",
                t.each(b.swf, function(t, e) {
                    c += '<param name="' + t + '" value="' + e + '"></param>',
                    s += " " + t + '="' + e + '"'
                }
                ),
                c += '<embed src="' + n + '" type="application/x-shockwave-flash" width="' + b.width + '" height="' + b.height + '"' + s + "></embed></object>",
                e.html(c),
                N();
                break;
            case "ajax":
                S = !1,
                t.fancybox.showActivity(),
                b.ajax.win = b.ajax.success,
                x = t.ajax(t.extend({}, b.ajax, {
                    url: n,
                    data: b.ajax.data || {},
                    error: function(t) {
                        t.status > 0 && F()
                    },
                    success: function(t, a, o) {
                        if (200 == ("object" == typeof o ? o : x).status) {
                            if ("function" == typeof b.ajax.win) {
                                if (r = b.ajax.win(n, t, a, o),
                                r === !1)
                                    return void i.hide();
                                ("string" == typeof r || "object" == typeof r) && (t = r)
                            }
                            e.html(t),
                            N()
                        }
                    }
                }));
                break;
            case "iframe":
                B()
            }
        else
            F()
    }
    , N = function() {
        var i = b.width
          , n = b.height;
        i = i.toString().indexOf("%") > -1 ? parseInt((t(window).width() - 2 * b.margin) * parseFloat(i) / 100, 10) + "px" : "auto" == i ? "auto" : i + "px",
        n = n.toString().indexOf("%") > -1 ? parseInt((t(window).height() - 2 * b.margin) * parseFloat(n) / 100, 10) + "px" : "auto" == n ? "auto" : n + "px",
        e.wrapInner('<div style="width:' + i + ";height:" + n + ";overflow: " + ("auto" == b.scrolling ? "auto" : "yes" == b.scrolling ? "scroll" : "hidden") + ';position:relative;"></div>'),
        b.width = e.width(),
        b.height = e.height(),
        B()
    }
    , B = function() {
        var l, x;
        if (i.hide(),
        a.is(":visible") && !1 === w.onCleanup(m, u, w))
            t.event.trigger("fancybox-cancel"),
            S = !1;
        else {
            if (S = !0,
            t(d.add(n)).unbind(),
            t(window).unbind("resize.fb scroll.fb"),
            t(document).unbind("keydown.fb"),
            a.is(":visible") && "outside" !== w.titlePosition && a.css("height", a.height()),
            m = y,
            u = g,
            w = b,
            w.overlayShow ? (n.css({
                "background-color": w.overlayColor,
                opacity: w.overlayOpacity,
                cursor: w.hideOnOverlayClick ? "pointer" : "auto",
                height: t(document).height()
            }),
            n.is(":visible") || (A && t("select:not(#fancybox-tmp select)").filter(function() {
                return "hidden" !== this.style.visibility
            }
            ).css({
                visibility: "hidden"
            }).one("fancybox-cleanup", function() {
                this.style.visibility = "inherit"
            }
            ),
            n.show())) : n.hide(),
            p = z(),
            O = w.title || "",
            j = 0,
            s.empty().removeAttr("style").removeClass(),
            w.titleShow !== !1 && (l = t.isFunction(w.titleFormat) ? w.titleFormat(O, m, u, w) : O && O.length ? "float" == w.titlePosition ? '<table id="fancybox-title-float-wrap" cellpadding="0" cellspacing="0"><tr><td id="fancybox-title-float-left"></td><td id="fancybox-title-float-main">' + O + '</td><td id="fancybox-title-float-right"></td></tr></table>' : '<div id="fancybox-title-' + w.titlePosition + '">' + O + "</div>" : !1,
            O = l,
            O && "" !== O))
                switch (s.addClass("fancybox-title-" + w.titlePosition).html(O).appendTo("body").show(),
                w.titlePosition) {
                case "inside":
                    s.css({
                        width: p.width - 2 * w.padding,
                        marginLeft: w.padding,
                        marginRight: w.padding
                    }),
                    j = s.outerHeight(!0),
                    s.appendTo(o),
                    p.height += j;
                    break;
                case "over":
                    s.css({
                        marginLeft: w.padding,
                        width: p.width - 2 * w.padding,
                        bottom: w.padding
                    }).appendTo(o);
                    break;
                case "float":
                    s.css("left", -1 * parseInt((s.width() - p.width - 40) / 2, 10)).appendTo(a);
                    break;
                default:
                    s.css({
                        width: p.width - 2 * w.padding,
                        paddingLeft: w.padding,
                        paddingRight: w.padding
                    }).appendTo(a)
                }
            s.hide(),
            a.is(":visible") ? (t(c.add(r).add(h)).hide(),
            l = a.position(),
            f = {
                top: l.top,
                left: l.left,
                width: a.width(),
                height: a.height()
            },
            x = f.width == p.width && f.height == p.height,
            d.fadeTo(w.changeFade, .3, function() {
                var i = function() {
                    d.html(e.contents()).fadeTo(w.changeFade, 1, L)
                }
                ;
                t.event.trigger("fancybox-change"),
                d.empty().removeAttr("filter").css({
                    "border-width": w.padding,
                    width: p.width - 2 * w.padding,
                    height: b.autoDimensions ? "auto" : p.height - j - 2 * w.padding
                }),
                x ? i() : (T.prop = 0,
                t(T).animate({
                    prop: 1
                }, {
                    duration: w.changeSpeed,
                    easing: w.easingChange,
                    step: M,
                    complete: i
                }))
            }
            )) : (a.removeAttr("style"),
            d.css("border-width", w.padding),
            "elastic" == w.transitionIn ? (f = H(),
            d.html(e.contents()),
            a.show(),
            w.opacity && (p.opacity = 0),
            T.prop = 0,
            t(T).animate({
                prop: 1
            }, {
                duration: w.speedIn,
                easing: w.easingIn,
                step: M,
                complete: L
            })) : ("inside" == w.titlePosition && j > 0 && s.show(),
            d.css({
                width: p.width - 2 * w.padding,
                height: b.autoDimensions ? "auto" : p.height - j - 2 * w.padding
            }).html(e.contents()),
            a.css(p).fadeIn("none" == w.transitionIn ? 0 : w.speedIn, L)))
        }
    }
    , P = function() {
        (w.enableEscapeButton || w.enableKeyboardNav) && t(document).bind("keydown.fb", function(e) {
            27 == e.keyCode && w.enableEscapeButton ? (e.preventDefault(),
            t.fancybox.close()) : 37 != e.keyCode && 39 != e.keyCode || !w.enableKeyboardNav || "INPUT" === e.target.tagName || "TEXTAREA" === e.target.tagName || "SELECT" === e.target.tagName || (e.preventDefault(),
            t.fancybox[37 == e.keyCode ? "prev" : "next"]())
        }
        ),
        w.showNavArrows ? ((w.cyclic && m.length > 1 || 0 !== u) && r.show(),
        (w.cyclic && m.length > 1 || u != m.length - 1) && h.show()) : (r.hide(),
        h.hide())
    }
    , L = function() {
        t.support.opacity || (d.get(0).style.removeAttribute("filter"),
        a.get(0).style.removeAttribute("filter")),
        b.autoDimensions && d.css("height", "auto"),
        a.css("height", "auto"),
        O && O.length && s.show(),
        w.showCloseButton && c.show(),
        P(),
        w.hideOnContentClick && d.bind("click", t.fancybox.close),
        w.hideOnOverlayClick && n.bind("click", t.fancybox.close),
        t(window).bind("resize.fb", t.fancybox.resize),
        w.centerOnScroll && t(window).bind("scroll.fb", t.fancybox.center),
        "iframe" == w.type && t('<iframe id="fancybox-frame" name="fancybox-frame' + (new Date).getTime() + '" frameborder="0" hspace="0" ' + (t.browser.msie ? 'allowtransparency="true""' : "") + ' scrolling="' + b.scrolling + '" src="' + w.href + '"></iframe>').appendTo(d),
        a.show(),
        S = !1,
        t.fancybox.center(),
        w.onComplete(m, u, w);
        var e, i;
        m.length - 1 > u && (e = m[u + 1].href,
        "undefined" != typeof e && e.match(I) && (i = new Image,
        i.src = e)),
        u > 0 && (e = m[u - 1].href,
        "undefined" != typeof e && e.match(I) && (i = new Image,
        i.src = e))
    }
    , M = function(t) {
        var e = {
            width: parseInt(f.width + (p.width - f.width) * t, 10),
            height: parseInt(f.height + (p.height - f.height) * t, 10),
            top: parseInt(f.top + (p.top - f.top) * t, 10),
            left: parseInt(f.left + (p.left - f.left) * t, 10)
        };
        "undefined" != typeof p.opacity && (e.opacity = .5 > t ? .5 : t),
        a.css(e),
        d.css({
            width: e.width - 2 * w.padding,
            height: e.height - j * t - 2 * w.padding
        })
    }
    , Q = function() {
        return [t(window).width() - 2 * w.margin, t(window).height() - 2 * w.margin, t(document).scrollLeft() + w.margin, t(document).scrollTop() + w.margin]
    }
    , z = function() {
        var t = Q()
          , e = {}
          , i = w.autoScale
          , n = 2 * w.padding;
        return e.width = w.width.toString().indexOf("%") > -1 ? parseInt(t[0] * parseFloat(w.width) / 100, 10) : w.width + n,
        e.height = w.height.toString().indexOf("%") > -1 ? parseInt(t[1] * parseFloat(w.height) / 100, 10) : w.height + n,
        i && (e.width > t[0] || e.height > t[1]) && ("image" == b.type || "swf" == b.type ? (i = w.width / w.height,
        e.width > t[0] && (e.width = t[0],
        e.height = parseInt((e.width - n) / i + n, 10)),
        e.height > t[1] && (e.height = t[1],
        e.width = parseInt((e.height - n) * i + n, 10))) : (e.width = Math.min(e.width, t[0]),
        e.height = Math.min(e.height, t[1]))),
        e.top = parseInt(Math.max(t[3] - 20, t[3] + .5 * (t[1] - e.height - 40)), 10),
        e.left = parseInt(Math.max(t[2] - 20, t[2] + .5 * (t[0] - e.width - 40)), 10),
        e
    }
    , H = function() {
        var e = b.orig ? t(b.orig) : !1
          , i = {};
        return e && e.length ? (i = e.offset(),
        i.top += parseInt(e.css("paddingTop"), 10) || 0,
        i.left += parseInt(e.css("paddingLeft"), 10) || 0,
        i.top += parseInt(e.css("border-top-width"), 10) || 0,
        i.left += parseInt(e.css("border-left-width"), 10) || 0,
        i.width = e.width(),
        i.height = e.height(),
        i = {
            width: i.width + 2 * w.padding,
            height: i.height + 2 * w.padding,
            top: i.top - w.padding - 20,
            left: i.left - w.padding - 20
        }) : (e = Q(),
        i = {
            width: 2 * w.padding,
            height: 2 * w.padding,
            top: parseInt(e[3] + .5 * e[1], 10),
            left: parseInt(e[2] + .5 * e[0], 10)
        }),
        i
    }
    , $ = function() {
        i.is(":visible") ? (t("div", i).css("top", -40 * k + "px"),
        k = (k + 1) % 12) : clearInterval(l)
    }
    ;
    t.fn.fancybox = function(e) {
        return t(this).length ? (t(this).data("fancybox", t.extend({}, e, t.metadata ? t(this).metadata() : {})).unbind("click.fb").bind("click.fb", function(e) {
            e.preventDefault(),
            S || (S = !0,
            t(this).blur(),
            y = [],
            g = 0,
            e = t(this).attr("rel") || "",
            e && "" != e && "nofollow" !== e ? (y = t("a[rel=" + e + "], area[rel=" + e + "]"),
            g = y.index(this)) : y.push(this),
            E())
        }
        ),
        this) : this
    }
    ,
    t.fancybox = function(e, i) {
        var n;
        if (!S) {
            if (S = !0,
            n = "undefined" != typeof i ? i : {},
            y = [],
            g = parseInt(n.index, 10) || 0,
            t.isArray(e)) {
                for (var a = 0, o = e.length; o > a; a++)
                    "object" == typeof e[a] ? t(e[a]).data("fancybox", t.extend({}, n, e[a])) : e[a] = t({}).data("fancybox", t.extend({
                        content: e[a]
                    }, n));
                y = jQuery.merge(y, e)
            } else
                "object" == typeof e ? t(e).data("fancybox", t.extend({}, n, e)) : e = t({}).data("fancybox", t.extend({
                    content: e
                }, n)),
                y.push(e);
            (g > y.length || 0 > g) && (g = 0),
            E()
        }
    }
    ,
    t.fancybox.showActivity = function() {
        clearInterval(l),
        i.show(),
        l = setInterval($, 66)
    }
    ,
    t.fancybox.hideActivity = function() {
        i.hide()
    }
    ,
    t.fancybox.next = function() {
        return t.fancybox.pos(u + 1)
    }
    ,
    t.fancybox.prev = function() {
        return t.fancybox.pos(u - 1)
    }
    ,
    t.fancybox.pos = function(t) {
        S || (t = parseInt(t),
        y = m,
        t > -1 && t < m.length ? (g = t,
        E()) : w.cyclic && m.length > 1 && (g = t >= m.length ? 0 : m.length - 1,
        E()))
    }
    ,
    t.fancybox.cancel = function() {
        S || (S = !0,
        t.event.trigger("fancybox-cancel"),
        D(),
        b.onCancel(y, g, b),
        S = !1)
    }
    ,
    t.fancybox.close = function() {
        function e() {
            n.fadeOut("fast"),
            s.empty().hide(),
            a.hide(),
            t.event.trigger("fancybox-cleanup"),
            d.empty(),
            w.onClosed(m, u, w),
            m = b = [],
            u = g = 0,
            w = b = {},
            S = !1
        }
        if (!S && !a.is(":hidden"))
            if (S = !0,
            w && !1 === w.onCleanup(m, u, w))
                S = !1;
            else if (D(),
            t(c.add(r).add(h)).hide(),
            t(d.add(n)).unbind(),
            t(window).unbind("resize.fb scroll.fb"),
            t(document).unbind("keydown.fb"),
            d.find("iframe").attr("src", A && /^https/i.test(window.location.href || "") ? "javascript:void(false)" : "about:blank"),
            "inside" !== w.titlePosition && s.empty(),
            a.stop(),
            "elastic" == w.transitionOut) {
                f = H();
                var i = a.position();
                p = {
                    top: i.top,
                    left: i.left,
                    width: a.width(),
                    height: a.height()
                },
                w.opacity && (p.opacity = 1),
                s.empty().hide(),
                T.prop = 1,
                t(T).animate({
                    prop: 0
                }, {
                    duration: w.speedOut,
                    easing: w.easingOut,
                    step: M,
                    complete: e
                })
            } else
                a.fadeOut("none" == w.transitionOut ? 0 : w.speedOut, e)
    }
    ,
    t.fancybox.resize = function() {
        n.is(":visible") && n.css("height", t(document).height()),
        t.fancybox.center(!0)
    }
    ,
    t.fancybox.center = function(t) {
        var e, i;
        S || (i = t === !0 ? 1 : 0,
        e = Q(),
        !i && (a.width() > e[0] || a.height() > e[1]) || a.stop().animate({
            top: parseInt(Math.max(e[3] - 20, e[3] + .5 * (e[1] - d.height() - 40) - w.padding)),
            left: parseInt(Math.max(e[2] - 20, e[2] + .5 * (e[0] - d.width() - 40) - w.padding))
        }, "number" == typeof t ? t : 200))
    }
    ,
    t.fancybox.init = function() {
        t("#fancybox-wrap").length || (t("body").append(e = t('<div id="fancybox-tmp"></div>'), i = t('<div id="fancybox-loading"><div></div></div>'), n = t('<div id="fancybox-overlay"></div>'), a = t('<div id="fancybox-wrap"></div>')),
        o = t('<div id="fancybox-outer"></div>').append('<div class="fancybox-bg" id="fancybox-bg-n"></div><div class="fancybox-bg" id="fancybox-bg-ne"></div><div class="fancybox-bg" id="fancybox-bg-e"></div><div class="fancybox-bg" id="fancybox-bg-se"></div><div class="fancybox-bg" id="fancybox-bg-s"></div><div class="fancybox-bg" id="fancybox-bg-sw"></div><div class="fancybox-bg" id="fancybox-bg-w"></div><div class="fancybox-bg" id="fancybox-bg-nw"></div>').appendTo(a),
        o.append(d = t('<div id="fancybox-content"></div>'), c = t('<a id="fancybox-close"></a>'), s = t('<div id="fancybox-title"></div>'), r = t('<a href="javascript:;" id="fancybox-left"><span class="fancy-ico" id="fancybox-left-ico"></span></a>'), h = t('<a href="javascript:;" id="fancybox-right"><span class="fancy-ico" id="fancybox-right-ico"></span></a>')),
        c.click(t.fancybox.close),
        i.click(t.fancybox.cancel),
        r.click(function(e) {
            e.preventDefault(),
            t.fancybox.prev()
        }
        ),
        h.click(function(e) {
            e.preventDefault(),
            t.fancybox.next()
        }
        ),
        t.fn.mousewheel && a.bind("mousewheel.fb", function(e, i) {
            S ? e.preventDefault() : (0 == t(e.target).get(0).clientHeight || t(e.target).get(0).scrollHeight === t(e.target).get(0).clientHeight) && (e.preventDefault(),
            t.fancybox[i > 0 ? "prev" : "next"]())
        }
        ),
        t.support.opacity || a.addClass("fancybox-ie"),
        A && (i.addClass("fancybox-ie6"),
        a.addClass("fancybox-ie6"),
        t('<iframe id="fancybox-hide-sel-frame" src="' + (/^https/i.test(window.location.href || "") ? "javascript:void(false)" : "about:blank") + '" scrolling="no" border="0" frameborder="0" tabindex="-1"></iframe>').prependTo(o)))
    }
    ,
    t.fn.fancybox.defaults = {
        padding: 10,
        margin: 40,
        opacity: !1,
        modal: !1,
        cyclic: !1,
        scrolling: "auto",
        width: 560,
        height: 340,
        autoScale: !0,
        autoDimensions: !0,
        centerOnScroll: !1,
        ajax: {},
        swf: {
            wmode: "transparent"
        },
        hideOnOverlayClick: !0,
        hideOnContentClick: !1,
        overlayShow: !0,
        overlayOpacity: .7,
        overlayColor: "#777",
        titleShow: !0,
        titlePosition: "float",
        titleFormat: null ,
        titleFromAlt: !1,
        transitionIn: "fade",
        transitionOut: "fade",
        speedIn: 300,
        speedOut: 300,
        changeSpeed: 300,
        changeFade: "fast",
        easingIn: "swing",
        easingOut: "swing",
        showCloseButton: !0,
        showNavArrows: !0,
        enableEscapeButton: !0,
        enableKeyboardNav: !0,
        onStart: function() {},
        onCancel: function() {},
        onComplete: function() {},
        onCleanup: function() {},
        onClosed: function() {},
        onError: function() {}
    },
    t(document).ready(function() {
        t.fancybox.init()
    }
    )
}
(jQuery),
jQuery(function() {
    jQuery(".single_post a, .type-attachment a").has("img").addClass("hasimg"),
    jQuery(".imgwrap a").removeClass("hasimg"),
    jQuery(".hasimg[href$='.jpg'], .hasimg[href$='.png'], .hasimg[href$='.gif']").fancybox({
        transitionIn: "elastic",
        transitionOut: "elastic",
        speedIn: 400,
        speedOut: 200,
        overlayShow: !0
    })
}
);

//AJAX PAGINATION
jQuery(document).ready(function(){
jQuery('.amp_next, .amp_prev').css({"display":"none"});
jQuery('.znn_paginate a:first').each(function () {
    var href = jQuery(this).attr('href');
    jQuery(this).attr('href', href + '?paged=1');
});

jQuery('.znn_paginate a').each(function(){
        this.href = this.href.replace('/page/', '?paged=');
});
    jQuery('.znn_paginate a').live('click', function(e)  {
  jQuery('.znn_paginate a, span.amp_page').removeClass('amp_current'); // remove if already existant
    jQuery(this).addClass('amp_current');

  e.preventDefault();
      var link = jQuery(this).attr('href');
  jQuery('.lay1_wrap').html('<div class="zn_ajaxwrap"><div class="zn_ajax"></div></div>').load(link + '.lay1_wrap .post', function() {
      var divs = jQuery(".lay1 .post");
      for(var i = 0; i < divs.length; i+=3) {
        divs.slice(i, i+3).wrapAll("<div class='zn_row'></div>"); }
    jQuery('.lay1_wrap').fadeIn(500); });

    });
});  // end ready function


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

// simpleCart
(function(p,f){var s="string",k=function(e,f){return typeof e===f},e=function(e){return k(e,"undefined")},h=function(e){return k(e,"function")},y=function(e){return"object"===typeof HTMLElement?e instanceof HTMLElement:"object"===typeof e&&1===e.nodeType&&"string"===typeof e.nodeName},C=function(q){function E(a){return b.extend({attr:"",label:"",view:"attr",text:"",className:"",hide:!1},a||{})}function F(){if(!b.isReady){try{f.documentElement.doScroll("left")}catch(a){setTimeout(F,1);return}b.init()}}
var t={MooTools:"$$",Prototype:"$$",jQuery:"*"},n=0,r={},x=q||"simpleCart",z={};q={};q={};var v=p.localStorage,l=p.console||{msgs:[],log:function(a){l.msgs.push(a)}},D={USD:{code:"USD",symbol:"&#36;",name:"US Dollar"},AUD:{code:"AUD",symbol:"&#36;",name:"Australian Dollar"},BRL:{code:"BRL",symbol:"R&#36;",name:"Brazilian Real"},CAD:{code:"CAD",symbol:"&#36;",name:"Canadian Dollar"},CZK:{code:"CZK",symbol:"&nbsp;&#75;&#269;",name:"Czech Koruna",after:!0},DKK:{code:"DKK",symbol:"DKK&nbsp;",name:"Danish Krone"},
EUR:{code:"EUR",symbol:"&euro;",name:"Euro"},HKD:{code:"HKD",symbol:"&#36;",name:"Hong Kong Dollar"},HUF:{code:"HUF",symbol:"&#70;&#116;",name:"Hungarian Forint"},ILS:{code:"ILS",symbol:"&#8362;",name:"Israeli New Sheqel"},JPY:{code:"JPY",symbol:"&yen;",name:"Japanese Yen",accuracy:0},MXN:{code:"MXN",symbol:"&#36;",name:"Mexican Peso"},NOK:{code:"NOK",symbol:"NOK&nbsp;",name:"Norwegian Krone"},NZD:{code:"NZD",symbol:"&#36;",name:"New Zealand Dollar"},PLN:{code:"PLN",symbol:"PLN&nbsp;",name:"Polish Zloty"},
GBP:{code:"GBP",symbol:"&pound;",name:"Pound Sterling"},SGD:{code:"SGD",symbol:"&#36;",name:"Singapore Dollar"},SEK:{code:"SEK",symbol:"SEK&nbsp;",name:"Swedish Krona"},CHF:{code:"CHF",symbol:"CHF&nbsp;",name:"Swiss Franc"},THB:{code:"THB",symbol:"&#3647;",name:"Thai Baht"},BTC:{code:"BTC",symbol:" BTC",name:"Bitcoin",accuracy:4,after:!0}},m={checkout:{type:"PayPal",email:"you@yours.com"},currency:"USD",language:"english-us",cartStyle:"div",cartColumns:[{attr:"name",label:"Name"},{attr:"price",label:"Price",
view:"currency"},{view:"decrement",label:!1},{attr:"quantity",label:"Qty"},{view:"increment",label:!1},{attr:"total",label:"SubTotal",view:"currency"},{view:"remove",text:"Remove",label:!1}],excludeFromCheckout:["thumb"],shippingFlatRate:0,shippingQuantityRate:0,shippingTotalRate:0,shippingCustom:null,taxRate:0,taxShipping:!1,data:{}},b=function(a){if(h(a))return b.ready(a);if(k(a,"object"))return b.extend(m,a)},A,B;b.extend=function(a,d){var c;e(d)&&(d=a,a=b);for(c in d)Object.prototype.hasOwnProperty.call(d,
c)&&(a[c]=d[c]);return a};b.extend({copy:function(a){a=C(a);a.init();return a}});b.extend({isReady:!1,add:function(a,d){var c=new b.Item(a||{}),g=!0,u=!0===d?d:!1;if(!u&&(g=b.trigger("beforeAdd",[c]),!1===g))return!1;(g=b.has(c))?(g.increment(c.quantity()),c=g):r[c.id()]=c;b.update();u||b.trigger("afterAdd",[c,e(g)]);return c},each:function(a,d){var c,g=0,u,e,w;if(h(a))e=a,w=r;else if(h(d))e=d,w=a;else return;for(c in w)if(Object.prototype.hasOwnProperty.call(w,c)){u=e.call(b,w[c],g,c);if(!1===u)break;
g+=1}},find:function(a){var d=[];if(k(r[a],"object"))return r[a];if(k(a,"object"))return b.each(function(c){var g=!0;b.each(a,function(a,b,d){k(a,s)?a.match(/<=.*/)?(a=parseFloat(a.replace("<=","")),c.get(d)&&parseFloat(c.get(d))<=a||(g=!1)):a.match(/</)?(a=parseFloat(a.replace("<","")),c.get(d)&&parseFloat(c.get(d))<a||(g=!1)):a.match(/>=/)?(a=parseFloat(a.replace(">=","")),c.get(d)&&parseFloat(c.get(d))>=a||(g=!1)):a.match(/>/)?(a=parseFloat(a.replace(">","")),c.get(d)&&parseFloat(c.get(d))>a||
(g=!1)):c.get(d)&&c.get(d)===a||(g=!1):c.get(d)&&c.get(d)===a||(g=!1);return g});g&&d.push(c)}),d;e(a)&&b.each(function(a){d.push(a)});return d},items:function(){return this.find()},has:function(a){var d=!1;b.each(function(b){b.equals(a)&&(d=b)});return d},empty:function(){var a={};b.each(function(b){!1===b.remove(!0)&&(a[b.id()]=b)});r=a;b.update()},quantity:function(){var a=0;b.each(function(b){a+=b.quantity()});return a},total:function(){var a=0;b.each(function(b){a+=b.total()});return a},grandTotal:function(){return b.total()+
b.tax()+b.shipping()},update:function(){b.save();b.trigger("update")},init:function(){b.load();b.update();b.ready()},$:function(a){return new b.ELEMENT(a)},$create:function(a){return b.$(f.createElement(a))},setupViewTool:function(){var a,d=p,c;for(c in t)if(Object.prototype.hasOwnProperty.call(t,c)&&p[c]&&(a=t[c].replace("*",c).split("."),(a=a.shift())&&(d=d[a]),"function"===typeof d)){A=d;b.extend(b.ELEMENT._,z[c]);break}},ids:function(){var a=[];b.each(function(b){a.push(b.id())});return a},save:function(){b.trigger("beforeSave");
var a={};b.each(function(d){a[d.id()]=b.extend(d.fields(),d.options())});v.setItem(x+"_items",JSON.stringify(a));b.trigger("afterSave")},load:function(){r={};var a=v.getItem(x+"_items");if(a){try{b.each(JSON.parse(a),function(a){b.add(a,!0)})}catch(d){b.error("Error Loading data: "+d)}b.trigger("load")}},ready:function(a){h(a)?b.isReady?a.call(b):b.bind("ready",a):e(a)&&!b.isReady&&(b.trigger("ready"),b.isReady=!0)},error:function(a){var d="";k(a,s)?d=a:k(a,"object")&&k(a.message,s)&&(d=a.message);
try{l.log("simpleCart(js) Error: "+d)}catch(c){}b.trigger("error",a)}});b.extend({tax:function(){var a=m.taxShipping?b.total()+b.shipping():b.total(),d=b.taxRate()*a;b.each(function(a){a.get("tax")?d+=a.get("tax"):a.get("taxRate")&&(d+=a.get("taxRate")*a.total())});return parseFloat(d)},taxRate:function(){return m.taxRate||0},shipping:function(a){if(h(a))b({shippingCustom:a});else{var d=m.shippingQuantityRate*b.quantity()+m.shippingTotalRate*b.total()+m.shippingFlatRate;h(m.shippingCustom)&&(d+=m.shippingCustom.call(b));
b.each(function(a){d+=parseFloat(a.get("shipping")||0)});return parseFloat(d)}}});B={attr:function(a,b){return a.get(b.attr)||""},currency:function(a,d){return b.toCurrency(a.get(d.attr)||0)},link:function(a,b){return"<a href='"+a.get(b.attr)+"'>"+b.text+"</a>"},decrement:function(a,b){return"<a href='javascript:;' class='"+x+"_decrement'>"+(b.text||"-")+"</a>"},increment:function(a,b){return"<a href='javascript:;' class='"+x+"_increment'>"+(b.text||"+")+"</a>"},image:function(a,b){return"<img src='"+
a.get(b.attr)+"'/>"},input:function(a,b){return"<input type='text' value='"+a.get(b.attr)+"' class='"+x+"_input'/>"},remove:function(a,b){return"<a href='javascript:;' class='"+x+"_remove'>"+(b.text||"X")+"</a>"}};b.extend({writeCart:function(a){var d=m.cartStyle.toLowerCase(),c="table"===d,g=c?"tr":"div",u=c?"th":"div",e=c?"td":"div",w=b.$create(d),d=b.$create(g).addClass("headerRow"),f,h;b.$(a).html(" ").append(w);w.append(d);c=0;for(h=m.cartColumns.length;c<h;c+=1)f=E(m.cartColumns[c]),a="item-"+
(f.attr||f.view||f.label||f.text||"cell")+" "+f.className,f=f.label||"",d.append(b.$create(u).addClass(a).html(f));b.each(function(a,d){b.createCartRow(a,d,g,e,w)});return w},createCartRow:function(a,d,c,g,u){d=b.$create(c).addClass("itemRow row-"+d+" "+(d%2?"even":"odd")).attr("id","cartItem_"+a.id());var e,f,l;u.append(d);u=0;for(c=m.cartColumns.length;u<c;u+=1)e=E(m.cartColumns[u]),f="item-"+(e.attr||(k(e.view,s)?e.view:e.label||e.text||"cell"))+" "+e.className,l=a,l=(h(e.view)?e.view:k(e.view,
s)&&h(B[e.view])?B[e.view]:B.attr).call(b,l,e),f=b.$create(g).addClass(f).html(l),d.append(f);return d}});b.Item=function(a){function d(){k(c.price,s)&&(c.price=parseFloat(c.price.replace(b.currency().decimal,".").replace(/[^0-9\.]+/ig,"")));isNaN(c.price)&&(c.price=0);0>c.price&&(c.price=0);k(c.quantity,s)&&(c.quantity=parseInt(c.quantity.replace(b.currency().delimiter,""),10));isNaN(c.quantity)&&(c.quantity=1);0>=c.quantity&&g.remove()}var c={},g=this;k(a,"object")&&b.extend(c,a);n+=1;for(c.id=
c.id||"SCI-"+n;!e(r[c.id]);)n+=1,c.id="SCI-"+n;g.get=function(a,b){var d=!b;return e(a)?a:h(c[a])?c[a].call(g):e(c[a])?h(g[a])&&d?g[a].call(g):!e(g[a])&&d?g[a]:c[a]:c[a]};g.set=function(a,b){e(a)||(c[a.toLowerCase()]=b,"price"!==a.toLowerCase()&&"quantity"!==a.toLowerCase()||d());return g};g.equals=function(a){for(var b in c)if(Object.prototype.hasOwnProperty.call(c,b)&&"quantity"!==b&&"id"!==b&&a.get(b)!==c[b])return!1;return!0};g.options=function(){var a={};b.each(c,function(d,c,e){var f=!0;b.each(g.reservedFields(),
function(a){a===e&&(f=!1);return f});f&&(a[e]=g.get(e))});return a};d()};b.Item._=b.Item.prototype={increment:function(a){a=parseInt(a||1,10);this.quantity(this.quantity()+a);return 1>this.quantity()?(this.remove(),null):this},decrement:function(a){return this.increment(-parseInt(a||1,10))},remove:function(a){if(!1===b.trigger("beforeRemove",[r[this.id()]]))return!1;delete r[this.id()];a||b.update();return null},reservedFields:function(){return"quantity id item_number price name shipping tax taxRate".split(" ")},
fields:function(){var a={},d=this;b.each(d.reservedFields(),function(b){d.get(b)&&(a[b]=d.get(b))});return a},quantity:function(a){return e(a)?parseInt(this.get("quantity",!0)||1,10):this.set("quantity",a)},price:function(a){return e(a)?parseFloat(this.get("price",!0).toString().replace(b.currency().symbol,"").replace(b.currency().delimiter,"")||1):this.set("price",parseFloat(a.toString().replace(b.currency().symbol,"").replace(b.currency().delimiter,"")))},id:function(){return this.get("id",!1)},
total:function(){return this.quantity()*this.price()}};b.extend({checkout:function(){if("custom"===m.checkout.type.toLowerCase()&&h(m.checkout.fn))m.checkout.fn.call(b,m.checkout);else if(h(b.checkout[m.checkout.type])){var a=b.checkout[m.checkout.type].call(b,m.checkout);a.data&&a.action&&a.method&&!1!==b.trigger("beforeCheckout",[a.data])&&b.generateAndSendForm(a)}else b.error("No Valid Checkout Method Specified")},extendCheckout:function(a){return b.extend(b.checkout,a)},generateAndSendForm:function(a){var d=
b.$create("form");d.attr("style","display:none;");d.attr("action",a.action);d.attr("method",a.method);b.each(a.data,function(a,g,e){d.append(b.$create("input").attr("type","hidden").attr("name",e).val(a))});b.$("body").append(d);d.el.submit();d.remove()}});b.extendCheckout({PayPal:function(a){if(!a.email)return b.error("No email provided for PayPal checkout");var d={cmd:"_cart",upload:"1",currency_code:b.currency().code,business:a.email,rm:"GET"===a.method?"0":"2",tax_cart:(1*b.tax()).toFixed(2),
handling_cart:(1*b.shipping()).toFixed(2),charset:"utf-8"},c=a.sandbox?"https://www.sandbox.paypal.com/cgi-bin/webscr":"https://www.paypal.com/cgi-bin/webscr",g="GET"===a.method?"GET":"POST";a.success&&(d["return"]=a.success);a.cancel&&(d.cancel_return=a.cancel);a.notify&&(d.notify_url=a.notify);b.each(function(a,c){var g=c+1,e=a.options(),f=0,h;d["item_name_"+g]=a.get("name");d["quantity_"+g]=a.quantity();d["amount_"+g]=(1*a.price()).toFixed(2);d["item_number_"+g]=a.get("item_number")||g;b.each(e,
function(a,c,e){10>c&&(h=!0,b.each(m.excludeFromCheckout,function(a){a===e&&(h=!1)}),h&&(f+=1,d["on"+c+"_"+g]=e,d["os"+c+"_"+g]=a))});d["option_index_"+c]=Math.min(10,f)});return{action:c,method:g,data:d}},GoogleCheckout:function(a){if(!a.merchantID)return b.error("No merchant id provided for GoogleCheckout");if("USD"!==b.currency().code&&"GBP"!==b.currency().code)return b.error("Google Checkout only accepts USD and GBP");var d={ship_method_name_1:"Shipping",ship_method_price_1:b.shipping(),ship_method_currency_1:b.currency().code,
_charset_:""},c="https://checkout.google.com/api/checkout/v2/checkoutForm/Merchant/"+a.merchantID;a="GET"===a.method?"GET":"POST";b.each(function(a,c){var e=c+1,f=[],h;d["item_name_"+e]=a.get("name");d["item_quantity_"+e]=a.quantity();d["item_price_"+e]=a.price();d["item_currency_ "+e]=b.currency().code;d["item_tax_rate"+e]=a.get("taxRate")||b.taxRate();b.each(a.options(),function(a,d,c){h=!0;b.each(m.excludeFromCheckout,function(a){a===c&&(h=!1)});h&&f.push(c+": "+a)});d["item_description_"+e]=f.join(", ")});
return{action:c,method:a,data:d}},AmazonPayments:function(a){if(!a.merchant_signature)return b.error("No merchant signature provided for Amazon Payments");if(!a.merchant_id)return b.error("No merchant id provided for Amazon Payments");if(!a.aws_access_key_id)return b.error("No AWS access key id provided for Amazon Payments");var d={aws_access_key_id:a.aws_access_key_id,merchant_signature:a.merchant_signature,currency_code:b.currency().code,tax_rate:b.taxRate(),weight_unit:a.weight_unit||"lb"},c="https://payments"+
(a.sandbox?"-sandbox":"")+".amazon.com/checkout/"+a.merchant_id,g="GET"===a.method?"GET":"POST";b.each(function(c,g){var e=g+1,f=[];d["item_title_"+e]=c.get("name");d["item_quantity_"+e]=c.quantity();d["item_price_"+e]=c.price();d["item_sku_ "+e]=c.get("sku")||c.id();d["item_merchant_id_"+e]=a.merchant_id;c.get("weight")&&(d["item_weight_"+e]=c.get("weight"));m.shippingQuantityRate&&(d["shipping_method_price_per_unit_rate_"+e]=m.shippingQuantityRate);b.each(c.options(),function(a,d,c){var g=!0;b.each(m.excludeFromCheckout,
function(a){a===c&&(g=!1)});g&&"weight"!==c&&"tax"!==c&&f.push(c+": "+a)});d["item_description_"+e]=f.join(", ")});return{action:c,method:g,data:d}},SendForm:function(a){if(!a.url)return b.error("URL required for SendForm Checkout");var d={currency:b.currency().code,shipping:b.shipping(),tax:b.tax(),taxRate:b.taxRate(),itemCount:b.find({}).length},c=a.url,g="GET"===a.method?"GET":"POST";b.each(function(a,c){var g=c+1,e=[],f;d["item_name_"+g]=a.get("name");d["item_quantity_"+g]=a.quantity();d["item_price_"+
g]=a.price();b.each(a.options(),function(a,d,c){f=!0;b.each(m.excludeFromCheckout,function(a){a===c&&(f=!1)});f&&e.push(c+": "+a)});d["item_options_"+g]=e.join(", ")});a.success&&(d["return"]=a.success);a.cancel&&(d.cancel_return=a.cancel);a.extra_data&&(d=b.extend(d,a.extra_data));return{action:c,method:g,data:d}}});q={bind:function(a,d){if(!h(d))return this;this._events||(this._events={});var c=a.split(/ +/);b.each(c,function(a){!0===this._events[a]?d.apply(this):e(this._events[a])?this._events[a]=
[d]:this._events[a].push(d)});return this},trigger:function(a,b){var c=!0,g,f;this._events||(this._events={});if(!e(this._events[a])&&h(this._events[a][0]))for(g=0,f=this._events[a].length;g<f;g+=1)c=this._events[a][g].apply(this,b||[]);return!1===c?!1:!0}};q.on=q.bind;b.extend(q);b.extend(b.Item._,q);q={beforeAdd:null,afterAdd:null,load:null,beforeSave:null,afterSave:null,update:null,ready:null,checkoutSuccess:null,checkoutFail:null,beforeCheckout:null,beforeRemove:null};b(q);b.each(q,function(a,
d,c){b.bind(c,function(){h(m[c])&&m[c].apply(this,arguments)})});b.extend({toCurrency:function(a,d){var c=parseFloat(a),g=d||{},g=b.extend(b.extend({symbol:"$",decimal:".",delimiter:",",accuracy:2,after:!1},b.currency()),g),e=c.toFixed(g.accuracy).split("."),c=e[1],e=e[0],e=b.chunk(e.reverse(),3).join(g.delimiter.reverse()).reverse();return(g.after?"":g.symbol)+e+(c?g.decimal+c:"")+(g.after?g.symbol:"")},chunk:function(a,b){"undefined"===typeof b&&(b=2);return a.match(RegExp(".{1,"+b+"}","g"))||[]}});
String.prototype.reverse=function(){return this.split("").reverse().join("")};b.extend({currency:function(a){if(k(a,s)&&!e(D[a]))m.currency=a;else if(k(a,"object"))D[a.code]=a,m.currency=a.code;else return D[m.currency]}});b.extend({bindOutlets:function(a){b.each(a,function(a,c,e){b.bind("update",function(){b.setOutlet("."+x+"_"+e,a)})})},setOutlet:function(a,d){var c=d.call(b,a);k(c,"object")&&c.el?b.$(a).html(" ").append(c):e(c)||b.$(a).html(c)},bindInputs:function(a){b.each(a,function(a){b.setInput("."+
x+"_"+a.selector,a.event,a.callback)})},setInput:function(a,d,c){b.$(a).live(d,c)}});b.ELEMENT=function(a){this.create(a);this.selector=a||null};b.extend(z,{MooTools:{text:function(a){return this.attr("text",a)},html:function(a){return this.attr("html",a)},val:function(a){return this.attr("value",a)},attr:function(a,b){if(e(b))return this.el[0]&&this.el[0].get(a);this.el.set(a,b);return this},remove:function(){this.el.dispose();return null},addClass:function(a){this.el.addClass(a);return this},removeClass:function(a){this.el.removeClass(a);
return this},append:function(a){this.el.adopt(a.el);return this},each:function(a){h(a)&&b.each(this.el,function(b,c,e){a.call(c,c,b,e)});return this},click:function(a){h(a)?this.each(function(b){b.addEvent("click",function(c){a.call(b,c)})}):e(a)&&this.el.fireEvent("click");return this},live:function(a,d){var c=this.selector;h(d)&&b.$("body").el.addEvent(a+":relay("+c+")",function(a,b){d.call(b,a)})},match:function(a){return this.el.match(a)},parent:function(){return b.$(this.el.getParent())},find:function(a){return b.$(this.el.getElements(a))},
closest:function(a){return b.$(this.el.getParent(a))},descendants:function(){return this.find("*")},tag:function(){return this.el[0].tagName},submit:function(){this.el[0].submit();return this},create:function(a){this.el=A(a)}},Prototype:{text:function(a){if(e(a))return this.el[0].innerHTML;this.each(function(b,c){$(c).update(a)});return this},html:function(a){return this.text(a)},val:function(a){return this.attr("value",a)},attr:function(a,b){if(e(b))return this.el[0].readAttribute(a);this.each(function(c,
e){$(e).writeAttribute(a,b)});return this},append:function(a){this.each(function(b,c){a.el?a.each(function(a,b){$(c).appendChild(b)}):y(a)&&$(c).appendChild(a)});return this},remove:function(){this.each(function(a,b){$(b).remove()});return this},addClass:function(a){this.each(function(b,c){$(c).addClassName(a)});return this},removeClass:function(a){this.each(function(b,c){$(c).removeClassName(a)});return this},each:function(a){h(a)&&b.each(this.el,function(b,c,e){a.call(c,c,b,e)});return this},click:function(a){h(a)?
this.each(function(b,c){$(c).observe("click",function(b){a.call(c,b)})}):e(a)&&this.each(function(a,b){$(b).fire("click")});return this},live:function(a,b){if(h(b)){var c=this.selector;f.observe(a,function(a,e){e===A(a).findElement(c)&&b.call(e,a)})}},parent:function(){return b.$(this.el.up())},find:function(a){return b.$(this.el.getElementsBySelector(a))},closest:function(a){return b.$(this.el.up(a))},descendants:function(){return b.$(this.el.descendants())},tag:function(){return this.el.tagName},
submit:function(){this.el[0].submit()},create:function(a){k(a,s)?this.el=A(a):y(a)&&(this.el=[a])}},jQuery:{passthrough:function(a,b){if(e(b))return this.el[a]();this.el[a](b);return this},text:function(a){return this.passthrough("text",a)},html:function(a){return this.passthrough("html",a)},val:function(a){return this.passthrough("val",a)},append:function(a){this.el.append(a.el||a);return this},attr:function(a,b){if(e(b))return this.el.attr(a);this.el.attr(a,b);return this},remove:function(){this.el.remove();
return this},addClass:function(a){this.el.addClass(a);return this},removeClass:function(a){this.el.removeClass(a);return this},each:function(a){return this.passthrough("each",a)},click:function(a){return this.passthrough("click",a)},live:function(a,b){A(f).delegate(this.selector,a,b);return this},parent:function(){return b.$(this.el.parent())},find:function(a){return b.$(this.el.find(a))},closest:function(a){return b.$(this.el.closest(a))},tag:function(){return this.el[0].tagName},descendants:function(){return b.$(this.el.find("*"))},
submit:function(){return this.el.submit()},create:function(a){this.el=A(a)}}});b.ELEMENT._=b.ELEMENT.prototype;b.ready(b.setupViewTool);b.ready(function(){b.bindOutlets({total:function(){return b.toCurrency(b.total())},quantity:function(){return b.quantity()},items:function(a){b.writeCart(a)},tax:function(){return b.toCurrency(b.tax())},taxRate:function(){return b.taxRate().toFixed()},shipping:function(){return b.toCurrency(b.shipping())},grandTotal:function(){return b.toCurrency(b.grandTotal())}});
b.bindInputs([{selector:"checkout",event:"click",callback:function(){b.checkout()}},{selector:"empty",event:"click",callback:function(){b.empty()}},{selector:"increment",event:"click",callback:function(){b.find(b.$(this).closest(".itemRow").attr("id").split("_")[1]).increment();b.update()}},{selector:"decrement",event:"click",callback:function(){b.find(b.$(this).closest(".itemRow").attr("id").split("_")[1]).decrement();b.update()}},{selector:"remove",event:"click",callback:function(){b.find(b.$(this).closest(".itemRow").attr("id").split("_")[1]).remove()}},
{selector:"input",event:"change",callback:function(){var a=b.$(this),d=a.parent(),c=d.attr("class").split(" ");b.each(c,function(c){c.match(/item-.+/i)&&(c=c.split("-")[1],b.find(d.closest(".itemRow").attr("id").split("_")[1]).set(c,a.val()),b.update())})}},{selector:"shelfItem .item_add",event:"click",callback:function(){var a={};b.$(this).closest("."+x+"_shelfItem").descendants().each(function(d,c){var e=b.$(c);e.attr("class")&&e.attr("class").match(/item_.+/)&&!e.attr("class").match(/item_add/)&&
b.each(e.attr("class").split(" "),function(b){var c,d;if(b.match(/item_.+/)){b=b.split("_")[1];c="";switch(e.tag().toLowerCase()){case "input":case "textarea":case "select":d=e.attr("type");if(!d||("checkbox"===d.toLowerCase()||"radio"===d.toLowerCase())&&e.attr("checked")||"text"===d.toLowerCase()||"number"===d.toLowerCase())c=e.val();break;case "img":c=e.attr("src");break;default:c=e.text()}null!==c&&""!==c&&(a[b.toLowerCase()]=a[b.toLowerCase()]?a[b.toLowerCase()]+", "+c:c)}})});b.add(a)}}])});
f.addEventListener?p.DOMContentLoaded=function(){f.removeEventListener("DOMContentLoaded",DOMContentLoaded,!1);b.init()}:f.attachEvent&&(p.DOMContentLoaded=function(){"complete"===f.readyState&&(f.detachEvent("onreadystatechange",DOMContentLoaded),b.init())});(function(){if("complete"===f.readyState)return setTimeout(b.init,1);if(f.addEventListener)f.addEventListener("DOMContentLoaded",DOMContentLoaded,!1),p.addEventListener("load",b.init,!1);else if(f.attachEvent){f.attachEvent("onreadystatechange",
DOMContentLoaded);p.attachEvent("onload",b.init);var a=!1;try{a=null===p.frameElement}catch(d){}f.documentElement.doScroll&&a&&F()}})();return b};p.simpleCart=C()})(window,document);var JSON;JSON||(JSON={});
(function(){function p(e){return 10>e?"0"+e:e}function f(f){e.lastIndex=0;return e.test(f)?'"'+f.replace(e,function(e){var f=C[e];return"string"===typeof f?f:"\\u"+("0000"+e.charCodeAt(0).toString(16)).slice(-4)})+'"':'"'+f+'"'}function s(e,k){var t,n,r,p,z=h,v,l=k[e];l&&"object"===typeof l&&"function"===typeof l.toJSON&&(l=l.toJSON(e));"function"===typeof q&&(l=q.call(k,e,l));switch(typeof l){case "string":return f(l);case "number":return isFinite(l)?String(l):"null";case "boolean":case "null":return String(l);
case "object":if(!l)return"null";h+=y;v=[];if("[object Array]"===Object.prototype.toString.apply(l)){p=l.length;for(t=0;t<p;t+=1)v[t]=s(t,l)||"null";r=0===v.length?"[]":h?"[\n"+h+v.join(",\n"+h)+"\n"+z+"]":"["+v.join(",")+"]";h=z;return r}if(q&&"object"===typeof q)for(p=q.length,t=0;t<p;t+=1)"string"===typeof q[t]&&(n=q[t],(r=s(n,l))&&v.push(f(n)+(h?": ":":")+r));else for(n in l)Object.prototype.hasOwnProperty.call(l,n)&&(r=s(n,l))&&v.push(f(n)+(h?": ":":")+r);r=0===v.length?"{}":h?"{\n"+h+v.join(",\n"+
h)+"\n"+z+"}":"{"+v.join(",")+"}";h=z;return r}}"function"!==typeof Date.prototype.toJSON&&(Date.prototype.toJSON=function(){return isFinite(this.valueOf())?this.getUTCFullYear()+"-"+p(this.getUTCMonth()+1)+"-"+p(this.getUTCDate())+"T"+p(this.getUTCHours())+":"+p(this.getUTCMinutes())+":"+p(this.getUTCSeconds())+"Z":null},String.prototype.toJSON=Number.prototype.toJSON=Boolean.prototype.toJSON=function(){return this.valueOf()});var k=/[\u0000\u00ad\u0600-\u0604\u070f\u17b4\u17b5\u200c-\u200f\u2028-\u202f\u2060-\u206f\ufeff\ufff0-\uffff]/g,
e=/[\\\"\x00-\x1f\x7f-\x9f\u00ad\u0600-\u0604\u070f\u17b4\u17b5\u200c-\u200f\u2028-\u202f\u2060-\u206f\ufeff\ufff0-\uffff]/g,h,y,C={"\b":"\\b","\t":"\\t","\n":"\\n","\f":"\\f","\r":"\\r",'"':'\\"',"\\":"\\\\"},q;"function"!==typeof JSON.stringify&&(JSON.stringify=function(e,f,k){var n;y=h="";if("number"===typeof k)for(n=0;n<k;n+=1)y+=" ";else"string"===typeof k&&(y=k);if((q=f)&&"function"!==typeof f&&("object"!==typeof f||"number"!==typeof f.length))throw Error("JSON.stringify");return s("",{"":e})});
"function"!==typeof JSON.parse&&(JSON.parse=function(e,f){function h(e,k){var n,p,l=e[k];if(l&&"object"===typeof l)for(n in l)Object.prototype.hasOwnProperty.call(l,n)&&(p=h(l,n),void 0!==p?l[n]=p:delete l[n]);return f.call(e,k,l)}var n;e=String(e);k.lastIndex=0;k.test(e)&&(e=e.replace(k,function(e){return"\\u"+("0000"+e.charCodeAt(0).toString(16)).slice(-4)}));if(/^[\],:{}\s]*$/.test(e.replace(/\\(?:["\\\/bfnrt]|u[0-9a-fA-F]{4})/g,"@").replace(/"[^"\\\n\r]*"|true|false|null|-?\d+(?:\.\d*)?(?:[eE][+\-]?\d+)?/g,
"]").replace(/(?:^|:|,)(?:\s*\[)+/g,"")))return n=eval("("+e+")"),"function"===typeof f?h({"":n},""):n;throw new SyntaxError("JSON.parse");})})();
(function(){if(!this.localStorage)if(this.globalStorage)try{this.localStorage=this.globalStorage}catch(p){}else{var f=document.createElement("div");f.style.display="none";document.getElementsByTagName("head")[0].appendChild(f);if(f.addBehavior){f.addBehavior("#default#userdata");var s=this.localStorage={length:0,setItem:function(e,h){f.load("localStorage");e=k(e);f.getAttribute(e)||this.length++;f.setAttribute(e,h);f.save("localStorage")},getItem:function(e){f.load("localStorage");e=k(e);return f.getAttribute(e)},
removeItem:function(e){f.load("localStorage");e=k(e);f.removeAttribute(e);f.save("localStorage");this.length=0},clear:function(){f.load("localStorage");for(var e=0;attr=f.XMLDocument.documentElement.attributes[e++];)f.removeAttribute(attr.name);f.save("localStorage");this.length=0},key:function(e){f.load("localStorage");return f.XMLDocument.documentElement.attributes[e]}},k=function(e){return e.replace(/[^-._0-9A-Za-z\xb7\xc0-\xd6\xd8-\xf6\xf8-\u037d\u37f-\u1fff\u200c-\u200d\u203f\u2040\u2070-\u218f]/g,
"-")};f.load("localStorage");s.length=f.XMLDocument.documentElement.attributes.length}}})();

// Place any jQuery/helper plugins in here.
//
var widgetsCart = document.getElementById("widgets-cart");
var formCart = document.getElementById("form-cart");
var shoppingCart = document.getElementById("shopping-cart");

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
      shoppingCart.style.display = "block";
      formCart.style.width = "80%";
    } else {
      widgetsCart.style.display = "none";
      shoppingCart.style.display = "none";
      formCart.style.width = "98%";
    }
  }
);

simpleCart({
  checkout: {
    type: "SendForm" ,
    url: "http://paulmitch.ru/forma-zakaza/",
    method: "POST"
  }
});
