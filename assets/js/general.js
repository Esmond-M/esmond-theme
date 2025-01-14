jQuery(document).ready(function($) {


// For the sideanv mobile view	
var fixmeTop = jQuery('.site-header').offset().top;
jQuery(window).scroll(function() {
    var currentScroll = jQuery(window).scrollTop();
    if (currentScroll >= fixmeTop) {
      jQuery( ".site-header" ).last().addClass( "scroll-with" );

	  jQuery('.emTheme-fixedheader-placeholder').css({
             display: 'block'
        });
    } 
    else {

        if (jQuery('.scroll-with').length ) {
            jQuery( ".site-header" ).last().removeClass(  );
        }
	  jQuery('.emTheme-fixedheader-placeholder').css({
             display: 'none'
        });		
    }
});
	jQuery( ".emTheme-closebtn" ).click(function() {
        jQuery('#mySidenav').css({
                    width: '0px'
                }); 
});
	
		jQuery( ".emTheme-openbtn" ).click(function() {
        jQuery('#mySidenav').css({
                    width: '250px'
                }); 
});

jQuery(".about").click(function() {
    jQuery('html, body').animate({
        scrollTop: jQuery("#about").offset().top
    }, 2000);
});
jQuery(".portfolio").click(function() {
    jQuery('html, body').animate({
        scrollTop: jQuery("#portfolio").offset().top
    }, 2000);
});
jQuery(".services").click(function() {
    jQuery('html, body').animate({
        scrollTop: jQuery("#services").offset().top
    }, 2000);
});
var containerEl = document.querySelector
('.em-modal-container');

var mixer = mixitup(containerEl);

/*
//Added padding if page content is not bigger than height of monitor
var div = jQuery(".em-page-content").height();
var win = jQuery(window).height();

if ( win <= 1080 ) {
    jQuery(".em-page-content").addClass('em-padding');
}
*/
});