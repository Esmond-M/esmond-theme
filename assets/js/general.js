jQuery(document).ready(function($) {

    var fixmeTop = jQuery('.site-header').offset().top;
    jQuery(window).scroll(function() {
        var currentScroll = jQuery(window).scrollTop();
        if (currentScroll >= fixmeTop) {
            jQuery(".site-header").last().addClass("scroll-with");

            jQuery('.emTheme-fixedheader-placeholder').css({
                display: 'block'
            });
        } else {

            if (jQuery('.scroll-with').length) {
                jQuery(".site-header").removeClass('scroll-with');
            }
            jQuery('.emTheme-fixedheader-placeholder').css({
                display: 'none'
            });
        }
    });
    jQuery(".about").click(function() {
        jQuery('html, body').animate({
            scrollTop: jQuery("#about").offset().top
        }, 500);
    });
    jQuery(".portfolio").click(function() {
        jQuery('html, body').animate({
            scrollTop: jQuery("#portfolio").offset().top
        }, 500);
    });
    jQuery(".services").click(function() {
        jQuery('html, body').animate({
            scrollTop: jQuery("#services").offset().top
        }, 500);
    });
    var containerEl = document.querySelector('.em-modal-container');

    var mixer = mixitup(containerEl);
});