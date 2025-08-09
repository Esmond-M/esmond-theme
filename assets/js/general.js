jQuery(function($) {
    // Sticky header logic
    var $header = $('.site-header');
    var fixmeTop = $header.offset().top;
    var $placeholder = $('.emTheme-fixedheader-placeholder');

    $(window).on('scroll', function() {
        var currentScroll = $(window).scrollTop();
        if (currentScroll >= fixmeTop) {
            $header.last().addClass('scroll-with');
            $placeholder.show();
        } else {
            $header.removeClass('scroll-with');
            $placeholder.hide();
        }
    });

    // Smooth scroll navigation
    function smoothScrollTo(selector) {
        var $target = $(selector);
        if ($target.length) {
            $('html, body').animate({
                scrollTop: $target.offset().top
            }, 500);
        }
    }

    $('.about').on('click', function() {
        smoothScrollTo('#about');
    });
    $('.portfolio').on('click', function() {
        smoothScrollTo('#portfolio');
    });
    $('.services').on('click', function() {
        smoothScrollTo('#services');
    });

    // Mixitup initialization
    var containerEl = document.querySelector('.em-modal-container');
    if (containerEl) {
        mixitup(containerEl);
    }
});