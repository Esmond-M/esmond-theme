jQuery(document).ready(function($) {
	
var fixmeTop = jQuery('.site-header').offset().top;
jQuery(window).scroll(function() {
    var currentScroll = jQuery(window).scrollTop();
    if (currentScroll >= fixmeTop) {
      jQuery('.site-header').css({
             position: 'fixed' ,
             zIndex:'1000' ,
		     width:'100%' ,
		     background: 'white' ,
		     top: '0'
        });
	  jQuery('.emTheme-fixedheader-placeholder').css({
             display: 'block'
        });
    } else {
        jQuery('.site-header').css({
            position: 'relative',
	       
        });
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

});