jQuery(document).ready(function() {
    "use strict";
    jQuery("#bestsell-slider .slider-items").owlCarousel({
        items: 4,
        itemsDesktop: [1024, 3],
        itemsDesktopSmall: [992, 2],
        itemsTablet: [767, 2],
        itemsMobile: [479, 2],
        navigation: !0,
        navigationText: ['<a class="flex-prev"></a>', '<a class="flex-next"></a>'],
        slideSpeed: 500,
        pagination: !1
    }), jQuery("#featured-slider .slider-items").owlCarousel({
        items: 4,
        itemsDesktop: [1024, 3],
        itemsDesktopSmall: [992, 2],
        itemsTablet: [767, 2],
        itemsMobile: [479, 2],
        navigation: !0,
        navigationText: ['<a class="flex-prev"></a>', '<a class="flex-next"></a>'],
        slideSpeed: 500,
        pagination: !1
    }), jQuery("#new-arrivals-slider .slider-items").owlCarousel({
        items: 4,
        itemsDesktop: [1024, 3],
        itemsDesktopSmall: [992, 2],
        itemsTablet: [767, 2],
        itemsMobile: [479, 2],
        navigation: !0,
        navigationText: ['<a class="flex-prev"></a>', '<a class="flex-next"></a>'],
        slideSpeed: 500,
        pagination: !1
    }), jQuery("#brand-logo-slider .slider-items").owlCarousel({
        autoPlay: !0,
        items: 6,
        itemsDesktop: [1024, 4],
        itemsDesktopSmall: [900, 3],
        itemsTablet: [600, 2],
        itemsMobile: [320, 2],
        navigation: !0,
        navigationText: ['<a class="flex-prev"></a>', '<a class="flex-next"></a>'],
        slideSpeed: 500,
        pagination: !1
    }), jQuery("#category-desc-slider .slider-items").owlCarousel({
        autoPlay: !0,
        items: 1,
        itemsDesktop: [1024, 1],
        itemsDesktopSmall: [900, 1],
        itemsTablet: [600, 1],
        itemsMobile: [320, 1],
        navigation: !0,
        navigationText: ['<a class="flex-prev"></a>', '<a class="flex-next"></a>'],
        slideSpeed: 500,
        pagination: !1
    }), jQuery("#related-products-slider .slider-items").owlCarousel({
        items: 4,
        itemsDesktop: [1024, 3],
        itemsDesktopSmall: [900, 3],
        itemsTablet: [768, 2],
        itemsMobile: [360, 2],
        navigation: !0,
        navigationText: ['<a class="flex-prev"></a>', '<a class="flex-next"></a>'],
        slideSpeed: 500,
        pagination: !1
    }), jQuery("#icon-products-slider .slider-items").owlCarousel({
        items: 10,
        itemsDesktop: [1024, 8],
        itemsDesktopSmall: [900, 5],
        itemsTablet: [768, 5],
        itemsTablet: [425, 4],
        itemsMobile: [360, 3],
        navigation: !0,
        pagination: !1
    }), jQuery("#productList-products-slider .slider-items").owlCarousel({
        items: 8,
        itemsDesktop: [1024, 6],
        itemsDesktopSmall: [900, 5],
        itemsTablet: [768, 5],
        itemsMobile: [360, 3],
        navigation: !0,
        pagination: !1
    }), jQuery("#upsell-products-slider .slider-items").owlCarousel({
        items: 4,
        itemsDesktop: [1024, 3],
        itemsDesktopSmall: [900, 3],
        itemsTablet: [768, 2],
        itemsMobile: [360, 2],
        navigation: !0,
        navigationText: ['<a class="flex-prev"></a>', '<a class="flex-next"></a>'],
        slideSpeed: 500,
        pagination: !1
    }), jQuery("#mobile-menu").mobileMenu({
        MenuWidth: 250,
        SlideSpeed: 300,
        WindowsMaxWidth: 767,
        PagePush: !0,
        FromLeft: !0,
        Overlay: !0,
        CollapseMenu: !0,
        ClassName: "mobile-menu"
    }), jQuery(".subDropdown")[0] && jQuery(".subDropdown").on("click", function() {
        jQuery(this).toggleClass("plus"), jQuery(this).toggleClass("minus"), jQuery(this).parent().find("ul").slideToggle()
    }), jQuery.extend(jQuery.easing, {
        easeInCubic: function(e, t, i, a, s) {
            return a * (t /= s) * t * t + i
        },
        easeOutCubic: function(e, t, i, a, s) {
            return a * ((t = t / s - 1) * t * t + 1) + i
        }
    }), jQuery.fn.extend({
        accordion: function() {
            return this.each(function() {})
        }
    }), jQuery(function(e) {
        e(".accordion").accordion(), e(".accordion").each(function(t) {
            var i = e(this).find("li.active");
            i.each(function(t) {
                e(this).children("ul").css("display", "block"), t == i.length - 1 && e(this).addClass("current")
            })
        })
    }), jQuery(".top-cart-contain").mouseenter(function() {
        jQuery(this).find(".top-cart-content").stop(!0, !0).slideDown()
    }), jQuery(".top-cart-contain").mouseleave(function() {
        jQuery(this).find(".top-cart-content").stop(!0, !0).slideUp()
    }), jQuery(window).scroll(function() {
        jQuery(this).scrollTop() > jQuery("header").height() ? jQuery("nav").addClass("sticky-header") : jQuery("nav").removeClass("sticky-header")
    })
}), jQuery.fn.UItoTop = function(e) {
    var t = jQuery.extend({
            text: "",
            min: 200,
            inDelay: 600,
            outDelay: 400,
            containerID: "toTop",
            containerHoverID: "toTopHover",
            scrollSpeed: 1200,
            easingType: "linear"
        }, e),
        i = "#" + t.containerID,
        a = "#" + t.containerHoverID;
    jQuery("body").append('<a href="#" id="' + t.containerID + '">' + t.text + "</a>"), jQuery(i).hide().on("click", function() {
        return jQuery("html, body").animate({
            scrollTop: 0
        }, t.scrollSpeed, t.easingType), jQuery("#" + t.containerHoverID, this).stop().animate({
            opacity: 0
        }, t.inDelay, t.easingType), !1
    }).prepend('<span id="' + t.containerHoverID + '"></span>').hover(function() {
        jQuery(a, this).stop().animate({
            opacity: 1
        }, 600, "linear")
    }, function() {
        jQuery(a, this).stop().animate({
            opacity: 0
        }, 700, "linear")
    }), jQuery(window).scroll(function() {
        var e = jQuery(window).scrollTop();
        void 0 === document.body.style.maxHeight && jQuery(i).css({
            position: "absolute",
            top: jQuery(window).scrollTop() + jQuery(window).height() - 50
        }), e > t.min ? jQuery(i).fadeIn(t.inDelay) : jQuery(i).fadeOut(t.Outdelay)
    })
};
var isTouchDevice = "ontouchstart" in window || navigator.msMaxTouchPoints > 0;
jQuery(window).on("load", function() {
    isTouchDevice && jQuery("#nav a.level-top").on("click", function(e) {
        if (jQueryt = jQuery(this), jQueryparent = jQueryt.parent(), jQueryparent.hasClass("parent")) {
            if (!jQueryt.hasClass("menu-ready")) return jQuery("#nav a.level-top").removeClass("menu-ready"), jQueryt.addClass("menu-ready"), !1;
            jQueryt.removeClass("menu-ready")
        }
    }), jQuery().UItoTop()
});